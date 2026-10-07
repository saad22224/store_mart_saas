<?php $__env->startSection('content'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="breadcrumb-sec bg-light bg-changer">
        <div class="container">
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark color-changer"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"
                        aria-current="page"><?php echo e(trans('labels.blog_details')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="details-text">
                <img src="<?php echo e(helper::image_path($getblog->image)); ?>" class="img-fluid blog-details-img " alt="...">
                <div class="d-flex align-items-baseline pt-3">
                    <i class="fa-solid fa-calendar-days card-date"></i>
                    <p class="card-date px-2"><?php echo e(helper::date_format($getblog->created_at, 1)); ?></p>
                </div>
                <h5 class="blog-details-title fw-semibold pb-3 pt-2 color-changer">
                    <?php echo e($getblog->title); ?></h5>
                <div class="cms-section fs-7">
                    <p class="details-footer m-0" data-aos="fade-up" data-aos-darution="1000" data-aos-delay="100">
                        <?php echo $getblog->description; ?>

                    </p>
                </div>
                <h5 class="recent-blogs-titel color-changer pt-5 pb-4"><?php echo e(trans('landing.related_blogs')); ?></h5>
            </div>
            <div class="owl-carousel blogs-slaider owl-theme pb-5">
                <?php echo $__env->make('landing.included.blogcommonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="d-flex justify-content-center view-all-btn">
                <a href="<?php echo e(URL::to('/blogs')); ?>" class="btn-secondary rounded-2"><?php echo e(trans('landing.view_all')); ?>

                </a>
            </div>
        </div>
    </section>
    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\landing\included\blogdetail.blade.php ENDPATH**/ ?>