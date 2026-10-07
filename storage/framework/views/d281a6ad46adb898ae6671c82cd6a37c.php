<?php $__env->startSection('content'); ?>
    <div class="wrapper">
        <section>
            <div class="container">
                <div class="d-flex justify-between align-items-center w-100 h-100vh">
                    <div
                        class="row justify-content-around align-items-center g-0 w-100 py-5 rounded-4 box-shadow login-form-bg-color">
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto d-lg-block d-none">
                            <img src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/images/login-form.png')); ?>"
                                class="login-page-img" alt="">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto login-form-box">
                            <div class="card overflow-hidden border-0 rounded-0">
                                <div class="row">
                                    <a href="<?php echo e(URL::to($slug)); ?>"
                                        class="logo p-0 d-flex justify-content-center align-items-center ">
                                        <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>"
                                            alt="" class="rounded-circle mb-4 login-imag object-fit-cover">
                                    </a>
                                    <h4 class="text-center"><?php echo e(trans('labels.login')); ?></h4>
                                </div>
                                <div class="card-body pt-0 p-2">
                                    <form class="my-3" method="POST"
                                        action="<?php echo e(URL::to($slug . '/checklogin-normal')); ?>">
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
                                        <div class="form-group">
                                            <label for="password" class="form-label"><?php echo e(trans('labels.password')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="<?php echo e(trans('labels.password')); ?>" id="password" required>
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
                                        <input type="hidden" class="form-control" name="type" value="user">
                                        <div class="text-end">
                                            <a href="<?php echo e(URL::to($slug . '/forgotpassword')); ?>"
                                                class="text-muted fs-8 fw-500">
                                                <i
                                                    class="fa-solid fa-lock-keyhole mx-2 fs-7"></i><?php echo e(trans('labels.forgot_password')); ?>

                                            </a>
                                        </div>
                                        <button class="btn btn-primary w-100 mt-3"
                                            type="submit"><?php echo e(trans('labels.login')); ?></button>
                                    </form>
                                    <?php if(@helper::checkaddons('subscription')): ?>
                                        <?php if(@helper::checkaddons('google_login')): ?>
                                            <?php
                                                $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)
                                                    ->orderByDesc('id')
                                                    ->first();
                                                $user = App\Models\User::where('id', $storeinfo->id)->first();
                                                if (@$user->allow_without_subscription == 1) {
                                                    $google_login = 1;
                                                } else {
                                                    $google_login = @$checkplan->social_login;
                                                }
                                                
                                            ?>
                                            <?php if($google_login == 1): ?>
                                                <div
                                                    class="login-form-bottom-icon d-flex align-items-center justify-content-center text-end mb-3">
                                                    <?php if(helper::appdata($storeinfo->id)->google_mode == 1): ?>
                                                        <a
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($slug . '/login/google-user')); ?>" <?php endif; ?>>
                                                            <button type="button" class="btn btn-primary icon-btn-google">
                                                                <i class="fa-brands fa-google"></i></i></button>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(@helper::checkaddons('google_login')): ?>
                                            <div
                                                class="login-form-bottom-icon d-flex align-items-center justify-content-center text-end mb-3">
                                                <?php if(helper::appdata($storeinfo->id)->google_mode == 1): ?>
                                                    <a
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  href="<?php echo e(URL::to($slug . '/login/google-user')); ?>" <?php endif; ?>>
                                                        <button type="button" class="btn btn-primary icon-btn-google"> <i
                                                                class="fa-brands fa-google"></i></i></button>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(@helper::checkaddons('subscription')): ?>
                                        <?php if(@helper::checkaddons('facebook_login')): ?>
                                            <?php
                                                $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)
                                                    ->orderByDesc('id')
                                                    ->first();
                                                $user = App\Models\User::where('id', $storeinfo->id)->first();
                                                if (@$user->allow_without_subscription == 1) {
                                                    $facebook_login = 1;
                                                } else {
                                                    $facebook_login = @$checkplan->social_login;
                                                }
                                                
                                            ?>
                                            <?php if($facebook_login == 1): ?>
                                                <div
                                                    class="login-form-bottom-icon d-flex align-items-center justify-content-center text-end mb-3">
                                                    <?php if(helper::appdata($storeinfo->id)->facebook_mode == 1): ?>
                                                        <a
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($slug . '/login/facebook-user')); ?>" <?php endif; ?>>
                                                            <button type="button"
                                                                class="btn btn-primary px-3 icon-btn-facebook mx-1"><i
                                                                    class="fa-brands fa-facebook-f"></i></button>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(@helper::checkaddons('facebook_login')): ?>
                                            <div
                                                class="login-form-bottom-icon d-flex align-items-center justify-content-center text-end mb-3">
                                                <?php if(helper::appdata($storeinfo->id)->facebook_mode == 1): ?>
                                                    <a
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  href="<?php echo e(URL::to($slug . '/login/facebook-user')); ?>" <?php endif; ?>>
                                                        <button type="button"
                                                            class="btn btn-primary px-3 icon-btn-facebook mx-1"><i
                                                                class="fa-brands fa-facebook-f"></i></button>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="fs-7 text-center mt-3"><?php echo e(trans('labels.dont_have_account')); ?>

                                <a href="<?php echo e(URL::to($slug . '/register')); ?>"
                                    class="text-primary fw-semibold"><?php echo e(trans('labels.register')); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\front\auth\login.blade.php ENDPATH**/ ?>