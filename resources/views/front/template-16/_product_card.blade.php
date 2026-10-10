@php
    $cartdata = $cartdata ?? collect();
    $key = $key ?? 0;

    if ($item->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
        $deal = helper::top_deals($storeinfo->id);
        if ($item['variation']->count() > 0) {
            $basePrice = $item['variation'][0]->price;
            $price = ($deal->offer_type == 1)
                ? ($basePrice > $deal->offer_amount ? $basePrice - $deal->offer_amount : $basePrice)
                : ($basePrice - $basePrice * ($deal->offer_amount / 100));
            $original_price = $basePrice;
        } else {
            $basePrice = $item->item_price;
            $price = ($deal->offer_type == 1)
                ? ($basePrice > $deal->offer_amount ? $basePrice - $deal->offer_amount : $basePrice)
                : ($basePrice - $basePrice * ($deal->offer_amount / 100));
            $original_price = $basePrice;
        }
    } else {
        if ($item['variation']->count() > 0) {
            $price = $item['variation'][0]->price;
            $original_price = $item['variation'][0]->original_price;
        } else {
            $price = $item->item_price;
            $original_price = $item->item_original_price;
        }
    }
    $off = ($original_price > 0 && $original_price > $price)
        ? number_format(100 - ($price * 100) / $original_price, 0)
        : 0;

    $cartQty = 0;
    $cartId = null;
    foreach ($cartdata as $ci) {
        if ((int) $ci->item_id === (int) $item->id) {
            $cartQty += $ci->qty;
            $cartId = $cartId ?? $ci->id;
        }
    }

    $imgFile = $item['product_image']?->image ?? ($item->image ?? null);
    $imgSrc = $imgFile
        ? helper::image_path($imgFile)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');

    $stockMgmt = $item->stock_management ?? 0;
    $isOut = ($stockMgmt == 1 && helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1);
    $onlineOrder = helper::appdata($storeinfo->id)->online_order;
    $uid = 't16_'.$item->id;
    $desc = ! empty($item->description) ? \Illuminate\Support\Str::limit(strip_tags($item->description), 90) : '';
@endphp

<article class="t16-card" id="t16card_{{ $item->id }}" data-name="{{ mb_strtolower($item->item_name) }}"
    style="animation-delay: {{ (is_numeric($key) ? ($key % 10) : 0) * 0.05 }}s;">
    <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}" class="t16-card-media">
        <img src="{{ $imgSrc }}" alt="{{ $item->item_name }}" loading="lazy">
        @if ($off > 0)
            <span class="t16-card-off">-{{ $off }}%</span>
        @endif
    </a>

    <div class="t16-card-body">
        <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}" class="t16-card-name">{{ $item->item_name }}</a>
        @if ($desc !== '')
            <p class="t16-card-desc">{{ $desc }}</p>
        @endif

        <div class="t16-card-footer">
            <div class="t16-card-price-wrap">
                <span class="t16-price">{{ helper::currency_formate($price, $storeinfo->id, $item->currency) }}</span>
                @if ($off > 0)
                    <span class="t16-old-price">{{ helper::currency_formate($original_price, $storeinfo->id, $item->currency) }}</span>
                @endif
            </div>

            @if ($onlineOrder == 1 && ! $isOut)
                <input type="hidden" id="{{ $uid }}_cartid" value="{{ $cartId }}">
                <input type="hidden" id="{{ $uid }}_price" value="{{ $price }}">
                <input type="hidden" id="{{ $uid }}_tax" value="{{ $item->tax }}">
                <input type="hidden" id="{{ $uid }}_image" value="{{ $imgFile }}">
                <input type="hidden" id="{{ $uid }}_name" value="{{ addslashes($item->item_name) }}">
                <input type="hidden" id="{{ $uid }}_stock" value="{{ $stockMgmt }}">
                <input type="hidden" id="{{ $uid }}_min" value="{{ $item->min_order ?? 0 }}">
                <input type="hidden" id="{{ $uid }}_max" value="{{ $item->max_order ?? 0 }}">
                <input type="hidden" id="{{ $uid }}_vendor" value="{{ $storeinfo->id }}">

                @if ($item->has_variants == 1)
                    <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}" class="t16-add-btn">
                        <i class="fa-regular fa-sliders"></i>
                        <span>{{ App::getLocale() == 'ar' ? 'الخيارات' : 'Options' }}</span>
                    </a>
                @else
                    <button type="button" class="t16-add-btn" id="{{ $uid }}_addbtn"
                        style="{{ $cartQty > 0 ? 'display:none;' : '' }}"
                        onclick="t16AddFirst('{{ $item->id }}')">
                        <i class="fa-regular fa-plus"></i>
                        <span>{{ trans('labels.add') }}</span>
                    </button>
                    <div class="t16-qty" id="{{ $uid }}_stepper"
                        style="{{ $cartQty > 0 ? 'display:flex;' : 'display:none;' }}">
                        <button type="button" class="t16-qty-btn" onclick="t16Decrement('{{ $item->id }}')">−</button>
                        <span class="t16-qty-num" id="{{ $uid }}_qtynum">{{ max(1, $cartQty) }}</span>
                        <button type="button" class="t16-qty-btn" onclick="t16Increment('{{ $item->id }}')">+</button>
                    </div>
                @endif
            @elseif ($onlineOrder == 1 && $isOut)
                <span class="t16-out-badge">{{ trans('labels.out_of_stock') }}</span>
            @else
                <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}" class="t16-add-btn">
                    <i class="fa-regular fa-eye"></i>
                    <span>{{ trans('labels.view') }}</span>
                </a>
            @endif
        </div>
    </div>
</article>
