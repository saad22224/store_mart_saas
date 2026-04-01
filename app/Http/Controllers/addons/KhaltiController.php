<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KhaltiController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function khalti(Request $request)
    {
        $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '14')->where('vendor_id', '1')->first();

        if ($gettoken->environment == 1) {
            $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
        } else {
            $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "return_url": "' . $request->successurl . '",
            "website_url": "' . $request->successurl . '",
            "amount": "' . $request->amount * 1000 . '",
            "purchase_order_id": "' . time() . '",
            "purchase_order_name": "Plan Subscription"
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: key ' . $gettoken->secret_key,
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 14);
        session()->put('amount', $request->amount);
        session()->put('tran_ref', $rData->pidx);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->payment_url], 200);
    }

    //  front----------------------------------------------------------------
    public function front_khaltirequest(Request $request)
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

            $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '14')->where('vendor_id', $request->vendor_id)->first();

            $failurl = $request->failure;
            $successurl = $request->url;

            if ($gettoken->environment == 1) {
                $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
            } else {
                $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "return_url": "' . $successurl . '",
                "website_url": "' . $failurl . '",
                "amount": "' . $request->grand_total * 1000 . '",
                "purchase_order_id": "' . time() . '",
                "purchase_order_name": "SaaS Order"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key ' . $gettoken->secret_key,
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $rData = json_decode($response);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $rData->payment_url, 'successurl' => $successurl, 'failureurl' => $failurl], 200);;
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function khaltirequestapi(Request $request)
    {
        try {

            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::select('environment', 'currency', 'secret_key')->where('payment_name', 'khalti')->where('vendor_id', $request->vendor_id)->first();

            if ($getkey->environment == 1) {
                $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
            } else {
                $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "return_url": "' . $successurl . '",
                "website_url": "' . $failurl . '",
                "amount": "' . $request->grand_total * 1000 . '",
                "purchase_order_id": "' . time() . '",
                "purchase_order_name": "SaaS Order"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key ' . $getkey->secret_key,
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $rData = json_decode($response);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->payment_url, 'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    public function gettransactionid(Request $request)
    {
        try {
            parse_str(parse_url($request->url)['query'], $params);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'transaction_id' => $params['transaction_id']], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
