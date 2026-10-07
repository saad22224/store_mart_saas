<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.table')); ?></h5>
        <a href="<?php echo e(URL::to('admin/dinein/add')); ?>"
            class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_table', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><i
                class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?></a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/dinein/reorder_category')); ?>">
                                <?php $i=1; ?>
                                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($table->id); ?>"
                                        data-id="<?php echo e($table->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>" class="color-changer"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo e($table->name); ?></td>
                                        <td>
                                            <?php if($table->is_available == '1'): ?>
                                                <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/dinein/change_status-' . $table->id . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_table', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fas fa-check"></i></a>
                                            <?php else: ?>
                                                <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/dinein/change_status-' . $table->id . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_table', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fas fa-close"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($table->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($table->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($table->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($table->updated_at, $vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="<?php echo e(URL::to('admin/dinein/edit-' . $table->id)); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_table', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                                <a tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/dinein/delete-' . $table->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_table', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-trash"></i></a>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\table\index.blade.php ENDPATH**/ ?>