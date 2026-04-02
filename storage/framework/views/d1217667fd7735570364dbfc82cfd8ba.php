<?php $__env->startSection('content'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="breadcrumb-sec bg-light bg-changer">
        <div class="container">
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark color-changer" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"
                        aria-current="page"><?php echo e(trans('landing.faq_section_title')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container faq-container faq">
            <div class="row mt-3">
                
                <div class="col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <?php $__currentLoopData = $allfaqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item border-0 bg-transparent <?php echo e($key == 0 ? 'pt-0' : 'pt-2'); ?>">
                                <h2 class="accordion-header" id="heading-<?php echo e($key); ?>">
                                    <button
                                        class="<?php echo e(session()->get('direction') == 2 ? 'accordion-button-rtl text-end' : 'accordion-button text-start'); ?> border rounded-3 color-changer faq-btn-bg justify-content-between m-0 <?php echo e($key == 0 ? '' : 'collapsed'); ?>"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($key); ?>"
                                        aria-expanded="true" aria-controls="collapse-<?php echo e($key); ?>">
                                        <?php echo e($faq->question); ?>

                                    </button>
                                </h2>
                                <div id="collapse-<?php echo e($key); ?>"
                                    class="accordion-collapse border rounded-2 collapse mt-2 <?php echo e($key == 0 ? 'show bg-black' : ''); ?>"
                                    aria-labelledby="heading-<?php echo e($key); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded-1 bg-changer">
                                        <p class="faq-accordion-lorem-text pt-2 fs-7 color-changer">
                                            <?php echo e($faq->answer); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-lg-5 d-lg-block d-none">
                    <img src="<?php echo e(@helper::image_path( helper::landingsettings()->faq_image)); ?>" alt=""
                        class="w-100 faq-img">
                </div>
            </div>
        </div>
    </section>
    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/landing/faq.blade.php ENDPATH**/ ?>