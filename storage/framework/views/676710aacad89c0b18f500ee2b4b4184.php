
<?php
    if (!isset($cartdata) || $cartdata === null) {
        $mpCartQuery = \App\Models\Cart::select(
            'carts.id', 'carts.item_id', 'carts.attribute', 'carts.item_name', 'carts.item_image',
            'carts.item_price', 'carts.extras_name', 'carts.extras_id', 'carts.extras_price',
            'carts.qty', 'carts.price', 'carts.tax', 'carts.variants_id', 'carts.buynow',
            'carts.variants_name', 'carts.variants_price', 'items.slug', 'items.currency', 'carts.color_choice'
        )->join('items', 'carts.item_id', 'items.id')
            ->where('carts.vendor_id', @$storeinfo->id)
            ->where('carts.buynow', '!=', 1);
        if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->type == 3) {
            $mpCartQuery->where('user_id', @\Illuminate\Support\Facades\Auth::user()->id);
        } else {
            $mpCartQuery->where('session_id', \Illuminate\Support\Facades\Session::getId());
        }
        $mpDrawerCart = $mpCartQuery->get();
    } else {
        $mpDrawerCart = collect($cartdata)->filter(function ($c) {
            return ($c->buynow ?? 0) != 1;
        });
    }
    $mpDrawerSub = 0;
    foreach ($mpDrawerCart as $c) {
        $mpDrawerSub += ($c->item_price * $c->qty);
    }
    $mpDrawerCount = is_countable($mpDrawerCart) ? count($mpDrawerCart) : 0;
?>

<div class="mp-drawer-backdrop" id="mpCartBackdrop" hidden></div>
<aside class="mp-cart-drawer" id="mpCartDrawer" aria-hidden="true" dir="rtl">
    <div class="mp-drawer-head">
        <button type="button" class="mp-drawer-close" id="mpCartClose" aria-label="إغلاق">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2>سلة التسوق</h2>
    </div>
    <div class="mp-drawer-body">
        <?php if($mpDrawerCount > 0): ?>
            <?php $__currentLoopData = $mpDrawerCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('front.template-22.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="mp-drawer-empty">
                <p class="mp-drawer-empty-title">سلة المشتريات فارغة</p>
                <p class="mp-drawer-empty-sub">لا يوجد لديك منتجات في سلة التسوق</p>
            </div>
        <?php endif; ?>
    </div>
    <?php if($mpDrawerCount > 0): ?>
        <div class="mp-drawer-foot">
            <div class="mp-summary-row mp-summary-total">
                <span><?php echo e(trans('labels.sub_total')); ?></span>
                <strong><?php echo e(helper::currency_formate($mpDrawerSub, $storeinfo->id)); ?></strong>
            </div>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/cart')); ?>" class="mp-btn-outline w-100">عرض السلة</a>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>" class="mp-btn-primary w-100"><?php echo e(trans('labels.checkout')); ?></a>
        </div>
    <?php endif; ?>
</aside>

<script>
(function () {
    function openMpCart() {
        var d = document.getElementById('mpCartDrawer');
        var b = document.getElementById('mpCartBackdrop');
        if (!d) return;
        d.classList.add('is-open');
        d.setAttribute('aria-hidden', 'false');
        if (b) { b.hidden = false; b.classList.add('is-open'); }
        document.documentElement.classList.add('mp-drawer-lock');
    }
    function closeMpCart() {
        var d = document.getElementById('mpCartDrawer');
        var b = document.getElementById('mpCartBackdrop');
        if (!d) return;
        d.classList.remove('is-open');
        d.setAttribute('aria-hidden', 'true');
        if (b) { b.hidden = true; b.classList.remove('is-open'); }
        document.documentElement.classList.remove('mp-drawer-lock');
    }
    window.mpOpenCartDrawer = openMpCart;
    window.mpCloseCartDrawer = closeMpCart;
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-mp-open-cart]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                openMpCart();
            });
        });
        var closeBtn = document.getElementById('mpCartClose');
        var backdrop = document.getElementById('mpCartBackdrop');
        if (closeBtn) closeBtn.addEventListener('click', closeMpCart);
        if (backdrop) backdrop.addEventListener('click', closeMpCart);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMpCart();
        });
        try {
            if (sessionStorage.getItem('mp_open_cart') === '1') {
                sessionStorage.removeItem('mp_open_cart');
                openMpCart();
            }
        } catch (e) {}
    });
})();
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/cart_drawer.blade.php ENDPATH**/ ?>