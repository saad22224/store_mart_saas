<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $subtotal = 0;
    foreach ($cartdata as $cart) {
        $subtotal += $cart->item_price * $cart->qty;
    }
    $minOrder = helper::appdata($storeinfo->id)->min_order_amount ?? 0;
?>

<main class="t16-cart-page">
    <div class="t16-shell" style="padding-top:22px;">
        <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-link">
            <i class="fa-solid <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
            <?php echo e(App::getLocale() == 'ar' ? 'متابعة التسوق' : 'Continue shopping'); ?>

        </a>

        <div class="t16-section-head" style="margin-top:8px;">
            <div>
                <h1 class="t16-section-title" style="text-transform:none;letter-spacing:-.02em;"><?php echo e(App::getLocale() == 'ar' ? 'سلتك' : 'Your cart'); ?></h1>
                <p class="t16-section-sub"><?php echo e(App::getLocale() == 'ar' ? 'راجع أصنافك ثم أكمل الطلب' : 'Review your dishes, then checkout'); ?></p>
            </div>
        </div>

        <?php if(count($cartdata) > 0): ?>
            <?php if(@helper::checkaddons('cart_checkout_countdown')): ?>
                <div class="mb-3"><?php echo $__env->make('front.cart_checkout_countdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <?php endif; ?>

            <div class="t16-cart-layout">
                <div class="t16-cart-list">
                    <?php $__currentLoopData = $cartdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.template-16.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(@helper::checkaddons('cart_checkout_progressbar')): ?>
                        <div class="mt-3"><?php echo $__env->make('front.cart_checkout_progressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                    <?php endif; ?>
                </div>

                <aside class="t16-cart-summary">
                    <div class="t16-cart-summary-row">
                        <span><?php echo e(trans('labels.sub_total')); ?></span>
                        <strong data-t16-subtotal><?php echo e(helper::currency_formate($subtotal, $storeinfo->id)); ?></strong>
                    </div>
                    <button type="button" class="t16-drawer-btn solid cart_checkout"
                        onclick="checkminorderamount('<?php echo e($subtotal); ?>','<?php echo e(Auth::user() && Auth::user()->type == 3 || helper::appdata($storeinfo->id)->checkout_login_required == 2 ? URL::to($storeinfo->slug.'/checkout?buy_now=0') : ''); ?>')">
                        <?php echo e(trans('labels.checkout')); ?>

                    </button>
                    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-drawer-btn ghost">
                        <?php echo e(App::getLocale() == 'ar' ? 'العودة للقائمة' : 'Back to menu'); ?>

                    </a>
                </aside>
            </div>
        <?php else: ?>
            <div class="t16-empty" style="margin-top:12px;">
                <i class="fa-regular fa-basket-shopping"></i>
                <p style="margin:8px 0 4px;font-weight:800;color:var(--t16-ink);">
                    <?php echo e(App::getLocale() == 'ar' ? 'السلة فارغة' : 'Your cart is empty'); ?>

                </p>
                <p style="margin:0 0 16px;"><?php echo e(App::getLocale() == 'ar' ? 'أضف أصنافاً من القائمة للمتابعة' : 'Add dishes from the menu to continue'); ?></p>
                <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-add-btn" style="display:inline-flex;">
                    <?php echo e(App::getLocale() == 'ar' ? 'تصفح القائمة' : 'Browse menu'); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    var minorderamount = "<?php echo e($minOrder); ?>";
    var qtycheckurl = "<?php echo e(URL::to($storeinfo->slug.'/qtycheckurl')); ?>";
    function checkminorderamount(subtotal, checkouturl) {
        $('.cart_checkout').prop('disabled', true);
        $('.cart_checkout').html('<span class="loader"></span>');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: qtycheckurl,
            method: 'post',
            data: { vendor_id: "<?php echo e($storeinfo->id); ?>" },
            success: function (data) {
                if (data.status == 1) {
                    if (parseInt(minorderamount) <= parseInt(subtotal)) {
                        if (checkouturl != null && checkouturl != '') {
                            location.href = checkouturl;
                        } else {
                            $('#loginmodel').modal('show');
                            $('#loginmodel').on('hidden.bs.modal', function () {
                                $('.cart_checkout').prop('disabled', false);
                                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                            });
                        }
                    } else {
                        $('.cart_checkout').prop('disabled', false);
                        $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                        toastr.error('<?php echo e(trans('messages.min_order_amount_required')); ?>' + minorderamount);
                    }
                } else {
                    $('.cart_checkout').prop('disabled', false);
                    $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                    toastr.error(data.message);
                }
            },
            error: function () {
                $('.cart_checkout').prop('disabled', false);
                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                toastr.error(typeof wrong !== 'undefined' ? wrong : 'Error');
            }
        });
    }
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/cart.blade.php ENDPATH**/ ?>