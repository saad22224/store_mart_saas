<form action="<?php echo e(URL::to('admin/settings/product_fake_view')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="product_fake_view">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="d-flex align-items-center card-header p-3 bg-secondary">
                        <h5 class="col-md-6 fw-600 text-dark">
                            <?php echo e(trans('labels.product_fake_view')); ?>

                        </h5>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <input id="product_fake_view-switch" type="checkbox" class="checkbox-switch"
                                name="product_fake_view" value="1"
                                <?php echo e($settingdata->product_fake_view == 1 ? 'checked' : ''); ?>>
                            <label for="product_fake_view-switch" class="switch">
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
                                    for="fake_view_message"><?php echo e(trans('labels.fake_view_message')); ?></label>
                                <span class="text-danger">*</span>
                                <p class="text-muted"><?php echo e(trans('labels.fake_view_message_line_1')); ?> <br>
                                    - {eye} <?php echo e(trans('labels.fake_view_message_line_2')); ?> <br>
                                    - {count} <?php echo e(trans('labels.fake_view_message_line_3')); ?> <br>
                                </p>
                                <textarea class="form-control" name="fake_view_message" placeholder="<?php echo e(trans('labels.fake_view_message')); ?>" required><?php echo e($settingdata->fake_view_message); ?></textarea>
                                <?php $__errorArgs = ['fake_view_message'];
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
                                        for="min_view_count"><?php echo e(trans('labels.min_view_count')); ?></label>
                                    <span class="text-danger">*</span>
                                    <p class="text-muted"><?php echo e(trans('labels.min_view_count_info')); ?></p>
                                    <input type="number" min="1" class="form-control" name="min_view_count"
                                        id="min_view_count" value="<?php echo e($settingdata->min_view_count); ?>" required>
                                    <?php $__errorArgs = ['min_view_count'];
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="max_view_count"><?php echo e(trans('labels.max_view_count')); ?> </label>
                                    <span class="text-danger">*</span>
                                    <p class="text-muted"><?php echo e(trans('labels.max_view_count_info')); ?></p>
                                    <input type="number" min="1" class="form-control" name="max_view_count"
                                        id="max_view_count" value="<?php echo e($settingdata->max_view_count); ?>" required>
                                    <?php $__errorArgs = ['max_view_count'];
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
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/product_fake_view/index.blade.php ENDPATH**/ ?>