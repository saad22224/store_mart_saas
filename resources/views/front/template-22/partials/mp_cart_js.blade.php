{{-- Theme 22 cart UX: direct add, AJAX qty/remove, no full reload --}}
<script>
(function () {
    if (window.__mpCartJsReady) return;
    window.__mpCartJsReady = true;

    var mpTpl = "{{ helper::appdata(@$storeinfo->id)->template }}";
    if (String(mpTpl) !== '22') return;

    function mpUpdateBadge(count) {
        var el = document.getElementById('cartcnt');
        if (el) {
            el.textContent = count;
            el.style.display = count > 0 ? 'flex' : 'none';
            el.classList.remove('d-none');
        }
        document.querySelectorAll('.cart-count').forEach(function (n) {
            n.textContent = count;
            n.style.display = count > 0 ? 'flex' : 'none';
        });
    }

    function mpRecalcDrawer() {
        var sub = 0;
        document.querySelectorAll('#mpCartDrawer .mp-cart-item').forEach(function (row) {
            var unit = parseFloat(row.getAttribute('data-unit-price') || '0');
            var qtyInput = row.querySelector('input[id^="number_"]');
            var qty = qtyInput ? parseInt(qtyInput.value, 10) || 0 : 0;
            var line = unit * qty;
            sub += line;
            var priceEl = row.querySelector('[data-mp-line-price]');
            if (priceEl && row.getAttribute('data-price-format')) {
                priceEl.textContent = row.getAttribute('data-price-format').replace('__AMT__', line.toFixed(2));
            }
            var small = row.querySelector('[data-mp-line-meta]');
            if (small) small.textContent = qty > 1 ? (unit + ' × ' + qty) : '';
        });
        var totalEl = document.querySelector('#mpCartDrawer [data-mp-subtotal]');
        if (totalEl && totalEl.getAttribute('data-format')) {
            totalEl.textContent = totalEl.getAttribute('data-format').replace('__AMT__', sub.toFixed(2));
        }
        // Prefer server-formatted currency when available via data-currency-html on each update from badge only
    }

    window.mpRecalcDrawerLocal = function (cart_id, qty, unitPrice) {
        var row = document.querySelector('.mp-cart-item[data-cart-id="' + cart_id + '"]');
        if (row) {
            var unit = parseFloat(row.getAttribute('data-unit-price') || unitPrice || 0);
            var lineEl = row.querySelector('[data-mp-line-price]');
            if (lineEl) {
                lineEl.textContent = lineEl.textContent.replace(/[\d]+([.,]\d+)?/, String((unit * qty).toFixed(2)));
            }
        }
        mpRecalcDrawer();
    };

    window.mpRefreshDrawerHtml = function mpRefreshDrawerHtml() {
        // IMPORTANT: do NOT send X-Requested-With.
        // On product detail pages, HomeController@details returns JSON for AJAX
        // requests (product overview modal) instead of the full page HTML.
        // Fetch store home HTML which always includes a fresh cart drawer from DB.
        var refreshUrl = "{{ URL::to(@$storeinfo->slug . '/') }}";
        var sep = refreshUrl.indexOf('?') >= 0 ? '&' : '?';
        refreshUrl = refreshUrl + sep + '_mpcart=' + Date.now();

        return fetch(refreshUrl, {
            headers: { 'Accept': 'text/html' },
            credentials: 'same-origin',
            cache: 'no-store'
        }).then(function (r) {
            if (!r.ok) throw new Error('cart refresh failed');
            return r.text();
        }).then(function (html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            var next = doc.getElementById('mpCartDrawer');
            var cur = document.getElementById('mpCartDrawer');
            if (next && cur) {
                var wasOpen = cur.classList.contains('is-open');
                cur.replaceWith(next);
                if (wasOpen && window.mpOpenCartDrawer) window.mpOpenCartDrawer();
                mpBindDrawerControls();
            }
            var badge = doc.getElementById('cartcnt');
            if (badge) mpUpdateBadge(badge.textContent.trim());
        }).catch(function () {});
    }

    window.mpQuickAdd = function (btn) {
        if (!btn || btn.dataset.busy === '1') return;
        btn.dataset.busy = '1';
        var icon = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ URL::to('/add-to-cart') }}",
            method: 'POST',
            dataType: 'json',
            data: {
                vendor_id: btn.getAttribute('data-vendor'),
                item_id: btn.getAttribute('data-item-id'),
                item_name: btn.getAttribute('data-item-name'),
                item_image: btn.getAttribute('data-item-image'),
                item_price: btn.getAttribute('data-item-price'),
                item_original_price: btn.getAttribute('data-item-original'),
                tax: btn.getAttribute('data-tax') || '',
                qty: 1,
                min_order: btn.getAttribute('data-min') || 0,
                max_order: btn.getAttribute('data-max') || 0,
                stock_management: btn.getAttribute('data-stock') || 2,
                buynow: 0,
                variants_name: '',
                extras_id: '',
                extras_name: '',
                extras_price: ''
            },
            success: function (res) {
                btn.dataset.busy = '0';
                btn.innerHTML = icon;
                if (res.status == 1) {
                    mpUpdateBadge(res.cartcnt);
                    if (typeof toastr !== 'undefined') toastr.success(res.message || "{{ trans('messages.success') }}");
                    mpRefreshDrawerHtml().then(function () {
                        if (window.mpOpenCartDrawer) window.mpOpenCartDrawer();
                    });
                } else {
                    if (typeof toastr !== 'undefined') toastr.error(res.message || "{{ trans('messages.wrong') }}");
                }
            },
            error: function (xhr) {
                btn.dataset.busy = '0';
                btn.innerHTML = icon;
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : (typeof wrong !== 'undefined' ? wrong : 'Error');
                if (typeof toastr !== 'undefined') toastr.error(msg);
            }
        });
    };

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-mp-quick-add]');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        window.mpQuickAdd(btn);
    });

    // Override global cart helpers for Theme 22 (no full page reload)
    var _qtyupdate = window.qtyupdate;
    window.qtyupdate = function (cart_id, item_id, variants_id, price, type) {
        var qtys = parseInt($("#number_" + cart_id).val(), 10) || 1;
        var qty = type === 'decreaseValue' ? qtys - 1 : qtys + 1;
        if (qty < 1) {
            if (typeof RemoveCart === 'function') RemoveCart(cart_id, "{{ @$storeinfo->id }}");
            return;
        }
        $('.change-qty, .mp-qty-btn').prop('disabled', true);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ URL::to('/cart/qtyupdate') }}",
            method: 'POST',
            dataType: 'json',
            data: {
                cart_id: cart_id,
                item_id: item_id,
                type: type,
                qty: qty,
                variants_id: variants_id,
                price: price * qty
            },
            success: function (response) {
                $('.change-qty, .mp-qty-btn').prop('disabled', false);
                if (response.status == 1) {
                    $("#number_" + cart_id).val(qty);
                    var row = document.querySelector('.mp-cart-item[data-cart-id="' + cart_id + '"]');
                    if (row) {
                        var unit = parseFloat(row.getAttribute('data-unit-price') || price || 0);
                        var lineEl = row.querySelector('[data-mp-line-price]');
                        if (lineEl) {
                            // Keep previous currency text shape by replacing numeric part loosely
                            lineEl.textContent = lineEl.textContent.replace(/[\d]+([.,]\d+)?/, String((unit * qty).toFixed(2)));
                        }
                    }
                    mpRecalcDrawer();
                    if (typeof toastr !== 'undefined') toastr.success(response.message || "{{ trans('messages.success') }}");
                } else {
                    if (response.qty !== undefined) $("#number_" + cart_id).val(response.qty);
                    if (typeof toastr !== 'undefined') toastr.error(response.message);
                }
            },
            error: function () {
                $('.change-qty, .mp-qty-btn').prop('disabled', false);
                if (typeof toastr !== 'undefined') toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
            }
        });
    };

    var _RemoveCart = window.RemoveCart;
    window.RemoveCart = function (cart_id, vendor_id) {
        if (typeof Swal === 'undefined') {
            if (_RemoveCart) return _RemoveCart(cart_id, vendor_id);
            return;
        }
        Swal.fire({
            icon: 'warning',
            title: "{{ trans('messages.are_you_sure') }}",
            showCancelButton: true,
            confirmButtonText: "{{ trans('messages.yes') }}",
            cancelButtonText: "{{ trans('messages.no') }}",
            reverseButtons: true
        }).then(function (result) {
            if (!result.isConfirmed) return;
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ URL::to('/cart/deletecartitem') }}",
                method: 'POST',
                dataType: 'json',
                data: { cart_id: cart_id, vendor_id: vendor_id },
                success: function (response) {
                    if (response.status == 1) {
                        mpUpdateBadge(response.cartcnt);
                        var row = document.querySelector('.mp-cart-item[data-cart-id="' + cart_id + '"]');
                        if (row) row.remove();
                        if (!document.querySelector('#mpCartDrawer .mp-cart-item')) {
                            mpRefreshDrawerHtml();
                        } else {
                            mpRecalcDrawer();
                        }
                        // Cart page: remove table row if present
                        var pageRow = document.querySelector('.mp-cart-page .mp-cart-item[data-cart-id="' + cart_id + '"]');
                        if (pageRow) {
                            pageRow.remove();
                            if (!document.querySelector('.mp-cart-page .mp-cart-item')) location.reload();
                        }
                    } else if (typeof toastr !== 'undefined') {
                        toastr.error("{{ trans('messages.wrong') }}");
                    }
                },
                error: function () {
                    if (typeof toastr !== 'undefined') toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
                }
            });
        });
    };

    function mpBindDrawerControls() {
        // open/close already bound in cart_drawer; re-bind open triggers if needed
        document.querySelectorAll('[data-mp-open-cart]').forEach(function (el) {
            el.onclick = function (e) {
                e.preventDefault();
                if (window.mpOpenCartDrawer) window.mpOpenCartDrawer();
            };
        });
        var closeBtn = document.getElementById('mpCartClose');
        var backdrop = document.getElementById('mpCartBackdrop');
        if (closeBtn) closeBtn.onclick = function () { if (window.mpCloseCartDrawer) window.mpCloseCartDrawer(); };
        if (backdrop) backdrop.onclick = function () { if (window.mpCloseCartDrawer) window.mpCloseCartDrawer(); };
    }

    document.addEventListener('DOMContentLoaded', mpBindDrawerControls);
})();
</script>
