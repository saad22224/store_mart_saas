
<style>
.variant-input {
    display: block;
    width: 100%;
    padding: 0.45rem 0.65rem;
    font-size: 0.88rem;
    font-weight: 500;
    line-height: 1.5;
    color: #0f172a !important;
    background-color: #ffffff !important;
    background-clip: padding-box;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 8px !important;
    outline: none;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.variant-input:focus {
    border-color: var(--bs-primary) !important;
    box-shadow: 0 0 0 3px rgba(21, 172, 130, 0.15) !important;
}
</style>

<div class="table-responsive">
    <table class="table table-bordered" id='tblvariants'>
        <thead>
        <tr class="text-center align-middle fs-15 fw-600">
          
            @foreach($variantArray as $variant)
                <th><span class="fs-15 fw-600">{{ ucwords($variant) }}</span></th>
            @endforeach
            <th><span class="fs-15 fw-600">{{ trans('labels.original_price')  }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.selling_price')  }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.stock_qty')  }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.min_order_qty')  }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.max_order_qty') }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.product_low_qty_warning') }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.stock_management') }}</span></th>
            <th><span class="fs-15 fw-600">{{ trans('labels.is_available') }}</span></th>
        </tr>
        </thead>
        <tbody>
            @foreach($possibilities as $counter => $possibility)
            <tr class="fs-7 fw-500 align-middle">
              
                @foreach(explode('|', $possibility) as $key => $values)
                    <td class="text-center align-middle">
                        <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 14px !important; color: #0f172a !important; background-color: #f1f5f9 !important; border: 1.5px solid #cbd5e1 !important; display: inline-block; min-width: 45px;">
                            {{ trim($values) }}
                        </span>
                        <input type="hidden" autocomplete="off" value="{{ $possibility }}" name="verians[{{$counter}}][name]">
                    </td>
                @endforeach
                <td> 
                    <input type="text" id="voriginal_price_{{ $counter }}" placeholder="{{ trans('labels.original_price')  }}" class="variant-input" name="verians[{{$counter}}][original_price]" required>
                </td>
                <td>
                    <input type="text" id="vprice_{{ $counter }}" autocomplete="off" spellcheck="false" placeholder="{{ trans('labels.selling_price')  }}" class="variant-input" name="verians[{{$counter}}][price]" required>
                </td>
               
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vquantity_{{ $counter }}" autocomplete="off" spellcheck="false" placeholder="{{ trans('labels.stock_qty')  }}" class="variant-input" name="verians[{{$counter}}][qty]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmin_order_{{ $counter }}" autocomplete="off" spellcheck="false" placeholder="{{ trans('labels.min_order_qty')  }}" class="variant-input" name="verians[{{$counter}}][min_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmax_order_{{ $counter }}" autocomplete="off" spellcheck="false" placeholder="{{ trans('labels.max_order_qty') }}" class="variant-input" name="verians[{{$counter}}][max_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vlow_qty_{{ $counter }}" autocomplete="off" spellcheck="false" placeholder="{{ trans('labels.product_low_qty_warning') }} " class="variant-input" name="verians[{{$counter}}][low_qty]">
                </td>
                <td class="text-center">
                    <input class="form-check-input stock_management" type="checkbox" value="1" onclick="stock_management(this.id)"
                    name="verians[{{$counter}}][stock_management]" id="vstockmanagement_{{ $counter }}">
                </td>
                <td class="text-center">
                    <input class="form-check-input product_available" type="checkbox" value="1" name="verians[{{$counter}}][is_available]" id="{{$counter}}" onclick="checkavailable(this.id)" checked>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
