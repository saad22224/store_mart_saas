{{-- Theme 22 order summary --}}
@php
    $mpSubtotal = $subtotal ?? 0;
@endphp
<aside class="mp-cart-summary">
    <h3>{{ trans('labels.order_summary') ?? 'ملخص الطلب' }}</h3>
    <div class="mp-summary-row">
        <span>{{ trans('labels.sub_total') }}</span>
        <strong>{{ helper::currency_formate($mpSubtotal, $storeinfo->id) }}</strong>
    </div>
    <div class="mp-summary-row mp-summary-note">
        <span>{{ trans('labels.extra_charges') ?? 'قد تُحسب الشحن والضرائب عند إتمام الطلب' }}</span>
    </div>
    <div class="mp-summary-row mp-summary-total">
        <span>{{ trans('labels.total') ?? 'الإجمالي' }}</span>
        <strong>{{ helper::currency_formate($mpSubtotal, $storeinfo->id) }}</strong>
    </div>

    <div class="mp-summary-actions">
        @if (@helper::checkaddons('customer_login'))
            @if (Auth::user() && Auth::user()->type == 3)
                <button type="button" class="mp-btn-primary w-100 cart_checkout"
                    onclick="checkminorderamount('{{ $mpSubtotal }}','{{ URL::to(@$storeinfo->slug . '/checkout?buy_now=0') }}')">
                    {{ trans('labels.checkout') }}
                </button>
            @else
                @if (helper::appdata($storeinfo->id)->checkout_login_required == 1)
                    <button type="button" class="mp-btn-primary w-100 cart_checkout"
                        @if (helper::appdata($storeinfo->id)->is_checkout_login_required == 1) onclick="login()" @else onclick="checkminorderamount('{{ $mpSubtotal }}','')" @endif>
                        {{ trans('labels.checkout') }}
                    </button>
                @else
                    <button type="button" class="mp-btn-primary w-100 cart_checkout"
                        onclick="checkminorderamount('{{ $mpSubtotal }}','{{ URL::to(@$storeinfo->slug . '/checkout?buy_now=0') }}')">
                        {{ trans('labels.checkout') }}
                    </button>
                @endif
            @endif
        @else
            <button type="button" class="mp-btn-primary w-100 cart_checkout"
                onclick="checkminorderamount('{{ $mpSubtotal }}','{{ URL::to(@$storeinfo->slug . '/checkout?buy_now=0') }}')">
                {{ trans('labels.checkout') }}
            </button>
        @endif
        <a href="{{ URL::to($storeinfo->slug) }}" class="mp-btn-outline w-100">{{ trans('labels.continue_shoping') }}</a>
    </div>
</aside>
