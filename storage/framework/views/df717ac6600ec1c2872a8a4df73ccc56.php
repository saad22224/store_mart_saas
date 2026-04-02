<div id="pwa">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-capitalize fw-600 settings-color"><?php echo e(trans('labels.pwa_settings')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        
                    </div>
                    <form method="POST" action="<?php echo e(URL::to('admin/pwasettings')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="form-label" for=""><?php echo e(trans('labels.pwa')); ?> </label>
                                <input id="pwa-switch" type="checkbox" class="checkbox-switch"
                                    name="pwa" value="1"
                                    <?php echo e($settingdata->pwa == 1 ? 'checked' : ''); ?>>
                                <label for="pwa-switch" class="switch">
                                    <span
                                        class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                            class="switch__circle-inner"></span></span>
                                    <span
                                        class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                    <span
                                        class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                </label>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.app_logo')); ?>  <small>(512 x 512)</small></label>
                                <input type="file" class="form-control"
                                    name="app_logo">
                                <?php $__errorArgs = ['app_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                    <br>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                    src="<?php echo e(helper::image_path(@$settingdata->app_logo)); ?>"
                                    alt="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.app_title')); ?> <span
                                    class="text-danger"> * </span></label>
                                <input type="text" class="form-control"
                                    name="app_title" value="<?php echo e($settingdata->app_title); ?>" placeholder="<?php echo e(trans('labels.app_title')); ?>" required>
                            </div> 
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.app_name')); ?> <span
                                    class="text-danger"> * </span></label>
                                <input type="text" class="form-control"
                                    name="app_name" value="<?php echo e($settingdata->app_name); ?>" placeholder="<?php echo e(trans('labels.app_name')); ?>" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.background_color')); ?></label>
                                <input type="color" class="form-control form-control-color w-100 border-0"
                                    name="background_color" value="<?php echo e($settingdata->background_color); ?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.theme_color')); ?></label>
                                <input type="color" class="form-control form-control-color w-100 border-0"
                                    name="theme_color" value="<?php echo e($settingdata->theme_color); ?>">
                            </div>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/pwa/pwa_settings.blade.php ENDPATH**/ ?>