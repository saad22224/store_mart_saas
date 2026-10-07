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
                            <div class="card overflow-hidden border-0 rounded-0 p-2">
                                <div class="row">
                                    <a href="<?php echo e(URL::to($slug)); ?>" class="logo p-0 d-flex justify-content-center align-items-center ">
                                        <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>" alt="" class="rounded-circle mb-4 login-imag object-fit-cover">
                                    </a>
                                    <h4 class="text-center"><?php echo e(trans('labels.register')); ?></h4>
                                </div>
                                <div class="card-body pt-0 ">
                                    <form class="my-3" method="POST" action="<?php echo e(URL::to($slug.'/register_customer')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name" class="form-label"><?php echo e(trans('labels.name')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="name"
                                                    value="<?php echo e(old('name')); ?>" id="name"
                                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>
                                                <?php $__errorArgs = ['name'];
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
                                            <div class="form-group">
                                                <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control" name="email"
                                                    value="<?php echo e(old('email')); ?>" id="email"
                                                    placeholder="<?php echo e(trans('labels.email')); ?>" required>
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
                                            <div class="form-group">
                                                <label for="mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="number" class="form-control" name="mobile"
                                                    value="<?php echo e(old('mobile')); ?>" id="mobile"
                                                    placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
                                                <?php $__errorArgs = ['mobile'];
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
                                            <div class="form-group">
                                                <label for="password" class="form-label"><?php echo e(trans('labels.password')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="password" class="form-control" name="password"
                                                    value="<?php echo e(old('password')); ?>" id="password"
                                                    placeholder="<?php echo e(trans('labels.password')); ?>" required>
                                                <?php $__errorArgs = ['password'];
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
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                                <label class="form-check-label" for="flexCheckChecked"><?php echo e(trans('labels.i_accept_the')); ?>

                                                    <a href="<?php echo e(URL::to($slug.'/terms_condition')); ?>" target="_blank" class="text-primary fw-semibold"><?php echo e(trans('labels.terms')); ?></a>
                                                </label>
                                            </div>
                                        </div>

                                        
                                        <button class="btn btn-primary w-100 mt-3" type="submit"><?php echo e(trans('labels.register')); ?></button>
                                        <p class="fs-7 text-center mb-3"><?php echo e(trans('labels.already_have_an_account')); ?>

                                            <a href="<?php echo e(URL::to($slug.'/login')); ?>"
                                                class="text-primary fw-semibold"><?php echo e(trans('labels.login')); ?></a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\front\auth\register.blade.php ENDPATH**/ ?>