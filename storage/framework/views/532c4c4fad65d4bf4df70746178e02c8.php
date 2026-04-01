<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.customers')); ?></h5>

        <div class="d-flex align-items-center" style="gap: 10px;">
            <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                <!-- Bulk Delete Button -->
                <?php if(@helper::checkaddons('bulk_delete')): ?>
                    <button id="bulkDeleteBtn"
                        <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/customers/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                        <i class="fa-regular fa-trash"></i>
                    </button>
                <?php endif; ?>

                <div class="d-inline-flex">
                    <a href="<?php echo e(URL::to('admin/customers/add')); ?>"
                        class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                        <i class="fa-regular fa-plus mx-1"></i>
                        <?php echo e(trans('labels.add')); ?>

                    </a>
                </div>
            <?php endif; ?>
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
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <?php if($getcustomerslist->count() > 0): ?>
                                                <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.image')); ?></td>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <td><?php echo e(trans('labels.users')); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.email')); ?></td>
                                    <td><?php echo e(trans('labels.mobile')); ?></td>
                                    <td><?php echo e(trans('labels.login_type')); ?></td>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <td><?php echo e(trans('labels.status')); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>

                                    <td><?php echo e(trans('labels.action')); ?></td>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $__currentLoopData = $getcustomerslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">
                                        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                            <?php if(@helper::checkaddons('bulk_delete')): ?>
                                                <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($user->id); ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td><?php echo $i++; ?></td>
                                        <td> <img src="<?php echo e(helper::image_path($user->image)); ?>"
                                                class="img-fluid rounded hw-50" alt="" srcset=""> </td>
                                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                            <td><?php echo e(@helper::getslug($user->vendor_id)->name); ?></td>
                                        <?php endif; ?>
                                        <td> <?php echo e($user->name); ?> </td>
                                        <td> <?php echo e($user->email); ?> </td>
                                        <td> <?php echo e($user->mobile); ?></td>
                                        <td>
                                            <?php if($user->login_type == 'email'): ?>
                                                <?php echo e(trans('labels.normal')); ?>

                                            <?php elseif($user->login_type == 'google'): ?>
                                                <?php echo e(trans('labels.google')); ?>

                                            <?php elseif($user->login_type == 'facebook'): ?>
                                                <?php echo e(trans('labels.facebook')); ?>

                                            <?php endif; ?>
                                        </td>
                                        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                            <td>
                                                <?php if($user->is_available == 1): ?>
                                                    <a class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.active')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/customers/status-' . $user->id . '/2')); ?>')" <?php endif; ?>>
                                                        <i class="fa-sharp fa-solid fa-check"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/customers/status-' . $user->id . '/1')); ?>')" <?php endif; ?>>
                                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e(helper::date_format($user->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($user->created_at, $vendor_id)); ?>


                                        </td>
                                        <td><?php echo e(helper::date_format($user->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($user->updated_at, $vendor_id)); ?>


                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                                    <a class="btn btn-sm btn-info hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                        href="<?php echo e(URL::to('admin/customers/edit-' . $user->id)); ?>">
                                                        <i class="fa fa-pen-to-square"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a class="btn btn-sm hov btn-secondary"
                                                    tooltip="<?php echo e(trans('labels.view')); ?>"
                                                    href="<?php echo e(URL::to('admin/customers/orders-' . $user->id)); ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                                    <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/customers/delete-' . $user->id)); ?>')" <?php endif; ?>
                                                        class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                        <i class="fa-regular fa-trash"></i>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>