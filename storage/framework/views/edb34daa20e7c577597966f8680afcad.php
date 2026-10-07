<div id="app_section">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="text-capitalize fw-600 settings-color"><?php echo e(trans('labels.app_section')); ?></h5>
                        <?php if(Auth::user()->type == 1): ?>
                            <input id="mobile_app-switch" type="checkbox" class="checkbox-switch" name="mobile_app_on_off"
                                value="1" <?php echo e(@$app->mobile_app_on_off == 1 ? 'checked' : ''); ?>>
                            <label for="mobile_app-switch" class="switch">
                                <span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                        class="switch__circle-inner"></span></span>
                                <span
                                    class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                <span
                                    class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                            </label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <form action="<?php echo e(URL::to('admin/app_section/update')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.android_link')); ?></label>
                                <input type="text" class="form-control" name="android_link"
                                    value="<?php echo e(@$app->android_link); ?>" placeholder="<?php echo e(trans('labels.android_link')); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.ios_link')); ?> </label>
                                <input type="text" class="form-control" name="ios_link"
                                    value="<?php echo e(@$app->ios_link); ?>" placeholder="<?php echo e(trans('labels.ios_link')); ?>">
                            </div>
                            <?php if(Auth::user()->type == 1): ?>
                                <div class="form-group col-md-6">
                                    <label class="form-label"><?php echo e(trans('labels.image')); ?> </label>
                                    <input type="file" class="form-control" name="image">
                                    <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                        src="<?php echo e(helper::image_Path(@$app->image)); ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <div class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button class="btn btn-primary px-sm-4"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\mobile_app\app_section.blade.php ENDPATH**/ ?>