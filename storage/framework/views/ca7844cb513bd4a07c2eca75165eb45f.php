<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark">
                    <a href="<?php echo e(URL::to('admin/shipping')); ?>" class="color-changer"><?php echo e(trans('labels.shipping_management')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row my-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/shipping/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.area_name')); ?>

                                    <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="area_name" value="<?php echo e(old('area_name')); ?>"
                                    placeholder="<?php echo e(trans('labels.area_name')); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.delivery_charge')); ?>

                                    <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="delivery_charge"
                                    value="<?php echo e(old('delivery_charge')); ?>"
                                    placeholder="<?php echo e(trans('labels.delivery_charge')); ?>" required>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-1 justify-content-end">
                            <a href="<?php echo e(URL::to('admin/shipping')); ?>"
                                class="btn btn-danger px-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_management', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\shipping\add.blade.php ENDPATH**/ ?>