<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)) {
            $getcustomerslist = User::where('type', 3)
                ->where('vendor_id', $vendor_id)->where('is_deleted', 2)
                ->get();
        } else {
            $getcustomerslist = User::where('type', 3)->where('is_deleted', 2)->orderBydesc('id')->get();
        }
        return view('admin.customers.index', compact('getcustomerslist'));
    }
    public function add(Request $request)
    {
        return view('admin.customers.add');
    }

    public function save_customer(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $validatoremail = Validator::make(['email' => $request->email], [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('type', 3),
                ]
            ]);
            if ($validatoremail->fails()) {
                return redirect()->back()->with('error', trans('messages.unique_email'));
            }
            $validatormobile = Validator::make(['mobile' => $request->mobile], [
                'mobile' => [
                    'required',
                    'numeric',
                    Rule::unique('users')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('type', 3),
                ]
            ]);
            if ($validatormobile->fails()) {
                return redirect()->back()->with('error', trans('messages.unique_mobile'));
            }
            $newuser = new User();
            $newuser->name = $request->name;
            $newuser->email = $request->email;
            $newuser->password = hash::make($request->password);
            $newuser->mobile = $request->mobile;
            $newuser->type = "3";
            $newuser->login_type = "email";
            $newuser->image = "default.png";
            $newuser->is_available = "1";
            $newuser->is_verified = "1";
            $newuser->vendor_id = $vendor_id;
            $newuser->save();

            return redirect('admin/customers')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect('admin/customers')->with('error', trans('messages.wrong'));
        }
    }

    public function edit($id)
    {
        $getuserdata = User::where('id', $id)->first();
        return view('admin.customers.edit', compact('getuserdata'));
    }

    public function update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $edituser = User::where('id', $request->id)->first();
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('type', 3)->ignore($edituser->id),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('type', 3)->ignore($edituser->id),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }

        $edituser->name = $request->name;
        $edituser->email = $request->email;
        $edituser->mobile = $request->mobile;
        $edituser->update();
        return redirect('admin/customers')->with('success', trans('messages.success'));
    }

    public function status(Request $request)
    {
        User::where('id', $request->id)->update(['is_available' => $request->status]);
        return redirect('admin/customers')->with('success', trans('messages.success'));
    }
    public function orders(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)) {
            $totalorders = Order::where('user_id', $request->id)->where('vendor_id', $vendor_id)->count();
            $totalprocessing = Order::whereIn('status_type', array(1, 2))->where('user_id', $request->id)->where('vendor_id', $vendor_id)->count();
            $totalrevenue = Order::where('status_type', 3)->where('user_id', $request->id)->where('vendor_id', $vendor_id)->sum('grand_total');
            $totalcompleted = Order::where('status_type', 3)->where('user_id', $request->id)->where('vendor_id', $vendor_id)->count();
            $totalcancelled = Order::where('status_type', 4)->where('user_id', $request->id)->where('vendor_id', $vendor_id)->count();
            $getorders = Order::with('vendorinfo')->where('user_id', $request->id)->where('vendor_id', $vendor_id);
        } else {
            $totalorders = Order::where('user_id', $request->id)->count();
            $totalprocessing = Order::whereIn('status_type', array(1, 2))->where('user_id', $request->id)->count();
            $totalrevenue = Order::where('status_type', 3)->where('user_id', $request->id)->sum('grand_total');
            $totalcompleted = Order::where('status_type', 3)->where('user_id', $request->id)->count();
            $totalcancelled = Order::where('status_type', 4)->where('user_id', $request->id)->count();
            $getorders = Order::with('vendorinfo')->where('user_id', $request->id);
        }
        if ($request->has('status') && $request->status != "") {
            if ($request->status == "processing") {
                $getorders = $getorders->whereIn('status_type', array(1, 2));
            }
            if ($request->status == "cancelled") {
                $getorders = $getorders->where('status_type', 4);
            }
            if ($request->status == "delivered") {
                $getorders = $getorders->where('status_type', 3);
            }
        }
        $getorders = $getorders->orderByDesc('id')->get();
        $userinfo = User::select('id', 'name')->where('id', $request->id)->first();
        return view('admin.customers.orders', compact('getorders', 'totalorders', 'totalprocessing', 'totalcompleted', 'totalcancelled', 'totalrevenue', 'userinfo'));
    }
    public function deletecustomer(Request $request)
    {
        User::where('id', $request->id)->update(['is_deleted' => 1]);
        return redirect('admin/customers')->with('success', trans('messages.success'));
    }
    public function bulk_delete_customer(Request $request)
    {
        foreach ($request->id as $id) {
            User::where('id', $id)->update(['is_deleted' => 1]);
        }
        return redirect('admin/customers')->with('success', trans('messages.success'));
    }
}
