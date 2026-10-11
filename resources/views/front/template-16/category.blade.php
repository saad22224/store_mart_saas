@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $cartdata = $cartdata ?? collect();
    $appdata = helper::appdata($storeinfo->id);
    $address = trim((string) ($appdata->address ?? ''));
    $contact = trim((string) ($appdata->contact ?? ''));
    if ($contact === '-') {
        $contact = '';
    }
    $t16Rtl = session()->get('direction') == 2;
@endphp

<div class="t16-shell" style="padding-top:8px;">
    @if ($address !== '' || $contact !== '')
        <div class="t16-cat-topmeta">
            @if ($address !== '')
                <a href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" rel="noopener">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    <span>{{ $address }}</span>
                </a>
            @else
                <span></span>
            @endif
            @if ($contact !== '')
                <a href="tel:{{ preg_replace('/\s+/', '', $contact) }}">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <span>{{ $contact }}</span>
                </a>
            @endif
        </div>
    @endif

    <a href="{{ URL::to($storeinfo->slug) }}" class="t16-back-circle" aria-label="{{ App::getLocale() == 'ar' ? 'رجوع' : 'Back' }}">
        <i class="fa-solid {{ $t16Rtl ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
    </a>

    <h1 class="t16-section-title">{{ $category->name }}</h1>

    <form class="t16-search-pill" action="{{ URL::to($storeinfo->slug.'/search') }}" method="GET" role="search" style="margin-bottom:20px;">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="hidden" name="category" value="{{ $category->slug }}">
        <input type="search" name="search_input" id="t16SearchInput" autocomplete="off"
            placeholder="{{ App::getLocale() == 'ar' ? 'بحث' : 'Search' }}"
            aria-label="{{ trans('labels.search') }}">
    </form>

    @if ($products->count() > 0)
        <div class="t16-menu-list" id="t16ProductsGrid">
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
        @if (method_exists($products, 'hasPages') && $products->hasPages())
            <div class="t16-pagination">{{ $products->withQueryString()->links() }}</div>
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
            var name = card.getAttribute('data-name') || '';
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
