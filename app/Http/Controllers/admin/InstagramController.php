<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InstagramService;
use Illuminate\Support\Facades\Auth;
use App\Models\InstagramImport;
use App\Models\Item;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Str;

class InstagramController extends Controller
{
    protected $instagramService;

    public function __construct(InstagramService $instagramService)
    {
        $this->instagramService = $instagramService;
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
        ]);

        $response = $this->instagramService->fetchPosts($request->username, $request->maxId);

        if (isset($response['error'])) {
            return response()->json(['status' => 0, 'msg' => $response['error']]);
        }

        return response()->json(['status' => 1, 'data' => $response]);
    }

    public function import(Request $request)
    {
        $vendor_id = Auth::user()->id;
        
        $request->validate([
            'selected_posts' => 'required|array',
            'selected_posts.*.instagram_post_id' => 'required|string',
            'selected_posts.*.item_name' => 'required|string',
            'selected_posts.*.item_price' => 'required|numeric',
            'selected_posts.*.cat_id' => 'required|integer',
        ]);

        try {
            foreach ($request->selected_posts as $post) {
                // Check if already imported
                $exists = InstagramImport::where('instagram_post_id', $post['instagram_post_id'])
                    ->where('vendor_id', $vendor_id)
                    ->first();

                if ($exists) {
                    continue; // Skip already imported posts
                }

                $check_slug = Item::where('slug', Str::slug($post['item_name'], '-'))->first();
                if (!empty($check_slug)) {
                    $last_id = Item::select('id')->orderByDesc('id')->first()->id ?? 1;
                    $slug = Str::slug($post['item_name'] . ' ' . $last_id, '-');
                } else {
                    $slug = Str::slug($post['item_name'], '-');
                }

                // Download image and optimize it
                $image_name = 'default.png';
                if (!empty($post['media_url'])) {
                    try {
                        $imageContent = file_get_contents($post['media_url']);
                        if ($imageContent !== false) {
                            $image_name = 'item-ig-' . uniqid() . '.jpg';
                            $dir = storage_path('app/public/item/');
                            if (!file_exists($dir)) {
                                mkdir($dir, 0777, true);
                            }
                            file_put_contents($dir . $image_name, $imageContent);
                        }
                    } catch (\Exception $e) {
                        \Log::error("Failed to download IG image: " . $e->getMessage());
                    }
                }

                $item = new Item();
                $item->vendor_id = $vendor_id;
                $item->item_name = $post['item_name'];
                $item->slug = $slug;
                $item->item_price = $post['item_price'];
                $item->item_original_price = $post['sale_price'] ?? null;
                $item->qty = $post['stock_quantity'] ?? null;
                $item->sku = $post['sku'] ?? null;
                $item->cat_id = $post['cat_id'];
                $item->description = $post['description'] ?? null;
                $item->image = $image_name;
                $item->is_available = $post['status'] ?? 1;
                $item->is_deleted = 2;
                $item->save();

                if ($image_name != 'default.png') {
                    ProductImage::create([
                        'item_id' => $item->id,
                        'image' => $image_name
                    ]);
                }

                InstagramImport::create([
                    'vendor_id' => $vendor_id,
                    'instagram_post_id' => $post['instagram_post_id'],
                    'item_id' => $item->id,
                    'username' => $post['username'] ?? null,
                    'media_url' => $post['media_url'] ?? null,
                    'caption' => $post['caption'] ?? null,
                ]);
            }

            return response()->json(['status' => 1, 'msg' => trans('messages.success')]);
        } catch (\Exception $e) {
            \Log::error("IG Import Error: " . $e->getMessage());
            return response()->json(['status' => 0, 'msg' => trans('messages.wrong')]);
        }
    }
}
