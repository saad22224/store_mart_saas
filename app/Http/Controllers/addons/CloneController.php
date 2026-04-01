<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\helper;
use App\Models\User;
use App\Models\Country;
use App\Models\StoreCategory;
use App\Models\Timing;
use App\Models\CustomStatus;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Category;
use App\Models\About;
use App\Models\AppSettings;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Coupons;
use App\Models\DineIn;
use App\Models\Terms;
use App\Models\Extra;
use App\Models\Faq;
use App\Models\Footerfeatures;
use App\Models\Item;
use App\Models\Media;
use App\Models\GlobalExtras;
use App\Models\Privacypolicy;
use App\Models\ProductImage;
use App\Models\Promotionalbanner;
use App\Models\Tax;
use App\Models\Variants;
use App\Models\Testimonials;
use App\Models\WhoWeAre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CloneController extends Controller
{

    public function add(Request $request)
    {
        $countries = Country::where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $stores = StoreCategory::where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $id = $request->id;
        return view('admin.user.add', compact('countries', 'stores', 'id'));
    }

    public function clonevendor(Request $request)
    {
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        $validatorslug = Validator::make(['slug' => $request->slug], [
            'slug' => [
                'required',
                Rule::unique('users')->where('type', 2)->where('is_deleted', 2),
            ]
        ]);
        if ($validatorslug->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_slug'));
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->mobile = $request->mobile;
        $new_user->password = Hash::make($request->password);
        $new_user->slug = $request->slug;
        $new_user->country_id = $request->country;
        $new_user->city_id = $request->city;
        $new_user->store_id = $request->store;
        $new_user->image = "default.png";
        $new_user->login_type = "normal";
        $new_user->type = 2;
        $new_user->save();

        $new_user = \DB::getPdo()->lastInsertId();

        $days = Timing::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($days as $day) {
            $timingclon = $day->replicate();
            $timingclon->vendor_id = $new_user;
            $timingclon->push();
        }

        $status_name = CustomStatus::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($status_name as $name) {
            $customstatusclone = $name->replicate();
            $customstatusclone->vendor_id = $new_user;
            $customstatusclone->push();
        }

        $paymentlist = Payment::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($paymentlist as $payment) {
            $paymentclone = $payment->replicate();
            $paymentclone->vendor_id = $new_user;
            $paymentclone->push();
        }

        $settingdata = Settings::where('vendor_id', $request->clone_vendor_id)->first();

        $logoreimage = 'logo-' . uniqid() . '.png';
        $faviconreimage = 'favicon-' . uniqid() . '.png';
        $og_imagereimage = 'og_image-' . uniqid() . '.png';
        $coverreimage = 'coverimage-' . uniqid() . '.png';
        $subscribereimage = 'subscribe-' . uniqid() . '.png';
        $order_detailreimage = 'order_detail-' . uniqid() . '.png';
        $order_successreimage = 'order_success-' . uniqid() . '.png';
        $nodatareimage = 'no_data-' . uniqid() . '.png';

        @File::copy(storage_path('app/public/admin-assets/images/about/logo/' . $settingdata->logo), storage_path('app/public/admin-assets/images/about/logo/' . $logoreimage));
        @File::copy(storage_path('app/public/admin-assets/images/about/favicon/' . $settingdata->favicon), storage_path('app/public/admin-assets/images/about/favicon/' . $faviconreimage));
        @File::copy(storage_path('app/public/admin-assets/images/about/og_image/' . $settingdata->og_image), storage_path('app/public/admin-assets/images/about/og_image/' . $og_imagereimage));
        @File::copy(storage_path('app/public/admin-assets/images/coverimage/' . $settingdata->cover_image), storage_path('app/public/admin-assets/images/coverimage/' . $coverreimage));
        @File::copy(storage_path('app/public/admin-assets/images/index/' . $settingdata->subscribe_image), storage_path('app/public/admin-assets/images/index/' . $subscribereimage));
        @File::copy(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_detail_image), storage_path('app/public/admin-assets/images/index/' . $order_detailreimage));
        @File::copy(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_success_image), storage_path('app/public/admin-assets/images/index/' . $order_successreimage));
        @File::copy(storage_path('app/public/admin-assets/images/index/' . $settingdata->no_data_image), storage_path('app/public/admin-assets/images/index/' . $nodatareimage));

        $settingclon = $settingdata->replicate();
        $settingclon->vendor_id = $new_user;
        $settingclon->logo = $logoreimage;
        $settingclon->favicon = $faviconreimage;
        $settingclon->og_image = $og_imagereimage;
        $settingclon->cover_image = $coverreimage;
        $settingclon->subscribe_image = $subscribereimage;
        $settingclon->order_detail_image = $order_detailreimage;
        $settingclon->order_success_image = $order_successreimage;
        $settingclon->no_data_image = $nodatareimage;
        $settingclon->push();

        $categorylist = Category::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($categorylist as $category) {
            $cat_last_id = Category::select('id')->orderByDesc('id')->first()->id;
            $catslug = Str::slug($category->name . ' ' . $cat_last_id, '-');

            $categoryclone = $category->replicate();
            $categoryclone->vendor_id = $new_user;
            $categoryclone->slug = $catslug;
            $categoryclone->push();

            $last_cat_id = \DB::getPdo()->lastInsertId();

            $itemlist = Item::where('cat_id', $category->id)->get();

            foreach ($itemlist as $data) {

                $downloadreimage = null;
                $attachmentreimage = null;
                $last_id = Item::select('id')->orderByDesc('id')->first()->id;
                $slug = Str::slug($data->item_name . ' ' . $last_id, '-');

                if ($data->attchment_file != null) {
                    $downloadreimage = 'downloadfile-' . uniqid() . '.png';
                    @File::copy(storage_path('app/public/admin-assets/images/product/' . $data->attchment_file), storage_path('app/public/admin-assets/images/product/' . $downloadreimage));
                }

                if ($data->download_file != null) {
                    $attachmentreimage = 'attachment-' . uniqid() . '.png';
                    @File::copy(storage_path('app/public/admin-assets/images/product/' . $data->download_file), storage_path('app/public/admin-assets/images/product/' . $attachmentreimage));
                }

                $itemsclon = $data->replicate();
                $itemsclon->vendor_id = $new_user;
                $itemsclon->cat_id = $last_cat_id;
                $itemsclon->slug = $slug;
                $itemsclon->download_file = $downloadreimage;
                $itemsclon->attchment_file = $attachmentreimage;
                $itemsclon->push();

                $last_item_id = \DB::getPdo()->lastInsertId();

                $extralist = Extra::where('item_id', $data->id)->get();

                foreach ($extralist as $extradata) {
                    $extraclon = $extradata->replicate();
                    $extraclon->item_id = $last_item_id;
                    $extraclon->push();
                }

                $variantslist = Variants::where('item_id', $data->id)->get();

                foreach ($variantslist as $variantsdata) {
                    $variantsclone = $variantsdata->replicate();
                    $variantsclone->item_id = $last_item_id;
                    $variantsclone->push();
                }

                $productimageslist = ProductImage::where('item_id', $data->id)->get();

                foreach ($productimageslist as $productimagesdata) {

                    $reimage = 'item-' . uniqid() . '.png';

                    @File::copy(storage_path('app/public/item/' . $productimagesdata->image), storage_path('app/public/item/' . $reimage));

                    $productimageclone = $productimagesdata->replicate();
                    $productimageclone->vendor_id = $new_user;
                    $productimageclone->item_id = $last_item_id;
                    $productimageclone->image = $reimage;
                    $productimageclone->push();
                }
            }
        }

        $aboutdata = About::where('vendor_id', $request->clone_vendor_id)->first();

        if ($aboutdata != "") {
            $aoutclon = @$aboutdata->replicate();
            $aoutclon->vendor_id = $new_user;
            $aoutclon->push();
        }


        $appsettingdata = AppSettings::where('vendor_id', $request->clone_vendor_id)->first();

        if ($appsettingdata != "") {

            if ($appsettingdata->image != "") {
                $appsectionmage = 'appsection-' . uniqid() . '.png';

                File::copy(storage_path('app/public/admin-assets/images/index/' . $appsettingdata->image), storage_path('app/public/admin-assets/images/index/' . $appsectionmage));
            }

            $appclon = @$appsettingdata->replicate();
            $appclon->vendor_id = $new_user;
            $appclon->image = @$appsectionmage;
            $appclon->push();
        }

        $policydata = Privacypolicy::where('vendor_id', $request->clone_vendor_id)->first();

        if ($policydata != "") {
            $policyclone = @$policydata->replicate();
            $policyclone->vendor_id = $new_user;
            $policyclone->push();
        }

        $termsdata = Terms::where('vendor_id', $request->clone_vendor_id)->first();

        if ($termsdata != "") {
            $termsclone = @$termsdata->replicate();
            $termsclone->vendor_id = $new_user;
            $termsclone->push();
        }

        $bannerlist = Banner::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($bannerlist as $banner) {

            $breimage = 'banner-' . uniqid() . '.png';

            @File::copy(storage_path('app/public/admin-assets/images/banners/' . $banner->banner_image), storage_path('app/public/admin-assets/images/banners/' . $breimage));

            $bannerclone = $banner->replicate();
            $bannerclone->vendor_id = $new_user;
            $bannerclone->banner_image = $breimage;
            $bannerclone->type = null;
            $bannerclone->category_id = null;
            $bannerclone->product_id = null;
            $bannerclone->push();
        }

        $whowearelist = WhoWeAre::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($whowearelist as $whoweare) {

            $whowearereimage = 'whoweare-' . uniqid() . '.png';

            @File::copy(storage_path('app/public/admin-assets/images/index/' . $whoweare->image), storage_path('app/public/admin-assets/images/index/' . $whowearereimage));

            $whoweareclone = $whoweare->replicate();
            $whoweareclone->vendor_id = $new_user;
            $whoweareclone->image = $whowearereimage;
            $whoweareclone->push();
        }

        $bloglist = Blog::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($bloglist as $blog) {

            $blogreimage = 'blog-' . uniqid() . '.png';

            @File::copy(storage_path('app/public/admin-assets/images/blog/' . $blog->image), storage_path('app/public/admin-assets/images/blog/' . $blogreimage));

            $blog_last_id = Blog::select('id')->orderByDesc('id')->first();
            $blogslug = Str::slug($blog->title . ' ' . $blog_last_id->id, '-');

            $blogclone = $blog->replicate();
            $blogclone->vendor_id = $new_user;
            $blogclone->slug = $blogslug;
            $blogclone->image = $blogreimage;
            $blogclone->push();
        }

        $couponlist = Coupons::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($couponlist as $coupon) {
            $couponclone = $coupon->replicate();
            $couponclone->vendor_id = $new_user;
            $couponclone->push();
        }

        $dinein = DineIn::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($dinein as $data) {
            $dineinclone = $data->replicate();
            $dineinclone->vendor_id = $new_user;
            $dineinclone->push();
        }

        $faqlist = Faq::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($faqlist as $data) {
            $faqclone = $data->replicate();
            $faqclone->vendor_id = $new_user;
            $faqclone->push();
        }

        $footerfeatureslist = Footerfeatures::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($footerfeatureslist as $data) {
            $footefeaturesclone = $data->replicate();
            $footefeaturesclone->vendor_id = $new_user;
            $footefeaturesclone->push();
        }

        $globleextralist = GlobalExtras::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($globleextralist as $data) {
            $globleextraclone = $data->replicate();
            $globleextraclone->vendor_id = $new_user;
            $globleextraclone->push();
        }

        $medialist = Media::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($medialist as $data) {

            $mreimage = 'item-' . uniqid() . '.png';

            if (file_exists(storage_path('app/public/item/' . $data->image))) {
                File::copy(storage_path('app/public/item/' . $data->image), storage_path('app/public/item/' . $mreimage));
            }

            $mediaclone = $data->replicate();
            $mediaclone->vendor_id = $new_user;
            $mediaclone->image = $mreimage;
            $mediaclone->push();
        }

        $promobannerlist = Promotionalbanner::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($promobannerlist as $data) {

            $promotionreimage = 'promotion-' . uniqid() . '.png';

            @File::copy(storage_path('app/public/admin-assets/images/banners/' . $data->image), storage_path('app/public/admin-assets/images/banners/' . $promotionreimage));

            $promobannerclone = $data->replicate();
            $promobannerclone->vendor_id = $new_user;
            $promobannerclone->image = $promotionreimage;
            $promobannerclone->push();
        }

        $taxlist = Tax::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($taxlist as $data) {
            $taxclone = $data->replicate();
            $taxclone->vendor_id = $new_user;
            $taxclone->push();
        }

        $testimoniallist = Testimonials::where('vendor_id', $request->clone_vendor_id)->get();

        foreach ($testimoniallist as $data) {
            $testimonialclone = $data->replicate();
            $testimonialclone->vendor_id = $new_user;
            $testimonialclone->push();
        }

        // $data = helper::vendor_register($request->name, $request->email, $request->mobile, hash::make($request->password), '', $request->slug, '', '', $request->country, $request->city, $request->store, $request->product_type);
        return redirect('admin/users')->with('success', trans('messages.success'));
    }
}
