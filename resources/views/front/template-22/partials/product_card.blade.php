@php
    $price = $product->item_price;
    $original = $product->item_original_price;
    if (isset($product->variation) && count($product->variation) > 0) {
        $price = $product->variation[0]->price ?? $price;
        $original = $product->variation[0]->original_price ?? $original;
    }
    $hasDiscount = $original > $price && $price > 0;
    $discountPct = $hasDiscount ? round((($original - $price) / $original) * 100) : 0;
    $img = helper::image_path($product->image);
    $url = URL::to(@$storeinfo->slug . '/detail-' . $product->slug);
@endphp
<article class="mp-card">
    <div class="mp-card-media">
        @if ($hasDiscount)
            <span class="mp-badge mp-badge-sale">-{{ $discountPct }}%</span>
        @endif
        <a href="{{ $url }}" class="mp-card-img-link">
            <img src="{{ $img }}" alt="{{ $product->item_name }}" loading="lazy" class="mp-card-img"
                onerror="this.src='{{ url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png') }}'">
        </a>
        @if (helper::appdata(@$storeinfo->id)->online_order == 1)
            <a href="javascript:void(0)" class="mp-card-quick" onclick="GetProductOverview('{{ $product->slug }}', '')"
                title="{{ trans('labels.add_to_cart') }}">
                <i class="fa-solid fa-bag-shopping"></i>
            </a>
        @endif
    </div>
    <div class="mp-card-body">
        <h3 class="mp-card-title">
            <a href="{{ $url }}">{{ $product->item_name }}</a>
        </h3>
        <div class="mp-card-price">
            @if ($hasDiscount)
                <span class="mp-price-was">{{ helper::currency_formate($original, @$storeinfo->id) }}</span>
            @endif
            <span class="mp-price-now">{{ helper::currency_formate($price, @$storeinfo->id) }}</span>
        </div>
    </div>
</article>
