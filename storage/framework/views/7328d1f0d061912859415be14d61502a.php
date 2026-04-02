<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/plan')); ?>"
                        class="color-changer"><?php echo e(trans('labels.pricing_plans')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/plan/save_plan')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" name="plan_name" value="<?php echo e(old('plan_name')); ?>"
                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>

                            </div>

                            <div class="col-sm-3 form-group">
                                <label class="form-label"><?php echo e(trans('labels.amount')); ?><span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control numbers_only" name="plan_price"
                                    value="<?php echo e(old('plan_price')); ?>" placeholder="<?php echo e(trans('labels.amount')); ?>" required>

                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="form-label"><?php echo e(trans('labels.tax')); ?></label>
                                <select name="plan_tax[]" class="form-control selectpicker" multiple
                                    data-live-search="true">
                                    <?php if(!empty($gettaxlist)): ?>
                                        <?php $__currentLoopData = $gettaxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tax->id); ?>"> <?php echo e($tax->name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>


                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.duration_type')); ?></label>
                                    <select class="form-select type" name="type">
                                        <option value="1" <?php echo e(old('type') == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.fixed')); ?></option>
                                        <option value="2" <?php echo e(old('type') == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.custom')); ?></option>
                                    </select>

                                </div>
                                <div class="form-group 1 selecttype">
                                    <label class="form-label"><?php echo e(trans('labels.duration')); ?><span class="text-danger"> *
                                        </span></label>
                                    <select class="form-select" name="plan_duration">
                                        <option value="1"><?php echo e(trans('labels.one_month')); ?></option>
                                        <option value="2"><?php echo e(trans('labels.three_month')); ?></option>
                                        <option value="3"><?php echo e(trans('labels.six_month')); ?></option>
                                        <option value="4"><?php echo e(trans('labels.one_year')); ?></option>
                                        <option value="5"><?php echo e(trans('labels.lifetime')); ?></option>
                                    </select>

                                </div>
                                <div class="form-group 2 selecttype">
                                    <label class="form-label"><?php echo e(trans('labels.days')); ?><span class="text-danger"> *
                                        </span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_days" value=""
                                        placeholder="<?php echo e(trans('labels.days')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.service_limit')); ?></label>
                                    <select class="form-select service_limit_type" name="service_limit_type">
                                        <option value="1" <?php echo e(old('service_limit_type') == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.limited')); ?></option>
                                        <option value="2" <?php echo e(old('service_limit_type') == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.unlimited')); ?></option>
                                    </select>

                                </div>
                                <div class="form-group 1 service-limit">
                                    <label class="form-label"><?php echo e(trans('labels.max_business')); ?><span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_max_business"
                                        value="<?php echo e(old('plan_max_business')); ?>"
                                        placeholder="<?php echo e(trans('labels.max_business')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.booking_limit')); ?></label>
                                    <select class="form-select booking_limit_type" name="booking_limit_type">
                                        <option value="1" <?php echo e(old('booking_limit_type') == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.limited')); ?></option>
                                        <option value="2" <?php echo e(old('booking_limit_type') == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.unlimited')); ?></option>
                                    </select>

                                </div>
                                <div class="form-group 1 booking-limit">
                                    <label class="form-label"><?php echo e(trans('labels.orders_limit')); ?><span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_appoinment_limit"
                                        value="<?php echo e(old('plan_appoinment_limit')); ?>"
                                        placeholder="<?php echo e(trans('labels.orders_limit')); ?>">

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.users')); ?></label>
                                    <select class="form-control selectpicker" name="vendors[]" multiple
                                        data-live-search="true">
                                        <?php if(!empty($vendors)): ?>
                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($vendor->id); ?>"
                                                    <?php echo e(old('vendor') == $vendor->id ? 'selected' : ''); ?>>
                                                    <?php echo e($vendor->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label"><?php echo e(trans('labels.features')); ?></label>
                                        <button type="button" class="btn btn-primary btn-sm"
                                            tooltip="<?php echo e(trans('labels.add')); ?>" id="addfeature">
                                            <i class="fa-regular fa-plus"></i>
                                        </button>
                                    </div>

                                    <div id="repeater"></div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <textarea class="form-control" rows="3" name="plan_description"
                                        placeholder="<?php echo e(trans('labels.description')); ?>"><?php echo e(old('plan_description')); ?></textarea>

                                </div>

                                <div class="row">
                                    <?php if(@helper::checkaddons('coupon')): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="coupons"
                                                    id="coupons">
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
                                                    id="custom_domain">
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
                                                    id="blogs">
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
                                                    id="google_login">
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
                                                    id="facebook_login">
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
                                                    id="sound_notification">
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
                                                    id="whatsapp_message">
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
                                                    id="telegram_message">
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
                                                    id="vendor_app">
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
                                                    id="customer_app">
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
                                                    id="pos">
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
                                                    id="pwa">
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
                                                    id="employee">
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
                                                    id="pixel">
                                                <label class="form-check-label"
                                                    for="pixel"><?php echo e(trans('labels.pixel')); ?></label>
                                                <?php if(env('Environment') == 'sendbox'): ?>
                                                    <span
                                                        class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                                <?php endif; ?>

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
                                    <?php
                                        $checktheme = @helper::checkthemeaddons('theme_');
                                        $themes = [];
                                        foreach ($checktheme as $ttlthemes) {
                                            array_push(
                                                $themes,
                                                str_replace('theme_', '', $ttlthemes->unique_identifier),
                                            );
                                        }
                                    ?>
                                    <ul
                                        class="theme-selection row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-2">
                                        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col">
                                                <li class="m-0 w-100">
                                                    <input type="checkbox" name="themecheckbox[]"
                                                        id="template<?php echo e($item); ?>" value="<?php echo e($item); ?>"
                                                        <?php echo e($key == 0 ? 'checked' : ''); ?>>
                                                    <label for="template<?php echo e($item); ?>">
                                                        <img src="<?php echo e(helper::image_path('theme-' . $item . '.png')); ?>">
                                                    </label>
                                                </li>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e(URL::to('admin/plan')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_pricing_plans', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
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
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/plan.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/plan/add_plan.blade.php ENDPATH**/ ?>