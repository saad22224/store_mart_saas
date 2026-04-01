<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class CartCheckoutProgressBar extends Controller
{
    public function cart_checkout_progressbar(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $data = Settings::where('vendor_id', $vendor_id)->first();
        $data->cart_checkout_progressbar =  isset($request->cart_checkout_progressbar) ? 1 : 2;
        $data->progress_message = $request->progress_message;
        $data->progress_message_end = $request->progress_message_end;
        $data->update();

        return redirect()->back()->with('success', trans('messages.success'));
    }
}
