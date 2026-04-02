<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-capitalize fw-600 text-dark color-changer"><?php echo e(trans('labels.add_new')); ?></h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/users')); ?>"
                        class="color-changer"><?php echo e(trans('labels.users')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <?php if(isset($id)): ?>
                        <form action="<?php echo e(URL::to('admin/clonevendor')); ?>" method="POST">
                            <input type="hidden" class="form-control" name="clone_vendor_id" value="<?php echo e(@$id); ?> "
                                required>
                        <?php else: ?>
                            <form action="<?php echo e(URL::to('admin/register_vendor')); ?>" method="POST">
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <?php if(@helper::checkaddons('digital_product')): ?>
                            <div class="form-group col-md-6">
                                <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                        class="text-danger">
                                        * </span></label>
                                <select name="store" class="form-select" required>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($store->id); ?>"
                                            <?php echo e(old('store') == $store->id ? 'selected' : ''); ?>><?php echo e($store->name); ?>

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
                                    <option value="1" <?php echo e(old('store') == 1 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.physical')); ?></option>
                                    <option value="2" <?php echo e(old('store') == 2 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.digital')); ?></option>
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
                                            <?php echo e(old('store') == $store->id ? 'selected' : ''); ?>><?php echo e($store->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                        <?php endif; ?>
                        <div class="form-group col-md-6">
                            <label for="name" class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger">
                                    * </span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                                id="name" placeholder="<?php echo e(trans('labels.name')); ?>" required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span class="text-danger">
                                    * </span></label>
                            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                                id="email" placeholder="<?php echo e(trans('labels.email')); ?>" required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?><span class="text-danger">
                                    * </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile"
                                value="<?php echo e(old('mobile')); ?>" id="mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                required>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="form-label"><?php echo e(trans('labels.password')); ?><span
                                    class="text-danger"> * </span></label>
                            <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>"
                                id="password" placeholder="<?php echo e(trans('labels.password')); ?>" required>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="country" class="form-label"><?php echo e(trans('labels.city')); ?><span class="text-danger"> *
                                </span></label>
                            <select name="country" class="form-select" id="country" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="city" class="form-label"><?php echo e(trans('labels.area')); ?><span class="text-danger"> *
                                </span></label>
                            <select name="city" class="form-select" id="city" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                            </select>

                        </div>
                    </div>
                    <?php if(@helper::checkaddons('unique_slug')): ?>
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
                                    value="<?php echo e(old('slug')); ?>" required>
                            </div>

                        </div>
                    <?php endif; ?>
                    <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>"
                            class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                        <button
                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> type="button"
                            onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
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
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('labels.select')); ?>";
        var cityid = '0';

        $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/user/add.blade.php ENDPATH**/ ?>