<?php

namespace App\Http\Controllers\addons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\Item;
use App\Models\Order;
use App\Models\Settings;
use App\Models\Testimonials;
use Illuminate\Support\Facades\Auth;

class ProductReviewsController extends Controller
{
    public function rattingmodal(Request $request)
    {
        try {
            $host = $_SERVER['HTTP_HOST'];

            if ($host  ==  env('WEBSITE_HOST')) {
                $storeinfo = helper::storeinfo($request->vendor);
                $vdata = $request->vendor_id;
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $storeinfo = Settings::where('custom_domain', $host)->first();
                $vdata = $storeinfo->vendor_id;
            }
            $orders = Order::where('orders.user_id', @Auth::user()->id)->where('orders.vendor_id', $vdata)->join('order_details', 'orders.id', 'order_details.order_id')->where('order_details.item_id', $request->item_id)->where('orders.status_type', '3')->count();
            $rattingcount = Testimonials::where('user_id', @Auth::user()->id)->where('vendor_id', $vdata)->where('item_id', $request->item_id)->count();
            $averagerating = number_format(Testimonials::where('item_id', $request->item_id)->where('vendor_id', $vdata)->avg('star'), 1);
            $getitem = Item::select('id', 'item_name')->where('id', $request->item_id)->where('vendor_id', $vdata)->first();

            $itemreviewdata = Testimonials::with('user_info')->where('vendor_id', $vdata)->where('item_id', $request->item_id)->get();
            $fivestaraverage = Testimonials::where('vendor_id', $vdata)->where('item_id', $request->item_id)->where('star', 5)->count();
            $fourstaraverage = Testimonials::where('vendor_id', $vdata)->where('item_id', $request->item_id)->where('star', 4)->count();
            $threestaraverage = Testimonials::where('vendor_id', $vdata)->where('item_id', $request->item_id)->where('star', 3)->count();
            $twostaraverage = Testimonials::where('vendor_id', $vdata)->where('item_id', $request->item_id)->where('star', 2)->count();
            $onestaraverage = Testimonials::where('vendor_id', $vdata)->where('item_id', $request->item_id)->where('star', 1)->count();
            $html = view('front.product_reviews', compact('storeinfo', 'vdata', 'orders', 'rattingcount', 'averagerating', 'getitem', 'itemreviewdata', 'fivestaraverage', 'fourstaraverage', 'threestaraverage', 'twostaraverage', 'onestaraverage'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, 'message' =>  trans('messages.wrong')], 200);
        }
    }
}
