@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $subtotal = 0;
    foreach ($cartdata as $cart) {
        $subtotal += $cart->item_price * $cart->qty;
    }
    $minOrder = helper::appdata($storeinfo->id)->min_order_amount ?? 0;
@endphp

<main class="t16-cart-page">
    <div class="t16-shell" style="padding-top:22px;">
        <a href="{{ URL::to($storeinfo->slug) }}" class="t16-back-link">
            <i class="fa-solid {{ session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
            {{ App::getLocale() == 'ar' ? 'متابعة التسوق' : 'Continue shopping' }}
        </a>

        <div class="t16-section-head" style="margin-top:8px;">
            <div>
                <h1 class="t16-section-title" style="text-transform:none;letter-spacing:-.02em;">{{ App::getLocale() == 'ar' ? 'سلتك' : 'Your cart' }}</h1>
                <p class="t16-section-sub">{{ App::getLocale() == 'ar' ? 'راجع أصنافك ثم أكمل الطلب' : 'Review your dishes, then checkout' }}</p>
            </div>
        </div>

        @if (count($cartdata) > 0)
            @if (@helper::checkaddons('cart_checkout_countdown'))
                <div class="mb-3">@include('front.cart_checkout_countdown')</div>
            @endif

            <div class="t16-cart-layout">
                <div class="t16-cart-list">
                    @foreach ($cartdata as $cart)
                        @include('front.template-16.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo])
                    @endforeach
                    @if (@helper::checkaddons('cart_checkout_progressbar'))
                        <div class="mt-3">@include('front.cart_checkout_progressbar')</div>
                    @endif
                </div>

                <aside class="t16-cart-summary">
                    <div class="t16-cart-summary-row">
                        <span>{{ trans('labels.sub_total') }}</span>
                        <strong data-t16-subtotal>{{ helper::currency_formate($subtotal, $storeinfo->id) }}</strong>
                    </div>
                    <button type="button" class="t16-drawer-btn solid cart_checkout"
                        onclick="checkminorderamount('{{ $subtotal }}','{{ Auth::user() && Auth::user()->type == 3 || helper::appdata($storeinfo->id)->checkout_login_required == 2 ? URL::to($storeinfo->slug.'/checkout?buy_now=0') : '' }}')">
                        {{ trans('labels.checkout') }}
                    </button>
                    <a href="{{ URL::to($storeinfo->slug) }}" class="t16-drawer-btn ghost">
                        {{ App::getLocale() == 'ar' ? 'العودة للقائمة' : 'Back to menu' }}
                    </a>
                </aside>
            </div>
        @else
            <div class="t16-empty" style="margin-top:12px;">
                <i class="fa-regular fa-basket-shopping"></i>
                <p style="margin:8px 0 4px;font-weight:800;color:var(--t16-ink);">
                    {{ App::getLocale() == 'ar' ? 'السلة فارغة' : 'Your cart is empty' }}
                </p>
                <p style="margin:0 0 16px;">{{ App::getLocale() == 'ar' ? 'أضف أصنافاً من القائمة للمتابعة' : 'Add dishes from the menu to continue' }}</p>
                <a href="{{ URL::to($storeinfo->slug) }}" class="t16-add-btn" style="display:inline-flex;">
                    {{ App::getLocale() == 'ar' ? 'تصفح القائمة' : 'Browse menu' }}
                </a>
            </div>
        @endif
    </div>
</main>

@include('front.theme.footer')

<script>
    var minorderamount = "{{ $minOrder }}";
    var qtycheckurl = "{{ URL::to($storeinfo->slug.'/qtycheckurl') }}";
    function checkminorderamount(subtotal, checkouturl) {
        $('.cart_checkout').prop('disabled', true);
        $('.cart_checkout').html('<span class="loader"></span>');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: qtycheckurl,
            method: 'post',
            data: { vendor_id: "{{ $storeinfo->id }}" },
            success: function (data) {
                if (data.status == 1) {
                    if (parseInt(minorderamount) <= parseInt(subtotal)) {
                        if (checkouturl != null && checkouturl != '') {
                            location.href = checkouturl;
                        } else {
                            $('#loginmodel').modal('show');
                            $('#loginmodel').on('hidden.bs.modal', function () {
                                $('.cart_checkout').prop('disabled', false);
                                $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                            });
                        }
                    } else {
                        $('.cart_checkout').prop('disabled', false);
                        $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                        toastr.error('{{ trans('messages.min_order_amount_required') }}' + minorderamount);
                    }
                } else {
                    $('.cart_checkout').prop('disabled', false);
                    $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                    toastr.error(data.message);
                }
            },
            error: function () {
                $('.cart_checkout').prop('disabled', false);
                $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
            }
        });
    }
</script>
