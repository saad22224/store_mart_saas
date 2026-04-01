<?php
namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pixcel;
class PixcelsettingsController extends Controller
{
    public function pixcel_settings(Request $request)
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $pixcelsettings = Pixcel::where('vendor_id',$vendor_id)->first();
        if($pixcelsettings == null || empty($pixcelsettings))
        {
            $pixcelsettings = new Pixcel();
            $pixcelsettings->vendor_id = $vendor_id;
            $pixcelsettings->facebook_pixcel_id = $request->facebook_pixcel_id;
            $pixcelsettings->twitter_pixcel_id = $request->twitter_pixcel_id;
            $pixcelsettings->linkedin_pixcel_id = $request->linkedin_pixcel_id;
            $pixcelsettings->google_tag_id = $request->googletag_pixcel_id;
            $pixcelsettings->save();
        }
        else
        {
            $pixcelsettings->facebook_pixcel_id = $request->facebook_pixcel_id;
            $pixcelsettings->twitter_pixcel_id = $request->twitter_pixcel_id;
            $pixcelsettings->linkedin_pixcel_id = $request->linkedin_pixcel_id;
            $pixcelsettings->google_tag_id = $request->googletag_pixcel_id;
            $pixcelsettings->update();
        }
        return redirect()->back()->with('success',trans('messages.success'));
    }
}
