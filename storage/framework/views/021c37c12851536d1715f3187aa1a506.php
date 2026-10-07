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
                        aria-current="page"><?php echo e(trans('landing.blog_section_title')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <div class="container blog-container">
        <div class="blog-card my-3">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card rounded-3 h-100 p-3">
                            <div class="overflow-hidden rounded-3">
                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                    class="card-img-top blog-card-top-img rounded-3 blog-card-hover" height="260"
                                    alt="...">
                            </div>
                            <div class="card-body p-0 pt-3">
                                <a href="<?php echo e(URL::to('/blogdetail-' . $blog->slug)); ?>">
                                    <h6 class="fw-500 pt-2 text-secondary-color text_truncation2">
                                        <?php echo e($blog->title); ?>

                                    </h6>
                                </a>
                                <p class="fs-7 text_truncation2 text-muted m-0">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Ducimus,
                                    nesciunt debitis. Asperiores perferendis, sed iure aut maxime repellat sunt debitis
                                    placeat numquam
                                    quam non aliquid commodi animi excepturi ab perspiciatis.</p>
                            </div>
                            <div class="card-footer pt-3 mt-3 p-0 bg-transparent text-end border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2 align-items-center">
                                        <i class="fa-solid fa-calendar-days fs-7 text-muted"></i>
                                        <p class="fs-7 text-muted">
                                            <?php echo e(helper::date_format($blog->created_at, 1)); ?>

                                        </p>
                                    </div>
                                    <a href="<?php echo e(URL::to('/blogdetail-' . $blog->slug)); ?>">
                                        <div class="text-secondary-color fs-7">
                                            <?php echo e(Str::contains(request()->url(), 'blog') ? trans('landing.read_more') : trans('landing.read_more')); ?>

                                            <i
                                                class="fa-solid <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-left' : 'fa-arrow-right'); ?>"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <?php echo $blogs->links(); ?>

            </div>
        </div>
    </div>
    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\landing\included\bloglist.blade.php ENDPATH**/ ?>