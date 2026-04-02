<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductInquiryController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getinquiries = Contact::with('products')->where('vendor_id', $vendor_id)->whereNot('product_id', null)->orderByDesc('id')->get();
        return view('admin.product_inquiries.index', compact('getinquiries'));
    }

    public function delete(Request $request)
    {
        $data = Contact::where('id', $request->id)->delete();
        if ($data) {
            return redirect('/admin/product_inquiry')->with('success', trans('messages.success'));
        } else {
            return redirect('/admin/product_inquiry')->with('error', trans('messages.wrong'));
        }
    }

    public function change_status(Request $request)
    {
        $inquiry = Contact::find($request->id);
        $inquiry->status = $request->status;
        $inquiry->update();
        return redirect('/admin/product_inquiry')->with('success', trans('messages.success'));
    }

    public function product_inquiry(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->vendor_id = $request->vendor_id;
            $contact->product_id = $request->product_id;
            $contact->name = $request->first_name . ' ' . $request->last_name;
            $contact->email = $request->email;
            $contact->mobile = $request->mobile;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', trans('messages.wrong'));
        }
    }

    public function bulk_delete(Request $request)
    {

        if ($request->id) {
            foreach ($request->id as $id) {
                $data = Contact::where('id', $id)->delete();
            }
            return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
        } else {
            return response()->json(['status' => 0, 'msg' => trans('messages.error')], 200);
        }
    }
}
