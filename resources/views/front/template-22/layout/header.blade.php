{{-- Theme 22 header — matches reference: logo | policies | search+cart --}}
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@include('front.template-22.partials.theme_styles')
@php
    $mpCartCount = 0;
    if (isset($cartdata) && is_countable($cartdata)) {
        $mpCartCount = collect($cartdata)->filter(function ($c) {
            return ($c->buynow ?? 0) != 1;
        })->count();
    } else {
        $mpCountQ = \App\Models\Cart::where('vendor_id', @$storeinfo->id)->where('buynow', '!=', 1);
        if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->type == 3) {
            $mpCountQ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id);
        } else {
            $mpCountQ->where('session_id', \Illuminate\Support\Facades\Session::getId());
        }
        $mpCartCount = $mpCountQ->count();
    }
@endphp
<header class="mp-header">
    <div class="mp-header-inner">
        {{-- RTL: right = logo --}}
        <a href="{{ URL::to(@$storeinfo->slug . '/') }}" class="mp-logo">
            @if (!empty(helper::appdata(@$storeinfo->id)->logo))
                <img src="{{ helper::image_path(helper::appdata(@$storeinfo->id)->logo) }}" alt="{{ @$storeinfo->name }}">
            @else
                <span class="mp-logo-text">{{ @$storeinfo->name }}</span>
            @endif
        </a>

        {{-- center = policy links --}}
        <nav class="mp-nav-policies">
            <a href="{{ URL::to(@$storeinfo->slug . '/refund_policy') }}">سياسة الاستبدال و الاسترجاع</a>
            <a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">سياسة الشحن</a>
        </nav>

        {{-- left = icons (LTR order like reference: bag then search) --}}
        <div class="mp-actions">
            <button type="button" class="mp-icon-plain mp-menu-btn" id="mpMenuToggle" aria-label="القائمة">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-cart aria-label="{{ trans('labels.cart') }}">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="mp-cart-count cart-count" id="cartcnt" @if ($mpCartCount < 1) style="display:none" @endif>{{ $mpCartCount }}</span>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-search aria-label="{{ trans('labels.search') }}">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
    <div class="mp-mobile-nav" id="mpMobileNav">
        <a href="{{ URL::to(@$storeinfo->slug . '/') }}">{{ trans('labels.home') }}</a>
        <a href="{{ URL::to(@$storeinfo->slug . '/refund_policy') }}">سياسة الاستبدال و الاسترجاع</a>
        <a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">سياسة الشحن</a>
        <a href="{{ URL::to(@$storeinfo->slug . '/privacy') }}">{{ trans('labels.privacypolicy') }}</a>
        <a href="{{ URL::to(@$storeinfo->slug . '/contact') }}">{{ trans('labels.contact_us') }}</a>
        <a href="{{ URL::to(@$storeinfo->slug . '/cart') }}">{{ trans('labels.cart') }}</a>
    </div>
</header>
@include('front.template-22.partials.search_overlay')
@include('front.template-22.partials.cart_drawer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('mpMenuToggle');
    var nav = document.getElementById('mpMobileNav');
    if (btn && nav) btn.addEventListener('click', function () { nav.classList.toggle('is-open'); });
});
</script>
