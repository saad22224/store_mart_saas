<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/coupons')); ?>" class="color-changer"><?php echo e(trans('labels.coupons')); ?></a>
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
                    <form action="<?php echo e(URL::to('admin/coupons/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.coupon_name')); ?><span class="text-danger">
                                        * </span></label>
                                <input type="text" class="form-control" name="offer_name" value="<?php echo e(old('offer_name')); ?>"
                                    placeholder="<?php echo e(trans('labels.coupon_name')); ?>" required>
                                <?php $__errorArgs = ['offer_name'];
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
                            <div class="col-md-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.coupon_code')); ?><span class="text-danger">
                                        *
                                    </span></label>
                                <input type="text" class="form-control" name="offer_code"
                                    value="<?php echo e(old('offer_code')); ?>" placeholder="<?php echo e(trans('labels.coupon_code')); ?>"
                                    required>
                                <?php $__errorArgs = ['offer_code'];
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
                            <div class="col-md-6 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label"><?php echo e(trans('labels.discount_type')); ?><span
                                                class="text-danger">
                                                * </span></label>
                                        <select class="form-select" name="offer_type" required>
                                            <option value=" "><?php echo e(trans('labels.select')); ?></option>
                                            <option value="1" <?php echo e(old('offer_type') == '1' ? 'selected' : ''); ?>>
                                                <?php echo e(trans('labels.fixed')); ?></option>
                                            <option value="2" <?php echo e(old('offer_type') == '2' ? 'selected' : ''); ?>>
                                                <?php echo e(trans('labels.percentage')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['offer_type'];
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
                                    <div class="col-md-6">
                                        <label class="form-label"><?php echo e(trans('labels.discount')); ?><span class="text-danger">
                                                *
                                            </span></label>
                                        <input type="text" class="form-control numbers_only" name="amount"
                                            value="<?php echo e(old('amount')); ?>" placeholder="<?php echo e(trans('labels.discount')); ?>"
                                            required>
                                        <?php $__errorArgs = ['amount'];
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
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label">
                                    <?php if(Auth::user()->type == 1): ?>
                                        <?php echo e(trans('labels.min_plan_amount')); ?>

                                    <?php else: ?>
                                        <?php echo e(trans('labels.min_order_amount')); ?>

                                    <?php endif; ?> <span class="text-danger"> * </span>
                                </label>
                                <input type="text" class="form-control numbers_only" name="order_amount" value="<?php echo e(old('amount')); ?>"
                                    <?php if(Auth::user()->type == 1): ?> placeholder="<?php echo e(trans('labels.min_plan_amount')); ?>" 
                                    <?php else: ?> placeholder="<?php echo e(trans('labels.min_order_amount')); ?>" <?php endif; ?>
                                    required>
                                <?php $__errorArgs = ['order_amount'];
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
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.start_date')); ?><span
                                                    class="text-danger"> *
                                                </span></label>
                                            <input type="date" class="form-control" name="start_date" id="start_date"
                                                value="<?php echo e(old('start_date')); ?>"
                                                placeholder="<?php echo e(trans('labels.start_date')); ?>" required>
                                            <?php $__errorArgs = ['start_date'];
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
                                        <div class="col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.end_date')); ?><span
                                                    class="text-danger"> *
                                                </span></label>
                                            <input type="date" class="form-control" name="end_date" id="end_date"
                                                value="<?php echo e(old('end_date')); ?>"
                                                placeholder="<?php echo e(trans('labels.end_date')); ?>" required>
                                            <?php $__errorArgs = ['end_date'];
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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.usage_type')); ?><span class="text-danger"> *
                                        </span></label>
                                    <select class="form-select type" name="usage_type">
                                        <option value=""><?php echo e(trans('labels.select')); ?></option>
                                        <option value="1" <?php echo e(old('usage_type') == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.limited')); ?></option>
                                        <option value="2" <?php echo e(old('usage_type') == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.unlimited')); ?></option>
                                    </select>
                                    <?php $__errorArgs = ['usage_type'];
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
                                <div class="form-group" id="usage_limit_input">
                                    <label class="form-label"><?php echo e(trans('labels.usage_limit')); ?><span class="text-danger">
                                            * </span></label>
                                    <input type="text" class="form-control numbers_only" name="usage_limit"
                                        value="<?php echo e(old('usage_limit')); ?>"
                                        placeholder="<?php echo e(trans('labels.usage_limit')); ?>">
                                    <?php $__errorArgs = ['usage_limit'];
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
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?><span class="text-danger">
                                            *
                                        </span></label>
                                    <textarea name="description" class="form-control" rows="5" placeholder="<?php echo e(trans('labels.description')); ?>"
                                        required><?php echo e(old('description')); ?></textarea>
                                    <?php $__errorArgs = ['description'];
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
                            </div>
                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e(URL::to('admin/coupons')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
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
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/promocode.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\included\coupons\add.blade.php ENDPATH**/ ?>