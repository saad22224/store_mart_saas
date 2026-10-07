<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------ breadcrumb ------>
<section class="breadcrumb-sec bg-change-mode">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug.'/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> active" aria-current="page"><?php echo e(trans('labels.profile')); ?></li>

            </ol>

        </nav>

    </div>

</section>

<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="user-bg-color mb-5">
            <div class="container">
                <div class="row">
                    <?php echo $__env->make('front.theme.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-xl-9 col-lg-8 col-xxl-9 col-12">
                        <div class="card-v p-0 border rounded user-form">
                            <div class="settings-box">
                                <div class="settings-box-header border-bottom px-4 py-3">
                                    <h5 class="mb-0 color-changer"><i class="fa-regular fa-user"></i><span class="px-2"><?php echo e(trans('labels.profile')); ?></span></h5>
                                </div>
                                <div class="settings-box-body p-3">
                                    <form id="deatilsForm" action="<?php echo e(URL::to($storeinfo->slug . '/updateprofile/')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" name="id">
                                        <div class="row row-cols-1 row-cols-sm-2 g-3 mb-3">
                                            <div class="col-12">
                                                <label class="form-label label14"><?php echo e(trans('labels.name')); ?> <span class="required">*</span></label>
                                                <input type="text" name="name" class="form-control p-3 rounded-2" placeholder="<?php echo e(trans('labels.name')); ?>" value="<?php echo e(Auth::user()->name); ?>" required="">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label label14"><?php echo e(trans('labels.email')); ?><span class="required">*</span></label>
                                                <input type="email" name="email" class="form-control p-3 rounded-2 mb-0" placeholder="<?php echo e(trans('labels.email')); ?>" value="<?php echo e(Auth::user()->email); ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label label14"><?php echo e(trans('labels.mobile')); ?> <span class="required">*</span></label>
                                            <input type="text" name="mobile" class="form-control p-3 rounded-2" placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e(Auth::user()->mobile); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label label14"><?php echo e(trans('labels.image')); ?>  </label>
                                            <input type="file" name="profile" class="form-control p-3 rounded-2" >
                                            <?php $__errorArgs = ['profile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?> <br></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <img class="rounded-circle object-fit-cover mt-3" src="<?php echo e(helper::image_path(Auth::user()->image)); ?>"
                                                alt="" width="70" height="70">
                                           
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-store" id="btnsubmit"><?php echo e(trans('labels.submit')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\profile.blade.php ENDPATH**/ ?>