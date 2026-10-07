
<?php
    $mpEmptyTitle = $title ?? (trans('labels.no_data_found') ?: 'لا توجد نتائج');
    $mpEmptyMsg = $message ?? (trans('labels.no_data_msg') ?: 'جرّب تصفح المنتجات أو العودة للرئيسية.');
    $mpEmptyCta = $cta ?? (trans('labels.return_to_shop') ?: 'العودة للمتجر');
    $mpEmptyHref = $href ?? URL::to(@$storeinfo->slug . '/');
    $mpEmptyIcon = $icon ?? 'fa-solid fa-box-open';
?>
<div class="mp-empty-state">
    <div class="mp-empty-icon"><i class="<?php echo e($mpEmptyIcon); ?>"></i></div>
    <h3><?php echo e($mpEmptyTitle); ?></h3>
    <p><?php echo e($mpEmptyMsg); ?></p>
    <a href="<?php echo e($mpEmptyHref); ?>" class="mp-btn-primary"><?php echo e($mpEmptyCta); ?></a>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/empty_state.blade.php ENDPATH**/ ?>