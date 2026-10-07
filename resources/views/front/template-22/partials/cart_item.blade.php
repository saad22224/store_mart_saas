{{-- Theme 22 cart line item — reuses qtyupdate / RemoveCart --}}
@php
    $lineTotal = $cart->price ?? ($cart->item_price * $cart->qty);
    $detailSlug = $cart->slug ?? optional(helper::getmin_maxorder($cart->item_id, $storeinfo->id))->slug;
    $detailUrl = $detailSlug ? URL::to($storeinfo->slug . '/detail-' . $detailSlug) : '#';
    $unitPrice = $cart->item_price;
@endphp
<div class="mp-cart-item" data-cart-id="{{ $cart->id }}" data-unit-price="{{ $unitPrice }}">
    <a href="{{ $detailUrl }}" class="mp-cart-item-img">
        <img src="{{ helper::image_path($cart->item_image) }}" alt="{{ $cart->item_name }}" loading="lazy">
    </a>
    <div class="mp-cart-item-body">
        <div class="mp-cart-item-top">
            <a href="{{ $detailUrl }}" class="mp-cart-item-name">{{ $cart->item_name }}</a>
            <button type="button" class="mp-cart-remove" aria-label="{{ trans('labels.remove') }}"
                onclick="RemoveCart('{{ $cart->id }}','{{ $storeinfo->id }}')">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
        @if (!empty($cart->variants_name) || !empty($cart->extras_name) || !empty($cart->color_choice))
            <div class="mp-cart-item-meta">
                @if (!empty($cart->variants_name))
                    <span>{{ $cart->variants_name }}</span>
                @endif
                @if (!empty($cart->color_choice))
                    <span>{{ trans('labels.colors') ?? 'اللون' }}: {{ $cart->color_choice }}</span>
                @endif
                @if (!empty($cart->extras_name))
                    <span>{{ $cart->extras_name }}</span>
                @endif
            </div>
        @endif
        <div class="mp-cart-item-price">
            <span class="mp-price-now" data-mp-line-price>{{ helper::currency_formate($lineTotal, $storeinfo->id, $cart->currency ?? null) }}</span>
            @if (($cart->qty ?? 1) > 1)
                <small data-mp-line-meta>{{ $cart->qty }} × {{ helper::currency_formate($cart->item_price, $storeinfo->id, $cart->currency ?? null) }}</small>
            @endif
        </div>
        <div class="mp-cart-item-bottom">
            <div class="mp-qty">
                <button type="button" class="mp-qty-btn change-qty"
                    onclick="qtyupdate('{{ $cart->id }}','{{ $cart->item_id }}','{{ $cart->variants_id }}','{{ $cart->item_price }}','decreaseValue')">
                    <i class="fa fa-minus"></i>
                </button>
                <input type="text" id="number_{{ $cart->id }}" value="{{ $cart->qty }}" readonly>
                <button type="button" class="mp-qty-btn change-qty"
                    onclick="qtyupdate('{{ $cart->id }}','{{ $cart->item_id }}','{{ $cart->variants_id }}','{{ $cart->item_price }}','increase')">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
