<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function mollie(Request $request)
    {
        $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '13')->where('vendor_id', '1')->first();

        // Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

        $payment = Mollie::api()->payments->create([
            'amount' => [
                'currency' => $gettoken->currency, // Type of currency you want to send
                'value' => number_format($request->amount, 2), // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Plan Subscription',
            'redirectUrl' => $request->successurl, // after the payment completion where you to redirect
        ]);

        $payment = Mollie::api()->payments->get($payment->id);

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 13);
        session()->put('amount', $request->amount);
        session()->put('tran_ref', $payment->id);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $payment->getCheckoutUrl()], 200);
    }

    //  front----------------------------------------------------------------
    public function front_mollierequest(Request $request)
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
            $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '13')->where('vendor_id', $request->vendor_id)->first();

            $failurl = $request->failure;
            $successurl = $request->url;

            Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => $gettoken->currency, // Type of currency you want to send
                    'value' => number_format($request->grand_total, 2), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => 'SaaS Order',
                'redirectUrl' => $successurl, // after the payment completion where you to redirect
            ]);

            $payment = Mollie::api()->payments->get($payment->id);

            Session::put('tran_ref', $payment->id);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $payment->getCheckoutUrl(), 'successurl' => $successurl, 'failureurl' => $failurl], 200);;
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function mollierequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '13')->where('vendor_id', $request->vendor_id)->first();

            Mollie::api()->setApiKey($getkey->secret_key); // your mollie test api key

            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => $getkey->currency, // Type of currency you want to send
                    'value' => number_format($request->grand_total, 2), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => 'SaaS Order',
                'redirectUrl' => $successurl, // after the payment completion where you to redirect
            ]);

            $payment = Mollie::api()->payments->get($payment->id);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $payment->getCheckoutUrl(), 'successurl' => $successurl, 'failureurl' => $failurl, 'tran_ref' => $payment->id], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Page redirection after the successfull payment
     *
     * @return Response
     */
    public function checkpaymentstatus($tran_ref, $vendor_id)
    {

        $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '13')->where('vendor_id', $vendor_id)->first();

        Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

        $payment = Mollie::api()->payments->get($tran_ref);
        if ($payment->isPaid()) {
            return "A";
        } else {
            return "C";
        }
    }

    public function checkpaymentstatusapi(Request $request)
    {
        try {
            $status = self::checkpaymentstatus($request->tran_ref, $request->vendor_id);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'status' => $status], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
