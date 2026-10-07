<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------ breadcrumb ------>
<section class="breadcrumb-sec">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug.'/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> active" aria-current="page"><?php echo e(trans('labels.change_password')); ?></li>

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
                                    <h5 class="mb-0 color-changer"><i class="fa-light fa-unlock"></i><span class="px-3"><?php echo e(trans('labels.change_password')); ?></span></h5>
                                </div>
                                <div class="settings-box-body p-3">
                                    <form id="deatilsForm" action="<?php echo e(URL::to($storeinfo->slug . '/change_password/')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="row row-cols-1 row-cols-sm-2 g-3 mb-3">
                                            <div class="col-12">
                                                <label class="form-label label14"><?php echo e(trans('labels.current_password')); ?> : <span class="required">*</span></label>
                                                <input type="password" name="current_password" class="form-control p-3 rounded-2" placeholder="<?php echo e(trans('labels.current_password')); ?>" required="">
                                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label label14"><?php echo e(trans('labels.new_password')); ?> : <span class="required">*</span></label>
                                                <input type="password" name="new_password" class="form-control p-3 rounded-2 mb-0" placeholder="<?php echo e(trans('labels.new_password')); ?>" required="">
                                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label label14"><?php echo e(trans('labels.confirm_password')); ?> : <span class="required">*</span></label>
                                            <input type="password" name="confirm_password" class="form-control p-3 rounded-2 mb-0" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" required="">
                                            <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-store m-0" id="btnsubmit"><?php echo e(trans('labels.submit')); ?></button>
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

<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\change-password.blade.php ENDPATH**/ ?>