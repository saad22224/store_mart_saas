@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $cartdata = $cartdata ?? collect();
    $allCategories = $category ?? helper::getcategory($storeinfo->id);
    $q = request('search_input');
    $activeCat = request('category');
    $t16Rtl = session()->get('direction') == 2;
@endphp

<div class="t16-shell" style="padding-top:12px;">
    <a href="{{ URL::to($storeinfo->slug) }}" class="t16-back-circle" aria-label="{{ App::getLocale() == 'ar' ? 'رجوع' : 'Back' }}">
        <i class="fa-solid {{ $t16Rtl ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
    </a>

    <h1 class="t16-section-title" style="text-transform:none;letter-spacing:-.02em;">
        {{ App::getLocale() == 'ar' ? 'بحث في القائمة' : 'Search' }}
    </h1>
    @if ($q)
        <p class="t16-section-sub">
            {{ App::getLocale() == 'ar' ? 'نتائج البحث عن' : 'Results for' }} “{{ $q }}”
        </p>
    @endif

    <form class="t16-search-pill" action="{{ URL::to($storeinfo->slug.'/search') }}" method="GET" role="search">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="search" name="search_input" value="{{ $q }}" autocomplete="off"
            placeholder="{{ App::getLocale() == 'ar' ? 'بحث' : 'Search' }}"
            aria-label="{{ trans('labels.search') }}">
        @if ($activeCat)
            <input type="hidden" name="category" value="{{ $activeCat }}">
        @endif
    </form>

    @if ($allCategories->count() > 0)
        <div class="t16-cat-chips">
            <a href="{{ URL::to($storeinfo->slug.'/search'.($q ? '?search_input='.urlencode($q) : '')) }}"
                class="t16-cat-chip {{ empty($activeCat) ? 'is-active' : '' }}">
                <span class="t16-cat-chip-name">{{ App::getLocale() == 'ar' ? 'الكل' : 'All' }}</span>
            </a>
            @foreach ($allCategories as $cat)
                <a href="{{ URL::to($storeinfo->slug.'/search?category='.$cat->slug.($q ? '&search_input='.urlencode($q) : '')) }}"
                    class="t16-cat-chip {{ $activeCat == $cat->slug ? 'is-active' : '' }}">
                    <span class="t16-cat-chip-name">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>
    @endif

    @if ($itemlist->count() > 0)
        <div class="t16-menu-list">
            @foreach ($itemlist as $key => $item)
                @include('front.template-16._product_card', [
                    'item' => $item,
                    'storeinfo' => $storeinfo,
                    'cartdata' => $cartdata,
                    'key' => $key,
                ])
            @endforeach
        </div>
        @if ($itemlist->hasPages())
            <div class="t16-pagination">{{ $itemlist->withQueryString()->links() }}</div>
        @endif
    @else
        <div class="t16-empty">
            <i class="fa-regular fa-magnifying-glass"></i>
            {{ App::getLocale() == 'ar' ? 'لا توجد نتائج' : 'No results found' }}
        </div>
    @endif
</div>

@include('front.template-16._cart_scripts')
@include('front.theme.footer')
