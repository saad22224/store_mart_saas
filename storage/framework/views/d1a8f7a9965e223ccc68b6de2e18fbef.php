<div id="tips_settings">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-dark fw-600">
                        <?php echo e(trans('labels.tips_settings')); ?>

                    </h5>
                </div>
                <div class="card-body">
                    <form class="form-body" action="<?php echo e(URL::to('admin/tips_settings/update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-6 box-shadow rounded border">
                            <div class="d-flex align-items-center justify-content-between p-3">
                                <p class="fs-6 fw-500 color-changer"><?php echo e(trans('labels.tips_pro')); ?></p>
                                <div class="d-flex justify-content-end align-items-center">
                                    <input id="tips_settings-switch" type="checkbox" class="checkbox-switch"
                                        name="tips_settings" value="1"
                                        <?php echo e(@$othersettingdata->tips_settings == 1 ? 'checked' : ''); ?>>
                                    <label for="tips_settings-switch" class="switch">
                                        <span
                                            class="<?php echo e(session()->get('direction') == '2' ? 'switch__circle-rtl' : 'switch__circle'); ?> switch__circle">
                                            <span class="switch__circle-inner"></span>
                                        </span>
                                        <span
                                            class="switch__left <?php echo e(session()->get('direction') == '2' ? ' pe-2' : ' ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                        <span
                                            class="switch__right <?php echo e(session()->get('direction') == '2' ? ' ps-2' : ' pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div
                            class="form-actions mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/tips_settings/tips_settings.blade.php ENDPATH**/ ?>