<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-capitalize color-changer fw-600 text-dark"><?php echo e(trans('labels.edit')); ?></h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/users')); ?>"
                        class="color-changer"><?php echo e(trans('labels.users')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="card border-0 box-shadow">
            <div class="card-body">
                <form action="<?php echo e(URL::to('admin/users/update-' . $getuserdata->id)); ?>" class="row" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if(@helper::checkaddons('digital_product')): ?>
                        <div class="form-group col-md-6">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($store->id); ?>"
                                        <?php echo e($store->id == $getuserdata->store_id ? 'selected' : ''); ?>>
                                        <?php echo e($store->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_type" class="form-label"><?php echo e(trans('labels.product_type')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="product_type" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <option value="1"
                                    <?php echo e(helper::appdata($getuserdata->id)->product_type == 1 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.physical')); ?>

                                </option>
                                <option value="2"
                                    <?php echo e(helper::appdata($getuserdata->id)->product_type == 2 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.digital')); ?>

                                </option>
                            </select>
                        </div>
                    <?php else: ?>
                        <div class="form-group col-md-12">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($store->id); ?>"
                                        <?php echo e($store->id == $getuserdata->store_id ? 'selected' : ''); ?>>
                                        <?php echo e($store->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-6 form-group">
                        <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                            </span></label>
                        <input type="text" class="form-control" name="name" value="<?php echo e($getuserdata->name); ?>"
                            id="name" placeholder="<?php echo e(trans('labels.name')); ?>" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="form-label"><?php echo e(trans('labels.email')); ?><span class="text-danger"> *
                            </span></label>
                        <input type="email" class="form-control" name="email" value="<?php echo e($getuserdata->email); ?>"
                            placeholder="<?php echo e(trans('labels.email')); ?>" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(trans('labels.mobile')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile"
                                value="<?php echo e($getuserdata->mobile); ?>" placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="form-label"><?php echo e(trans('labels.image')); ?></label>
                        <input type="file" class="form-control" name="profile">
                        <img class="rounded-circle mt-2" src="<?php echo e(helper::image_path($getuserdata->image)); ?>"
                            alt="" width="70" height="70">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country" class="form-label"><?php echo e(trans('labels.city')); ?><span class="text-danger">
                                *
                            </span></label>
                        <select name="country" class="form-select" id="country" required>
                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"
                                    <?php echo e($country->id == $getuserdata->country_id ? 'selected' : ''); ?>>
                                    <?php echo e($country->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city" class="form-label"><?php echo e(trans('labels.area')); ?><span class="text-danger">
                                * </span></label>
                        <select name="city" class="form-select" id="city" required>
                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                        </select>
                    </div>
                    <?php if(@helper::checkaddons('unique_slug')): ?>
                        <?php if($getuserdata->custom_domain == null): ?>
                            <div class="form-group">
                                <label for="basic-url" class="form-label"><?php echo e(trans('labels.personlized_link')); ?><span
                                        class="text-danger"> * </span></label>
                                <?php if(env('Environment') == 'sendbox'): ?>
                                    <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                <?php endif; ?>
                                <div class="input-group ">
                                    <span
                                        class="input-group-text col-5 col-lg-auto overflow-x-auto"><?php echo e(URL::to('/')); ?>/</span>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="<?php echo e($getuserdata->slug); ?>" required>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class=" col-sm-6">
                        <?php if(@helper::checkaddons('allow_without_subscription')): ?>
                            <div class="form-group" id="plan">
                                <?php
                                    $plan = helper::plandetail(@$getuserdata->plan_id);
                                ?>
                                <div class="d-flex">
                                    <input class="form-check-input mx-1" type="checkbox" name="plan_checkbox"
                                        id="plan_checkbox">
                                    <div>
                                        <label for="plan_checkbox"
                                            class="form-label"><?php echo e(trans('labels.assign_plan')); ?></label>&nbsp;<span>(<?php echo e(trans('labels.current_plan')); ?>&nbsp;:&nbsp;</span>
                                        <span class="fw-500"> <?php echo e(!empty($plan) ? $plan->name : '-'); ?>)</span>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span
                                                class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <select name="plan" id="selectplan" class="form-select" disabled>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $getplanlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($plan->vendor_id != '' && $plan->vendor_id != null): ?>
                                            <?php if(in_array($getuserdata->id, explode('|', $plan->vendor_id))): ?>
                                                <option value="<?php echo e($plan->id); ?>"
                                                    <?php echo e($plan->id == $getuserdata->plan_id ? 'selected' : ''); ?>>
                                                    <?php echo e($plan->name); ?>

                                                </option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?php echo e($plan->id); ?>"
                                                <?php echo e($plan->id == $getuserdata->plan_id ? 'selected' : ''); ?>>
                                                <?php echo e($plan->name); ?>

                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                            <div class="form-group d-flex">
                                <input class="form-check-input mx-1" type="checkbox" name="allow_store_subscription"
                                    id="allow_store_subscription" <?php if($getuserdata->allow_without_subscription == '1'): ?> checked <?php endif; ?>>
                                <div>
                                    <label class="form-check-label"
                                        for="allow_store_subscription"><?php echo e(trans('labels.allow_store_without_subscription')); ?>

                                    </label>
                                    <?php if(env('Environment') == 'sendbox'): ?>
                                        <span class="badge badge bg-danger ms-2"><?php echo e(trans('labels.addon')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <input class="form-check-input mx-1" type="checkbox" name="show_landing_page"
                                id="show_landing_page" <?php if($getuserdata->available_on_landing == '1'): ?> checked <?php endif; ?>><label
                                class="form-check-label"
                                for="show_landing_page"><?php echo e(trans('labels.display_store_on_landing')); ?></label>
                        </div>
                    </div>
                    <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>"
                            class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                        <button
                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                    </div>
                </form>
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
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('labels.select')); ?>";
        var cityid = "<?php echo e($getuserdata->city_id); ?>";
        $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
    </script>
    <script src="<?php echo e(url('storage/app/public/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/user/edit.blade.php ENDPATH**/ ?>