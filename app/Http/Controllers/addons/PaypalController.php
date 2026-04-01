<?php



namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Session;

class PaypalController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $getpaypal = Payment::where('payment_type', 8)->where('vendor_id', '1')->first();
        if ($getpaypal->environment == 1) {
            $mode = true;
        } else {
            $mode = false;
        }
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($getpaypal->public_key);
        $this->gateway->setSecret($getpaypal->secret_key);
        $this->gateway->setTestMode($mode); //set it to 'false' when go live
    }

    public function paypalrequest(Request $request)
    {
        if ($request->return == "1") {
            session()->put('amount', $request->amount);
            session()->put('plan_id', $request->plan_id);
            //payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10
            session()->put('payment_type', 8);
            session()->put('successurl', $request->successurl);
            session()->put('failureurl', $request->failureurl);
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        }
        if ($request->return == "2") {
            $getpaypal = Payment::where('payment_type', 8)->where('vendor_id', '1')->first();
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => session()->get('amount'),
                    'currency' => $getpaypal->currency,
                    'returnUrl' => session()->get('successurl'),
                    'cancelUrl' => session()->get('failureurl'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return redirect()->back()->with('error', trans('messages.wrong'));
                    // return response()->json(['status' => 0, 'message' => ], 200);

                }
            } catch (Exception $e) {
                return redirect()->back()->with('error', trans('messages.wrong'));
            }
        }
    }

    // front----------------------------------------------------
    // private $gateway;
    public function front_paypalrequest(Request $request)
    {

        if ($request->return == "1") {
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
            Session::put('tablename', $request->tablename);
            Session::put('tips', $request->tips);
            Session::put('buynow', $request->buynow);

            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        }

        if ($request->return == "2") {
            $getpaypal = Payment::where('payment_type', 8)->where('vendor_id', Session::get('vendor_id'))->first();
            if ($getpaypal->environment == 1) {
                $mode = true;
            } else {
                $mode = false;
            }
            $this->gateway = Omnipay::create('PayPal_Rest');
            $this->gateway->setClientId($getpaypal->public_key);
            $this->gateway->setSecret($getpaypal->secret_key);
            $this->gateway->setTestMode($mode); //set it to 'false' when go live
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => session()->get('grand_total'),
                    'currency' => $getpaypal->currency,
                    'returnUrl' => session()->get('successurl'),
                    'cancelUrl' => session()->get('failureurl'),
                ))->send();
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return redirect()->back()->with('error', trans('messages.wrong'));
                }
            } catch (Exception $e) {
                return redirect()->back()->with('error', trans('messages.wrong'));
            }
        }
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => $responseurl->sandbox_init_point], 200);
    }
}
