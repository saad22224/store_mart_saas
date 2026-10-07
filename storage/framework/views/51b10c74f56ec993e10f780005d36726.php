
<?php
    $mpSubtotal = $subtotal ?? 0;
?>
<aside class="mp-cart-summary">
    <h3><?php echo e(trans('labels.order_summary') ?? 'ملخص الطلب'); ?></h3>
    <div class="mp-summary-row">
        <span><?php echo e(trans('labels.sub_total')); ?></span>
        <strong><?php echo e(helper::currency_formate($mpSubtotal, $storeinfo->id)); ?></strong>
    </div>
    <div class="mp-summary-row mp-summary-note">
        <span><?php echo e(trans('labels.extra_charges') ?? 'قد تُحسب الشحن والضرائب عند إتمام الطلب'); ?></span>
    </div>
    <div class="mp-summary-row mp-summary-total">
        <span><?php echo e(trans('labels.total') ?? 'الإجمالي'); ?></span>
        <strong><?php echo e(helper::currency_formate($mpSubtotal, $storeinfo->id)); ?></strong>
    </div>

    <div class="mp-summary-actions">
        <?php if(@helper::checkaddons('customer_login')): ?>
            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                <button type="button" class="mp-btn-primary w-100 cart_checkout"
                    onclick="checkminorderamount('<?php echo e($mpSubtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')">
                    <?php echo e(trans('labels.checkout')); ?>

                </button>
            <?php else: ?>
                <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                    <button type="button" class="mp-btn-primary w-100 cart_checkout"
                        <?php if(helper::appdata($storeinfo->id)->is_checkout_login_required == 1): ?> onclick="login()" <?php else: ?> onclick="checkminorderamount('<?php echo e($mpSubtotal); ?>','')" <?php endif; ?>>
                        <?php echo e(trans('labels.checkout')); ?>

                    </button>
                <?php else: ?>
                    <button type="button" class="mp-btn-primary w-100 cart_checkout"
                        onclick="checkminorderamount('<?php echo e($mpSubtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')">
                        <?php echo e(trans('labels.checkout')); ?>

                    </button>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <button type="button" class="mp-btn-primary w-100 cart_checkout"
                onclick="checkminorderamount('<?php echo e($mpSubtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')">
                <?php echo e(trans('labels.checkout')); ?>

            </button>
        <?php endif; ?>
        <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="mp-btn-outline w-100"><?php echo e(trans('labels.continue_shoping')); ?></a>
    </div>
</aside>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/cart_summary.blade.php ENDPATH**/ ?>