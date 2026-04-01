<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class WizzchatController extends Controller
{
    public function wizz_chat_settings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $wizzchatsetting = Settings::where('vendor_id', $vendor_id)->first();
        $wizzchatsetting->wizz_chat_settings = $request->wizz_chat_settings;
        $wizzchatsetting->wizz_chat_on_off = isset($request->wizz_chat_on_off) ? 1 : 2;
        $wizzchatsetting->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}
