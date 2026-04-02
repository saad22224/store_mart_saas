<form action="<?php echo e(URL::to('admin/settings/fake_sales_notification')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="fake_sales_notification">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="d-flex align-items-center card-header p-3 bg-secondary">
                        <h5 class="col-md-6 fw-600 text-dark">
                            <?php echo e(trans('labels.fake_sales_notification')); ?>

                        </h5>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <input id="fake_sales_notification-switch" type="checkbox" class="checkbox-switch"
                                name="fake_sales_notification" value="1"
                                <?php echo e($settingdata->fake_sales_notification == 1 ? 'checked' : ''); ?>>
                            <label for="fake_sales_notification-switch" class="switch">
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
                            <div class="col-md-6 form-group">
                                <p class="form-label">
                                    <?php echo e(trans('labels.sales_notification_position')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="sales_notification_position" id="saleradio" value="1"
                                        <?php echo e(@$settingdata->sales_notification_position == '1' ? 'checked' : ''); ?> />
                                    <label for="saleradio" class="form-check-label"><?php echo e(trans('labels.left')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="sales_notification_position" id="saleradio1" value="2"
                                        <?php echo e(@$settingdata->sales_notification_position == '2' ? 'checked' : ''); ?> />
                                    <label for="saleradio1"
                                        class="form-check-label"><?php echo e(trans('labels.right')); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="product_source"><?php echo e(trans('labels.product_source')); ?></label>
                                <span class="text-danger">*</span>
                                <select class="form-control" name="product_source" id="product_source" required>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <option value="1" <?php echo e($settingdata->product_source == '1' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.all_random_product')); ?></option>
                                    <option value="2" <?php echo e($settingdata->product_source == '2' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.all_random_orders')); ?></option>
                                </select>
                                <?php $__errorArgs = ['product_source'];
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
                                        for="next_time_popup"><?php echo e(trans('labels.next_time_popup')); ?></label>
                                    <span class="text-danger">*</span>
                                    <p class="text-muted"><?php echo e(trans('labels.next_time_popup_info')); ?></p>
                                    <input type="number" min="1" class="form-control" name="next_time_popup"
                                        id="next_time_popup" value="<?php echo e($settingdata->next_time_popup); ?>" required>
                                    <?php $__errorArgs = ['next_time_popup'];
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
                                        for="notification_display_time"><?php echo e(trans('labels.notification_display_time')); ?>

                                    </label>
                                    <span class="text-danger">*</span>
                                    <p class="text-muted"><?php echo e(trans('labels.next_time_popup_info')); ?></p>
                                    <input type="number" min="1" class="form-control"
                                        name="notification_display_time" id="notification_display_time"
                                        value="<?php echo e($settingdata->notification_display_time); ?>" required>
                                    <?php $__errorArgs = ['notification_display_time'];
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
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/fake_sales_notification/index.blade.php ENDPATH**/ ?>