<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class XenditController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function xendit(Request $request)
    {
        $gettoken = Payment::select('environment', 'currency', 'public_key')->where('payment_type', '15')->where('vendor_id', '1')->first();
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        Configuration::setXenditKey($gettoken->public_key);
        $params = [
            'external_id' => $orderID,
            'description' => 'Plan Subscription',
            'amount' => $request->amount * 1000,
            'callback_url' =>  $request->successurl,
            'success_redirect_url' => $request->successurl,
        ];
        $apiInstance = new InvoiceApi();

        $Xenditinvoice = $apiInstance->createInvoice($params);

        Session::put('invoicepay', $Xenditinvoice);

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 15);
        session()->put('amount', $request->amount);
        session()->put('payment_id', $orderID);
        session()->put('tran_ref', $Xenditinvoice['id']);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $Xenditinvoice['invoice_url']], 200);
    }

    public function checkpaymentstatus($tran_ref, $vendor_id)
    {
        $gettoken = Payment::select('environment', 'secret_key', 'public_key', 'currency')->where('payment_type', '15')->where('vendor_id', $vendor_id)->first();

        $xendit_api = $gettoken->public_key;
        Configuration::setXenditKey($xendit_api);
        $apiInstance = new InvoiceApi();
        $getInvoice = $apiInstance->getInvoiceById($tran_ref);
        return $getInvoice['status'];
    }

    //  front----------------------------------------------------------------
    public function front_xenditrequest(Request $request)
    {
        try {
            Session::put('sub_total', $request->sub_total);
            Session::put('tax', $request->tax);
            Session::put('tax_name', $request->tax_name);
            Session::put('grand_total', $request->grand_total);
            Session::put('delivery_time', $request->delivery_time);
            Session::put('delivery_date', $request->delivery_date);
            Session::put('delivery_area', $request->delivery_area);
            Session::put('delivery_charge', $request->delivery_charge);
            Session::put('discount_amount', $request->discount_amount);
            Session::put('offer_type', $request->offer_type);
            Session::put('couponcode', $request->couponcode);
            Session::put('order_type', $request->order_type);
            Session::put('address', $request->address);
            Session::put('postal_code', $request->postal_code);
            Session::put('building', $request->building);
            Session::put('landmark', $request->landmark);
            Session::put('notes', $request->notes);
            Session::put('customer_name', $request->customer_name);
            Session::put('customer_email', $request->customer_email);
            Session::put('customer_mobile', $request->customer_mobile);
            Session::put('vendor_id', $request->vendor_id);
            Session::put('payment_type', $request->payment_type);
            Session::put('slug', $request->slug);
            Session::put('successurl', $request->url);
            Session::put('failureurl', $request->failure);
            Session::put('table', $request->table);
            Session::put('tips', $request->tips);
            Session::put('buynow', $request->buynow);
            $gettoken = Payment::select('environment', 'currency', 'public_key')->where('payment_type', '15')->where('vendor_id', $request->vendor_id)->first();

            $failurl = $request->failure;
            $successurl = $request->url;

            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

            Configuration::setXenditKey($gettoken->public_key);
            $params = [
                'external_id' => $orderID,
                'description' => 'SaaS Order',
                'amount' => $request->grand_total * 1000,
                'callback_url' =>  $failurl,
                'success_redirect_url' => $successurl,
            ];
            $apiInstance = new InvoiceApi();

            $Xenditinvoice = $apiInstance->createInvoice($params);

            Session::put('invoicepay', $Xenditinvoice);

            session()->put('payment_id', $orderID);
            session()->put('tran_ref', $Xenditinvoice['id']);


            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $Xenditinvoice['invoice_url'], 'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function xenditrequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $gettoken = Payment::where('payment_type', '15')->where('vendor_id', $request->vendor_id)->first();

            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

            Configuration::setXenditKey($gettoken->public_key);
            $params = [
                'external_id' => $orderID,
                'description' => 'SaaS Order',
                'amount' => $request->grand_total * 1000,
                'callback_url' =>  $failurl,
                'success_redirect_url' => $successurl,
            ];
            $apiInstance = new InvoiceApi();

            $Xenditinvoice = $apiInstance->createInvoice($params);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $Xenditinvoice['invoice_url'], 'successurl' => $successurl, 'failureurl' => $failurl, 'tran_ref' => $Xenditinvoice['id'], 'payment_id' => $orderID], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function checkpaymentstatusapi(Request $request)
    {
        try {
            $status = self::checkpaymentstatus($request->tran_ref, $request->vendor_id);

            return response()->json(['status' => 1, 'message' => $status], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
