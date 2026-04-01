<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;

class PhonepeController extends Controller
{
  public function phoneperequest(Request $request)
  {
    try {
      $gettoken = Payment::select('environment', 'secret_key', 'public_key')->where('payment_type', '11')->where('vendor_id', '1')->first();

      $data = array(
        'merchantId' => $gettoken->public_key,
        'merchantTransactionId' => uniqid(),
        'merchantUserId' => 'MUID' . time(),
        'amount' => $request->amount * 100,
        'redirectUrl' => $request->successurl,
        'redirectMode' => 'POST',
        'callbackUrl' => $request->successurl,
        'mobileNumber' => '9999999999',
        'paymentInstrument' =>
        array(
          'type' => 'PAY_PAGE',
        ),
      );

      $encode = base64_encode(json_encode($data));

      $saltKey = $gettoken->secret_key;
      $saltIndex = 1;

      $string = $encode . '/pg/v1/pay' . $saltKey;
      $sha256 = hash('sha256', $string);

      $finalXHeader = $sha256 . '###' . $saltIndex;

      if ($gettoken->environment == 1) {
        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>
      } else {
        $url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; // <PRODUCTION URL>
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'X-VERIFY: ' . $finalXHeader
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      $rData = json_decode($response);

      //payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10, phonepe : 11, phonepe : 11
      session()->put('plan_id', $request->plan_id);
      session()->put('payment_type', 11);
      session()->put('amount', $request->amount);
      session()->put('offer_code', $request->offer_code);
      session()->put('discount', $request->discount);
      return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->data->instrumentResponse->redirectInfo->url], 200);
    } catch (\Throwable $th) {
      dd($th);
    }
  }

  //  front----------------------------------------------------------------
  public function front_phoneperequest(Request $request)
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
      $gettoken = Payment::where('payment_type', '11')->where('vendor_id', $request->vendor_id)->first();

      $data = array(
        'merchantId' => $gettoken->public_key,
        'merchantTransactionId' => uniqid(),
        'merchantUserId' => 'MUID' . time(),
        'amount' => $request->grand_total * 100,
        'redirectUrl' => session()->get('successurl'),
        'redirectMode' => 'POST',
        'callbackUrl' => session()->get('failureurl'),
        'mobileNumber' => '9999999999',
        'paymentInstrument' =>
        array(
          'type' => 'PAY_PAGE',
        ),
      );

      $encode = base64_encode(json_encode($data));

      $saltKey = $gettoken->secret_key;
      $saltIndex = 1;

      $string = $encode . '/pg/v1/pay' . $saltKey;
      $sha256 = hash('sha256', $string);

      $finalXHeader = $sha256 . '###' . $saltIndex;

      if ($gettoken->environment == 1) {
        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>
      } else {
        $url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; // <PRODUCTION URL>
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'X-VERIFY: ' . $finalXHeader
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $rData = json_decode($response);

      return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $rData->data->instrumentResponse->redirectInfo->url], 200);
    } catch (\Exception $e) {
      dd($e);
      return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
    }
  }

  //  api----------------------------------------------------------------
  public function phoneperequestapi(Request $request)
  {
    try {
      $url = url()->current();
      $my_var = 'phonepecallback';

      $successurl = str_replace("phoneperequest", $my_var, $url);

      $failurl = "https://paymentfailure.com";

      $getkey = Payment::where('payment_type', '11')->where('vendor_id', $request->vendor_id)->first();

      $data = array(
        'merchantId' => $getkey->public_key,
        'merchantTransactionId' => uniqid(),
        'merchantUserId' => 'MUID' . time(),
        'amount' => $request->grand_total * 100,
        'redirectUrl' => $successurl,
        'redirectMode' => 'POST',
        'callbackUrl' => $failurl,
        'mobileNumber' => '9999999999',
        'paymentInstrument' =>
        array(
          'type' => 'PAY_PAGE',
        ),
      );

      $encode = base64_encode(json_encode($data));

      $saltKey = $getkey->secret_key;;
      $saltIndex = 1;

      $string = $encode . '/pg/v1/pay' . $saltKey;
      $sha256 = hash('sha256', $string);

      $finalXHeader = $sha256 . '###' . $saltIndex;

      if ($getkey->environment == 1) {
        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>
      } else {
        $url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; // <PRODUCTION URL>
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'X-VERIFY: ' . $finalXHeader
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $rData = json_decode($response);

      return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->data->instrumentResponse->redirectInfo->url, 'successurl' => $successurl, 'failureurl' => $failurl], 200);
    } catch (\Exception $e) {
      return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
    }
  }
}
