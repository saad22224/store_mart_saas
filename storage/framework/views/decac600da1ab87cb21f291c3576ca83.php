<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.custom_status')); ?></h5>
        <?php if(@helper::checkaddons('custom_domain')): ?>
            <a href="<?php echo e(URL::to('admin/custom_status/add')); ?>"
                class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

            </a>
        <?php endif; ?>
    </div>
    <div class="row">
        <?php
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
        ?>
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration zero-configuration1 w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.order_type')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?> <?php echo e(trans('labels.type')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/custom_status/reorder_status')); ?>">
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($status->id); ?>"
                                        data-id="<?php echo e($status->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td><?php
                                            echo $i++;
                                        ?></td>
                                        <td>
                                            <?php if($status->order_type == 1): ?>
                                                <?php echo e(trans('labels.delivery')); ?>

                                            <?php elseif($status->order_type == 2): ?>
                                                <?php echo e(trans('labels.pickup')); ?>

                                            <?php elseif($status->order_type == 3): ?>
                                                <?php echo e(trans('labels.table')); ?>

                                            <?php elseif($status->order_type == 4): ?>
                                                <?php echo e(trans('labels.pos')); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($status->type == 1): ?>
                                                <?php echo e(trans('labels.default')); ?>

                                            <?php elseif($status->type == 2): ?>
                                                <?php echo e(trans('labels.process')); ?>

                                            <?php elseif($status->type == 3): ?>
                                                <?php echo e(trans('labels.complete')); ?>

                                            <?php elseif($status->type == 4): ?>
                                                <?php echo e(trans('labels.cancel')); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($status->name); ?></td>
                                        <td>
                                            <?php if($status->type == 2): ?>
                                                <?php if($status->is_available == '1'): ?>
                                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/custom_status/change_status-' . $status->id . '/2')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.active')); ?>"><i
                                                            class="fa-regular fa-check"></i></a>
                                                <?php else: ?>
                                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/custom_status/change_status-' . $status->id . '/1')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.inactive')); ?>"><i
                                                            class="fa-regular fa-xmark"></i></a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($status->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($status->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($status->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($status->updated_at, $vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="<?php echo e(URL::to('admin/custom_status/edit-' . $status->id)); ?>"
                                                    class="btn hov btn-info btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"> <i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <?php if($status->type == 2): ?>
                                                    <?php if(@helper::checkaddons('custom_status')): ?>
                                                        <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/custom_status/delete-' . $status->id)); ?>')" <?php endif; ?>
                                                            class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                            tooltip="<?php echo e(trans('labels.delete')); ?>"> <i
                                                                class="fa-regular fa-trash"></i></a>
                                                    <?php endif; ?>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/custom_status/index.blade.php ENDPATH**/ ?>