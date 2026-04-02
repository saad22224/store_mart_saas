<?php $__env->startSection('content'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="breadcrumb-sec m-0 bg-light bg-changer">
        <div class="container">
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark color-changer" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"
                        aria-current="page"><?php echo e(trans('landing.our_stors')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- slaider-section start -->
    <section>
        <div class="owl-carousel hotels-slaider owl-theme">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to('/' . $banner['vendor_info']->slug)); ?>" target="_blank">
                    <div class="item item-1">
                        <img src="<?php echo e(helper::image_path($banner->image)); ?>" class="mg-fluid">
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <!-- slaider-section end -->
    <!--card-section start -->
    <section>
        <div class="container">
            <form action="<?php echo e(URL::to('/stores')); ?>" method="get">
                <div class="row d-flex justify-content-center align-items-center my-4">
                    <div>
                        <div class="card shadow w-100 border-0 d-flex">
                            <div class="card-header p-3 bg-transparent border-bottom">
                                <h5 class="fw-600 m-0 color-changer">
                                    Find Your Shope
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city" class="form-label mb-1 hotel-label"><?php echo e(trans('landing.store_category')); ?></label>
                                            <select name="store" class="form-select cursor-pointer py-2" id="store">
                                                <option value=""><?php echo e(trans('landing.select')); ?></option>
                                                <?php $__currentLoopData = $storecategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($store->name); ?>"  <?php echo e(request()->get('store') == $store->name ? 'selected' : ''); ?>><?php echo e($store->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="country" class="form-label mb-1 hotel-label"><?php echo e(trans('landing.city')); ?></label>
                                        <select name="country" class="form-select py-2 cursor-pointer" id="country">
                                            <option value=""
                                                data-value="<?php echo e(URL::to('/stores?country=' . '&city=' . request()->get('city'))); ?>"
                                                data-id="0" selected><?php echo e(trans('landing.select')); ?></option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->name); ?>"
                                                    data-value="<?php echo e(URL::to('/stores?country=' . request()->get('country') . '&city=' . request()->get('city'))); ?>"
                                                    data-id=<?php echo e($country->id); ?>

                                                    <?php echo e(request()->get('country') == $country->name ? 'selected' : ''); ?>>
                                                    <?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city" class="form-label mb-1 hotel-label"><?php echo e(trans('landing.area')); ?></label>
                                            <select name="city" class="form-select cursor-pointer py-2" id="city">
                                                <option value=""><?php echo e(trans('landing.select')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 d-flex flex-column justify-content-end">
                                        <label class="form-lables mb-1 hotel-label"></label>
                                        <button type="submit" class="btn btn-secondary py-2 m-0 w-100 btn-class"><?php echo e(trans('landing.submit')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if($stores->count() > 0): ?>
                <div class="title-restaurant text-center">
                    <?php if(!empty(request()->get('city')) && request()->get('city') != null): ?>
                        <h5 class="mt-5 mb-5"><?php echo e(trans('landing.stores_in')); ?> <?php echo e(@$city_name); ?></h5>
                    <?php endif; ?>
                </div>
                <div
                    class="row row-cols-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xll-4 g-md-4 g-2 mb-5">
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <a href="<?php echo e(URL::to('/' . $store->slug)); ?>" target="_blank">
                                <div class="post-slide h-100 card border-0">
                                    <div class="post-img rounded-3 overflow-hidden">
                                        <span class="over-layer">
                                        </span>
                                        <img src="<?php echo e(helper::image_path(@helper::appdata($store->id)->cover_image)); ?>" alt="">
                                    </div>
                                    <div class="card-body pt-3 p-0">
                                        <h3 class="fs-6 post-title text-capitalize color-changer fw-600 line-2 m-0">
                                            <?php echo e(@helper::appdata($store->id)->website_title); ?>

                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="d-flex justify-content-center mt-3">

                    <?php echo $stores->links(); ?>


                </div>
            <?php else: ?>
                <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </section>
    <!--card-section end-->
        
    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('landing.select')); ?>";
        var cityname = "<?php echo e(request()->get('city')); ?>";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/landing/js/store.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/landing/stores.blade.php ENDPATH**/ ?>