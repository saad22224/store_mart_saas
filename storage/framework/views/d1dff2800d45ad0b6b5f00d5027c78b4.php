<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center">
    <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.product_inquiry')); ?></h5>

     <!-- Bulk Delete Button -->
        <?php if(@helper::checkaddons('bulk_delete')): ?>
        <button id="bulkDeleteBtn"
            <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/product_inquiry/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>" style="margin-right: 20px;">
            <i class="fa-regular fa-trash"></i>
        </button>
        <?php endif; ?>
</div>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($getinquiries->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.item_name')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.email')); ?></td>
                                    <td><?php echo e(trans('labels.mobile')); ?></td>
                                    <td><?php echo e(trans('labels.message')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $__currentLoopData = $getinquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($inquiry->id); ?>"></td>
                                        <?php endif; ?>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo e($inquiry->products->item_name); ?></td>
                                        <td><?php echo e($inquiry->name); ?></td>
                                        <td><?php echo e($inquiry->email); ?></td>
                                        <td><?php echo e($inquiry->mobile); ?></td>
                                        <td><?php echo e($inquiry->message); ?></td>
                                        <td>
                                            <?php if($inquiry->status == 1): ?>
                                                <span class="badge bg-warning"> <?php echo e(trans('labels.pending')); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-success"> <?php echo e(trans('labels.completed')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($inquiry->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($inquiry->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($inquiry->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($inquiry->updated_at, $vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/product_inquiry/delete-' . $inquiry->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_product_inquiry', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
                                                <?php if($inquiry->status == 1): ?>
                                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/product_inquiry/change_status-' . $inquiry->id . '/2')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_product_inquiry', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.active')); ?>">
                                                        <i class="fa-regular fa-check"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product_inquiries\index.blade.php ENDPATH**/ ?>