<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="breadcrumb-sec bg-change-mode">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>
                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> text-dark active" aria-current="page"><?php echo e(trans('labels.faqs')); ?>

                </li>
            </ol>
        </nav>
    </div>
</section>
<section class="mb-5 faqs">
    <div class="container">
        <?php if(helper::getfaqs($storeinfo->id)->count() > 0): ?>
            <div class="accordion rounded-0 faq-accordion" id="accordionExample">
                <?php $__currentLoopData = helper::getfaqs($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item rounded-0 bg-transparent mb-3">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button shadow-none justify-content-between m-0 <?php echo e($key != 0 ? 'collapsed' : ''); ?>"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($key); ?>"
                                aria-expanded="true" aria-controls="collapse<?php echo e($key); ?>">
                                <?php echo e($faq->question); ?>

                            </button>
                        </h2>
                        <div id="collapse<?php echo e($key); ?>"
                            class="accordion-collapse collapse rounded-0 <?php echo e($key == 0 ? 'show' : ''); ?>"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-changer m-0">
                                <p class="color-changer"><?php echo e($faq->answer); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
</section>
<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\faq.blade.php ENDPATH**/ ?>