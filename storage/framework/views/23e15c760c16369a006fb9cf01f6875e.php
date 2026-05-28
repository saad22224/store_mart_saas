<div id="email_template">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <form method="POST" action="<?php echo e(URL::to('admin/emailmessagesettings')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card-header rounded-top p-3 bg-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-capitalize fw-600 settings-color col-6">
                                <?php echo e(trans('labels.email_message_settings')); ?>

                            </h5>
                            <select name="template_type" id="template_type" class="form-select">
                                <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                    <option value="1" data-attribute="forgotpassword">
                                        <?php echo e(trans('labels.forgot_password')); ?>

                                    </option>
                                    <option value="2" data-attribute="delete_account">
                                        <?php echo e(trans('labels.delete_profile')); ?>

                                    </option>
                                    <option value="3" data-attribute="banktransfer_request">
                                        <?php echo e(trans('labels.banktransfer_request')); ?></option>
                                    <option value="4" data-attribute="cod_request">
                                        <?php echo e(trans('labels.cod_request')); ?>

                                    </option>
                                    <option value="5" data-attribute="subscription_reject">
                                        <?php echo e(trans('labels.subscription_reject')); ?></option>
                                    <option value="6" data-attribute="subscription_success">
                                        <?php echo e(trans('labels.subscription_success')); ?></option>
                                    <option value="7" data-attribute="admin_subscription_request">
                                        <?php echo e(trans('labels.admin_subscription_request')); ?></option>
                                    <option value="8" data-attribute="admin_subscription_success">
                                        <?php echo e(trans('labels.admin_subscription_success')); ?></option>

                                    <option value="9" data-attribute="vendor_register">
                                        <?php echo e(trans('labels.vendor_register')); ?></option>
                                    <option value="10" data-attribute="admin_vendor_register">
                                        <?php echo e(trans('labels.admin_vendor_register')); ?></option>
                                    <option value="11" data-attribute="vendor_status_change">
                                        <?php echo e(trans('labels.vendor_status_change')); ?></option>
                                <?php endif; ?>
                                <option value="12" data-attribute="contact_email">
                                    <?php echo e(trans('labels.contact_email')); ?>

                                </option>
                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                    <option value="13" data-attribute="new_order_invoice">
                                        <?php echo e(trans('labels.new_order_invoice')); ?></option>
                                    <option value="14" data-attribute="vendor_new_order">
                                        <?php echo e(trans('labels.vendor_new_order')); ?></option>
                                    <option value="15" data-attribute="order_status">
                                        <?php echo e(trans('labels.order_status')); ?>

                                    </option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="templatemenuContent">
                                <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                    <div id="forgotpassword" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.forgot_password')); ?> <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.username')); ?> :
                                                <code>{user}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.password')); ?> :
                                                <code>{password}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="forget_password_email_message" cols="50" rows="10"><?php echo e(@$settingdata->forget_password_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="delete_account" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.delete_profile')); ?> <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="delete_account_email_message" cols="50" rows="10"><?php echo e(@$settingdata->delete_account_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="banktransfer_request" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.banktransfer_request')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminemail')); ?> :
                                                <code>{adminemail}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="banktransfer_request_email_message" cols="50" rows="10"><?php echo e(@$settingdata->banktransfer_request_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="cod_request" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.cod_request')); ?> <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminemail')); ?> :
                                                <code>{adminemail}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="cod_request_email_message" cols="50" rows="10"><?php echo e(@$settingdata->cod_request_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="subscription_reject" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.subscription_reject')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.payment_type')); ?> :
                                                <code>{payment_type}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.planname')); ?> :
                                                <code>{plan_name}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminemail')); ?> :
                                                <code>{adminemail}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="subscription_reject_email_message" cols="50" rows="10"><?php echo e(@$settingdata->subscription_reject_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="subscription_success" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.subscription_success')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.payment_type')); ?> :
                                                <code>{payment_type}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_duration')); ?> :
                                                <code>{subscription_duration}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_cost')); ?> :
                                                <code>{subscription_price}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.planname')); ?> :
                                                <code>{plan_name}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminemail')); ?> :
                                                <code>{adminemail}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="subscription_success_email_message" cols="50" rows="10"><?php echo e(@$settingdata->subscription_success_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="admin_subscription_request" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.admin_subscription_request')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendoremail')); ?> :
                                                <code>{vendoremail}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.planname')); ?> :
                                                <code>{plan_name}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_duration')); ?> :
                                                <code>{subscription_duration}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_cost')); ?> :
                                                <code>{subscription_price}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.payment_type')); ?> :
                                                <code>{payment_type}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="admin_subscription_request_email_message" cols="50" rows="10"><?php echo e(@$settingdata->admin_subscription_request_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="admin_subscription_success" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.admin_subscription_success')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendoremail')); ?> :
                                                <code>{vendoremail}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.planname')); ?> :
                                                <code>{plan_name}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_duration')); ?> :
                                                <code>{subscription_duration}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.subscription_cost')); ?> :
                                                <code>{subscription_price}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.payment_type')); ?> :
                                                <code>{payment_type}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="admin_subscription_success_email_message" cols="50" rows="10"><?php echo e(@$settingdata->admin_subscription_success_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="vendor_register" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.vendor_register')); ?> <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="vendor_register_email_message" cols="50" rows="10"><?php echo e(@$settingdata->vendor_register_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="admin_vendor_register" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.admin_vendor_register')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.adminname')); ?> :
                                                <code>{adminname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendoremail')); ?> :
                                                <code>{vendoremail}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendormobile')); ?> :
                                                <code>{vendormobile}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="admin_vendor_register_email_message" cols="50" rows="10"><?php echo e(@$settingdata->admin_vendor_register_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="vendor_status_change" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.vendor_status_change')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="vendor_status_change_email_message" cols="50" rows="10"><?php echo e(@$settingdata->vendor_status_change_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div id="contact_email" class="hidechild">
                                    <div class="col-12">
                                        <h5 class="text-start color-changer">
                                            <?php echo e(trans('labels.contact_email')); ?> <?php echo e(trans('labels.variable')); ?>

                                        </h5>
                                        <div class="border-bottom my-3"></div>
                                        <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                            <code>{vendorname}</code>
                                        </p>
                                        <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.username')); ?> :
                                            <code>{username}</code>
                                        </p>
                                        <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.useremail')); ?> :
                                            <code>{useremail}</code>
                                        </p>
                                        <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.usermobile')); ?> :
                                            <code>{usermobile}</code>
                                        </p>
                                        <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.usermessage')); ?> :
                                            <code>{usermessage}</code>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                <span class="text-danger"> * </span> </label>
                                            <textarea class="form-control" name="contact_email_message" cols="50" rows="10"><?php echo e(@$settingdata->contact_email_message); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                    <div id="new_order_invoice" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.new_order_invoice')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.customer_name')); ?> :
                                                <code>{customername}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.order_number')); ?> :
                                                <code>{ordernumber}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.date')); ?> :
                                                <code>{date}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.time')); ?> :
                                                <code>{time}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.grand_total')); ?> :
                                                <code>{grandtotal}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.track_order_url')); ?> :
                                                <code>{track_order_url}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="new_order_invoice_email_message" cols="50" rows="10"><?php echo e(@$settingdata->new_order_invoice_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="vendor_new_order" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.vendor_new_order')); ?>

                                                <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.order_number')); ?> :
                                                <code>{ordernumber}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.date')); ?> :
                                                <code>{date}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.time')); ?> :
                                                <code>{time}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.grand_total')); ?> :
                                                <code>{grandtotal}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.customer_name')); ?> :
                                                <code>{customername}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="vendor_new_order_email_message" cols="50" rows="10"><?php echo e(@$settingdata->vendor_new_order_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="order_status" class="hidechild">
                                        <div class="col-12">
                                            <h5 class="text-start color-changer">
                                                <?php echo e(trans('labels.order_status')); ?> <?php echo e(trans('labels.variable')); ?>

                                            </h5>
                                            <div class="border-bottom my-3"></div>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.customer_name')); ?> :
                                                <code>{customername}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.status_message')); ?> :
                                                <code>{status_message}</code>
                                            </p>
                                            <p class="mb-1 fs-15 color-changer"><?php echo e(trans('labels.vendorname')); ?> :
                                                <code>{vendorname}</code>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold"><?php echo e(trans('labels.email_message')); ?>

                                                    <span class="text-danger"> * </span> </label>
                                                <textarea class="form-control" name="order_status_email_message" cols="50" rows="10"><?php echo e(@$settingdata->order_status_email_message); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div
                                class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/email_template/setting_form.blade.php ENDPATH**/ ?>