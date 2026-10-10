@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $cartdata = $cartdata ?? collect();
    $allCategories = $category ?? helper::getcategory($storeinfo->id);
    $q = request('search_input');
    $activeCat = request('category');
@endphp

<div class="t16-shell" style="padding-top:18px;">
    <a href="{{ URL::to($storeinfo->slug) }}" class="t16-back-link">
        <i class="fa-solid {{ session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
        {{ App::getLocale() == 'ar' ? 'القائمة الرئيسية' : 'Back to menu' }}
    </a>

    <div class="t16-section-head" style="margin-top:8px;">
        <div>
            <h1 class="t16-section-title">{{ App::getLocale() == 'ar' ? 'بحث في القائمة' : 'Search the menu' }}</h1>
            <p class="t16-section-sub">
                @if ($q)
                    {{ App::getLocale() == 'ar' ? 'نتائج البحث عن' : 'Results for' }} “{{ $q }}”
                @else
                    {{ App::getLocale() == 'ar' ? 'ابحث عن طبق أو قسم' : 'Find a dish or category' }}
                @endif
            </p>
        </div>
    </div>

    <form class="t16-search-local" action="{{ URL::to($storeinfo->slug.'/search') }}" method="GET" role="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" name="search_input" value="{{ $q }}" autocomplete="off"
            placeholder="{{ App::getLocale() == 'ar' ? 'ابحث عن صنف...' : 'Search for a dish...' }}">
        @if ($activeCat)
            <input type="hidden" name="category" value="{{ $activeCat }}">
        @endif
    </form>

    @if ($allCategories->count() > 0)
        <div class="t16-cat-chips" style="margin-bottom:14px;">
            <a href="{{ URL::to($storeinfo->slug.'/search'.($q ? '?search_input='.urlencode($q) : '')) }}"
                class="t16-cat-chip {{ empty($activeCat) ? 'is-active' : '' }}">
                <span class="t16-cat-chip-name">{{ App::getLocale() == 'ar' ? 'الكل' : 'All' }}</span>
            </a>
            @foreach ($allCategories as $cat)
                <a href="{{ URL::to($storeinfo->slug.'/search?category='.$cat->slug.($q ? '&search_input='.urlencode($q) : '')) }}"
                    class="t16-cat-chip {{ $activeCat == $cat->slug ? 'is-active' : '' }}">
                    <span class="t16-cat-chip-img">
                        @if (! empty($cat->image) && $cat->image !== 'default.png')
                            <img src="{{ helper::image_path($cat->image) }}" alt="" loading="lazy">
                        @else
                            <i class="fa-solid fa-utensils"></i>
                        @endif
                    </span>
                    <span class="t16-cat-chip-name">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>
    @endif

    @if ($itemlist->count() > 0)
        <div class="t16-menu-grid">
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
