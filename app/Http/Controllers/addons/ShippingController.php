<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function add()
    {
        return view('admin.shipping.add');
    }

    public function save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $newshipping = new Shipping();
        $newshipping->vendor_id = $vendor_id;
        $newshipping->area_name = $request->area_name;
        $newshipping->delivery_charge = $request->delivery_charge;
        $newshipping->save();
        return redirect('admin/shipping')->with('success', trans('messages.success'));
    }

    public function edit(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editwork = Shipping::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        return view('admin.shipping.edit', compact('editwork'));
    }

    public function update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editshipping = Shipping::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $editshipping->area_name = $request->area_name;
        $editshipping->delivery_charge = $request->delivery_charge;
        $editshipping->update();
        return redirect('admin/shipping')->with('success', trans('messages.success'));
    }

    public function status_update($id, $status)
    {
        Shipping::where('id', $id)->update(['is_available' => $status]);
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        Shipping::where('id', $request->id)->where('vendor_id', $vendor_id)->delete();
        return redirect('admin/shipping')->with('success', trans('messages.success'));
    }

    public function reorder_shipping(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getshipping = Shipping::where('vendor_id', $vendor_id)->get();
        foreach ($getshipping as $shipping) {
            foreach ($request->order as $order) {
                $shipping = Shipping::where('id', $order['id'])->first();
                $shipping->reorder_id = $order['position'];
                $shipping->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
    public function bulk_delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        foreach ($request->id as $id) {
            Shipping::where('id', $id)->where('vendor_id', $vendor_id)->delete();
        }
       return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}
