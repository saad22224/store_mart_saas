<div id="whatsappmessagesettings">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-capitalize fw-600 settings-color">
                        <?php echo e(trans('labels.whatsapp_message_settings')); ?>

                    </h5>
                </div>
                <form method="POST" action="<?php echo e(URL::to('admin/settings/order_message_update')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.contact')); ?>

                                        <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control numbers_only" name="whatsapp_number"
                                        value="<?php echo e(@whatsapp_helper::whatsapp_message_config(1)->whatsapp_number); ?>"
                                        placeholder="<?php echo e(trans('labels.contact')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label" for=""><?php echo e(trans('labels.whatsapp_chat')); ?>

                                </label>
                                <div class="text-center">
                                    <input id="whatsapp_chat_on_off" type="checkbox" class="checkbox-switch"
                                        name="whatsapp_chat_on_off" value="1"
                                        <?php echo e(whatsapp_helper::whatsapp_message_config(1)->whatsapp_chat_on_off == 1 ? 'checked' : ''); ?>>
                                    <label for="whatsapp_chat_on_off" class="switch">
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
                            <div class="col-md-3 form-group">
                                <label class="form-label" for=""><?php echo e(trans('labels.mobile_view_display')); ?>

                                </label>
                                <div class="text-center">
                                    <input id="whatsapp_mobile_view_on_off" type="checkbox" class="checkbox-switch"
                                        name="whatsapp_mobile_view_on_off" value="1"
                                        <?php echo e(whatsapp_helper::whatsapp_message_config(1)->whatsapp_mobile_view_on_off == 1 ? 'checked' : ''); ?>>
                                    <label for="whatsapp_mobile_view_on_off" class="switch">
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
                            <div class="col-md-3 form-group">
                                <p class="form-label">
                                    <?php echo e(trans('labels.whatsapp_chat_position')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="whatsapp_chat_position" id="chatradio" value="1"
                                        <?php echo e(@whatsapp_helper::whatsapp_message_config(1)->whatsapp_chat_position == '1' ? 'checked' : ''); ?> />
                                    <label for="chatradio" class="form-check-label"><?php echo e(trans('labels.left')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="whatsapp_chat_position" id="chatradio1" value="2"
                                        <?php echo e(@whatsapp_helper::whatsapp_message_config(1)->whatsapp_chat_position == '2' ? 'checked' : ''); ?> />
                                    <label for="chatradio1"
                                        class="form-check-label"><?php echo e(trans('labels.right')); ?></label>
                                </div>
                            </div>
                            <div
                                class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button
                                    class="btn btn-primary px-sm-4  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/included/whatsapp_message/admin_setting_form.blade.php ENDPATH**/ ?>