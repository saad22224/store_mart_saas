<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
            <span>/</span>
            <span><?php echo e(trans('labels.terms')); ?></span>
        </nav>
        <div class="mp-page-head"><h1><?php echo e(trans('labels.terms')); ?></h1></div>
        <div class="mp-cms-card mp-rich-body">
            <?php if(@$terms->terms_content != ''): ?>
                <?php echo $terms->terms_content; ?>

            <?php else: ?>
                <?php echo $__env->make('front.template-22.partials.empty_state', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\terms.blade.php ENDPATH**/ ?>