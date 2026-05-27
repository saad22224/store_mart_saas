@php
    /* ─── Price calculation (identical to template-7) ─── */
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
            $price          = $item['variation'][0]->price;
            $original_price = $item['variation'][0]->original_price;
        } else {
            $price          = $item->item_price;
            $original_price = $item->item_original_price;
        }
    }
    $off = ($original_price > 0 && $original_price > $price)
        ? number_format(100 - ($price * 100) / $original_price, 0)
        : 0;

    /* ─── Cart state from current session ─── */
    $cartQty = 0;
    $cartId  = null;
    foreach ($cartdata as $ci) {
        if ($ci->item_id == $item->id) {
            $cartQty += $ci->qty;
            $cartId   = $cartId ?? $ci->id;
        }
    }

    $imgSrc    = (@$item['product_image']->image)
        ? helper::image_path($item['product_image']->image)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');

    $stockMgmt  = $item->stock_management ?? 0;
    $isOut      = ($stockMgmt == 1 && helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1);
    $onlineOrder = helper::appdata($storeinfo->id)->online_order;

    /* unique id for this card's DOM elements */
    $uid = 't16_' . $item->id;
@endphp

<div class="t16-card" id="t16card_{{ $item->id }}">

    {{-- ── Image ── --}}
    <div class="t16-card-img">
        <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}">
            <img src="{{ $imgSrc }}" alt="{{ $item->item_name }}" loading="lazy">
        </a>
    </div>

    {{-- ── Body ── --}}
    <div class="t16-card-body">
        <div>
            {{-- Name --}}
            <a href="{{ URL::to($storeinfo->slug.'/detail-'.$item->slug) }}" style="text-decoration:none;">
                <div class="t16-card-name">{{ $item->item_name }}</div>
            </a>

            {{-- Description --}}
            @if(!empty($item->description))
                <div class="t16-card-desc">{{ Str::limit(strip_tags($item->description), 80) }}</div>
            @endif

            {{-- Rating --}}
            @if(@helper::checkaddons('product_reviews') && helper::appdata($storeinfo->id)->product_ratting_switch == 1 && $item->ratings_average > 0)
                <div style="margin-top:4px;font-size:.75rem;display:flex;align-items:center;gap:3px;">
                    <i class="fa-solid fa-star" style="color:#f59e0b;"></i>
                    <span style="color:#666;">{{ number_format($item->ratings_average, 1) }}</span>
                </div>
            @endif
        </div>

        {{-- ── Footer: price + action ── --}}
        <div class="t16-card-footer">
            <div>
                {{-- Price --}}
                <span class="t16-price">
                    {{ helper::currency_formate($price, $storeinfo->id, $item->currency) }}
                </span>
                @if($off > 0)
                    <span class="t16-old-price">
                        {{ helper::currency_formate($original_price, $storeinfo->id, $item->currency) }}
                    </span>
                    <span class="t16-off-badge">-{{ $off }}%</span>
                @endif

                {{-- Stock status --}}
                @if($isOut)
                    <div class="t16-out-stock mt-1">
                        <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                        {{ trans('labels.out_of_stock') }}
                    </div>
                @elseif($stockMgmt == 1)
                    <div class="t16-in-stock mt-1">
                        <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                        {{ trans('labels.in_stock') }}
                    </div>
                @endif
            </div>

            {{-- ── Cart action ── --}}
            @if($onlineOrder == 1 && !$isOut)

                {{-- Hidden data fields --}}
                <input type="hidden" id="{{ $uid }}_cartid"  value="{{ $cartId }}">
                <input type="hidden" id="{{ $uid }}_price"   value="{{ $price }}">
                <input type="hidden" id="{{ $uid }}_tax"     value="{{ $item->tax }}">
                <input type="hidden" id="{{ $uid }}_image"   value="{{ @$item['product_image']->image }}">
                <input type="hidden" id="{{ $uid }}_name"    value="{{ addslashes($item->item_name) }}">
                <input type="hidden" id="{{ $uid }}_stock"   value="{{ $stockMgmt }}">
                <input type="hidden" id="{{ $uid }}_min"     value="{{ $item->min_order ?? 0 }}">
                <input type="hidden" id="{{ $uid }}_max"     value="{{ $item->max_order ?? 0 }}">
                <input type="hidden" id="{{ $uid }}_vendor"  value="{{ $storeinfo->id }}">
                <input type="hidden" id="{{ $uid }}_slug"    value="{{ $item->slug }}">
                <input type="hidden" id="{{ $uid }}_qty"     value="{{ $cartQty }}">

                {{-- "Add" button: visible when qty=0 --}}
                <button class="t16-add-btn"
                        id="{{ $uid }}_addbtn"
                        style="{{ $cartQty > 0 ? 'display:none;' : 'display:flex;' }}"
                        onclick="t16AddFirst('{{ $item->id }}')">
                    <i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>
                    {{ trans('labels.add') ?? 'إضافة' }}
                </button>

                {{-- Stepper: visible when qty>0 --}}
                <div class="t16-qty"
                     id="{{ $uid }}_stepper"
                     style="{{ $cartQty > 0 ? 'display:flex;' : 'display:none;' }}">
                    <button class="t16-qty-btn minus"
                            onclick="t16Decrement('{{ $item->id }}')">−</button>
                    <span class="t16-qty-num"
                          id="{{ $uid }}_qtynum">{{ max(1, $cartQty) }}</span>
                    <button class="t16-qty-btn plus"
                            onclick="t16Increment('{{ $item->id }}')">+</button>
                </div>

            @elseif($onlineOrder == 1 && $isOut)
                <button class="t16-add-btn" style="opacity:.45;cursor:not-allowed;" disabled>
                    <i class="fa-regular fa-ban" style="font-size:12px;"></i>
                    {{ trans('labels.out_of_stock') }}
                </button>
            @else
                {{-- View product modal (no online ordering) --}}
                <button class="t16-add-btn"
                        id="iconverifybtn_t16_{{ $item->id }}"
                        onclick="GetProductOverview('{{ $item->slug }}', 'iconverifybtn_t16_{{ $item->id }}')">
                    <i class="fa-regular fa-eye" style="font-size:12px;"></i>
                    {{ trans('labels.view') ?? 'عرض' }}
                </button>
            @endif
        </div>
    </div>
</div>
