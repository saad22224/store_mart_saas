<script>
function t16Data(itemId) {
    var uid = 't16_' + itemId;
    return {
        cartId: $('#' + uid + '_cartid').val() || '',
        price: $('#' + uid + '_price').val() || 0,
        tax: $('#' + uid + '_tax').val() || '',
        image: $('#' + uid + '_image').val() || '',
        name: $('#' + uid + '_name').val() || '',
        stock: $('#' + uid + '_stock').val() || 0,
        min: $('#' + uid + '_min').val() || 0,
        max: $('#' + uid + '_max').val() || 0,
        vendor: $('#' + uid + '_vendor').val() || ''
    };
}
window.t16Increment = function(itemId) {
    var d = t16Data(itemId), uid = 't16_' + itemId;
    var curQ = parseInt($('#' + uid + '_qtynum').text(), 10) || 0;
    if (curQ === 0) t16DoAdd(itemId, uid, d, 1);
    else t16DoUpdate(itemId, uid, d, curQ + 1);
};
window.t16Decrement = function(itemId) {
    var d = t16Data(itemId), uid = 't16_' + itemId;
    var curQ = parseInt($('#' + uid + '_qtynum').text(), 10) || 1;
    if (curQ <= 1) t16DoRemove(itemId, uid, d);
    else t16DoUpdate(itemId, uid, d, curQ - 1);
};
window.t16AddFirst = function(itemId) {
    var d = t16Data(itemId), uid = 't16_' + itemId;
    t16DoAdd(itemId, uid, d, 1);
};
function t16DoAdd(itemId, uid, d, qty) {
    $('#' + uid + '_addbtn').prop('disabled', true);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '{{ URL::to("/add-to-cart") }}',
        method: 'POST',
        dataType: 'json',
        data: {
            vendor_id: d.vendor, item_id: itemId, item_name: d.name, item_image: d.image,
            item_price: d.price, item_original_price: d.price, tax: d.tax, qty: qty,
            min_order: d.min, max_order: d.max, stock_management: d.stock, buynow: 0,
            variants_name: '', extras_id: '', extras_name: '', extras_price: ''
        },
        success: function(res) {
            if (res.status == 1) {
                $('#cartcnt').text(res.cartcnt).removeClass('d-none');
                $('.cart-count').text(res.cartcnt);
                $('#' + uid + '_addbtn').hide();
                $('#' + uid + '_stepper').css('display', 'flex');
                $('#' + uid + '_qtynum').text(qty);
                if (res.cart_id) $('#' + uid + '_cartid').val(res.cart_id);
                toastr.success('{{ trans("messages.add_to_cart_msg") }}');
                if (typeof window.t16RefreshDrawerHtml === 'function') {
                    window.t16RefreshDrawerHtml();
                }
            } else {
                toastr.error(res.message);
            }
            $('#' + uid + '_addbtn').prop('disabled', false);
        },
        error: function() {
            toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
            $('#' + uid + '_addbtn').prop('disabled', false);
        }
    });
}
function t16DoUpdate(itemId, uid, d, newQty) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '{{ URL::to("/cart/qtyupdate") }}',
        method: 'POST',
        dataType: 'json',
        data: {
            vendor_id: d.vendor, item_id: itemId, cart_id: d.cartId, qty: newQty,
            price: parseFloat(d.price) * newQty, stock_management: d.stock, variants_id: null
        },
        success: function(res) {
            if (res.status == 1) $('#' + uid + '_qtynum').text(newQty);
            else {
                toastr.error(res.message);
                if (res.qty !== undefined) $('#' + uid + '_qtynum').text(res.qty);
            }
        },
        error: function() { toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error'); }
    });
}
function t16DoRemove(itemId, uid, d) {
    if (!d.cartId) {
        $('#' + uid + '_stepper').hide();
        $('#' + uid + '_addbtn').show();
        $('#' + uid + '_qtynum').text(1);
        return;
    }
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '{{ URL::to("/cart/deletecartitem") }}',
        method: 'POST',
        dataType: 'json',
        data: { cart_id: d.cartId, vendor_id: d.vendor },
        success: function(res) {
            if (res.status == 1) {
                $('#cartcnt').text(res.cartcnt);
                $('.cart-count').text(res.cartcnt);
                $('#' + uid + '_stepper').hide();
                $('#' + uid + '_addbtn').show();
                $('#' + uid + '_qtynum').text(1);
                $('#' + uid + '_cartid').val('');
                if (typeof window.t16RefreshDrawerHtml === 'function') {
                    window.t16RefreshDrawerHtml();
                }
            } else toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
        },
        error: function() { toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error'); }
    });
}
</script>
