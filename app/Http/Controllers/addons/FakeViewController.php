<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class FakeViewController extends Controller
{
    public function product_fake_view(Request $request)
    {
        $request->validate([
            'fake_view_message' => 'required',
            'min_view_count' => 'required',
            'max_view_count' => 'required',
        ]);

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $data = Settings::where('vendor_id', $vendor_id)->first();
        $data->product_fake_view =  isset($request->product_fake_view) ? 1 : 2;
        $data->fake_view_message = $request->fake_view_message;
        $data->min_view_count = $request->min_view_count;
        $data->max_view_count = $request->max_view_count;
        $data->update();

        return redirect()->back()->with('success', trans('messages.success'));
    }
}
