@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

<main class="mp-category mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <div class="mp-page-head">
            <h1>{{ $category->name ?? trans('labels.category') }}</h1>
            @if (!empty($category->description))
                <p>{!! nl2br(e(strip_tags($category->description))) !!}</p>
            @endif
        </div>

        @if (isset($getcategory) && $getcategory->count() > 0)
            <div class="mp-cat-scroll">
                @foreach ($getcategory as $cat)
                    <a class="mp-cat-chip {{ isset($category) && $category->id == $cat->id ? 'is-active' : '' }}"
                        href="{{ URL::to(@$storeinfo->slug . '/category/' . $cat->slug) }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if (isset($products) && $products->count() > 0)
            <div class="mp-grid">
                @foreach ($products as $product)
                    @include('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo])
                @endforeach
            </div>
            @if (method_exists($products, 'links'))
                <div class="mp-pagination">{{ $products->withQueryString()->links() }}</div>
            @endif
        @else
            <div class="mp-search-empty">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>لم يتم العثور على نتائج</p>
            </div>
        @endif
    </div>
</main>

@include('front.theme.footer')
