<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Theme;
use App\Models\VendorTheme;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        // Admin gets management list, Merchant gets themes catalog
        $themes = VendorTheme::orderBy('reorder_id', 'asc')->orderBy('id', 'desc')->get();
        if ($themes->isEmpty()) {
            // Fallback to Theme model if vendor_themes is empty
            $themes = Theme::orderBy('reorder_id', 'asc')->orderBy('id', 'desc')->get();
        }

        $adminUser = User::where('type', 1)->first();
        $adminWhatsapp = @$adminUser->mobile ?? @$adminUser->whatsapp ?? @helper::appdata(1)->mobile ?? '';

        return view('admin.theme.index', compact('themes', 'adminWhatsapp'));
    }

    public function add(Request $request)
    {
        return view('admin.theme.add');
    }

    public function edit(Request $request)
    {
        $theme = VendorTheme::where('id', $request->id)->first();
        if (!$theme) {
            $theme = Theme::where('id', $request->id)->first();
        }
        return view('admin.theme.edit', compact('theme'));
    }

    public function update(Request $request)
    {
        $edittheme = VendorTheme::where('id', $request->id)->first();
        if (!$edittheme) {
            $edittheme = Theme::where('id', $request->id)->first();
        }

        if ($edittheme) {
            $edittheme->name = $request->name;
            $edittheme->preview_link = $request->link ?? $request->preview_link;
            if (isset($edittheme->link)) {
                $edittheme->link = $request->link ?? $request->preview_link;
            }

            if ($request->hasfile('image')) {
                $validator = Validator::make($request->all(), [
                    'image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                ], [
                    "image.image" => trans('messages.enter_image_file'),
                    'image.max' => trans('messages.image_size_message'),
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' MB');
                }

                if (!empty($edittheme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $edittheme->image))) {
                    @unlink(storage_path('app/public/admin-assets/images/theme/' . $edittheme->image));
                }

                $themeImage = 'theme-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->file('image')->move(storage_path('app/public/admin-assets/images/theme/'), $themeImage);
                $edittheme->image = $themeImage;
            }
            $edittheme->save();
        }

        return redirect('admin/themes')->with('success', trans('messages.success'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:' . helper::imagesize() . '|' . helper::imageext(),
        ]);

        $themeImage = '';
        if ($request->hasfile('image')) {
            $themeImage = 'theme-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/theme/'), $themeImage);
        }

        $newVendorTheme = new VendorTheme();
        $newVendorTheme->name = $request->name;
        $newVendorTheme->image = $themeImage;
        $newVendorTheme->preview_link = $request->link ?? $request->preview_link;
        $newVendorTheme->save();

        // Also sync to Theme table for frontend system template selection if needed
        $newTheme = new Theme();
        $newTheme->name = $request->name;
        $newTheme->vendor_id = Auth::user()->id;
        $newTheme->image = $themeImage;
        $newTheme->link = $request->link ?? $request->preview_link;
        $newTheme->save();

        return redirect('admin/themes')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        $vendorTheme = VendorTheme::where('id', $request->id)->first();
        if ($vendorTheme) {
            if (!empty($vendorTheme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $vendorTheme->image))) {
                @unlink(storage_path('app/public/admin-assets/images/theme/' . $vendorTheme->image));
            }
            $vendorTheme->delete();
        }

        $theme = Theme::where('id', $request->id)->first();
        if ($theme) {
            if (!empty($theme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $theme->image))) {
                @unlink(storage_path('app/public/admin-assets/images/theme/' . $theme->image));
            }
            $theme->delete();
        }

        return redirect('admin/themes')->with('success', trans('messages.success'));
    }

    public function reorder_theme(Request $request)
    {
        foreach ($request->order as $order) {
            $vendorTheme = VendorTheme::where('id', $order['id'])->first();
            if ($vendorTheme) {
                $vendorTheme->reorder_id = $order['position'];
                $vendorTheme->save();
            }
            $theme = Theme::where('id', $order['id'])->first();
            if ($theme) {
                $theme->reorder_id = $order['position'];
                $theme->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }

    public function bulk_delete(Request $request)
    {
        foreach ($request->id as $id) {
            $vendorTheme = VendorTheme::where('id', $id)->first();
            if ($vendorTheme) {
                if (!empty($vendorTheme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $vendorTheme->image))) {
                    @unlink(storage_path('app/public/admin-assets/images/theme/' . $vendorTheme->image));
                }
                $vendorTheme->delete();
            }

            $theme = Theme::where('id', $id)->first();
            if ($theme) {
                if (!empty($theme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $theme->image))) {
                    @unlink(storage_path('app/public/admin-assets/images/theme/' . $theme->image));
                }
                $theme->delete();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}