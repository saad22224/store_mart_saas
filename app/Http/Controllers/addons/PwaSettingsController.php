<?php
namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
class PwaSettingsController extends Controller
{
    public function pwasettings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
        if ($request->hasfile('app_logo')) {
            $file = $request->file('app_logo');
            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'Upload Error: ' . $file->getErrorMessage());
            }
            
            $path = $file->getRealPath() ?: $file->getPathname();
            if (!$path || !file_exists($path)) {
                return redirect()->back()->with('error', 'Path Error: Temp file does not exist. path=' . $path);
            }

            // try {
            //     $size = @getimagesize($path);
            //     if (!$size) {
            //         return redirect()->back()->with('error', 'Image Error: Not a valid image format.');
            //     }
            //     if ($size[0] != 512 || $size[1] != 512) {
            //         return redirect()->back()->withErrors(['app_logo' => 'يجب أن تكون مقاسات الصورة 512x512 بكسل. (المقاس المرفوع: ' . $size[0] . 'x' . $size[1] . ')'])->withInput();
            //     }
            // } catch (\Throwable $e) {
            //     return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
            // }

            $request->validate([
                "app_logo"     => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            ], [
                "app_logo.image" => trans('messages.enter_image_file'),
            ]);
            if ($settingsdata->app_logo != "default-logo.png" && $settingsdata->app_logo != "" && file_exists(storage_path('app/public/admin-assets/images/about/logo/' . $settingsdata->app_logo))) {
                unlink(storage_path('app/public/admin-assets/images/about/logo/' . $settingsdata->app_logo));
            }
            $logo_name = 'logo-' . uniqid() . '.' . $request->app_logo->getClientOriginalExtension();
            $request->file('app_logo')->move(storage_path('app/public/admin-assets/images/about/logo/'), $logo_name);
            $settingsdata->app_logo = $logo_name;
        }
        $settingsdata->app_name = $request->app_name;
        $settingsdata->app_title = $request->app_title;
        $settingsdata->background_color = $request->background_color;
        $settingsdata->theme_color = $request->theme_color;
        $settingsdata->pwa = isset($request->pwa) ? 1 : 2;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}
