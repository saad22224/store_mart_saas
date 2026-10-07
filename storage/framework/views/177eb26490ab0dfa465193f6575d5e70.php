<?php $__env->startSection('content'); ?>
<div class="wrapper">
    <section>
            <div class="container">
                <div class="d-flex justify-between align-items-center w-100 h-100vh">
                    <div class="row justify-content-around align-items-center g-0 w-100 py-5 rounded-4 box-shadow login-form-bg-color">
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto d-lg-block d-none">
                            <img src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/images/login-form.png')); ?>" class="login-page-img" alt="">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto login-form-box">
                            <div class="card overflow-hidden border-0 rounded-0">
                                <div class="row">
                                    <a href="<?php echo e(URL::to($slug)); ?>" class="logo p-0 d-flex justify-content-center align-items-center ">
                                        <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>" alt="" class="rounded-circle mb-4 login-imag object-fit-cover">
                                    </a>
                                    <h4 class="text-center"><?php echo e(trans('labels.forgot_password')); ?></h4>
                                </div>
                                <div class="card-body pt-0 p-2">
                                    <form class="my-3" method="POST" action="<?php echo e(URL::to($slug.'/send_password')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="<?php echo e(trans('labels.email')); ?>" id="email" required>
                                            <?php $__errorArgs = ['email'];
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
                                        <input type="hidden" class="form-control" name="type" value="user">
                                        <div class="text-end">
                                            <a href="<?php echo e(URL::to($slug.'/forgotpassword?redirect=user')); ?>" class="text-muted fs-8 fw-500">
                                                <i
                                                    class="fa-solid fa-lock-keyhole mx-2 fs-7"></i><?php echo e(trans('labels.forgot_password')); ?>

                                            </a>
                                        </div>
                                        <button class="btn btn-primary w-100 mt-3" <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> 
                                            type="submit" <?php endif; ?>><?php echo e(trans('labels.submit')); ?></button>
                                    </form>
                                </div>
                            </div>
                            <p class="fs-7 text-center mt-3"><?php echo e(trans('labels.dont_have_account')); ?>

                                <a href="<?php echo e(URL::to($slug.'/login')); ?>"
                                    class="text-primary fw-semibold"><?php echo e(trans('labels.login')); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\front\auth\forgotpassword.blade.php ENDPATH**/ ?>