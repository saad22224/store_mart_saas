<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="breadcrumb-sec bg-change-mode">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug.'/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.latest-post')); ?></li>

                <li class="text-muted breadcrumb-item active" aria-current="page"><?php echo e($blogdetail->title); ?></li>

            </ol>

        </nav>

    </div>

</section>

<div class="blog-sec">
    <div class="container">
        <section class="blog-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="blog-details px-0">
                        <div class="card card-bg border border-0">

                            <img src="<?php echo e(helper::image_path($blogdetail->image)); ?>"
                                class="card-img-top border blog-card-border">

                            <div class="card-body px-0">
                                <div class="row justify-content-between mb-3">
                                    <div class="col-auto text-muted">
                                        <span><?php echo e(helper::date_format($blogdetail->created_at,$blogdetail->vendor_id)); ?></span>
                                    </div>
                                </div>
                                <p class="fs-4 color-changer mb-3"><?php echo e($blogdetail->title); ?></p>
                                <small class="text-muted card-text"><?php echo $blogdetail->description; ?></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <?php if($getblog->count() > 0): ?>
            <section class="mb-4">

                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="text-font color-changer main-title m-0"><?php echo e(trans('labels.latest-post')); ?></h2>
                    <a href="<?php echo e(URL::to($storeinfo->slug.'/blogs')); ?>" class="btn btn-store mobile-btn"><?php echo e(trans('labels.view_all')); ?></a>
                </div>

                <div class="row">
                    <?php $__currentLoopData = $getblog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4 col-xl-3 d-flex mt-3 justify-content-sm-center">
                            <div class="card card-bg w-100 border-0 border-1">
                                <div class="img-overlay border rounded-4 overflow-hidden">
                                    <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                        class="card-img-top" alt="...">
                                </div>
                                <div class="card-body px-0">
                                    <p class="mb-3 line-2 color-changer"><?php echo e($blog->title); ?></p>
                                    <small class="card-text m-0 text-muted line-3"><?php echo Str::limit($blog->description, 100); ?></small>
                                </div>
                                <div class="card-footer border-0 bg-transparent px-0">
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0 text-primary-color fw-medium fs-7 text-muted"><i
                                                class="fa-regular fa-calendar-days"></i>
                                            <?php echo e(helper::date_format($blog->created_at,$blog->vendor_id)); ?></p>
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                            class="read-btn fs-7"><?php echo e(trans('labels.readmore')); ?><span class="mx-1"><i
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-regular fa-arrow-left' : 'fa-regular fa-arrow-right'); ?>"></i></span></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </section>
        <?php else: ?>
            <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

</div>
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\included\blogs\blog_detail.blade.php ENDPATH**/ ?>