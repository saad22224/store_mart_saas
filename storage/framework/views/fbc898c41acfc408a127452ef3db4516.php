<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
            <span>/</span>
            <span><?php echo e(trans('labels.faqs')); ?></span>
        </nav>
        <div class="mp-page-head"><h1><?php echo e(trans('labels.faqs')); ?></h1></div>

        <?php if(helper::getfaqs($storeinfo->id)->count() > 0): ?>
            <?php $__currentLoopData = helper::getfaqs($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="mp-faq-item">
                    <summary><?php echo e($faq->question); ?></summary>
                    <div class="mp-faq-body"><?php echo e($faq->answer); ?></div>
                </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make('front.template-22.partials.empty_state', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\faq.blade.php ENDPATH**/ ?>