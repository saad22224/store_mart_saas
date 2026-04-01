<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\helper;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Settings;
use App\Models\TelegramMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TelegramController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $telegramdata = TelegramMessage::where('vendor_id', $vendor_id)->first();
        return view('admin.telegram_message.setting_form', compact('vendor_id', 'telegramdata'));
    }

    public function business_api(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = TelegramMessage::where('vendor_id', $vendor_id)->first();
        if (empty($settingsdata)) {
            $settingsdata = new TelegramMessage();
            $settingsdata->vendor_id = $vendor_id;
        }
        $settingsdata->telegram_access_token = $request->telegram_access_token;
        $settingsdata->telegram_chat_id = $request->telegram_chat_id;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function order_message_update(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $order_message = TelegramMessage::where('vendor_id', $vendor_id)->first();
            if (empty($order_message)) {
                $order_message = new TelegramMessage();
                $order_message->vendor_id = $vendor_id;
            }
            $order_message->item_message = $request->item_message;
            $order_message->telegram_message = $request->telegram_message;
            $order_message->order_created = isset($request->order_created) ? 1 : 2;
            $order_message->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function telegram(Request $request)
    {
        try {
            $order_number = $request->order_number;
            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $storeinfo = helper::storeinfo($request->vendor);
                $vdata = $storeinfo->id;
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $storeinfo = Settings::where('custom_domain', $host)->first();
                $vdata = $storeinfo->vendor_id;
            }
            $pagee[] = "";
            $payment_status = "";
            $orderdata = Order::where('order_number', $order_number)->first();
            if ($orderdata->payment_status == "1") {
                $payment_status = trans('labels.unpaid');
            }
            if ($orderdata->payment_status == "2") {
                $payment_status = trans('labels.paid');
            }
            if ($orderdata->delivery_charge > 0) {
                $delivery_charge = helper::currency_formate($orderdata->delivery_charge, $storeinfo->id);
            } else {
                $delivery_charge = trans('labels.free');
            }

            $data = OrderDetails::where('order_id', $orderdata->id)->get();
            foreach ($data as $value) {
                if ($value['variants_id'] != "") {
                    $variantsdata = '(' . $value['variants_name'] . ')';
                } else {
                    $variantsdata = "";
                }
                $item_message = helper::telegramdata($vdata)->item_message;
                $itemvar = ["{qty}", "{item_name}", "{variantsdata}", "{item_price}", "{total}"];
                $newitemvar = [$value['qty'], $value['item_name'], $variantsdata, helper::currency_formate($value->price, $storeinfo->id), helper::currency_formate($value->price * $value['qty'], $storeinfo->id)];
                $pagee[] = str_replace($itemvar, $newitemvar, $item_message);

                $extras_id = explode("|", $value['extras_id']);
                $extras_name = explode("|", $value['extras_name']);
                $extras_price = explode("|", $value['extras_price']);
                if ($value['extras_id'] != "") {
                    foreach ($extras_id as $key =>  $addons) {
                        $pagee[] .= "       👉" . $extras_name[$key] . ' : ' . helper::currency_formate($extras_price[$key], $vdata);
                    }
                }
            }
            $items = implode("|", $pagee);
            $itemlist = str_replace('|', "\n", $items);

            $tax = explode("|", $orderdata['tax']);
            $tax_name = explode("|", $orderdata['tax_name']);

            $tax_data[] = "";
            if ($tax != "") {
                foreach ($tax as $key => $tax_value) {
                    @$tax_data[] .= "👉" . $tax_name[$key] . ' : ' . helper::currency_formate((float)$tax[$key], $vdata);
                }
            }

            $tdata = implode("|", $tax_data);
            $tax_val = str_replace('|', "\n", $tdata);

            if ($orderdata->order_type == 1) {
                $order_type = trans('labels.delivery');
            } else {
                $order_type = trans('labels.pickup');
            }

            $var = ["{delivery_type}", "{order_no}", "{item_variable}", "{tips}", "{sub_total}", "{total_tax}", "{delivery_charge}", "{discount_amount}", "{grand_total}", "{notes}", "{customer_name}", "{customer_email}", "{customer_mobile}", "{address}", "{building}", "{landmark}", "{postal_code}", "{date}", "{time}", "{payment_type}", "{payment_status}", "{store_name}", "{track_order_url}", "{store_url}"];
            $newvar = [$order_type, $order_number, $itemlist, helper::currency_formate($orderdata->tips, $vdata), helper::currency_formate($orderdata->sub_total, $vdata), $tax_val, $delivery_charge, helper::currency_formate($orderdata->discount_amount, $vdata), helper::currency_formate($orderdata->grand_total, $vdata), $orderdata->order_notes, $orderdata->customer_name, $orderdata->customer_email, $orderdata->mobile, $orderdata->address, $orderdata->building, $orderdata->landmark, $orderdata->pincode, $orderdata->delivery_date, $orderdata->delivery_time, helper::getpayment($orderdata->payment_type, $orderdata->vendor_id)->payment_name, $payment_status, $storeinfo->name, URL::to(@$storeinfo->slug . "/find-order?order=" . $order_number), URL::to(@$storeinfo->slug)];
            $telegrammessage = str_replace($var, $newvar, helper::telegramdata($vdata)->telegram_message);

            $apiToken = helper::telegramdata($vdata)->telegram_access_token;
            $chatIds = array(helper::telegramdata($vdata)->telegram_chat_id); // AND SOME MORE
            $data = [
                'text' => $telegrammessage
            ];
            foreach ($chatIds as $chatId) {
                // Send Message To chat id
                file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&" . http_build_query($data));
            }
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }

    // api===========================================================
    public function telegram_msg(Request $request)
    {
        try {

            if ($request->vendor_id == "") {
                return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
            }
            if ($request->order_number == "") {
                return response()->json(["status" => 0, "message" => trans('messages.order_number_required')], 400);
            }

            $order_number = $request->order_number;
            $storeinfo = User::where('id', $request->vendor_id)->first();

            $pagee[] = "";
            $orderdata = Order::where('order_number', $order_number)->first();
            $data = OrderDetails::where('order_id', $orderdata->id)->get();
            foreach ($data as $value) {
                if ($value['variants_id'] != "") {
                    $item_p = $value['qty'] * $value['price'];
                    $variantsdata = '(' . $value['variants_name'] . ')';
                } else {
                    $variantsdata = "";
                    $item_p = $value['qty'] * $value['price'];
                }
                $extras_id = explode("|", $value['extras_id']);
                $extras_name = explode("|", $value['extras_name']);
                $extras_price = explode("|", $value['extras_price']);
                $item_message = helper::appdata($storeinfo->id)->item_message;
                $itemvar = ["{qty}", "{item_name}", "{variantsdata}", "{item_price}"];
                $newitemvar = [$value['qty'], $value['item_name'], $variantsdata, helper::currency_formate($item_p, $storeinfo->id)];
                $pagee[] = str_replace($itemvar, $newitemvar, $item_message);
                if ($value['extras_id'] != "") {
                    foreach ($extras_id as $key => $addons) {
                        @$pagee[] .= "👉" . $extras_name[$key] . ':' . helper::currency_formate($extras_price[$key], $storeinfo->id) . '%0a';
                    }
                }
            }
            $items = implode(",", $pagee);


            $itemlist = str_replace(',', "\n", $items);
            if ($orderdata->order_type == 1) {
                $order_type = trans('labels.delivery');
            } else {
                $order_type = trans('labels.pickup');
            }
            //payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10

            $var = ["{delivery_type}", "{order_no}", "{item_variable}", "{sub_total}", "{total_tax}", "{delivery_charge}", "{discount_amount}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{address}", "{building}", "{landmark}", "{postal_code}", "{date}", "{time}", "{payment_type}", "{store_name}", "{track_order_url}", "{store_url}"];
            $newvar = [$order_type, $order_number, $itemlist, helper::currency_formate($orderdata->sub_total, $storeinfo->id), helper::currency_formate($orderdata->tax, $storeinfo->id), helper::currency_formate($orderdata->delivery_charge, $storeinfo->id), helper::currency_formate($orderdata->discount_amount, $storeinfo->id), helper::currency_formate($orderdata->grand_total, $storeinfo->id), $orderdata->order_notes, $orderdata->customer_name, $orderdata->mobile, $orderdata->address, $orderdata->building, $orderdata->landmark, $orderdata->postal_code, $orderdata->delivery_date, $orderdata->delivery_time, @helper::getpayment($orderdata->payment_type, $storeinfo->id)->payment_name, $storeinfo->name, URL::to($storeinfo->slug . "/find-order/?order=" . $order_number), URL::to($storeinfo->slug)];

            $telegrammessage = str_replace($var, $newvar, helper::appdata($storeinfo->id)->telegram_message);

            $apiToken = helper::appdata($storeinfo->id)->telegram_access_token;
            $chatIds = array(helper::appdata($storeinfo->id)->telegram_chat_id); // AND SOME MORE
            $data = [
                'text' => $telegrammessage
            ];
            foreach ($chatIds as $chatId) {
                // Send Message To chat id
                file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&" . http_build_query($data));
            }
            return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => trans('messages.wrong')], 400);
        }
    }
}
