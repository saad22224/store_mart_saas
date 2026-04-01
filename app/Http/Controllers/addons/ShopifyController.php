<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\helper;
use App\Models\Item;
use App\Models\Variants;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Storage;

class ShopifyController extends Controller
{
    public function index()
    {
        try {

            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }

            $shopify_store_url = helper::appdata($vendor_id)->shopify_store_url;
            $shopify_access_token = helper::appdata($vendor_id)->shopify_access_token;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://$shopify_store_url.myshopify.com/admin/api/2023-07/products.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "X-Shopify-Access-Token: $shopify_access_token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response == false) {
                if (env('Environment') == 'sendbox') {
                    $product = Item::with('variation', 'category_info', 'product_image')->where('vendor_id',  $vendor_id)->get();
                    return view('admin.shopify.index', compact('product'));
                } else {
                    return redirect()->back()->with('error', trans('messages.wrong'));
                }
            } else {
                $product = json_decode($response, true);

                if (isset($product['errors'])) {

                    $errorMessage = $product['errors'];
                    return redirect()->back()->with('error', $errorMessage);
                } else {
                    return view('admin.shopify.index', compact('product'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }

    public function add(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $checkplan = helper::checkplan($vendor_id, '');
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return redirect('admin/shopify-products')->with('error', @$v->original->message);
        }

        $shopify_store_url = helper::appdata($vendor_id)->shopify_store_url;
        $shopify_access_token = helper::appdata($vendor_id)->shopify_access_token;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://$shopify_store_url.myshopify.com/admin/api/2023-07/products.json?ids=$request->id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "X-Shopify-Access-Token: $shopify_access_token"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $products = json_decode($response, true);

        $hiddenVariantOptions = array_map("unserialize", array_unique(array_map("serialize", $products['products'][0]['options'])));

        $variantArray = [];
        foreach ($hiddenVariantOptions as $key => $value) {
            $varnew = [
                'variant_name' => $value['name'],
                'variant_options' => $value['values'],
            ];
            $variantArray[] = $varnew;
        }

        $hiddenVariantOptions = array_map("unserialize", array_unique(array_map("serialize", $variantArray)));

        $check_slug = Item::where('slug', Str::slug($products['products'][0]['title'], '-'))->first();
        if (!empty($check_slug)) {
            $last_id = Item::select('id')->orderByDesc('id')->first()->id;
            $slug = Str::slug($products['products'][0]['title'] . ' ' . $last_id, '-');
        } else {
            $slug = Str::slug($products['products'][0]['title'], '-');
        }

        $price = $request->price;
        $original_price = $request->original_price;

        $product = new Item();

        if ($products['products'][0]['variants'][0]['title'] != 'Default Title') {
            $has_variants = 1;
            foreach ($products['products'][0]['variants'] as $variants) {
                $price = $variants['price'];
                $qty = $variants['inventory_quantity'];
                $original_price = $variants['compare_at_price'];
                break;
            }
        } else {
            $price = $products['products'][0]['variants'][0]['price'];
            $original_price = $products['products'][0]['variants'][0]['compare_at_price'];
            $qty = $products['products'][0]['variants'][0]['inventory_quantity'];
            $has_variants = 0;
        }

        $product->vendor_id = $vendor_id;
        $product->item_name = $products['products'][0]['title'];
        $product->item_price = $price;
        $product->item_original_price = $original_price;
        $product->qty = $qty;
        $product->slug = $slug;
        $product->has_variants = $has_variants;
        $product->variants_json = json_encode($hiddenVariantOptions);
        $product->tax = $request->tax != null ? implode('|', $request->tax) : '';
        $product->description = $products['products'][0]['body_html'];
        $product->save();

        if ($products['products'][0]['variants'][0]['title'] != 'Default Title') {
            foreach ($products['products'][0]['variants'] as $key => $variants) {

                $title_spase = str_replace(' / ', '|', $variants['title']);
                $VariantOption = new Variants();
                $VariantOption->name = $title_spase;
                $VariantOption->item_id = $product->id;
                $VariantOption->price =  $products['products'][0]['variants'][0]['price'];
                $VariantOption->original_price = $variants['compare_at_price'];
                $VariantOption->qty = $variants['inventory_quantity'];
                $VariantOption->stock_management = 2;
                $VariantOption->low_qty = 0;
                if ($variants['inventory_quantity'] > 0) {
                    $VariantOption->stock_management = 1;
                    $VariantOption->low_qty = 10;
                }
                $VariantOption->is_available = 1;
                $VariantOption->save();
            }
        }

        foreach ($products['products'][0]['images'] as $key => $images) {
            $image = $products['products'][0]['images'][$key];
            $src = $image['src'];
            $url =  strtok($src, '?');

            // $imgname = helper::imageresize($url, storage_path('app/public/item'));

            $contents = file_get_contents($url);

            $filename = basename($url);


            $reimage = 'item-' . uniqid() . "." . $filename;

            Storage::put('public/item/' . $reimage, $contents);

            $productimage = new ProductImage();
            $productimage->image = $reimage;
            $productimage->vendor_id =  $vendor_id;
            $productimage->item_id = $product->id;
            $productimage->save();
        }
        return redirect('admin/shopify-products')->with('success', trans('messages.success'));
    }

    public function shopify_category()
    {
        try {

            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }

            $shopify_store_url = helper::appdata($vendor_id)->shopify_store_url;
            $shopify_access_token = helper::appdata($vendor_id)->shopify_access_token;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://$shopify_store_url.myshopify.com/admin/api/2023-07/custom_collections.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "X-Shopify-Access-Token: $shopify_access_token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == false) {
                if (env('Environment') == 'sendbox') {
                    $category = Category::where('vendor_id', $vendor_id)->where('is_deleted', 2)->get();
                    return view('admin.shopify.category', compact('category'));
                } else {
                    return redirect()->back()->with('error', trans('messages.wrong'));
                }
            } else {
                $category = json_decode($response, true);
                if (isset($category['errors'])) {

                    $errorMessage = $category['errors'];
                    return redirect()->back()->with('error', $errorMessage);
                } else {
                    return view('admin.shopify.category', compact('category'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }

    public function add_category(Request $request)
    {
        try {

            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $checkplan = helper::checkplan($vendor_id, '');
            $v = json_decode(json_encode($checkplan));
            if (@$v->original->status == 2) {
                return redirect('admin/shopify-category')->with('error', @$v->original->message);
            }

            $shopify_store_url = helper::appdata($vendor_id)->shopify_store_url;
            $shopify_access_token = helper::appdata($vendor_id)->shopify_access_token;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://$shopify_store_url.myshopify.com/admin/api/2023-07/custom_collections.json?ids=$request->id",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "X-Shopify-Access-Token: $shopify_access_token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $category = json_decode($response, true);

            $check_slug = Category::where('slug', Str::slug($category['custom_collections'][0]['title'], '-'))->first();
            if (!empty($check_slug)) {
                $last_id = Category::select('id')->orderByDesc('id')->first()->id;
                $slug = Str::slug($category['custom_collections'][0]['title'] . ' ' . $last_id, '-');
            } else {
                $slug = Str::slug($category['custom_collections'][0]['title'], '-');
            }
            $savecategory = new Category();
            $savecategory->vendor_id = $vendor_id;
            $savecategory->name = $category['custom_collections'][0]['title'];
            $savecategory->slug = $slug;
            $savecategory->save();

            return redirect('admin/shopify-category/')->with('success', trans('messages.success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
}
