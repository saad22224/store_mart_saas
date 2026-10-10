@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $cartdata = $cartdata ?? collect();
    $getcategory = $getcategory ?? helper::getcategory($storeinfo->id);
@endphp

<div class="t16-shell" style="padding-top:18px;">
    <a href="{{ URL::to($storeinfo->slug) }}" class="t16-back-link">
        <i class="fa-solid {{ session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
        {{ App::getLocale() == 'ar' ? 'القائمة الرئيسية' : 'Back to menu' }}
    </a>

    <div class="t16-section-head" style="margin-top:8px;">
        <div>
            <h1 class="t16-section-title">{{ $category->name }}</h1>
            <p class="t16-section-sub">{{ App::getLocale() == 'ar' ? 'اختر أصنافك وأضفها للسلة' : 'Pick your items and add to cart' }}</p>
        </div>
    </div>

    @if ($getcategory->count() > 0)
        <div class="t16-cat-chips" style="margin-bottom:8px;">
            @foreach ($getcategory as $cat)
                <a href="{{ URL::to($storeinfo->slug.'/category/'.$cat->slug) }}"
                    class="t16-cat-chip {{ $cat->id == $category->id ? 'is-active' : '' }}">
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

    <div class="t16-search-local">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" id="t16SearchInput" autocomplete="off"
            placeholder="{{ App::getLocale() == 'ar' ? 'ابحث داخل هذا القسم...' : 'Search in this category...' }}">
    </div>

    @if ($products->count() > 0)
        <div class="t16-menu-grid" id="t16ProductsGrid">
            @foreach ($products as $key => $item)
                @include('front.template-16._product_card', [
                    'item' => $item,
                    'storeinfo' => $storeinfo,
                    'cartdata' => $cartdata,
                    'key' => $key,
                ])
            @endforeach
        </div>
        <div class="t16-empty" id="t16NoResults" style="display:none;margin-top:16px;">
            <i class="fa-regular fa-face-meh"></i>
            {{ App::getLocale() == 'ar' ? 'لا توجد نتائج مطابقة' : 'No matching items' }}
        </div>
        @if ($products->hasPages())
            <div class="t16-pagination">{{ $products->links() }}</div>
        @endif
    @else
        <div class="t16-empty">
            <i class="fa-regular fa-utensils"></i>
            {{ App::getLocale() == 'ar' ? 'لا توجد أصناف في هذا القسم' : 'No items in this category' }}
        </div>
    @endif
</div>

<script>
(function () {
    var input = document.getElementById('t16SearchInput');
    var grid = document.getElementById('t16ProductsGrid');
    var empty = document.getElementById('t16NoResults');
    if (!input || !grid) return;
    input.addEventListener('input', function () {
        var q = (input.value || '').trim().toLowerCase();
        var cards = grid.querySelectorAll('.t16-card');
        var shown = 0;
        cards.forEach(function (card) {
            var name = (card.getAttribute('data-name') || '').toLowerCase();
            var ok = !q || name.indexOf(q) !== -1;
            card.style.display = ok ? '' : 'none';
            if (ok) shown++;
        });
        if (empty) empty.style.display = shown ? 'none' : 'block';
    });
})();
</script>
@include('front.template-16._cart_scripts')
@include('front.theme.footer')
