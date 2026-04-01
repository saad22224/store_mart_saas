<?php

namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class ToyyibpayController extends Controller
{
      public function toyyibpayrequest(Request $request)
    {
        $gettoken = Payment::select('environment','secret_key','public_key')->where('payment_type', $request->payment_type)->where('vendor_id', '1')->first();
        $some_data = array(
            'userSecretKey'=>$gettoken->secret_key,
            'categoryCode'=>$gettoken->public_key,
            'billName'=>Auth::user()->name,
            'billDescription'=>"Plan Subscription",
            'billPriceSetting'=>1,
            'billPayorInfo'=>0,
            'billAmount'=>$request->amount*100,
            'billReturnUrl'=>$request->successurl,
            'billCallbackUrl'=>$request->successurl,
            'billExternalReferenceNo' => '',
            'billTo'=>'',
            'billEmail'=>'',
            'billPhone'=>'',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>0,
            'billContentEmail'=>'Thank you for using our platform!',
            'billChargeToCustomer'=>""
          );  
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill/');  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result = curl_exec($curl);
        curl_close($curl);
        $obj = json_decode($result);
        
        if($gettoken->environment == 1) {
            $redirecturl = "https://dev.toyyibpay.com/".$obj[0]->BillCode;
        } else {
            $redirecturl = "https://toyyibpay.com/".$obj[0]->BillCode;
        }
//payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10
        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', $request->payment_type);
        session()->put('amount', $request->amount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
    }

    //  front----------------------------------------------------------------
    public function front_toyyibpayrequest(Request $request)
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
            Session::put('tablename', $request->tablename);
            $getkey = Payment::where('payment_type',$request->payment_type)->where('vendor_id', $request->vendor_id)->first();
            $some_data = array(
                'userSecretKey' => $getkey->secret_key,
                'categoryCode' => $getkey->public_key,
                'billName' => $request->customer_name,
                'billDescription' => "Order",
                'billPriceSetting' => 1,
                'billPayorInfo' => 0,
                'billAmount' => $request->grand_total * 100,
                'billReturnUrl' => $request->url,
                'billCallbackUrl' => $request->failure,
                'billExternalReferenceNo' => '',
                'billTo' => '',
                'billEmail' => '',
                'billPhone' => '',
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
                'billContentEmail' => 'Thank you for using our platform!',
                'billChargeToCustomer' => ""
            );
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill/');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
            $result = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($result);
            if ($getkey->environment == 1) {
                $redirecturl = "https://dev.toyyibpay.com/" . $obj[0]->BillCode;
            } else {
                $redirecturl = "https://toyyibpay.com/" . $obj[0]->BillCode;
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $redirecturl], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function toyyibpayrequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::where('payment_type', 10)->where('vendor_id', $request->vendor_id)->first();
            $some_data = array(
                'userSecretKey' => $getkey->secret_key,
                'categoryCode' => $getkey->public_key,
                'billName' => $request->user_name,
                'billDescription' => "Order",
                'billPriceSetting' => 1,
                'billPayorInfo' => 0,
                'billAmount' => $request->grand_total * 100,
                'billReturnUrl' => $successurl,
                'billCallbackUrl' => $failurl,
                'billExternalReferenceNo' => '',
                'billTo' => '',
                'billEmail' => '',
                'billPhone' => '',
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
                'billContentEmail' => 'Thank you for using our platform!',
                'billChargeToCustomer' => ""
            );
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill/');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
            $result = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($result);
            if ($getkey->environment == 1) {
                $redirecturl = "https://dev.toyyibpay.com/" . $obj[0]->BillCode;
            } else {
                $redirecturl = "https://toyyibpay.com/" . $obj[0]->BillCode;
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl ,'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200); 
        }
    }
}
