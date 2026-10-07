<?php $__env->startSection('content'); ?>
    <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">
        <?php echo e(trans('labels.telegram_settings')); ?></h5>
    <div class="row justify-content-center">
        <div class="col-12 my-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="business-api-tab" data-bs-toggle="tab" data-bs-target="#business-api"
                        type="button" role="tab" aria-controls="message"
                        aria-selected="true"><?php echo e(trans('labels.telegram_business_api')); ?></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"
                        role="tab" aria-controls="labels"
                        aria-selected="false"><?php echo e(trans('labels.telegram_order_message')); ?></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="business-api" role="tabpanel" aria-labelledby="business-api-tab">
                    <div class="card border-0 box-shadow rounded-top-0">
                        <div class="card-body">
                            <div class="form-validation">
                                <form action="<?php echo e(URL::to('admin/telegrammessage/business_api')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.telegram_chat_id')); ?>

                                                    <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="telegram_chat_id"
                                                    value="<?php echo e(@$telegramdata->telegram_chat_id); ?>"
                                                    placeholder="<?php echo e(trans('labels.telegram_chat_id')); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.telegram_access_token')); ?>

                                                    <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="telegram_access_token"
                                                    value="<?php echo e(@$telegramdata->telegram_access_token); ?>"
                                                    placeholder="<?php echo e(trans('labels.telegram_access_token')); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-4 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <button
                                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_telegram_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" name="about_update" value="1" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="card border-0 box-shadow rounded-top-0">
                        <div class="card-body">
                            <div class="form-validation">
                                <form action="<?php echo e(URL::to('admin/telegrammessage/order_message_update')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.order_variable')); ?>

                                                </label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.order_no')); ?> :
                                                                <code>{order_no}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.payment_type')); ?> :
                                                                <code>{payment_type}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.payment_status')); ?> :
                                                                <code>{payment_status}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.tips')); ?> :
                                                                <code>{tips}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.sub_total')); ?> :
                                                                <code>{sub_total}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.total_tax')); ?> :
                                                                <code>{total_tax}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.delivery_charge')); ?> :
                                                                <code>{delivery_charge}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.discount')); ?> :
                                                                <code>{discount_amount}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.grand_total')); ?> :
                                                                <code>{grand_total}</code>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.customer_name')); ?>

                                                                : <code>{customer_name}</code></li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.customer_email')); ?> :
                                                                <code>{customer_email}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.customer_mobile')); ?> :
                                                                <code>{customer_mobile}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.address')); ?>

                                                                :
                                                                <code>{address}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.building')); ?> :
                                                                <code>{building}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.landmark')); ?> :
                                                                <code>{landmark}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.pincode')); ?>

                                                                :
                                                                <code>{postal_code}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.delivery_type')); ?>

                                                                : <code>{delivery_type}</code></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.notes')); ?> :
                                                                <code>{notes}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.item_variable')); ?>

                                                                : <code>{item_variable}</code></li>
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.time')); ?> :
                                                                <code>{time}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.date')); ?> :
                                                                <code>{date}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.store_name')); ?> :
                                                                <code>{store_name}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.store_url')); ?> :
                                                                <code>{store_url}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.track_order_url')); ?> :
                                                                <code>{track_order_url}</code>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.item_variable')); ?>

                                                </label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.item_name')); ?> :
                                                                <code>{item_name}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer"><?php echo e(trans('labels.qty')); ?> :
                                                                <code>{qty}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.variants')); ?> :
                                                                <code>{variantsdata}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.item_price')); ?> :
                                                                <code>{item_price}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <?php echo e(trans('labels.total')); ?> :
                                                                <code>{total}</code>
                                                            </li>
                                                            <li class="list-group-item px-0 color-changer">
                                                                <input type="text" name="item_message"
                                                                    class="form-control"
                                                                    placeholder="<?php echo e(trans('labels.item_message')); ?>"
                                                                    value="<?php echo e(@$telegramdata->item_message); ?>" required>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.telegram_messages')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" required="required" name="telegram_message" cols="50" rows="10"><?php echo e(@$telegramdata->telegram_message); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label"
                                                    for=""><?php echo e(trans('labels.order_created')); ?>

                                                </label>
                                                <input id="order_created-switch" type="checkbox" class="checkbox-switch"
                                                    name="order_created" value="1"
                                                    <?php echo e(@$telegramdata->order_created == 1 ? 'checked' : ''); ?>>
                                                <label for="order_created-switch" class="switch">
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
                                        <div
                                            class="mt-3 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <button
                                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_telegram_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" name="orders_telegram_message" value="1" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\telegram_message\setting_form.blade.php ENDPATH**/ ?>