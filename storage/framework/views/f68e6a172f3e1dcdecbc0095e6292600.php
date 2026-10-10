
<script>
(function () {
    if (window.__t16CartJsReady) return;
    window.__t16CartJsReady = true;

    var tpl = "<?php echo e(helper::appdata(@$storeinfo->id)->template); ?>";
    if (String(tpl) !== '16') return;

    function t16UpdateBadge(count) {
        var el = document.getElementById('cartcnt');
        if (el) {
            el.textContent = count;
            el.classList.remove('d-none');
            el.style.display = count > 0 ? 'flex' : 'none';
        }
        document.querySelectorAll('.cart-count').forEach(function (n) {
            n.textContent = count;
            n.style.display = count > 0 ? 'flex' : 'none';
        });
    }

    function t16RecalcDrawer() {
        var sub = 0;
        document.querySelectorAll('#t16CartDrawer .t16-cart-item').forEach(function (row) {
            var unit = parseFloat(row.getAttribute('data-unit-price') || '0');
            var qtyInput = row.querySelector('input[id^="number_"]');
            var qty = qtyInput ? parseInt(qtyInput.value, 10) || 0 : 0;
            var line = unit * qty;
            sub += line;
            var priceEl = row.querySelector('[data-t16-line-price]');
            if (priceEl) {
                priceEl.textContent = priceEl.textContent.replace(/[\d]+([.,]\d+)?/, String(line.toFixed(2)));
            }
        });
        var totalEl = document.querySelector('#t16CartDrawer [data-t16-subtotal]');
        if (totalEl) {
            totalEl.textContent = totalEl.textContent.replace(/[\d]+([.,]\d+)?/, String(sub.toFixed(2)));
        }
    }

    window.t16RefreshDrawerHtml = function () {
        var refreshUrl = "<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>";
        var sep = refreshUrl.indexOf('?') >= 0 ? '&' : '?';
        refreshUrl = refreshUrl + sep + '_t16cart=' + Date.now();

        return fetch(refreshUrl, {
            headers: { 'Accept': 'text/html' },
            credentials: 'same-origin',
            cache: 'no-store'
        }).then(function (r) {
            if (!r.ok) throw new Error('cart refresh failed');
            return r.text();
        }).then(function (html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            var nextDrawer = doc.getElementById('t16CartDrawer');
            var nextBackdrop = doc.getElementById('t16CartBackdrop');
            var curDrawer = document.getElementById('t16CartDrawer');
            var curBackdrop = document.getElementById('t16CartBackdrop');
            var wasOpen = curDrawer && curDrawer.classList.contains('is-open');
            if (nextDrawer && curDrawer) {
                curDrawer.replaceWith(nextDrawer);
            }
            if (nextBackdrop && curBackdrop) {
                curBackdrop.replaceWith(nextBackdrop);
            }
            t16BindDrawerControls();
            if (wasOpen && window.t16OpenCartDrawer) window.t16OpenCartDrawer();
            var badge = doc.getElementById('cartcnt');
            if (badge) t16UpdateBadge(badge.textContent.trim());
        }).catch(function () {});
    };

    window.t16OpenCartDrawer = function () {
        var d = document.getElementById('t16CartDrawer');
        var b = document.getElementById('t16CartBackdrop');
        if (!d) return;
        d.classList.add('is-open');
        d.setAttribute('aria-hidden', 'false');
        if (b) { b.hidden = false; b.classList.add('is-open'); }
        document.documentElement.classList.add('t16-drawer-lock');
    };

    window.t16CloseCartDrawer = function () {
        var d = document.getElementById('t16CartDrawer');
        var b = document.getElementById('t16CartBackdrop');
        if (!d) return;
        d.classList.remove('is-open');
        d.setAttribute('aria-hidden', 'true');
        if (b) { b.hidden = true; b.classList.remove('is-open'); }
        document.documentElement.classList.remove('t16-drawer-lock');
    };

    function t16BindDrawerControls() {
        document.querySelectorAll('[data-t16-open-cart]').forEach(function (el) {
            el.onclick = function (e) {
                e.preventDefault();
                window.t16OpenCartDrawer();
            };
        });
        var closeBtn = document.getElementById('t16CartClose');
        var backdrop = document.getElementById('t16CartBackdrop');
        if (closeBtn) closeBtn.onclick = function () { window.t16CloseCartDrawer(); };
        if (backdrop) backdrop.onclick = function () { window.t16CloseCartDrawer(); };
    }

    var _qtyupdate = window.qtyupdate;
    window.qtyupdate = function (cart_id, item_id, variants_id, price, type) {
        var qtys = parseInt($("#number_" + cart_id).val(), 10) || 1;
        var qty = type === 'decreaseValue' ? qtys - 1 : qtys + 1;
        if (qty < 1) {
            if (typeof RemoveCart === 'function') RemoveCart(cart_id, "<?php echo e(@$storeinfo->id); ?>");
            return;
        }
        $('.change-qty, .t16-cart-qty-btn').prop('disabled', true);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "<?php echo e(URL::to('/cart/qtyupdate')); ?>",
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
                $('.change-qty, .t16-cart-qty-btn').prop('disabled', false);
                if (response.status == 1) {
                    $("#number_" + cart_id).val(qty);
                    var row = document.querySelector('.t16-cart-item[data-cart-id="' + cart_id + '"]');
                    if (row) {
                        var unit = parseFloat(row.getAttribute('data-unit-price') || price || 0);
                        var lineEl = row.querySelector('[data-t16-line-price]');
                        if (lineEl) {
                            lineEl.textContent = lineEl.textContent.replace(/[\d]+([.,]\d+)?/, String((unit * qty).toFixed(2)));
                        }
                    }
                    t16RecalcDrawer();
                    if (typeof toastr !== 'undefined') toastr.success(response.message || "<?php echo e(trans('messages.success')); ?>");
                } else {
                    if (response.qty !== undefined) $("#number_" + cart_id).val(response.qty);
                    if (typeof toastr !== 'undefined') toastr.error(response.message);
                }
            },
            error: function () {
                $('.change-qty, .t16-cart-qty-btn').prop('disabled', false);
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
            title: "<?php echo e(trans('messages.are_you_sure')); ?>",
            showCancelButton: true,
            confirmButtonText: "<?php echo e(trans('messages.yes')); ?>",
            cancelButtonText: "<?php echo e(trans('messages.no')); ?>",
            reverseButtons: true
        }).then(function (result) {
            if (!result.isConfirmed) return;
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "<?php echo e(URL::to('/cart/deletecartitem')); ?>",
                method: 'POST',
                dataType: 'json',
                data: { cart_id: cart_id, vendor_id: vendor_id },
                success: function (response) {
                    if (response.status == 1) {
                        t16UpdateBadge(response.cartcnt);
                        document.querySelectorAll('.t16-cart-item[data-cart-id="' + cart_id + '"]').forEach(function (row) {
                            row.remove();
                        });
                        if (!document.querySelector('#t16CartDrawer .t16-cart-item')) {
                            window.t16RefreshDrawerHtml();
                        } else {
                            t16RecalcDrawer();
                        }
                        if (document.querySelector('.t16-cart-page') && !document.querySelector('.t16-cart-page .t16-cart-item')) {
                            location.reload();
                        }
                    } else if (typeof toastr !== 'undefined') {
                        toastr.error("<?php echo e(trans('messages.wrong')); ?>");
                    }
                },
                error: function () {
                    if (typeof toastr !== 'undefined') toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
                }
            });
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        t16BindDrawerControls();
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') window.t16CloseCartDrawer();
        });
        try {
            if (sessionStorage.getItem('t16_open_cart') === '1') {
                sessionStorage.removeItem('t16_open_cart');
                window.t16OpenCartDrawer();
            }
        } catch (e) {}
    });
})();
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/partials/cart_drawer_js.blade.php ENDPATH**/ ?>