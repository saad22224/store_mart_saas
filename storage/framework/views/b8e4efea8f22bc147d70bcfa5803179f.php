<form action="<?php echo e(URL::to('admin/settings/cart_checkout_countdown')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="cart_checkout_countdown">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="d-flex justify-content-between align-items-center card-header p-3 bg-secondary">
                        <h5 class="text-capitalize text-dark fw-600 m-0">
                            <?php echo e(trans('labels.cart_checkout_countdown')); ?>

                        </h5>
                        <div class="d-flex justify-content-end align-items-center">
                            <input id="cart_checkout_countdown-switch" type="checkbox" class="checkbox-switch"
                                name="cart_checkout_countdown" value="1"
                                <?php echo e($settingdata->cart_checkout_countdown == 1 ? 'checked' : ''); ?>>
                            <label for="cart_checkout_countdown-switch" class="switch">
                                <span
                                    class="<?php echo e(session()->get('direction') == '2' ? 'switch__circle-rtl' : 'switch__circle'); ?> switch__circle"><span
                                        class="switch__circle-inner"></span></span>
                                <span
                                    class="switch__left <?php echo e(session()->get('direction') == '2' ? ' pe-2' : ' ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                <span
                                    class="switch__right <?php echo e(session()->get('direction') == '2' ? ' ps-2' : ' pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label fs-7 fw-500"
                                    for="countdown_message"><?php echo e(trans('labels.countdown_message')); ?></label>
                                <span class="text-danger">*</span>
                                <p class="text-muted"><?php echo e(trans('labels.countdown_message_info')); ?>

                                </p>
                                <textarea class="form-control" name="countdown_message" placeholder="<?php echo e(trans('labels.countdown_message')); ?>" required><?php echo e($settingdata->countdown_message); ?></textarea>
                                <?php $__errorArgs = ['countdown_message'];
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
                            <div class="form-group col-md-12">
                                <label class="form-label fs-7 fw-500"
                                    for="countdown_expired_message"><?php echo e(trans('labels.countdown_expired_message')); ?></label>
                                <span class="text-danger">*</span>
                                <p class="text-muted"><?php echo e(trans('labels.countdown_expired_message_info')); ?>

                                </p>
                                <textarea class="form-control" name="countdown_expired_message"
                                    placeholder="<?php echo e(trans('labels.countdown_expired_message')); ?>" required><?php echo e($settingdata->countdown_expired_message); ?></textarea>
                                <?php $__errorArgs = ['countdown_expired_message'];
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="countdown_mins"><?php echo e(trans('labels.countdown_mins')); ?> </label>
                                    <span class="text-danger">*</span>
                                    <input type="number" min="1" max="10" class="form-control"
                                        name="countdown_mins" id="countdown_mins"
                                        value="<?php echo e($settingdata->countdown_mins); ?>" required>
                                    <?php $__errorArgs = ['countdown_mins'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span><br>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                <?php echo e(trans('labels.save')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/cart_checkout_countdown/index.blade.php ENDPATH**/ ?>