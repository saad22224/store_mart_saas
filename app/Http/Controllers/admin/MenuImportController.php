<?php

namespace App\Http\Controllers\admin;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ProductImage;
use App\Services\MenuVisionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RuntimeException;

class MenuImportController extends Controller
{
    public function __construct(
        protected MenuVisionService $vision
    ) {
    }

    public function showUpload()
    {
        $vendorId = helper::current_vendor_id();
        if (! $this->authorized($vendorId) || ! helper::is_menu_store($vendorId)) {
            return redirect('admin/products')->with('error', trans('messages.menu_import_not_available'));
        }

        $checkplan = helper::checkplan($vendorId, '');
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return redirect('admin/products')->with('error', @$v->original->message);
        }

        return view('admin.product.menu_import.upload', [
            'visionAvailable' => $this->vision->isAvailable(),
            'maxMb' => (int) (helper::appdata('')->image_size ?? 2),
        ]);
    }

    public function process(Request $request)
    {
        $vendorId = helper::current_vendor_id();
        if (! $this->authorized($vendorId) || ! helper::is_menu_store($vendorId)) {
            return redirect('admin/products')->with('error', trans('messages.menu_import_not_available'));
        }

        if (! $this->vision->isAvailable()) {
            return redirect('admin/products/menu-import')
                ->with('error', trans('messages.menu_import_gemini_missing'));
        }

        $maxKb = helper::imagesize();
        $validator = Validator::make($request->all(), [
            'menu_image' => 'required|file|mimes:jpeg,jpg,png,webp|max:'.$maxKb,
        ], [
            'menu_image.max' => trans('messages.image_size_message'),
            'menu_image.mimes' => trans('messages.menu_import_invalid_image'),
        ]);

        if ($validator->fails()) {
            return redirect('admin/products/menu-import')
                ->with('error', $validator->errors()->first());
        }

        try {
            $parsed = $this->vision->extractFromImage($request->file('menu_image'));
        } catch (RuntimeException $e) {
            return redirect('admin/products/menu-import')
                ->with('error', $this->mapVisionError($e->getMessage()));
        } catch (\Throwable $e) {
            report($e);

            return redirect('admin/products/menu-import')
                ->with('error', trans('messages.menu_import_failed'));
        }

        if (empty($parsed['products'])) {
            return redirect('admin/products/menu-import')
                ->with('error', trans('messages.menu_import_no_products'));
        }

        $token = (string) Str::uuid();
        session([
            'menu_import_'.$token => [
                'vendor_id' => $vendorId,
                'categories' => $parsed['categories'],
                'products' => $parsed['products'],
                'raw_text' => $parsed['raw_text'] ?? '',
                'model' => $parsed['model'] ?? '',
                'created_at' => now()->timestamp,
            ],
        ]);

        return redirect('admin/products/menu-import/review/'.$token);
    }

    public function review(string $token)
    {
        $vendorId = helper::current_vendor_id();
        if (! $this->authorized($vendorId) || ! helper::is_menu_store($vendorId)) {
            return redirect('admin/products')->with('error', trans('messages.menu_import_not_available'));
        }

        $payload = session('menu_import_'.$token);
        if (! $payload || (int) ($payload['vendor_id'] ?? 0) !== (int) $vendorId) {
            return redirect('admin/products/menu-import')
                ->with('error', trans('messages.menu_import_session_expired'));
        }

        $categories = Category::where('vendor_id', $vendorId)
            ->where('is_deleted', 2)
            ->where('is_available', 1)
            ->orderBy('reorder_id')
            ->get(['id', 'name']);

        return view('admin.product.menu_import.review', [
            'token' => $token,
            'payload' => $payload,
            'categories' => $categories,
        ]);
    }

    public function confirm(Request $request, string $token)
    {
        $vendorId = helper::current_vendor_id();
        if (! $this->authorized($vendorId) || ! helper::is_menu_store($vendorId)) {
            return redirect('admin/products')->with('error', trans('messages.menu_import_not_available'));
        }

        $lockKey = 'menu_import_lock_'.$token;
        if (session()->has($lockKey)) {
            return redirect('admin/products')->with('error', trans('messages.menu_import_duplicate'));
        }

        $payload = session('menu_import_'.$token);
        if (! $payload || (int) ($payload['vendor_id'] ?? 0) !== (int) $vendorId) {
            return redirect('admin/products/menu-import')
                ->with('error', trans('messages.menu_import_session_expired'));
        }

        // Empty file inputs arrive as UPLOAD_ERR_NO_FILE and fail "file" validation.
        $products = $this->normalizeConfirmProducts($request);

        $validator = Validator::make(['products' => $products], [
            'products' => 'required|array|min:1',
            'products.*.include' => 'nullable',
            'products.*.name' => 'nullable|string|max:190',
            'products.*.description' => 'nullable|string|max:5000',
            'products.*.price' => 'nullable|numeric|min:0',
            'products.*.category_id' => 'nullable|integer',
            'products.*.new_category' => 'nullable|string|max:120',
            'products.*.image' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:'.helper::imagesize(),
        ]);

        if ($validator->fails()) {
            return redirect('admin/products/menu-import/review/'.$token)
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        session([$lockKey => 1]);

        $created = 0;
        $skipped = 0;
        $skipReasons = [
            'no_price' => 0,
            'no_category' => 0,
            'no_name' => 0,
            'duplicate' => 0,
        ];

        try {
            DB::beginTransaction();

            $nextReorder = (int) (Item::where('vendor_id', $vendorId)->max('reorder_id') ?? 0);

            foreach ($products as $row) {
                if (empty($row['include'])) {
                    continue;
                }

                $name = trim((string) ($row['name'] ?? ''));
                if ($name === '') {
                    $skipped++;
                    $skipReasons['no_name']++;
                    continue;
                }

                $priceRaw = $row['price'] ?? null;
                $price = ($priceRaw !== null && $priceRaw !== '') ? (float) $priceRaw : null;
                if ($price === null || $price < 0) {
                    $skipped++;
                    $skipReasons['no_price']++;
                    continue;
                }

                $categoryId = $this->resolveCategoryId($vendorId, $row);
                if (! $categoryId) {
                    $skipped++;
                    $skipReasons['no_category']++;
                    continue;
                }

                $exists = Item::where('vendor_id', $vendorId)
                    ->where('is_deleted', 2)
                    ->where('item_name', $name)
                    ->where('cat_id', (string) $categoryId)
                    ->where('item_price', $price)
                    ->exists();
                if ($exists) {
                    $skipped++;
                    $skipReasons['duplicate']++;
                    continue;
                }

                $slug = $this->uniqueSlug($name);
                $nextReorder++;

                $item = new Item();
                $item->vendor_id = $vendorId;
                $item->cat_id = (string) $categoryId;
                $item->item_name = $name;
                $item->slug = $slug;
                $item->item_price = $price;
                $item->item_original_price = $price;
                $item->description = trim((string) ($row['description'] ?? ''));
                $item->image = 'default.png';
                $item->has_variants = 2;
                $item->variants_json = '';
                $item->stock_management = 2;
                $item->is_available = 1;
                $item->is_deleted = 2;
                $item->is_imported = 1;
                $item->reorder_id = $nextReorder;
                $item->save();

                if (! empty($row['image']) && $row['image'] instanceof \Illuminate\Http\UploadedFile && $row['image']->isValid()) {
                    $imageOptimizationService = app(\App\Services\ImageOptimizationService::class);
                    $reimage = $imageOptimizationService->upload($row['image'], 'item');
                    $item->image = $reimage;
                    $item->save();
                    ProductImage::create([
                        'vendor_id' => $vendorId,
                        'item_id' => $item->id,
                        'image' => $reimage,
                    ]);
                }

                $created++;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->forget($lockKey);
            report($e);

            return redirect('admin/products/menu-import/review/'.$token)
                ->with('error', trans('messages.menu_import_failed'))
                ->withInput();
        }

        if ($created === 0) {
            session()->forget($lockKey);
            $hint = trans('messages.menu_import_nothing_saved');
            if ($skipReasons['no_price'] > 0) {
                $hint = trans('messages.menu_import_missing_prices', ['count' => $skipReasons['no_price']]);
            } elseif ($skipReasons['no_category'] > 0) {
                $hint = trans('messages.menu_import_missing_categories', ['count' => $skipReasons['no_category']]);
            }

            return redirect('admin/products/menu-import/review/'.$token)
                ->with('error', $hint)
                ->withInput();
        }

        session()->forget('menu_import_'.$token);
        session()->forget($lockKey);

        return redirect('admin/products')->with(
            'success',
            trans('messages.menu_import_success', ['count' => $created, 'skipped' => $skipped])
        );
    }

    /**
     * Merge input + uploaded files; drop empty file fields so validation can pass.
     *
     * @return array<int|string, array<string, mixed>>
     */
    protected function normalizeConfirmProducts(Request $request): array
    {
        $products = $request->input('products', []);
        if (! is_array($products)) {
            return [];
        }

        foreach ($products as $i => $row) {
            if (! is_array($row)) {
                unset($products[$i]);
                continue;
            }

            $file = $request->file('products.'.$i.'.image');
            if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                $products[$i]['image'] = $file;
            } else {
                unset($products[$i]['image']);
            }
        }

        return $products;
    }

    protected function resolveCategoryId(int $vendorId, array $row): ?int
    {
        $categoryId = isset($row['category_id']) ? (int) $row['category_id'] : 0;
        if ($categoryId > 0) {
            $owns = Category::where('id', $categoryId)
                ->where('vendor_id', $vendorId)
                ->where('is_deleted', 2)
                ->exists();

            return $owns ? $categoryId : null;
        }

        $newName = trim((string) ($row['new_category'] ?? ''));
        if ($newName === '') {
            return null;
        }

        $existing = Category::where('vendor_id', $vendorId)
            ->where('is_deleted', 2)
            ->where('name', $newName)
            ->first();
        if (! $existing) {
            // Case-insensitive fallback for Latin names; Arabic compared exactly above.
            $existing = Category::where('vendor_id', $vendorId)
                ->where('is_deleted', 2)
                ->get(['id', 'name'])
                ->first(fn ($c) => mb_strtolower((string) $c->name) === mb_strtolower($newName));
        }
        if ($existing) {
            return (int) $existing->id;
        }

        $slugBase = Str::slug($newName, '-') ?: 'category-'.uniqid();
        $slug = $slugBase;
        if (Category::where('slug', $slug)->exists()) {
            $slug = $slugBase.'-'.(Category::max('id') + 1);
        }

        $category = new Category();
        $category->vendor_id = $vendorId;
        $category->name = $newName;
        $category->slug = $slug;
        $category->image = 'default.png';
        $category->is_available = 1;
        $category->is_deleted = 2;
        $category->reorder_id = (int) (Category::where('vendor_id', $vendorId)->max('reorder_id') ?? 0) + 1;
        $category->save();

        return (int) $category->id;
    }

    protected function uniqueSlug(string $name): string
    {
        $base = Str::slug($name, '-') ?: 'item-'.uniqid();
        if (! Item::where('slug', $base)->exists()) {
            return $base;
        }
        $lastId = (int) (Item::max('id') ?? 0);

        return Str::slug($name.' '.$lastId, '-') ?: $base.'-'.$lastId;
    }

    protected function authorized(?int $vendorId): bool
    {
        if (! $vendorId || ! Auth::check()) {
            return false;
        }
        $user = Auth::user();
        if ((int) $user->type === 4) {
            return helper::check_access('role_products', $user->role_id, $vendorId, 'add') == 1;
        }

        return in_array((int) $user->type, [1, 2, 3], true) || (int) $user->id === (int) $vendorId;
    }

    protected function mapVisionError(string $code): string
    {
        $base = explode(':', $code)[0];

        return match ($base) {
            'gemini_not_configured' => trans('messages.menu_import_gemini_missing'),
            'ocr_unsupported_image', 'menu_image_unreadable' => trans('messages.menu_import_invalid_image'),
            'menu_image_too_large' => trans('messages.image_size_message'),
            'menu_import_no_products' => trans('messages.menu_import_no_products'),
            'gemini_bad_json' => trans('messages.menu_import_bad_ai_response'),
            default => trans('messages.menu_import_failed'),
        };
    }
}
