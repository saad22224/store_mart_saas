<?php
    $t16Rtl = session()->get('direction') == 2;
    $t16CartQuery = \App\Models\Cart::select(
        'carts.id', 'carts.item_id', 'carts.attribute', 'carts.item_name', 'carts.item_image',
        'carts.item_price', 'carts.extras_name', 'carts.extras_id', 'carts.extras_price',
        'carts.qty', 'carts.price', 'carts.tax', 'carts.variants_id', 'carts.buynow',
        'carts.variants_name', 'carts.variants_price', 'items.slug', 'items.currency', 'carts.color_choice'
    )->join('items', 'carts.item_id', 'items.id')
        ->where('carts.vendor_id', @$storeinfo->id)
        ->where('carts.buynow', '!=', 1);
    if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->type == 3) {
        $t16CartQuery->where('carts.user_id', @\Illuminate\Support\Facades\Auth::user()->id);
    } else {
        $t16CartQuery->where('carts.session_id', \Illuminate\Support\Facades\Session::getId());
    }
    $t16DrawerCart = $t16CartQuery->orderBy('carts.id', 'desc')->get();
    $t16DrawerSub = 0;
    foreach ($t16DrawerCart as $c) {
        $t16DrawerSub += ($c->item_price * $c->qty);
    }
    $t16DrawerCount = $t16DrawerCart->count();
?>

<div class="t16-drawer-backdrop" id="t16CartBackdrop" hidden></div>
<aside class="t16-cart-drawer <?php echo e($t16Rtl ? 'is-rtl' : 'is-ltr'); ?>" id="t16CartDrawer" aria-hidden="true"
    dir="<?php echo e($t16Rtl ? 'rtl' : 'ltr'); ?>">
    <div class="t16-drawer-head">
        <h2><?php echo e(App::getLocale() == 'ar' ? 'سلتك' : 'Your cart'); ?></h2>
        <button type="button" class="t16-drawer-close" id="t16CartClose" aria-label="<?php echo e(App::getLocale() == 'ar' ? 'إغلاق' : 'Close'); ?>">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="t16-drawer-body">
        <?php if($t16DrawerCount > 0): ?>
            <?php $__currentLoopData = $t16DrawerCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('front.template-16.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="t16-drawer-empty">
                <i class="fa-regular fa-basket-shopping"></i>
                <p class="t16-drawer-empty-title"><?php echo e(App::getLocale() == 'ar' ? 'السلة فارغة' : 'Your cart is empty'); ?></p>
                <p class="t16-drawer-empty-sub"><?php echo e(App::getLocale() == 'ar' ? 'أضف أصنافاً من القائمة للمتابعة' : 'Add dishes from the menu to continue'); ?></p>
            </div>
        <?php endif; ?>
    </div>
    <?php if($t16DrawerCount > 0): ?>
        <div class="t16-drawer-foot">
            <div class="t16-drawer-subtotal">
                <span><?php echo e(trans('labels.sub_total')); ?></span>
                <strong data-t16-subtotal><?php echo e(helper::currency_formate($t16DrawerSub, $storeinfo->id)); ?></strong>
            </div>
            <div class="t16-drawer-actions">
                <a href="<?php echo e(URL::to(@$storeinfo->slug.'/cart')); ?>" class="t16-drawer-btn ghost"><?php echo e(App::getLocale() == 'ar' ? 'عرض السلة' : 'View cart'); ?></a>
                <a href="<?php echo e(URL::to(@$storeinfo->slug.'/checkout?buy_now=0')); ?>" class="t16-drawer-btn solid"><?php echo e(trans('labels.checkout')); ?></a>
            </div>
        </div>
    <?php endif; ?>
</aside>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/partials/cart_drawer.blade.php ENDPATH**/ ?>