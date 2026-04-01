<?php

namespace App\Http\Controllers\addons;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Variants;
use App\Models\CustomStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class POSController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $user_id = Auth::user()->vendor_id;
            } else {
                $user_id = Auth::user()->id;
            }
            $session_id = Session::getId();
            $getcategory = Category::where('vendor_id', $user_id)->where('is_available', '=', '1')->where('is_deleted', '2')->orderBy('id', 'ASC')->get();
            $getitem = Item::with(['variation', 'extras', 'product_image'])
                ->select('items.*', DB::raw('(case when carts.item_id is null then 0 else 1 end) as is_cart'), 'carts.id as cart_id', 'carts.qty as cart_qty')
                ->leftJoin('carts', function ($query) use ($session_id) {
                    $query->on('carts.item_id', '=', 'items.id')
                        ->where('carts.session_id', '=', $session_id);
                })
                ->groupBy('items.id', 'carts.item_id')
                ->where('items.vendor_id',  $user_id)->where('items.is_available', '1')->orderBy('items.id', 'ASC')->get();
            $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name', 'variants_price')
                ->where('vendor_id', $user_id)->where('session_id', $session_id)->orderByDesc('id')->get();
            $getcustomerslist = User::where('type', 3)->where('vendor_id',  $user_id)->where('is_deleted', 2)->get();
            $ordersdetails = array();
            $getorderdata = array();
            $cat_id = null;
            $tax_name = [];
            $tax_price = [];
            foreach ($cartitems as $cart) {
                $taxlist =  helper::gettax($cart->tax);
                if (!empty($taxlist)) {
                    foreach ($taxlist as $tax) {
                        if (!empty($tax)) {
                            $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                            $itemTax['tax_name'] = $tax->name;
                            $itemTax['tax'] = $tax->tax;
                            $itemTax['tax_rate'] = $producttax;
                            $itemtaxes[] = $itemTax;

                            if (!in_array($tax->name, $tax_name)) {
                                $tax_name[] = $tax->name;

                                if ($tax->type == 1) {
                                    $price = $tax->tax * $cart->qty;
                                }

                                if ($tax->type == 2) {
                                    $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                                }
                                $tax_price[] = $price;
                            } else {
                                if ($tax->type == 1) {
                                    $price = $tax->tax * $cart->qty;
                                }

                                if ($tax->type == 2) {
                                    $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                                }
                                $tax_price[array_search($tax->name, $tax_name)] += $price;
                            }
                        }
                    }
                }
            }
            $taxArr['tax'] = $tax_name;
            $taxArr['rate'] = $tax_price;
            $customers = User::where('type', 3)->where('vendor_id', $user_id)->get();
            $customers1 = "";

            if ($request->ajax()) {
                if ($request->id != null) {
                    $getitem = Item::with(['variation', 'extras', 'product_image'])->where('vendor_id', $user_id)->where('is_available', '1')->where(DB::Raw("FIND_IN_SET($request->id, items.cat_id)"), '>', 0)->orderBy('id', 'ASC')->get();
                }
                if ($request->keyword != null) {
                    if ($request->id != null) {
                        $getitem = Item::with(['variation', 'extras'])->where('vendor_id', $user_id)->where('is_available', '1')->where(DB::Raw("FIND_IN_SET($request->id, items.cat_id)"), '>', 0)->where('item_name', 'LIKE', '%' . $request->keyword . '%')->orderBy('id', 'ASC')->get();
                    } else {
                        $getitem = Item::with(['variation', 'extras'])->where('vendor_id', $user_id)->where('item_name', 'LIKE', '%' . $request->keyword . '%')->where('is_available', '1')->orderBy('id', 'ASC')->get();
                    }
                }
                $cat_id = $request->id;
                return view('admin.pos.positem', compact('getitem', 'cat_id'));
            } else {
                return view('admin.pos.index', compact('getcategory', 'getitem', 'cat_id', 'customers', 'cartitems', 'customers1', 'getcustomerslist', 'ordersdetails', 'taxArr', 'getorderdata'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }

    public function item_details(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $storeinfo = User::where('id', $vendor_id)->first();
        $item_check = Item::where('slug', $request->slug)->first();
        $getitem = Item::with(['variation', 'extras', 'product_image', 'multi_image'])->select(
            'items.vendor_id',
            'items.id',
            'items.cat_id',
            'items.attribute',
            DB::raw("CONCAT('" . asset('/storage/app/public/item/') . "/', items.image) AS image"),
            DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'),
            'items.image as image_name',
            'items.item_name',
            'items.sku',
            'items.item_price',
            'items.video_url',
            'items.qty',
            'items.item_original_price',
            'items.tax',
            'items.description',
            'items.min_order',
            'items.max_order',
            'attchment_name',
            DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/product') . "/', attchment_file) AS attchment_url"),
            'items.view_count',
            'items.has_variants',
            'items.variants_json',
            'items.stock_management',
            'items.is_available',
            'items.is_deleted',
            'items.top_deals'
        )->leftjoin('testimonials', 'testimonials.item_id', 'items.id')
            ->where('items.slug', $request->slug)
            ->where('items.vendor_id', $vendor_id)->first();

        if (count($getitem['variation']) <= 0) {
            $getitem->item_p = helper::currency_formate($getitem->item_price, $getitem->vendor_id);
            $getitem->item_original_p = helper::currency_formate($getitem->item_original_price, $getitem->vendor_id);
            $getitem->item_original_price = $getitem->item_original_price;
            $getitem->category_name = $getitem->category_name;
        }
        $getitem->variants_json = json_decode($getitem->variants_json, true);
        $raplceid = str_replace('|', ',', $getitem->cat_id);
        $relateditem = Item::with(['variation', 'extras', 'product_image', 'multi_image'])->select('items.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftjoin('testimonials', 'testimonials.item_id', 'items.id')->where('items.vendor_id', @$storeinfo->id)->where('items.is_available', '1')->where('items.id', '!=', $getitem->id)->whereIn('items.cat_id', explode(',', $raplceid))->where('items.is_available', 1)->where('items.is_deleted', 2)->groupBy('items.id')->orderBy('items.reorder_id', 'ASC')->get();
        if ($request->ajax()) {
            $html = view('front.productdetail', compact('getitem', 'storeinfo', 'item_check'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        } else {
            return view('front.detail', compact('getitem', 'relateditem', 'storeinfo', 'item_check'));
        }
    }

    public function addtocart(Request $request)
    {
        try {

            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $item = Item::where('id', $request->id)->first();

            $variant = Variants::where('name', $request->variants_name)->where('item_id', $request->id)->first();

            if ($item->has_variants == 2) {
                $checkcartitem = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $request->id)->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->first();
                $stock_management = $request->stock_management;
            } else {
                $checkcartitem = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $request->id)->where('vendor_id', $vendor_id)->where('variants_id', $request->variants_id)->where('session_id', Session::getId())->first();
                $stock_management = $item->stock_management;
            }

            if ($item->has_variants == 2) {
                if ($checkcartitem->qty != null) {
                    $productqty = 1 + $checkcartitem->qty;
                } else {
                    $productqty = 1;
                }
            } else {
                if ($checkcartitem->qty != null) {
                    $productqty = $request->qty + $checkcartitem->qty;
                } else {
                    $productqty = $request->qty;
                }
            }
            if ($item->has_variants == 2) {
                if ($item->stock_management == 1) {
                    if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {

                        if ($productqty > $item->max_order) {
                            if ($checkcartitem->qty == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $item->max_order], 200);
                            }
                        }
                    }
                    if ($productqty > $request->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            } else {

                if ($variant->stock_management == 1) {
                    if ($variant->min_order != null && $variant->min_order != ""  && $variant->min_order != 0) {
                        if ($productqty < $variant->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order], 200);
                        }
                    }

                    if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {

                        if ($productqty > $variant->max_order) {
                            if ($checkcartitem->qty == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $variant->max_order], 200);
                            }
                        }
                    }
                    if ($productqty > $variant->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            }

            $cart = new Cart;
            if ($item->has_variants == 1) {
                $cartprice = $variant->price;
                $cart->price = (float) $variant->price * (float)$request->qty;
                $cart->variants_price = $variant->price;
                $cart->variants_id = $variant->id;
                $cart->variants_name = $variant->name;
            } else {
                $cartprice = $request->item_price;
                $cart->variants_price = $request->item_price;
                $cart->price = (float)$request->item_price * 1;
            }
            $extra_price = explode('|', $request->extras_price);
            if ($request->extras_price != null || $request->extras_price != "") {
                foreach ($extra_price as $price) {
                    $cartprice  = $cartprice +  $price;
                }
            }

            $cart->session_id = Session::getId();
            $cart->vendor_id = $vendor_id;
            $cart->item_id = $request->id;
            $cart->item_name = $request->name;
            $cart->item_image = $request->image;
            $cart->item_price = $cartprice;
            $cart->tax = $request->tax;
            $cart->extras_id = $request->extras_id;
            $cart->extras_name = $request->extras_name;
            $cart->extras_price = $request->extras_price;
            $cart->qty = $request->qty;
            $cart->save();
            $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name', 'variants_price')
                ->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->orderByDesc('id')->get();

            $tax_name = [];
            $tax_price = [];
            foreach ($cartitems as $cart) {

                $taxlist =  helper::gettax($cart->tax);
                if (!empty($taxlist)) {
                    foreach ($taxlist as $tax) {
                        if (!empty($tax)) {
                            $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                            $itemTax['tax_name'] = $tax->name;
                            $itemTax['tax'] = $tax->tax;
                            $itemTax['tax_rate'] = $producttax;
                            $itemtaxes[] = $itemTax;

                            if (!in_array($tax->name, $tax_name)) {
                                $tax_name[] = $tax->name;

                                if ($tax->type == 1) {
                                    $price = $tax->tax * $cart->qty;
                                }

                                if ($tax->type == 2) {
                                    $price = ($tax->tax / 100) * ($cart->price);
                                }
                                $tax_price[] = $price;
                            } else {
                                if ($tax->type == 1) {
                                    $price = $tax->tax * $cart->qty;
                                }

                                if ($tax->type == 2) {
                                    $price = ($tax->tax / 100) * ($cart->price);
                                }
                                $tax_price[array_search($tax->name, $tax_name)] += $price;
                            }
                        }
                    }
                }
            }

            $taxArr = [
                'tax' => $tax_name,
                'rate' => $tax_price
            ];

            $getcustomerslist = User::where('type', 3)->where('vendor_id',  $vendor_id)->where('is_deleted', 2)->get();
            $ordersdetails = [];
            $cartitemcount = $cartitems->count();

            return response()->json([
                'status' => 1,
                'message' => '',
                'cartitems' => $cartitems,
                'getcustomerslist' => $getcustomerslist,
                'ordersdetails' => $ordersdetails,
                'taxArr' => $taxArr,
                'cartitemcount' => $cartitemcount
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'message' => $e], 400);
        }
    }

    public function qtyupdate(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $cart = Cart::where('id', $request->id)->first();
        if ($request->variant_id == null) {
            $checkcart = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $request->item_id)->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->first();
        } else {
            $checkcart = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $request->item_id)->where('variants_id', $request->variant_id)->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->first();
        }
        if ($request->type == "plus") {

            $totalqty = $checkcart->qty + 1;

            if ($request->variant_id != null || $request->variant_id != 0) {
                $variants = Variants::where('item_id', $request->item_id)->where('id', $request->variant_id)->first();
                if ($variants->stock_management == 1) {
                    if ($variants->min_order != null && $variants->min_order != "" && $variants->min_order != 0) {
                        if ($variants->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $variants->min_order], 200);
                        }
                    }

                    if ($variants->max_order != null && $variants->max_order != "" && $variants->max_order != 0) {
                        if ($variants->max_order < $totalqty) {
                            if ($checkcart->qty  == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . ' ' . $variants->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $variants->max_order], 200);
                            }
                        }
                    }
                    if ($variants->qty < $totalqty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            } elseif ($request->variant_id == null || $request->variant_id == 0) {
                $items = item::where('id', $request->item_id)->where('vendor_id', $vendor_id)->first();
                if ($items->stock_management == 1) {
                    if ($items->min_order != null && $items->min_order != "" && $items->min_order != 0) {
                        if ($items->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $items->min_order], 200);
                        }
                    }
                    if ($items->max_order != null && $items->max_order != "" && $items->max_order != 0) {
                        if ($items->max_order < $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . ' ' . $items->max_order], 200);
                        }
                    }
                    if ($items->qty < $totalqty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            }
            $cart->qty =  $request->qty + 1;
        } else {
            $totalqty = $checkcart->qty - 1;
            if ($request->variant_id != null || $request->variant_id != 0) {
                $variants = Variants::where('item_id', $request->item_id)->where('id', $request->variant_id)->first();
                if ($variants->stock_management == 1) {
                    if ($variants->min_order != null && $variants->min_order != "" && $variants->min_order != 0) {
                        if ($variants->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $variants->min_order], 200);
                        }
                    }
                }
            } else {
                $items = item::where('id', $request->item_id)->where('vendor_id', $vendor_id)->first();
                if ($items->stock_management == 1) {
                    if ($items->min_order != null && $items->min_order != "" && $items->min_order != 0) {
                        if ($items->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $items->min_order], 200);
                        }
                    }
                }
            }
            if ($cart->qty > 1) {
                $cart->qty -= 1;
            }
        }
        $cart->save();
        $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name', 'variants_price')
            ->where('vendor_id',  $vendor_id)->where('session_id', Session::getId())->orderByDesc('id')->get();
        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];
        foreach ($cartitems as $cart) {
            $taxlist =  helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }
        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;

        $ordersdetails = array();
        $customers = User::where('type', 3)->where('vendor_id', $vendor_id)->where('is_deleted', 2)->get();

        if ($request->ajax()) {
            $html = view('admin.pos.cartview', compact('cartitems', 'customers', 'ordersdetails', 'taxArr'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        }
    }

    public function ordernow(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name', 'variants_price')
            ->where('vendor_id', $vendor_id)
            ->where('session_id', Session::getId())
            ->orderByDesc('id')
            ->get();

        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];

        foreach ($cartitems as $cart) {
            $taxlist = helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            } elseif ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            } elseif ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }

        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;

        $ordersdetails = [];
        $customers1 = User::where('id', $request->customerid)->first();

        if ($request->ajax()) {
            $html = view('admin.pos.ordernow', compact('cartitems', 'customers1', 'ordersdetails', 'taxArr', 'itemtaxes'))->render();
            return response()->json(['status' => 1, 'output' => $html,], 200);
        }
    }

    public function deletecart(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if ($request->cart_id != '') {
            Cart::where('id', $request->cart_id)->delete();
        } else {
            $request->session()->forget('discount');
            Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->delete();
        }

        return response()->json(['status' => 1, 'message' => 'Item Deleted!!'], 200);
    }

    public function checkorderitems(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (Auth::user() && Auth::user()->type == 2) {
            $data = Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->get();
        }
        foreach ($data as $cart) {
            if ($cart->variants_id != "" && $cart->variants_id != null) {
                $variant = Variants::where('id', $cart->variants_id)->first();
                $item_name = Item::select('item_name')->where('id', $cart->item_id)->first();
                $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('variants_id', $cart->variants_id)->where('session_id', Session::getId())->first();
                if ($variant->stock_management == 1) {
                    if ($variant->min_order != null && $variant->min_order != ""  && $variant->min_order != 0) {
                        if ($cartqty->qty < $variant->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order . ' ' . '(' . $item_name->item_name . ')'], 200);
                        }
                    }

                    if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {
                        if ($cartqty->qty > $variant->max_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order . ' ' . '(' . $item_name->item_name . ')'], 200);
                        }
                    }
                    if ($cartqty->qty > $variant->qty) {
                        return response()->json(['status' => 0, 'message' => trans($variant->name . 'qty not enough for order !!')], 200);
                    }
                }
                return response()->json(['status' => 1, 'message' => ''], 200);
            } else {
                $item = Item::where('id', $cart->item_id)->first();

                $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $cart->item_id)->where('session_id', Session::getId())->first();
                if ($item->stock_management == 1) {
                    if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                        if ($cartqty->qty < $item->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order . ' ' . '(' . $item->item_name . ')'], 200);
                        }
                    }


                    if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                        if ($cartqty->qty > $item->max_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order . ' ' . '(' . $item->item_name . ')'], 200);
                        }
                    }
                    if ($cartqty->qty > $item->qty) {
                        return response()->json(['status' => 0, 'message' => trans($item->name . 'qty not enough for order !!')], 200);
                    }
                }
                return response()->json(['status' => 1, 'message' => ''], 200);
            }
        }
    }

    public function createorder(Request $request)
    {
        $order_number = "";
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            date_default_timezone_set(helper::appdata($vendor_id)->timezone);
            $vendorinfo = User::where('id', $vendor_id)->first();
            $customerinfo = User::where('id', $request->customer)->first();
            if (Auth::user() && Auth::user()->type == 2 || Auth::user()->type == 4) {
                $data = Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->get();
            }
            foreach ($data as $cart) {
                if ($cart->variants_id != "" && $cart->variants_id != null) {
                    $variant = Variants::where('id', $cart->variants_id)->first();
                    $item_name = Item::select('item_name')->where('id', $cart->item_id)->first();
                    $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('variants_id', $cart->variants_id)->where('session_id', Session::getId())->first();
                    if ($variant->stock_management == 1) {
                        if ($variant->min_order != null && $variant->min_order != ""  && $variant->min_order != 0) {
                            if ($cartqty->qty < $variant->min_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order . ' ' . '(' . $item_name->item_name . ')'], 200);
                            }
                        }

                        if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {
                            if ($cartqty->qty > $variant->max_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order . ' ' . '(' . $item_name->item_name . ')'], 200);
                            }
                        }
                        if ($cartqty->qty > $variant->qty) {
                            return response()->json(['status' => 0, 'message' => trans($variant->name . 'qty not enough for order !!')], 200);
                        }
                    }
                } else {
                    $item = Item::where('id', $cart->item_id)->first();

                    $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('item_id', $cart->item_id)->where('session_id', Session::getId())->first();
                    if ($item->stock_management == 1) {
                        if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                            if ($cartqty->qty < $item->min_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order . ' ' . '(' . $item->item_name . ')'], 200);
                            }
                        }

                        if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                            if ($cartqty->qty > $item->max_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order . ' ' . '(' . $item->item_name . ')'], 200);
                            }
                        }
                        if ($cartqty->qty > $item->qty) {
                            return response()->json(['status' => 0, 'message' => trans($item->item_name . 'qty not enough for order !!')], 200);
                        }
                    }
                }
            }

            if ($data->count() > 0) {
                if (Auth::user()->type == 4) {
                    $vendor_id = Auth::user()->vendor_id;
                } else {
                    $vendor_id = Auth::user()->id;
                }
                //payment_type = COD : 1, Online : 2
                $discount_amount =  $request->discount_amount;

                $address = "";
                if ($discount_amount == "NaN") {
                    $discount_amount = 0;
                } else {
                    $discount_amount = $discount_amount;
                }
                $defaultsatus = CustomStatus::where('vendor_id', $vendor_id)->where('type', 1)->where('order_type', 4)->where('is_available', 1)->where('is_deleted', 2)->first();
                if (empty($defaultsatus) && $defaultsatus == null) {
                    return response()->json(['status' => 0, 'message' => trans('order not placed without default status !!')], 200);
                }
                $getordernumber = Order::select('order_number', 'order_number_digit', 'order_number_start')->where('vendor_id', $vendor_id)->orderBy('id', 'DESC')->first();
                if (empty($getordernumber->order_number_digit)) {
                    $n = helper::appdata($vendor_id)->order_number_start;
                    $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
                } else {
                    if ($getordernumber->order_number_start == helper::appdata($vendor_id)->order_number_start) {
                        $n = (int)($getordernumber->order_number_digit);
                        $newbooking_number = str_pad($n + 1, 0, STR_PAD_LEFT);
                    } else {
                        $n = helper::appdata($vendor_id)->order_number_start;
                        $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
                    }
                }
                $order = new Order;
                $order_number = helper::appdata($vendor_id)->order_prefix . $newbooking_number;
                $order->order_number = $order_number;
                $order->order_number_digit = $newbooking_number;
                $order->order_number_start = helper::appdata($vendor_id)->order_number_start;
                $order->vendor_id = $vendor_id;
                $order->order_number = $order_number;
                $order->payment_type = $request->payment_type;
                $order->sub_total = $request->sub_total;
                $order->tax = $request->tax_rates;
                $order->tax_name = $request->tax_names;
                $order->delivery_date = date('Y-m-d');
                $order->grand_total = $request->grand_total;
                $order->status = $defaultsatus->id;
                $order->status_type = $defaultsatus->type;
                $order->address = $address;
                $order->discount_amount = $discount_amount;
                $order->is_notification = 2;
                $order->order_type = '4';
                $order->order_from = 'pos';
                $order->payment_status = '2';
                $order->customer_name = $request->customer_name;
                $order->customer_email = $request->customer_email;
                $order->mobile = $request->customer_phone;
                $order->order_notes = $request->cart_order_note;
                $order->save();



                $order_id = DB::getPdo()->lastInsertId();
                foreach ($data as $value) {
                    $OrderPro = new OrderDetails();
                    $OrderPro->order_id = $order_id;
                    $OrderPro->item_id = $value['item_id'];
                    $OrderPro->item_name = $value['item_name'];
                    $OrderPro->item_image = $value['item_image'];
                    $OrderPro->extras_id = $value['extras_id'];
                    $OrderPro->extras_name = $value['extras_name'];
                    $OrderPro->extras_price = $value['extras_price'];
                    if ($value['variants_id'] == "") {
                        $OrderPro->price = $value['item_price'];
                        $product = Item::where('id', $value['item_id'])->first();
                        if ($product->stock_management == 1) {
                            $product->qty = (int)$product->qty - (int)$value['qty'];
                            $product->update();
                        }
                    } else {
                        $variant = Variants::where('item_id', $value['item_id'])->where('id', $value['variants_id'])->first();
                        if ($variant->stock_management == 1) {
                            $variant->qty = (int)$variant->qty - (int)$value['qty'];
                            $variant->update();
                        }
                        $OrderPro->price = $value['price'];
                    }
                    $OrderPro->variants_id = $value['variants_id'];
                    $OrderPro->variants_name = $value['variants_name'];
                    $OrderPro->variants_price = $value['variants_price'];
                    $OrderPro->qty = $value['qty'];
                    $OrderPro->save();
                }

                if (Auth::user() && (Auth::user()->type == 2 || Auth::user()->type == 4)) {
                    $data1 = Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->delete();
                }
                $trackurl = URL::to(@$vendorinfo->slug . '/track-order/' . $order_number);
                $checkplan = Transaction::where('vendor_id', $vendorinfo->id)->orderByDesc('id')->first();
                if (!empty($checkplan)) {
                    if ($checkplan->appoinment_limit != -1) {
                        $checkplan->appoinment_limit -= 1;
                        $checkplan->save();
                    }
                }

                $request->session()->forget('discount');
                $url = URL::to('/admin/orders/print/' . $order_number);
                return response()->json(['status' => 1, 'url' => $url], 200);
            } else {
                return response()->json(['status' => 0, 'message' => 'Cart Empty!!'], 200);
            }
        } catch (\Throwable $th) {
            dd($th);
            return $th;
        }
    }

    public function qtycheckurl(Request $request)
    {
        try {
            $cartitems = Cart::select('carts.id', 'carts.item_id', 'carts.item_name', 'carts.item_image', 'carts.item_price', 'carts.extras_name', 'carts.extras_price', 'carts.qty', 'carts.price', 'carts.tax', 'carts.variants_id', 'carts.variants_name', 'carts.variants_price', \DB::raw("GROUP_CONCAT(tax.name) as name"))
                ->leftjoin("tax", \DB::raw("FIND_IN_SET(tax.id,carts.tax)"), ">", \DB::raw("'0'"))
                ->where('carts.vendor_id', @$request->vendor_id)->where('carts.session_id', Session::getId());

            $cartdata = $cartitems->groupBy("carts.id")->get();
            $qtyexist = 0;
            foreach ($cartdata as $cart) {
                if ($cart->variants_id != "" && $cart->variants_id != null) {
                    $variant = Variants::where('id', $cart->variants_id)->first();
                    if ($variant->stock_management == 1) {
                        if ($cart->qty < $variant->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order . 'for' . ' ' . $variant->name], 200);
                        }
                        if ($cart->qty > $variant->max_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order . 'for' . ' ' . $variant->name], 200);
                        }
                        if ($cart->qty > $variant->qty) {
                            $qtyexist = 1;
                        }
                    } else {
                        $qtyexist = 0;
                    }
                } else {
                    $item = Item::where('id', $cart->item_id)->first();
                    if ($item->stock_management == 1) {
                        if ($cart->qty < $item->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order . 'for' . ' ' . $item->item_name], 200);
                        }
                        if ($cart->qty > $item->max_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order . 'for' . ' ' . $item->item_name], 200);
                        }
                        if ($cart->qty > $item->qty) {
                            $qtyexist = 1;
                            // return response()->json(['status' => 0, 'message' => trans($item->item_name . ' qty not enough for order !!')], 200);
                        }
                    } else {
                        $qtyexist = 0;
                    }
                }
            }
            if ($qtyexist == 1) {
                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('labels.out_of_stock_msg') . ' ' . $item->item_name . '' . ($cart->variants_id != null && !empty($variant)) ? '(' . $variant->name . ')' : ''], 200);
            } else {
                return response()->json(['status' => 1, 'message' => ''], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => $th], 400);
        }
    }

    public function getProductsVariantQuantity(Request $request)
    {

        $quantity = $variant_id = 0;
        $price = 0;
        $item = Item::where('id', $request->item_id)->first();
        $variant = Variants::where('item_id', $request->item_id)->where('name',  implode('|', str_replace('_', ' ', $request->name)))->first();
        $quantity = @$variant->qty - (isset($cart[@$variant->id]['qty']) ? $cart[@$variant->id]['qty'] : 0);
        $price = @$variant->price;
        $original_price = @$variant->original_price;
        $variant_id = @$variant->id;
        $min_order = @$variant->min_order;
        $max_order = @$variant->max_order;
        $stock_management = @$variant->stock_management;
        $variants_name = @$request->name;
        if ($item->is_available == 2 || $item->is_deleted == 1) {
            $is_available = 2;
        } else {
            $is_available = @$variant->is_available;
        }
        return response()->json([
            'status' => 1,
            'price' => $price,
            'original_price' => $original_price,
            'quantity' => $quantity,
            'variant_id' => $variant_id,
            'min_order' => $min_order,
            'max_order' => $max_order,
            'stock_management' => $stock_management,
            'variants_name' => $variants_name,
            'is_available' => $is_available
        ], 200);
    }

    public function cartview(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $customers = User::where('type', 3)->where('vendor_id', $vendor_id)->get();

        $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name', 'variants_price')
            ->where('vendor_id', $vendor_id)
            ->where('session_id', Session::getId())
            ->orderByDesc('id')
            ->get();

        $tax_name = [];
        $tax_price = [];
        foreach ($cartitems as $cart) {
            $taxlist =  helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }
        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;


        if ($request->ajax()) {
            $html = view('admin.pos.cartview', compact('cartitems', 'customers', 'taxArr'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        }
    }

    public function cartviewdelete($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function applydiscount(Request $request)
    {
        $discountValue = $request->input('discount');

        $request->session()->put('discount', $discountValue);

        return response()->json([
            'message' => 'Discount applied successfully!',
            'discount' => $discountValue
        ]);
    }

    public function removeDiscount(Request $request)
    {
        $request->session()->forget('discount');
        return response()->json([
            'message' => 'Discount removed successfully!',
            'discount' => 0
        ]);
    }

    public function print(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $getorderdata = Order::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (empty($getorderdata)) {
            abort(404);
        }
        $ordersdetails = OrderDetails::where('order_id', $request->id)->get();
        return view('admin.orders.print', compact('getorderdata', 'ordersdetails'));
    }
}
