<div id="age_verification">
    <div class="row mb-5">
        <div class="col-12">
            <form action="<?php echo e(URL::to('admin/age_verification')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card border-0 box-shadow">
                    <div class="d-flex align-items-center card-header p-3 bg-secondary">
                        <h5 class="col-md-6 fw-600 text-dark">
                            <?php echo e(trans('labels.age_verification')); ?></h5>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <input id="age_verification-switch" type="checkbox" class="checkbox-switch"
                                name="age_verification_on_off" value="1"
                                <?php echo e(@helper::getagedetails($vendor_id)->age_verification_on_off == 1 ? 'checked' : ''); ?>>
                            <label for="age_verification-switch" class="switch">
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
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <p class="form-label">
                                    <?php echo e(trans('labels.popup_type')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="popup_type" id="age-radio1" value="1"
                                        <?php echo e(@helper::getagedetails($vendor_id)->popup_type == '1' ? 'checked' : ''); ?>

                                        required>
                                    <label for="age-radio1"
                                        class="form-check-label"><?php echo e(trans('labels.default')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="popup_type" id="age-radio2" value="2"
                                        <?php echo e(@helper::getagedetails($vendor_id)->popup_type == '2' ? 'checked' : ''); ?>

                                        required>
                                    <label for="age-radio2"
                                        class="form-check-label"><?php echo e(trans('labels.enter_dob')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="popup_type" id="age-radio3" value="3"
                                        <?php echo e(@helper::getagedetails($vendor_id)->popup_type == '3' ? 'checked' : ''); ?>

                                        required>
                                    <label for="age-radio3"
                                        class="form-check-label"><?php echo e(trans('labels.enter_age')); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.min_age')); ?> <span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="min_age"
                                    value="<?php echo e(@helper::getagedetails($vendor_id)->min_age); ?>"
                                    placeholder="<?php echo e(trans('labels.min_age')); ?>" required>
                            </div>
                            <div
                                class="form-group mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button
                                    class="btn btn-primary px-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" value="1" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/age_verification/index.blade.php ENDPATH**/ ?>