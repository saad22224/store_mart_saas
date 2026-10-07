@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

@php
    $q = request()->get('search_input');
    $catSlug = request()->get('category');
    $filter = request()->get('filter');
    $baseSearch = URL::to($storeinfo->slug . '/search');
    $hasQuery = filled($q) || filled($catSlug);
@endphp

<main class="mp-search-page mp-body">
    <div class="mp-wrap mp-search-wrap">
        <form action="{{ $baseSearch }}" method="GET" class="mp-underline-search" role="search">
            @if ($catSlug)
                <input type="hidden" name="category" value="{{ $catSlug }}">
            @endif
            @if ($filter)
                <input type="hidden" name="filter" value="{{ $filter }}">
            @endif
            <label class="mp-underline-label" for="mpPageSearch">بحث</label>
            <div class="mp-underline-row">
                <button type="submit" class="mp-underline-icon" aria-label="بحث">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="search" name="search_input" id="mpPageSearch" value="{{ $q }}"
                    placeholder="" autocomplete="off">
            </div>
        </form>

        @if ($hasQuery && $itemlist->count() > 0)
            <div class="mp-results-meta">
                <div>
                    <strong>{{ $itemlist->firstItem() }}–{{ $itemlist->lastItem() }}</strong>
                    من <strong>{{ $itemlist->total() }}</strong> نتيجة
                </div>
            </div>
            <div class="mp-grid">
                @foreach ($itemlist as $product)
                    @include('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo])
                @endforeach
            </div>
            <div class="mp-pagination">{{ $itemlist->withQueryString()->links() }}</div>
        @elseif ($hasQuery)
            <div class="mp-search-empty">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>لم يتم العثور على نتائج</p>
            </div>
        @endif
    </div>
</main>

@include('front.theme.footer')
