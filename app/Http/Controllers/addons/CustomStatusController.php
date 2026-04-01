<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomStatus;
use App\Models\Transaction;
use App\Models\SystemAddons;
use App\Helpers\helper;
use Illuminate\Support\Facades\Auth;

class CustomStatusController extends Controller
{


    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
       
        $status = [];
        if (@helper::checkaddons('subscription')) {
        
            if (@helper::checkaddons('pos')) {
               
                $checkplan = Transaction::where('vendor_id', $vendor_id)
                    ->orderByDesc('id')
                    ->first();
                if (helper::getslug($vendor_id)->allow_without_subscription == 1) {
                    $pos = 1;
                } else {
                    $pos = @$checkplan->pos;
                }
                if ($pos == 1) {
                    $status = CustomStatus::where('vendor_id', $vendor_id)->where('is_deleted', 2)->orderBy('reorder_id')->get();
                }
                else {
                    $status = CustomStatus::where('vendor_id', $vendor_id)->where('order_type', '!=', 4)->where('is_deleted', 2)->orderBy('reorder_id')->get();
                }
            } else {
              $status = CustomStatus::where('vendor_id', $vendor_id)->where('order_type', '!=', 4)->where('is_deleted', 2)->orderBy('reorder_id')->get();
            }
        } elseif (@helper::checkaddons('pos')) {
            $status = CustomStatus::where('vendor_id', $vendor_id)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        } else {
            $status = CustomStatus::where('vendor_id', $vendor_id)->where('order_type', '!=', 4)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        }
        return view('admin.custom_status.index', compact('status'));
    }
    public function edit(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editstatus = CustomStatus::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        return view('admin.custom_status.edit', compact('editstatus'));
    }
    public function update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editstatus = CustomStatus::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if ($request->order_type == 1 &&  $editstatus->order_type != 1) {
            if ($request->status_type == 1) {
                $defaulttatus  = CustomStatus::where('type', 1)->where('order_type', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 3) {
                $completetatus  = CustomStatus::where('type', 3)->where('order_type', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 4) {
                $cancelstatus  = CustomStatus::where('type', 4)->where('order_type', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
        }
        if ($request->order_type == 2 && $editstatus->order_type != 2) {
            if ($request->status_type == 1) {
                $defaulttatus  = CustomStatus::where('type', 1)->where('order_type', 2)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 3) {
                $completetatus  = CustomStatus::where('type', 3)->where('order_type', 2)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 4) {
                $cancelstatus  = CustomStatus::where('type', 4)->where('order_type', 2)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
        }
        if ($request->order_type == 3 && $editstatus->order_type != 3) {
            if ($request->status_type == 1) {
                $defaulttatus  = CustomStatus::where('type', 1)->where('order_type', 3)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 3) {
                $completetatus  = CustomStatus::where('type', 3)->where('order_type', 3)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 4) {
                $cancelstatus  = CustomStatus::where('type', 4)->where('order_type', 3)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
        }
        if ($request->order_type == 4 && $editstatus->order_type != 4) {
            if ($request->status_type == 1) {
                $defaulttatus  = CustomStatus::where('type', 1)->where('order_type', 4)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 3) {
                $completetatus  = CustomStatus::where('type', 3)->where('order_type', 4)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
            if ($request->status_type == 4) {
                $cancelstatus  = CustomStatus::where('type', 4)->where('order_type', 4)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
            }
        }
        if (!empty($defaulttatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } elseif (!empty($completetatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } elseif (!empty($cancelstatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } else {
            $editstatus->vendor_id = $vendor_id;
            $editstatus->type = $request->type;
            $editstatus->name = $request->name;
            $editstatus->order_type = $request->order;
            $editstatus->update();
            return redirect('admin/custom_status')->with('success', trans('messages.success'));
        }
    }
    public function change_status(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $status = CustomStatus::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $status->is_available = $request->status;
        $status->update();
        return redirect('admin/custom_status')->with('success', trans('messages.success'));
    }
    public function reorder_status(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getstatus = CustomStatus::where('vendor_id', $vendor_id)->get();
        foreach ($getstatus as $status) {
            foreach ($request->order as $order) {
                $status = CustomStatus::where('id', $order['id'])->first();
                $status->reorder_id = $order['position'];
                $status->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
    public function add(Request $request)
    {
        return view('admin.custom_status.add');
    }
    public function save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if ($request->status_type == 1) {
            $defaulttatus  = CustomStatus::where('type', 1)->where('order_type', $request->order_type)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
        }
        if ($request->status_type == 3) {
            $completetatus  = CustomStatus::where('type', 3)->where('order_type', $request->order_type)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
        }
        if ($request->status_type == 4) {
            $cancelstatus  = CustomStatus::where('type', 4)->where('order_type', $request->order_type)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->first();
        }
        if (!empty($defaulttatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } elseif (!empty($completetatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } elseif (!empty($cancelstatus)) {
            return redirect()->back()->with('error', trans('messages.already_added_this_status'));
        } else {
            $newstatus = new CustomStatus();
            $newstatus->vendor_id = $vendor_id;
            $newstatus->type = $request->status_type;
            $newstatus->name = $request->name;
            $newstatus->order_type = $request->order_type;
            $newstatus->save();
            return redirect('admin/custom_status')->with('success', trans('messages.success'));
        }
    }
    public function delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $status = CustomStatus::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $status->is_deleted = 1;
        $status->update();
        return redirect('admin/custom_status')->with('success', trans('messages.success'));
    }
}