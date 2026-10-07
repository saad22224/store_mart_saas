{{-- Theme 22 header — desktop + mobile (reference match) --}}
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
    $mpCategories = helper::getcategory(@$storeinfo->id);
    $mpContact = helper::appdata(@$storeinfo->id)->contact ?? null;
    $mpLogo = trim((string) (helper::appdata(@$storeinfo->id)->logo ?? ''));
    $mpLogoUrl = null;
    if ($mpLogo !== '' && $mpLogo !== 'default.png' && $mpLogo !== '-') {
        $mpLogoCandidates = [
            storage_path('app/public/admin-assets/images/about/logo/' . $mpLogo),
            storage_path('app/public/admin-assets/images/about/defaultimages/' . $mpLogo),
            public_path('storage/admin-assets/images/about/logo/' . $mpLogo),
            public_path('storage/admin-assets/images/about/defaultimages/' . $mpLogo),
        ];
        $mpLogoRelMap = [
            storage_path('app/public/admin-assets/images/about/logo/' . $mpLogo) => 'admin-assets/images/about/logo/' . $mpLogo,
            storage_path('app/public/admin-assets/images/about/defaultimages/' . $mpLogo) => 'admin-assets/images/about/defaultimages/' . $mpLogo,
            public_path('storage/admin-assets/images/about/logo/' . $mpLogo) => 'admin-assets/images/about/logo/' . $mpLogo,
            public_path('storage/admin-assets/images/about/defaultimages/' . $mpLogo) => 'admin-assets/images/about/defaultimages/' . $mpLogo,
        ];
        foreach ($mpLogoCandidates as $mpAbs) {
            if (is_file($mpAbs)) {
                $mpLogoUrl = url(rtrim((string) env('ASSETPATHURL'), '/') . '/' . $mpLogoRelMap[$mpAbs]);
                break;
            }
        }
        // Never fall back to a guessed URL — missing files render as a broken "image" icon.
    }
@endphp
<header class="mp-header">
    <div class="mp-header-inner">
        {{-- Mobile: left bag+search | center logo | right menu — outline icons like reference --}}
        <button type="button" class="mp-icon-plain mp-menu-btn" id="mpMenuToggle" aria-label="القائمة" aria-expanded="false">
            <i class="fa-light fa-bars"></i>
        </button>

        <a href="{{ URL::to(@$storeinfo->slug . '/') }}" class="mp-logo">
            @if (!empty($mpLogoUrl))
                <img src="{{ $mpLogoUrl }}" alt="{{ @$storeinfo->name }}">
            @else
                <span class="mp-logo-text">{{ @$storeinfo->name }}</span>
            @endif
        </a>

        <nav class="mp-nav-policies mp-nav-policies-desktop">
            <a href="{{ URL::to(@$storeinfo->slug . '/refund_policy') }}">سياسة الاستبدال و الاسترجاع</a>
            <a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">سياسة الشحن</a>
        </nav>

        <div class="mp-actions">
            <button type="button" class="mp-icon-plain" data-mp-open-cart aria-label="{{ trans('labels.cart') }}">
                <i class="fa-light fa-bag-shopping"></i>
                <span class="mp-cart-count cart-count" id="cartcnt" @if ($mpCartCount < 1) style="display:none" @endif>{{ $mpCartCount }}</span>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-search aria-label="{{ trans('labels.search') }}">
                <i class="fa-light fa-magnifying-glass"></i>
            </button>
        </div>
    </div>

    {{-- Mobile-only beige policy strip (reference) --}}
    <div class="mp-policy-bar">
        <a href="{{ URL::to(@$storeinfo->slug . '/refund_policy') }}">سياسة الاستبدال و الاسترجاع</a>
        <span class="mp-policy-sep" aria-hidden="true"></span>
        <a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">سياسة الشحن</a>
    </div>
</header>

{{-- Mobile categories drawer (reference style, categories instead of policies) --}}
<div class="mp-nav-backdrop" id="mpNavBackdrop" hidden></div>
<aside class="mp-nav-drawer" id="mpNavDrawer" aria-hidden="true" dir="rtl">
    <div class="mp-nav-drawer-top">
        <button type="button" class="mp-nav-close" id="mpNavClose" aria-label="إغلاق">
            <i class="fa-light fa-xmark"></i>
        </button>
        <a href="{{ URL::to(@$storeinfo->slug . '/') }}" class="mp-nav-logo">
            @if (!empty($mpLogoUrl))
                <img src="{{ $mpLogoUrl }}" alt="{{ @$storeinfo->name }}">
            @else
                <span>{{ @$storeinfo->name }}</span>
            @endif
        </a>
    </div>
    <nav class="mp-nav-drawer-links">
        @forelse ($mpCategories as $mpCat)
            <a href="{{ URL::to(@$storeinfo->slug . '/category/' . $mpCat->slug) }}">{{ $mpCat->name }}</a>
        @empty
            <a href="{{ URL::to(@$storeinfo->slug . '/') }}">{{ trans('labels.home') }}</a>
        @endforelse
    </nav>
    @if (!empty($mpContact) && $mpContact !== '-')
        <div class="mp-nav-drawer-foot">
            <a href="tel:{{ preg_replace('/\s+/', '', $mpContact) }}" class="mp-nav-help">
                <strong>{{ $mpContact }}</strong>
                <span>Need help? call us</span>
            </a>
        </div>
    @endif
</aside>

@include('front.template-22.partials.search_overlay')
@include('front.template-22.partials.cart_drawer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('mpMenuToggle');
    var drawer = document.getElementById('mpNavDrawer');
    var backdrop = document.getElementById('mpNavBackdrop');
    var closeBtn = document.getElementById('mpNavClose');

    function openNav() {
        if (!drawer) return;
        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
        if (backdrop) {
            backdrop.hidden = false;
            backdrop.classList.add('is-open');
        }
        document.documentElement.classList.add('mp-drawer-lock');
    }
    function closeNav() {
        if (!drawer) return;
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        if (backdrop) {
            backdrop.hidden = true;
            backdrop.classList.remove('is-open');
        }
        document.documentElement.classList.remove('mp-drawer-lock');
    }

    window.mpOpenNavDrawer = openNav;
    window.mpCloseNavDrawer = closeNav;

    if (toggle) toggle.addEventListener('click', function (e) {
        e.preventDefault();
        openNav();
    });
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    if (backdrop) backdrop.addEventListener('click', closeNav);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeNav();
    });
});
</script>
