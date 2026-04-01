<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class QuickCallController extends Controller
{
    public function quick_call(Request $request)
    {
        try {
            $request->validate([
                'quick_call_name' => 'required',
                'quick_call_mobile' => 'required',
            ]);

            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }


            $data = Settings::where('vendor_id', $vendor_id)->first();
            // Upload Image
            if ($request->hasFile('quick_call_image')) {
                $file = $request->file("quick_call_image");
                $filename = 'quick-call-' . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move(env('ASSETPATHURL') . 'admin-assets/images/about/', $filename);
                $data->quick_call_image = @$filename;
            }

            $data->quick_call =  isset($request->quick_call) ? 1 : 2;
            $data->quick_call_mobile_view_on_off =  isset($request->quick_call_mobile_view_on_off) ? 1 : 2;
            $data->quick_call_name = $request->quick_call_name;
            $data->quick_call_description = $request->quick_call_description;
            $data->quick_call_mobile = $request->quick_call_mobile;
            $data->quick_call_position = $request->quick_call_position;
            $data->update();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
