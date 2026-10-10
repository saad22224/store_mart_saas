@php
    $lineTotal = $cart->price ?? ($cart->item_price * $cart->qty);
    $detailSlug = $cart->slug ?? optional(helper::getmin_maxorder($cart->item_id, $storeinfo->id))->slug;
    $detailUrl = $detailSlug ? URL::to($storeinfo->slug.'/detail-'.$detailSlug) : '#';
    $imgSrc = (! empty($cart->item_image) && $cart->item_image !== 'default.png')
        ? helper::image_path($cart->item_image)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');
@endphp
<div class="t16-cart-item" data-cart-id="{{ $cart->id }}" data-unit-price="{{ $cart->item_price }}">
    <a href="{{ $detailUrl }}" class="t16-cart-item-img">
        <img src="{{ $imgSrc }}" alt="{{ $cart->item_name }}" loading="lazy">
    </a>
    <div class="t16-cart-item-body">
        <div class="t16-cart-item-top">
            <a href="{{ $detailUrl }}" class="t16-cart-item-name">{{ $cart->item_name }}</a>
            <button type="button" class="t16-cart-remove" aria-label="{{ trans('labels.remove') }}"
                onclick="RemoveCart('{{ $cart->id }}','{{ $storeinfo->id }}')">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
        @if (! empty($cart->variants_name) || ! empty($cart->extras_name))
            <div class="t16-cart-item-meta">
                @if (! empty($cart->variants_name))
                    <span>{{ $cart->variants_name }}</span>
                @endif
                @if (! empty($cart->extras_name))
                    <span>{{ $cart->extras_name }}</span>
                @endif
            </div>
        @endif
        <div class="t16-cart-item-price">
            <span data-t16-line-price>{{ helper::currency_formate($lineTotal, $storeinfo->id, $cart->currency ?? null) }}</span>
        </div>
        <div class="t16-cart-item-qty">
            <button type="button" class="t16-cart-qty-btn change-qty"
                onclick="qtyupdate('{{ $cart->id }}','{{ $cart->item_id }}','{{ $cart->variants_id }}','{{ $cart->item_price }}','decreaseValue')">
                <i class="fa fa-minus"></i>
            </button>
            <input type="text" id="number_{{ $cart->id }}" value="{{ $cart->qty }}" readonly>
            <button type="button" class="t16-cart-qty-btn change-qty"
                onclick="qtyupdate('{{ $cart->id }}','{{ $cart->item_id }}','{{ $cart->variants_id }}','{{ $cart->item_price }}','increase')">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>
