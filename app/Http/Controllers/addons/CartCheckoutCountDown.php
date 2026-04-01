<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class CartCheckoutCountDown extends Controller
{
    public function cart_checkout_countdown(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $data = Settings::where('vendor_id', $vendor_id)->first();
        $data->cart_checkout_countdown =  isset($request->cart_checkout_countdown) ? 1 : 2;
        $data->countdown_message = $request->countdown_message;
        $data->countdown_expired_message = $request->countdown_expired_message;
        $data->countdown_mins = $request->countdown_mins;
        $data->update();

        return redirect()->back()->with('success', trans('messages.success'));
    }
}
