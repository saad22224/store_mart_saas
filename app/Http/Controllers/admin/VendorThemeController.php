<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorTheme;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Support\Facades\Validator;

class VendorThemeController extends Controller
{
    public function index(Request $request)
    {
        $themes = VendorTheme::orderBy('reorder_id', 'asc')->orderBy('id', 'desc')->get();
        $adminUser = User::where('type', 1)->first();
        $adminWhatsapp = @$adminUser->mobile ?? @$adminUser->whatsapp ?? @helper::appdata(1)->mobile ?? '';

        return view('admin.vendor_themes.index', compact('themes', 'adminWhatsapp'));
    }

    public function add(Request $request)
    {
        return view('admin.vendor_themes.add');
    }

    public function edit(Request $request)
    {
        $theme = VendorTheme::findOrFail($request->id);
        return view('admin.vendor_themes.edit', compact('theme'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:' . helper::imagesize() . '|' . helper::imageext(),
            'preview_link' => 'nullable|url',
        ]);

        $themeImage = '';
        if ($request->hasFile('image')) {
            $themeImage = 'vendor-theme-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/theme/'), $themeImage);
        }

        VendorTheme::create([
            'name' => $request->name,
            'image' => $themeImage,
            'preview_link' => $request->preview_link,
            'is_active' => 1,
        ]);

        return redirect('admin/vendor_themes')->with('success', trans('messages.success'));
    }

    public function update(Request $request)
    {
        $theme = VendorTheme::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'preview_link' => 'nullable|url',
        ]);

        $theme->name = $request->name;
        $theme->preview_link = $request->preview_link;

        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', trans('messages.image_size_message'));
            }

            if (!empty($theme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $theme->image))) {
                @unlink(storage_path('app/public/admin-assets/images/theme/' . $theme->image));
            }

            $themeImage = 'vendor-theme-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/theme/'), $themeImage);
            $theme->image = $themeImage;
        }

        $theme->save();

        return redirect('admin/vendor_themes')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        $theme = VendorTheme::findOrFail($request->id);

        if (!empty($theme->image) && file_exists(storage_path('app/public/admin-assets/images/theme/' . $theme->image))) {
            @unlink(storage_path('app/public/admin-assets/images/theme/' . $theme->image));
        }

        $theme->delete();

        return redirect('admin/vendor_themes')->with('success', trans('messages.success'));
    }
}
