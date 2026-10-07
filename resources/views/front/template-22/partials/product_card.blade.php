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
    $cartImage = @$product->product_image->image ?? $product->image;
    $hasVariants = (int) ($product->has_variants ?? 2) === 1;
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
            @if ($hasVariants)
                <a href="{{ $url }}" class="mp-card-quick" title="{{ trans('labels.view') }}">
                    <i class="fa-light fa-bag-shopping"></i>
                </a>
            @else
                <button type="button" class="mp-card-quick"
                    title="{{ trans('labels.add_to_cart') }}"
                    data-mp-quick-add
                    data-item-id="{{ $product->id }}"
                    data-item-name="{{ e($product->item_name) }}"
                    data-item-image="{{ $cartImage }}"
                    data-item-price="{{ $price }}"
                    data-item-original="{{ $original }}"
                    data-tax="{{ $product->tax }}"
                    data-min="{{ $product->min_order ?? 0 }}"
                    data-max="{{ $product->max_order ?? 0 }}"
                    data-stock="{{ $product->stock_management }}"
                    data-vendor="{{ @$storeinfo->id }}">
                    <i class="fa-light fa-bag-shopping"></i>
                </button>
            @endif
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
