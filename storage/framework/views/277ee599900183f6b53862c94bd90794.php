<form action="<?php echo e(URL::to('admin/settings/wizz_chat_settings')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="wizz_chat_settings">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-header p-3 bg-secondary">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="text-capitalize fw-600 settings-color"><?php echo e(trans('labels.wizz_chat_settings')); ?>

                            </h5>
                            <div>
                                <div class="text-center">
                                    <input id="wizz_chat_on_off" type="checkbox" class="checkbox-switch"
                                        name="wizz_chat_on_off" value="1"
                                        <?php echo e($settingdata->wizz_chat_on_off == 1 ? 'checked' : ''); ?>>
                                    <label for="wizz_chat_on_off" class="switch">
                                        <span
                                            class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>">
                                            <span class="switch__circle-inner"></span>
                                        </span>
                                        <span
                                            class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>">
                                            <?php echo e(trans('labels.off')); ?>

                                        </span>
                                        <span
                                            class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>">
                                            <?php echo e(trans('labels.on')); ?>

                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="form-label"><?php echo e(trans('labels.wizz_chat_info')); ?> <a
                                        href="https://app.wizzchat.com/"
                                        target="_blank"><?php echo e(trans('labels.click_here')); ?></a></label>
                                <textarea class="form-control" name="wizz_chat_settings" placeholder="<script type=&quot;text/javascript&quot;></script>" required><?php echo e(@$settingdata->wizz_chat_settings); ?></textarea>
                            </div>

                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/wizz_chat_settings/index.blade.php ENDPATH**/ ?>