<?php



namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class MercadoPagoController extends Controller
{
    public function mercadorequest(Request $request)
    {
        $gettoken = Payment::where('payment_type', $request->payment_type)->where('vendor_id', 1)->first();
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "items": [
                {
                    "title": "' . trans('labels.plan') . ' : ' . $request->plan_name . '",
                    "description": "' . $request->plan_description . '",
                    "quantity": 1,
                    "unit_price": ' . $request->amount . ',
                }
            ],
            "payer": {
                "name": "' . Auth::user()->name . '",
                "email": "' . Auth::user()->email . '",
            },
            "payment_methods": {
                "installments": 1
            },
            "back_urls": {
                "success": "' . $request->successurl . '",
                "failure": "' . $request->failureurl . '",
                "pending": "' . $request->failureurl . '",
            },
            "auto_return" : "approved",
        }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $gettoken->secret_key . '',
                    'Content-Type: application/json'
                ),
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        $responseurl = json_decode($response);
        if ($gettoken->environment == 1) {
            $redirecturl = $responseurl->sandbox_init_point;
        }
        if ($gettoken->environment == 2) {
            $redirecturl = $responseurl->init_point;
        }

        session()->put('plan_id', $request->plan_id);
        //payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10
        session()->put('payment_type', $request->payment_type);
        session()->put('amount', $request->amount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
    }


    // front------------------------
    public function mercadoorderrequest(Request $request)
    {
        try {
        $gettoken = Payment::select('environment', 'secret_key')->where('payment_type', $request->payment_type)->where('vendor_id', $request->vendor_id)->first();
        // dd($gettoken);

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,    
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "items": [
                {
                    "title": "Item purchase",
                    "description": "Order",
                    "quantity": 1,
                    "unit_price": ' . $request->grand_total . ',
                }
            ],
            "payer": {
                "name": ' . $request->customer_name . ',
                "email": ' . $request->customer_email . ',
            },
            "payment_methods": {
                "installments": 1
            },
            "back_urls": {
                "success": "' . $request->url . '",
                "failure": "' . $request->failure . '",
                "pending": "' . $request->failure . '",
            },
            "auto_return" : "approved",
        }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $gettoken->secret_key . '',
                    'Content-Type: application/json'
                ),
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        $responseurl = json_decode($response);


        if ($gettoken->environment == 1) {
            $redirecturl = $responseurl->sandbox_init_point;
        }
        if ($gettoken->environment == 2) {
            $redirecturl = $responseurl->init_point;
        }
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
        Session::put('table', $request->table);
        Session::put('tablename', $request->tablename);
        Session::put('tips', $request->tips);
        Session::put('buynow', $request->buynow);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $redirecturl], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => $th->getMessage()], 200);
        }

    }

    // api------------------------
    public function mercadorequestapi(Request $request)
    {
        try {
            $gettoken = Payment::select('environment', 'secret_key')->where('payment_type', '7')->where('vendor_id', $request->vendor_id)->first();
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                "items": [
                    {
                        "title": "Item purchase",
                        "description": "Order",
                        "quantity": 1,
                        "unit_price": ' . $request->grand_total . ',
                    }
                ],
                "payer": {
                    "name": ' . $request->user_name . ',
                    "email": ' . $request->user_email . ',
                },
                "payment_methods": {
                    "installments": 1
                },
                "back_urls": {
                    "success": "' . $successurl . '",
                    "failure": "' . $failurl . '",
                    "pending": "' . $failurl . '",
                },
                "auto_return" : "approved",
            }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $gettoken->secret_key . '',
                        'Content-Type: application/json'
                    ),
                )
            );
            $response = curl_exec($curl);
            curl_close($curl);
            $responseurl = json_decode($response);

            if ($gettoken->environment == 1) {
                $redirecturl = $responseurl->sandbox_init_point;
            }
            if ($gettoken->environment == 2) {
                $redirecturl = $responseurl->init_point;
            }

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl, 'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
