<?php

namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Session;

class PayTabController extends Controller
{
    public function paytab(Request $request)
    {
        $gettoken = Payment::select('environment','secret_key','public_key','currency','base_url_by_region')->where('payment_type', '12')->where('vendor_id', '1')->first();
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => $gettoken->base_url_by_region,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{    
            "profile_id": "' . $gettoken->public_key . '",
            "tran_type": "sale",
            "tran_class": "ecom" ,
            "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
            "cart_description": "Plan Subscription",
            "cart_currency": "' . $gettoken->currency . '",
            "cart_amount": "' . round($request->amount, 2). '",
            "callback":  "' . $request->successurl . '",
            "return":  "' . $request->successurl . '"
        }',
        CURLOPT_HTTPHEADER => array(
            'authorization: ' . $gettoken->secret_key . '',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $responseurl = json_decode($response);

        //payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10, paytab : 11
        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 12);
        session()->put('amount', $request->amount);
        session()->put('tran_ref', $responseurl->tran_ref);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $responseurl->redirect_url], 200);
    }

    //  front----------------------------------------------------------------
    public function front_paytabrequest(Request $request)
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
            $getkey = Payment::where('payment_type', '12')->where('vendor_id', $request->vendor_id)->first();

            $failurl = $request->failure;
            $successurl = $request->url;

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $getkey->base_url_by_region,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{    
                "profile_id": "' . $getkey->public_key . '",
                "tran_type": "sale",
                "tran_class": "ecom" ,
                "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
                "cart_description": "SaaS Order",
                "cart_currency": "' . $getkey->currency . '",
                "cart_amount": "' . round($request->grand_total, 2). '",
                "callback": "' . $failurl . '",
                "return": "' . $successurl . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'authorization: ' . $getkey->secret_key . '',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);


            $responseurl = json_decode($response);
            Session::put('tran_ref', $responseurl->tran_ref);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $responseurl->redirect_url ,'successurl' => $successurl, 'failureurl' => $failurl], 200);
            ;
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function paytabrequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::where('payment_name', 'Paytab')->where('vendor_id', $request->vendor_id)->first();

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $getkey->base_url_by_region,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{    
                "profile_id": "' . $getkey->public_key . '",
                "tran_type": "sale",
                "tran_class": "ecom" ,
                "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
                "cart_description": "SaaS Order",
                "cart_currency": "' . $getkey->currency . '",
                "cart_amount": "' . round($request->grand_total, 2). '",
                "callback": "' . $failurl . '",
                "return": "' . $successurl . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'authorization: ' . $getkey->secret_key . '',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            
            $responseurl = json_decode($response);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $responseurl ,'successurl' => $successurl, 'failureurl' => $failurl, 'tran_ref' => $responseurl->tran_ref], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200); 
        }
    }

    public function checkpaymentstatusapi(Request $request)
    {
        try {
            $status = self::checkpaymentstatus($request->tran_ref,$request->vendor_id);
            return response()->json(['status' => 1, 'message' => session()->get('paytab_response'), 'status' => $status], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200); 
        }
    }

    public function checkpaymentstatus($tran_ref,$vendor_id)
    {
        $gettoken = Payment::select('environment','secret_key','public_key','currency','base_url_by_region')->where('payment_name', 'Paytab')->where('vendor_id', $vendor_id)->first();
        // dd($gettoken);
        $curl = curl_init();

        $statuscheckurl = str_replace("request","query",$gettoken->base_url_by_region);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$statuscheckurl",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "profile_id": "'.$gettoken->public_key.'",
            "tran_ref": "'.$tran_ref.'"
          }',
        CURLOPT_HTTPHEADER => array(
            'authorization: ' . $gettoken->secret_key . '',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $result = json_decode($response);
        session()->put('paytab_response', $result->payment_result->response_message);

        return $result->payment_result->response_status;
    }
}
