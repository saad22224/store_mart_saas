<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Features;
use App\Models\PricingPlan;
use App\Models\User;
use App\Models\Testimonials;
use App\Models\Blog;
use App\Models\Subscriber;
use App\Models\Category;
use App\Models\StoreCategory;
use App\Models\Item;
use App\Models\Banner;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Country;
use App\Models\City;
use App\Models\Terms;
use App\Models\About;
use App\Models\Privacypolicy;
use App\Models\Promotionalbanner;
use App\Models\Faq;
use App\Models\AppSettings;
use App\Models\Contact;
use App\Models\Theme;
use App\Helpers\helper;
use App\Models\HowWorks;
use App\Models\FunFact;
use App\Models\Landing2Settings;
use App\Models\Landing2Translation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $planlist = PricingPlan::where('is_available', 1)->where('vendor_id', null)->orderBy('reorder_id')->get();

        // Get current language from request or default to 'ar'
        $lang = $request->get('lang', session('landing2_lang', 'ar'));
        session(['landing2_lang' => $lang]);

        // Get all translations for the current language
        $translations = Landing2Translation::getAll($lang);

        return view('landing2.index', compact('translations', 'lang', 'planlist'));
    }

    public function help(Request $request)
    {
        $lang = $request->get('lang', session('landing2_lang', 'ar'));
        session(['landing2_lang' => $lang]);

        $translations = Landing2Translation::getAll($lang);
        return view('landing2.help', compact('translations', 'lang'));
    }

    public function aiAsk(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000'
        ]);

        $userQuestion = trim($request->question);

        // Gather all API keys from env (GEMINI_API, GEMINI_API2, GEMINI_API3, GEMINI_API4, GEMINI_API_KEYS)
        $apiKeys = [];
        foreach (['GEMINI_API', 'GEMINI_API2', 'GEMINI_API3', 'GEMINI_API4'] as $envKey) {
            $val = env($envKey);
            if (!empty($val)) {
                $apiKeys[] = trim($val);
            }
        }
        if (!empty(env('GEMINI_API_KEYS'))) {
            $keysList = explode(',', env('GEMINI_API_KEYS'));
            foreach ($keysList as $k) {
                if (!empty(trim($k))) {
                    $apiKeys[] = trim($k);
                }
            }
        }
        $apiKeys = array_values(array_unique($apiKeys));

        if (empty($apiKeys)) {
            return response()->json([
                'status' => false,
                'message' => 'عذراً، لم يتم ضبط مفاتيح Gemini API في ملف الإعدادات.'
            ], 500);
        }

        $systemContext = "أنت المساعد الذكي الرسمي لمنصة متجر هب (MatjarHub / store_mart_saas)، وهي منصة تجارة إلكترونية سحابية متطورة تتيح للتجار إنشاء وإدارة متاجرهم الإلكترونية بكل سهولة واحترافية.
وظيفتك مساعدة التجار والعملاء والإجابة عن استفساراتهم حول كيفية استخدام المنصة وإدارة المتجر بأسلوب عربي فصيح، دقيق، ودود ومختصر، واستخدام النقاط لتبسيط الخطوات.

إليك الدليل الكامل لمنصة متجر هب لاستخدامه في الإجابة:
1. **إنشاء حساب وتدشين متجر جديد**:
   - التوجه لرابط التسجيل (/admin/register) أو النقر على 'ابدأ تجربتك المجانية'.
   - كتابة اسم المتجر باللغتين العربية والإنجليزية، البريد الإلكتروني، رقم الجوال، وتعيين كلمة المرور.

2. **إدارة الأقسام والمنتجات**:
   - **الأقسام**: الانتقال إلى (الأقسام -> إضافة جديد) لإنشاء تصنيفات مثل (ساعات، ملابس، إلكترونيات، إلخ).
   - **المنتجات**: الانتقال إلى (المنتجات -> إضافة جديد)، رفع الصور، كتابة اسم وصرف المنتج، تحديد السعر والسعر قبل الخصم، اختيار القسم، وتحديد الخيارات المتعددة (Variants) كالألوان والمقاسات والكمية.

3. **تخصيص التصميم والظهر**:
   - الانتقال إلى (إعدادات المتجر -> تخصيص المظهر) لتغيير شعار المتجر (Logo)، البانرات الترويجية المتحركة، وألوان الواجهة.
   - اختيار القالب المناسب من قسم (الثيمات المتاحة) المتوافقة مع باقتك.

4. **إدارة الملف الشخصي والإعدادات الحسابية**:
   - النقر على الصورة الشخصية بالأعلى والانتفال لـ (تعديل الملف الشخصي) لتحديث صورة البروفايل، البيانات، والبريد الإلكتروني وتغيير كلمة السر.

5. **وسائط الدفع وتكلفة الشحن**:
   - **الدفع**: تفعيل الدفع عند الاستلام، الطلب المباشر عبر الواتساب، أو بوابات الدفع الإلكتروني (فيزا/ماستركارد، باي بال، تـاب، سترايب).
   - **الشحن**: إضافة مناطق الشحن واسم كل منطقة وسعر توصيلها من قسم (مناطق الشحن).

6. **ربط الدومين الخاص (Custom Domain)**:
   - يتيح لك المتجر توجيه نطاقك الخاص (مثال: mystore.com). انتقل لـ (الدومين الخاص) ثم ادخل اسم النطاق ووجه سجلات CNAME نحو خادم المنصة.

7. **باقات الاشتراك والترقية**:
   - التوجه لقسم (الباقات) لاختيار الباقة المناسبة (شهرية، سنوية، مدى الحياة)، واستعراض حدود المنتجات، الطلبات، والدومين.

أجب دائماً بنظام وشرح واضح خطوة بخطوة واستخدم تنسيق النقاط وتنسيق العناوين البارزة.";

        $contents = [
            [
                'role' => 'user',
                'parts' => [['text' => $userQuestion]]
            ]
        ];

        $lastError = '';

        foreach ($apiKeys as $index => $apiKey) {
            try {
                // Try gemini-2.5-flash-lite endpoint
                $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}";
                $response = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->timeout(45)
                    ->post($url, [
                        'system_instruction' => [
                            'parts' => [['text' => $systemContext]],
                        ],
                        'contents' => $contents,
                        'generationConfig' => [
                            'temperature' => 0.4,
                            'topK' => 40,
                            'topP' => 0.95,
                            'maxOutputTokens' => 2000,
                        ],
                        'safetySettings' => [
                            ['category' => 'HARM_CATEGORY_HARASSMENT',        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_HATE_SPEECH',       'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',  'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                        ],
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                        return response()->json([
                            'status' => true,
                            'answer' => $data['candidates'][0]['content']['parts'][0]['text']
                        ]);
                    }
                }

                // Fallback to gemini-1.5-flash
                $fallbackUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";
                $fallbackResp = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->timeout(45)
                    ->post($fallbackUrl, [
                        'contents' => [
                            [
                                'role' => 'user',
                                'parts' => [['text' => $systemContext . "\n\nسؤال المستخدم: " . $userQuestion]]
                            ]
                        ],
                    ]);

                if ($fallbackResp->successful()) {
                    $fbData = $fallbackResp->json();
                    if (isset($fbData['candidates'][0]['content']['parts'][0]['text'])) {
                        return response()->json([
                            'status' => true,
                            'answer' => $fbData['candidates'][0]['content']['parts'][0]['text']
                        ]);
                    }
                }

                $lastError = $response->body() ?: $fallbackResp->body();
                Log::warning("Gemini AI key index {$index} failed", ['status' => $response->status(), 'body' => $lastError]);
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
                Log::warning("Gemini AI key index {$index} exception", ['error' => $lastError]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'عذراً، لم نتمكن من الوصول للإجابة حالياً، يرجى إعادة المحاولة لاحقاً.'
        ], 500);
    }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        // else {
        //     // if the current package doesn't have 'custom domain' feature || the custom domain is not connected
        //     $settingdata = User::where('custom_domain', $host)->first();
        //     if (empty($settingdata)) {
        //         abort(404);
        //     }
        //     $storeinfo = User::where('id', @$settingdata->vendor_id)->first();
        //     $getcategory = Category::where('vendor_id', @$settingdata->vendor_id)->where('is_available', '=', '1')->where('is_deleted', '2')->orderBy('id', 'ASC')->get();
        //     $getitem = Item::with(['variation', 'extras'])->where('vendor_id', @$settingdata->vendor_id)->where('is_available', '1')->orderBy('id', 'ASC')->get();
        //     $bannerimage = Banner::where('vendor_id', @$settingdata->vendor_id)->orderBy('id', 'ASC')->get();
        //     $cartitems = Cart::select('id', 'item_id', 'item_name', 'item_image', 'item_price', 'extras_id', 'extras_name', 'extras_price', 'qty', 'price', 'tax', 'variants_id', 'variants_name')
        //         ->where('vendor_id', @$settingdata->vendor_id);
        //     if (Auth::user() && Auth::user()->type == 3) {
        //         $cartitems->where('user_id', @Auth::user()->id);
        //     } else {
        //         $cartitems->where('session_id', Session::getId());
        //     }
        //     $cartdata = $cartitems->get();
        //     if (empty($settingdata)) {
        //         abort(404);
        //     }
        //     if (Auth::user() && Auth::user()->type == 3) {
        //         $count = Cart::where('user_id', Auth::user()->id)->where('vendor_id', @$settingdata->vendor_id)->count();
        //     } else {
        //         $count = Cart::where('session_id', Session::getId())->where('vendor_id', @$settingdata->vendor_id)->count();
        //     }
        //     session()->put('cart', $count);
        //     return view('front.template-' . $settingdata->template . '.home', compact('getcategory', 'getitem', 'storeinfo', 'bannerimage', 'cartdata'));
        // }
    
    public function emailsubscribe(Request $request)
    {
        $newsubscriber = new Subscriber();
        $newsubscriber->vendor_id = 1;
        $newsubscriber->email = $request->email;
        $newsubscriber->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function inquiry(Request $request)
    {
        try {
            if (@helper::checkaddons('google_recaptcha')) {

                if (helper::appdata('')->recaptcha_version == 'v2') {
                    $request->validate([
                        'g-recaptcha-response' => 'required'
                    ], [
                        'g-recaptcha-response.required' => 'The g-recaptcha-response field is required.'
                    ]);
                }

                if (helper::appdata('')->recaptcha_version == 'v3') {
                    $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'contact');
                    if ($score <= helper::appdata('')->score_threshold) {
                        return redirect()->back()->with('error', 'You are most likely a bot');
                    }
                }
            }
            $newinquiry = new Contact();
            $newinquiry->vendor_id = 1;
            $newinquiry->name = $request->name;
            $newinquiry->email = $request->email;
            $newinquiry->mobile = $request->mobile;
            $newinquiry->message = $request->message;
            $newinquiry->save();
            $vendordata = User::select('name', 'email')->where('id', 1)->first();
            $emaildata = helper::emailconfigration(helper::appdata('')->id);
            Config::set('mail', $emaildata);
            helper::vendor_contact_data(1, $vendordata->name, $vendordata->email, $request->name, $request->email, $request->mobile, $request->message);
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function termscondition()
    {
        $terms = Terms::select('terms_content')->where('vendor_id', 1)->first();
        return view('landing.terms_condition', compact('terms'));
    }
    public function aboutus()
    {
        $aboutus = About::select('about_content')->where('vendor_id', 1)->first();
        return view('landing.aboutus', compact('aboutus'));
    }
    public function privacypolicy()
    {
        $privacypolicy = Privacypolicy::select('privacypolicy_content')->where('vendor_id', 1)->first();
        return view('landing.privacypolicy', compact('privacypolicy'));
    }
    public function refund_policy()
    {
        $policy = Settings::select('refund_policy')->where('vendor_id', 1)->first();
        return view('landing.refund_policy', compact('policy'));
    }
    public function faqs(Request $request)
    {
        $allfaqs = Faq::where('vendor_id', 1)->orderBy('reorder_id')->get();
        return view('landing.faq', compact('allfaqs'));
    }
    public function contact()
    {
        return view('landing.contact');
    }
    public function allstores(Request $request)
    {
        $countries = Country::where('is_deleted', 2)->where('is_available', 1)->get();
        $banners = Promotionalbanner::with('vendor_info')->orderBy('reorder_id')->get();
        $storecategory = StoreCategory::where('is_available', 1)->where('is_deleted', 2)->get();
        $stores = User::where('type', 2)->where('is_available', 1)->where('is_deleted', 2);
        if ($request->country == "" && $request->city == "") {
            $stores = $stores;
        }
        $city_name = "";
        if ($request->has('country') && $request->country != "") {
            $country = Country::select('id')->where('name', $request->country)->first();
            $stores =  $stores->where('country_id', $country->id);
        }
        if ($request->has('city') && $request->city != "") {
            $city = City::where('city', $request->city)->first();
            $stores =  $stores->where('city_id', $city->id);
            $city_name = $city->city;
        }
        if ($request->has('store') && $request->store != "") {
            $storeinfo = StoreCategory::where('name', $request->store)->first();
            $stores =  $stores->where('store_id', $storeinfo->id);
        }
        if ($stores != null) {
            $stores = $stores->paginate(12)->onEachSide(0);
        }
        return view('landing.stores', compact('countries', 'stores', 'city_name', 'banners', 'storecategory'));
    }
    public function themeimages(Request $request)
    {
        $newpath = [];
        $output = '';
        foreach ($request->theme_id as $theme_id) {
            $image = 'theme-' . $theme_id;
            if (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.png'))) {
                $image = 'theme-' . $theme_id . '.png';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.jpeg'))) {
                $image = 'theme-' . $theme_id . '.jpeg';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.jpg'))) {
                $image = 'theme-' . $theme_id . '.jpg';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.webp'))) {
                $image = 'theme-' . $theme_id . '.webp';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } else {
                $path =  asset('storage/app/public/admin-assets/images/about/defaultimages/item-placeholder.png');
            }
            $newpath[] = $path;
        }
        $html = view('admin.theme.themeimages', compact('newpath'))->render();
        return response()->json(['status' => 1, 'output' => $html], 200);
    }
}
