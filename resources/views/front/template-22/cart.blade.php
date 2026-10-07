@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

@php
    $subtotal = 0;
    foreach ($cartdata as $cart) {
        $subtotal += $cart->item_price * $cart->qty;
    }
@endphp

<main class="mp-cart-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <div class="mp-page-head">
            <h1>سلة التسوق</h1>
        </div>

        @if (count($cartdata) > 0)
            @if (@helper::checkaddons('cart_checkout_countdown'))
                <div class="mb-3">@include('front.cart_checkout_countdown')</div>
            @endif
            <div class="mp-cart-layout">
                <div class="mp-cart-list">
                    @foreach ($cartdata as $cart)
                        @include('front.template-22.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo])
                    @endforeach
                    @if (@helper::checkaddons('cart_checkout_progressbar'))
                        <div class="mt-3">@include('front.cart_checkout_progressbar')</div>
                    @endif
                </div>
                @include('front.template-22.partials.cart_summary', ['subtotal' => $subtotal, 'storeinfo' => $storeinfo])
            </div>
        @else
            <div class="mp-empty-state">
                <p class="mp-drawer-empty-title" style="font-size:1.25rem;">سلة المشتريات فارغة</p>
                <p class="mp-drawer-empty-sub" style="margin-bottom:22px;">لا يوجد لديك منتجات في سلة التسوق</p>
                <a href="{{ URL::to($storeinfo->slug . '/') }}" class="mp-btn-primary">متابعة التسوق</a>
            </div>
        @endif
    </div>
</main>

@include('front.theme.footer')

<script>
    var minorderamount = "{{ helper::appdata($storeinfo->id)->min_order_amount }}";
    var qtycheckurl = "{{ URL::to($storeinfo->slug . '/qtycheckurl') }}";
    function checkminorderamount(subtotal, checkouturl) {
        $('.cart_checkout').prop("disabled", true);
        $('.cart_checkout').html('<span class="loader"></span>');
        $.ajax({
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            url: qtycheckurl,
            method: "post",
            data: { vendor_id: "{{ $storeinfo->id }}" },
            success: function(data) {
                if (data.status == 1) {
                    if (parseInt(minorderamount) <= parseInt(subtotal)) {
                        if (checkouturl != null && checkouturl != "") {
                            location.href = checkouturl;
                        } else {
                            $('#loginmodel').modal('show');
                            $("#loginmodel").on('hidden.bs.modal', function() {
                                $('.cart_checkout').prop("disabled", false);
                                $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                            });
                        }
                    } else {
                        $('.cart_checkout').prop("disabled", false);
                        $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                        toastr.error('{{ trans('messages.min_order_amount_required') }}' + minorderamount);
                    }
                } else {
                    $('.cart_checkout').prop("disabled", false);
                    $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                    toastr.error(data.message);
                }
            },
            error: function() {
                $('.cart_checkout').prop("disabled", false);
                $('.cart_checkout').html('{{ trans('labels.checkout') }}');
                toastr.error(wrong);
            }
        });
    }
</script>
