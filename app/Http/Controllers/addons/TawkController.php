<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class TawkController extends Controller
{
    public function tawk_settings(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $tawksetting = Settings::where('vendor_id', $vendor_id)->first();
        $tawksetting->tawk_widget_id = $request->widget_id;
        $tawksetting->tawk_on_off = isset($request->tawk_on_off) ? 1 : 2;
        $tawksetting->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}
