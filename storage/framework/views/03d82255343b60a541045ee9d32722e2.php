<?php $__env->startSection('content'); ?>
    <?php

        $module = 'users';

    ?>

    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.employees')); ?></h5>

        <div class="d-flex align-items-center" style="gap: 10px;">
            <!-- Bulk Delete Button -->
            <?php if(@helper::checkaddons('bulk_delete')): ?>
            <button id="bulkDeleteBtn"
                <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/employees/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                <i class="fa-regular fa-trash"></i>
            </button>
            <?php endif; ?>
            
            <a href="<?php echo e(URL::to('admin/employees/add')); ?>"
                class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

            </a>
        </div>

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

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                            <thead>

                                <tr class="text-capitalize fw-500 fs-15">
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($employees->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <td><?php echo e(trans('labels.srno')); ?></td>

                                    <td><?php echo e(trans('labels.image')); ?></td>

                                    <td><?php echo e(trans('labels.role')); ?></td>

                                    <td><?php echo e(trans('labels.name')); ?></td>

                                    <td><?php echo e(trans('labels.email')); ?></td>

                                    <td><?php echo e(trans('labels.mobile')); ?></td>

                                    <td><?php echo e(trans('labels.status')); ?></td>

                                    <td><?php echo e(trans('labels.created_date')); ?></td>

                                    <td><?php echo e(trans('labels.updated_date')); ?></td>

                                    <td><?php echo e(trans('labels.action')); ?></td>



                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                    $i = 1;

                                ?>

                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">

                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($employee->id); ?>"></td>
                                        <?php endif; ?>
                                        <td><?php

                                            echo $i++;

                                        ?></td>

                                        <td><img src="<?php echo e(helper::image_path($employee->image)); ?>" height="50"
                                                width="50" alt=""></td>

                                        <td><?php echo e(@helper::role($employee->role_id)->role); ?></td>

                                        <td><?php echo e($employee->name); ?></td>

                                        <td><?php echo e($employee->email); ?></td>

                                        <td><?php echo e($employee->mobile); ?></td>

                                        <td>

                                            <?php if($employee->is_available == '1'): ?>
                                                <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    href="javascript::void(0)"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/employees/status-' . $employee->id . '/2')); ?>')" <?php endif; ?>><i
                                                        class="fa-regular fa-check"></i>

                                                </a>
                                            <?php else: ?>
                                                <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    href="javascript::void(0)"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="statusupdate('<?php echo e(URL::to('admin/employees/status-' . $employee->id . '/1')); ?>')" <?php endif; ?>><i
                                                        class="fa-regular fa-xmark "></i>

                                                </a>
                                            <?php endif; ?>

                                        </td>

                                        <td><?php echo e(helper::date_format($employee->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($employee->created_at, $vendor_id)); ?>

                                        </td>

                                        <td><?php echo e(helper::date_format($employee->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($employee->updated_at, $vendor_id)); ?>

                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="<?php echo e(URL::to('admin/employees/edit-' . $employee->id)); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i>

                                                </a>

                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>

                                                    onclick="statusupdate('<?php echo e(URL::to('/admin/employees/delete-' . $employee->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">

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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/employee/index.blade.php ENDPATH**/ ?>