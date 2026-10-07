<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $subtotal = 0;
    foreach ($cartdata as $cart) {
        $subtotal += $cart->item_price * $cart->qty;
    }
?>

<main class="mp-cart-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <div class="mp-page-head">
            <h1>سلة التسوق</h1>
        </div>

        <?php if(count($cartdata) > 0): ?>
            <?php if(@helper::checkaddons('cart_checkout_countdown')): ?>
                <div class="mb-3"><?php echo $__env->make('front.cart_checkout_countdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <?php endif; ?>
            <div class="mp-cart-layout">
                <div class="mp-cart-list">
                    <?php $__currentLoopData = $cartdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.template-22.partials.cart_item', ['cart' => $cart, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(@helper::checkaddons('cart_checkout_progressbar')): ?>
                        <div class="mt-3"><?php echo $__env->make('front.cart_checkout_progressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                    <?php endif; ?>
                </div>
                <?php echo $__env->make('front.template-22.partials.cart_summary', ['subtotal' => $subtotal, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php else: ?>
            <div class="mp-empty-state">
                <p class="mp-drawer-empty-title" style="font-size:1.25rem;">سلة المشتريات فارغة</p>
                <p class="mp-drawer-empty-sub" style="margin-bottom:22px;">لا يوجد لديك منتجات في سلة التسوق</p>
                <a href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>" class="mp-btn-primary">متابعة التسوق</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    var minorderamount = "<?php echo e(helper::appdata($storeinfo->id)->min_order_amount); ?>";
    var qtycheckurl = "<?php echo e(URL::to($storeinfo->slug . '/qtycheckurl')); ?>";
    function checkminorderamount(subtotal, checkouturl) {
        $('.cart_checkout').prop("disabled", true);
        $('.cart_checkout').html('<span class="loader"></span>');
        $.ajax({
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            url: qtycheckurl,
            method: "post",
            data: { vendor_id: "<?php echo e($storeinfo->id); ?>" },
            success: function(data) {
                if (data.status == 1) {
                    if (parseInt(minorderamount) <= parseInt(subtotal)) {
                        if (checkouturl != null && checkouturl != "") {
                            location.href = checkouturl;
                        } else {
                            $('#loginmodel').modal('show');
                            $("#loginmodel").on('hidden.bs.modal', function() {
                                $('.cart_checkout').prop("disabled", false);
                                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                            });
                        }
                    } else {
                        $('.cart_checkout').prop("disabled", false);
                        $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                        toastr.error('<?php echo e(trans('messages.min_order_amount_required')); ?>' + minorderamount);
                    }
                } else {
                    $('.cart_checkout').prop("disabled", false);
                    $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                    toastr.error(data.message);
                }
            },
            error: function() {
                $('.cart_checkout').prop("disabled", false);
                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                toastr.error(wrong);
            }
        });
    }
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\cart.blade.php ENDPATH**/ ?>