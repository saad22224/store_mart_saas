<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding:48px 16px;">
        <div class="mp-empty-state" style="max-width:560px;">
            <div class="mp-empty-icon" style="background:#e8f5e9;color:#2e7d32;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3><?php echo e(trans('labels.order_successfull')); ?></h3>
            <p><?php echo e(trans('labels.order_number') ?? 'رقم الطلب'); ?>: <strong><?php echo e($order_number); ?></strong></p>

            <?php $host = $_SERVER['HTTP_HOST'] ?? ''; ?>
            <div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin:16px 0;">
                <input type="text"
                    value="<?php echo e(URL::to($host == env('WEBSITE_HOST') ? $storeinfo->slug . '/find-order/?order=' . $order_number : '/find-order/?order=' . $order_number)); ?>"
                    id="data" class="mp-input" style="flex:1;min-width:200px;" readonly>
                <button type="button" onclick="copytext('<?php echo e(trans('labels.copied')); ?>')" class="mp-btn-outline">
                    <?php echo e(trans('labels.copy')); ?>

                </button>
            </div>

            <div style="display:grid;gap:10px;margin-top:8px;">
                <a href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>" class="mp-btn-primary"><?php echo e(trans('labels.continue_shoping')); ?></a>
                <a href="<?php echo e(URL::to($host == env('WEBSITE_HOST') ? $storeinfo->slug . '/find-order/?order=' . $order_number : '/find-order/?order=' . $order_number)); ?>"
                    class="mp-btn-outline"><?php echo e(trans('labels.track_order') ?? 'تتبع الطلب'); ?></a>
            </div>
        </div>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(!empty($whmessage)): ?>
    <script>window.location.href = "https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata($storeinfo->id)->contact); ?>&text=<?php echo e(urlencode($whmessage)); ?>";</script>
<?php endif; ?>
<script>
function copytext(msg) {
    var copyText = document.getElementById("data");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    if (typeof toastr !== 'undefined') toastr.success(msg);
}
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/ordersuccess.blade.php ENDPATH**/ ?>