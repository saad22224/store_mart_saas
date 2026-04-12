<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 box-shadow">
            <form action="<?php echo e(URL::to('/admin/facebook_login')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-header rounded-top p-3 bg-secondary">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-capitalize fw-600 settings-color"><?php echo e(trans('labels.facebook_login')); ?></h5>
                        <div class="form-group m-0">
                            <input id="facebook-switch" type="checkbox" class="checkbox-switch" name="facebook_mode"
                                value="1" <?php echo e($settingdata->facebook_mode == 1 ? 'checked' : ''); ?>>
                            <label for="facebook-switch" class="switch">
                                <span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                        class="switch__circle-inner"></span></span>
                                <span
                                    class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                <span
                                    class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="form-label"><?php echo e(trans('labels.facebook_client_id')); ?><span class="text-danger">
                                    *
                                </span></label>
                            <input type="text" class="form-control" name="facebook_client_id" pattern="*"
                                value="<?php echo e(@$settingdata->facebook_client_id); ?>"
                                placeholder="<?php echo e(trans('labels.facebook_client_id')); ?>" required>
                            <?php $__errorArgs = ['facebook_client_id'];
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
                        <div class="form-group col-sm-6">
                            <label class="form-label"><?php echo e(trans('labels.facebook_client_secret')); ?><span
                                    class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control" name="facebook_client_secret" pattern="*"
                                value="<?php echo e(@$settingdata->facebook_client_secret); ?>"
                                placeholder="<?php echo e(trans('labels.facebook_client_secret')); ?>" required>
                            <?php $__errorArgs = ['facebook_client_secret'];
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
                        <div class="form-group col-sm-6">
                            <label class="form-label"><?php echo e(trans('labels.facebook_redirect_url')); ?><span
                                    class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control" name="facebook_redirect_url" pattern="*"
                                value="<?php echo e(@$settingdata->facebook_redirect_url); ?>"
                                placeholder="<?php echo e(trans('labels.facebook_redirect_url')); ?>" required>
                            <?php $__errorArgs = ['facebook_redirect_url'];
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
                    <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                        <button
                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/sociallogin/facebook_login.blade.php ENDPATH**/ ?>