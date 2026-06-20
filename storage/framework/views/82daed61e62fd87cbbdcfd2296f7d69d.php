<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/plan')); ?>" class="color-changer"><?php echo e(trans('labels.pricing_plans')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/plan/update_plan-' . $editplan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="plan_name" value="<?php echo e($editplan->name); ?>"
                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>

                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="form-label"><?php echo e(trans('labels.amount')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control numbers_only" name="plan_price"
                                    value="<?php echo e($editplan->price); ?>" placeholder="<?php echo e(trans('labels.amount')); ?>" required>

                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="form-label"><?php echo e(trans('labels.tax')); ?></label>
                                <select name="plan_tax[]" class="form-control selectpicker" multiple
                                    data-live-search="true">
                                    <?php if(!empty($gettaxlist)): ?>
                                        <?php $__currentLoopData = $gettaxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tax->id); ?>"
                                                <?php echo e(in_array($tax->id, explode('|', $editplan->tax)) ? 'selected' : ''); ?>>
                                                <?php echo e($tax->name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.duration_type')); ?></label>
                                    <select class="form-select type" name="type">
                                        <option value="1" <?php echo e($editplan->plan_type == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.fixed')); ?>

                                        </option>
                                        <option value="2" <?php echo e($editplan->plan_type == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.custom')); ?>

                                        </option>
                                    </select>

                                </div>
                                <div class="form-group 1 selecttype">
                                    <label class="form-label"><?php echo e(trans('labels.duration')); ?><span class="text-danger"> *
                                        </span></label>
                                    <select class="form-select" name="plan_duration">
                                        <option value="1" <?php echo e($editplan->duration == 1 ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.one_month')); ?>

                                        </option>
                                        <option value="2" <?php echo e($editplan->duration == 2 ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.three_month')); ?>

                                        </option>
                                        <option value="3" <?php echo e($editplan->duration == 3 ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.six_month')); ?>

                                        </option>
                                        <option value="4" <?php echo e($editplan->duration == 4 ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.one_year')); ?>

                                        </option>
                                        <option value="5" <?php echo e($editplan->duration == 5 ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.lifetime')); ?>

                                        </option>
                                    </select>

                                </div>
                                <div class="form-group 2 selecttype">
                                    <label class="form-label"><?php echo e(trans('labels.days')); ?><span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_days"
                                        placeholder="<?php echo e(trans('labels.days')); ?>" value="<?php echo e($editplan->days); ?>">
                                    <?php $__errorArgs = ['plan_days'];
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
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.service_limit')); ?></label>
                                    <select class="form-select service_limit_type" name="service_limit_type">
                                        <option value="1" <?php echo e($editplan->order_limit != '-1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.limited')); ?>

                                        </option>
                                        <option value="2" <?php echo e($editplan->order_limit == '-1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.unlimited')); ?>

                                        </option>
                                    </select>

                                </div>
                                <div class="form-group 1 service-limit">
                                    <label class="form-label"><?php echo e(trans('labels.max_business')); ?><span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="number" class="form-control numbers_only" name="plan_max_business"
                                        value="<?php echo e($editplan->order_limit == -1 ? '' : $editplan->order_limit); ?>"
                                        placeholder="<?php echo e(trans('labels.max_business')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.booking_limit')); ?></label>
                                    <select class="form-select booking_limit_type" name="booking_limit_type">
                                        <option value="1"
                                            <?php echo e($editplan->appointment_limit != '-1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.limited')); ?>

                                        </option>
                                        <option value="2"
                                            <?php echo e($editplan->appointment_limit == '-1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.unlimited')); ?>

                                        </option>
                                    </select>

                                </div>
                                <div class="form-group 1 booking-limit">
                                    <label class="form-label"><?php echo e(trans('labels.orders_limit')); ?><span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="number" class="form-control numbers_only" name="plan_appoinment_limit"
                                        value="<?php echo e($editplan->appointment_limit == -1 ? '' : $editplan->appointment_limit); ?>"
                                        placeholder="<?php echo e(trans('labels.orders_limit')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.users')); ?></label>
                                    <select class="form-control selectpicker" name="vendors[]" multiple
                                        data-live-search="true">
                                        <?php if(!empty($vendors)): ?>
                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($vendor->id); ?>"
                                                    <?php echo e(in_array($vendor->id, explode('|', $editplan->vendor_id)) ? 'selected' : ''); ?>>
                                                    <?php echo e($vendor->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <?php
                                        $new_array = [];
                                        if ($editplan->features != '') {
                                            $new_array = explode('|', $editplan->features);
                                        }
                                    ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label m-0"><?php echo e(trans('labels.features')); ?><span
                                                class="text-danger">
                                                * </span></label>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            tooltip="<?php echo e(trans('labels.add')); ?>" id="addfeature">
                                            <i class="fa-regular fa-plus"></i>
                                        </button>
                                    </div>

                                    <div id="repeater">
                                        <?php $__currentLoopData = $new_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $features): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex gap-2 my-2" id="deletediv<?php echo e($key); ?>">
                                                <input type="text" class="form-control" name="plan_features[]"
                                                    value="<?php echo e($features); ?>"
                                                    placeholder="<?php echo e(trans('labels.features')); ?>" required>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    onclick="deletefeature(<?php echo e($key); ?>)">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <textarea class="form-control" rows="3" name="plan_description"
                                        placeholder="<?php echo e(trans('labels.description')); ?>"><?php echo e($editplan->description); ?></textarea>

                                </div>

                                <div class="row">
                                    <?php if(@helper::checkaddons('coupon')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="coupons"
                                                    id="coupons" <?php if($editplan->coupons == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="coupons"><?php echo e(trans('labels.coupons')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('custom_domain')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="custom_domain"
                                                    id="custom_domain" <?php if($editplan->custom_domain == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="custom_domain"><?php echo e(trans('labels.custom_domain')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('blog')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="blogs"
                                                    id="blogs" <?php if($editplan->blogs == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="blogs"><?php echo e(trans('labels.blogs')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('google_login')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="google_login"
                                                    id="google_login" <?php if($editplan->google_login == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="google_login"><?php echo e(trans('labels.google_login')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('facebook_login')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="facebook_login"
                                                    id="facebook_login" <?php if($editplan->facebook_login == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="facebook_login"><?php echo e(trans('labels.facebook_login')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('notification')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="sound_notification"
                                                    id="sound_notification"
                                                    <?php if($editplan->sound_notification == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="sound_notification"><?php echo e(trans('labels.sound_notification')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="whatsapp_message"
                                                    id="whatsapp_message"
                                                    <?php if($editplan->whatsapp_message == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="whatsapp_message"><?php echo e(trans('labels.whatsapp_message')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('telegram_message')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="telegram_message"
                                                    id="telegram_message"
                                                    <?php if($editplan->telegram_message == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="telegram_message"><?php echo e(trans('labels.telegram_message')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('vendor_app')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="vendor_app"
                                                    id="vendor_app" <?php if($editplan->vendor_app == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="vendor_app"><?php echo e(trans('labels.vendor_app_available')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('user_app')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="customer_app"
                                                    id="customer_app" <?php if($editplan->customer_app == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="customer_app"><?php echo e(trans('labels.customer_app')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('pos')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pos"
                                                    id="pos" <?php if($editplan->pos == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="pos"><?php echo e(trans('labels.pos')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('pwa')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pwa"
                                                    id="pwa" <?php if($editplan->pwa == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="pwa"><?php echo e(trans('labels.pwa')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('employee')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="employee"
                                                    id="employee" <?php if($editplan->role_management == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="employee"><?php echo e(trans('labels.role_management')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('pixel')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pixel"
                                                    id="pixel" <?php if($editplan->pixel == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="pixel"><?php echo e(trans('labels.pixel')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="reports" id="reports" <?php if($editplan->reports == '1'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="reports"><?php echo e(trans('labels.report')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="tax_report" id="tax_report" <?php if($editplan->tax_report == '1'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="tax_report"><?php echo e(trans('labels.tax')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="global_addons" id="global_addons" <?php if($editplan->global_addons == '1'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="global_addons"><?php echo e(trans('labels.global_extras')); ?></label>
                                        </div>
                                    </div>
                                    <?php if(@helper::checkaddons('question_answer')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="product_qa" id="product_qa" <?php if($editplan->product_qa == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="product_qa"><?php echo e(trans('labels.product_question_answer')); ?></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('product_import')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="bulk_import" id="bulk_import" <?php if($editplan->bulk_import == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="bulk_import"><?php echo e(trans('labels.product_upload')); ?></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="shipping_management" id="shipping_management" <?php if($editplan->shipping_management == '1'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="shipping_management"><?php echo e(trans('labels.shipping_management')); ?></label>
                                        </div>
                                    </div>
                                    <?php if(@helper::checkaddons('top_deals')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="top_deals" id="top_deals" <?php if($editplan->top_deals == '1'): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="top_deals"><?php echo e(trans('labels.top_deals')); ?></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.themes')); ?>

                                        <span class="text-danger"> * </span> </label>
                                    <?php if(env('Environment') == 'sendbox'): ?>
                                        <span class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                    <?php endif; ?>
                                    <?php $planthemes = explode('|', $editplan->themes_id); ?>
                                    <?php
                                        // $checktheme = @helper::checkthemeaddons('theme_');
                                        // $themes = [];
                                        // foreach ($checktheme as $ttlthemes) {
                                        //     array_push(
                                        //         $themes,
                                        //         str_replace('theme_', '', $ttlthemes->unique_identifier),
                                        //     );
                                        // }
                                         $themes = App\Models\Theme::all();
                                    ?>
                                    <ul class="theme-selection row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-2">
                                        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col">
                                            <li class="m-0 w-100">
                                                <input type="checkbox" name="themecheckbox[]"
                                                    id="template<?php echo e($item->id); ?>" value="<?php echo e($item); ?>"
                                                    <?php echo e(in_array($item->id, $planthemes) ? 'checked' : ''); ?>>
                                                <label for="template<?php echo e($item->id); ?>">
                                                     <img loading="lazy" src="<?php echo e(asset('storage/app/public/admin-assets/images/theme/' .  $item->image)); ?>">
                                                </label>
                                            </li>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/plan')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_pricing_plans', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        <?php if(count($errors) > 0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error("<?php echo e($error); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/plan.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/plan/edit_plan.blade.php ENDPATH**/ ?>