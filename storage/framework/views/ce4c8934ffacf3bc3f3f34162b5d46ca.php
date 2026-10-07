<table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <td><?php echo e(trans('labels.srno')); ?></td>
            <td><?php echo e(trans('labels.name')); ?></td>
            <td><?php echo e(trans('labels.requested_domain')); ?></td>
            <td><?php echo e(trans('labels.current_domain')); ?></td>
            <td><?php echo e(trans('labels.status')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
        ?>
        <?php $__currentLoopData = $customdomaindata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $vendor = $ddata->users;
                $vendorId = $vendor->id ?? $ddata->vendor_id;
                $vendorName = $vendor->name ?? ('#' . $ddata->vendor_id);
            ?>
            <tr class="fs-7">
                <td><?php echo e($i++); ?></td>
                <td>
                    <?php echo e($vendorName); ?>

                    <?php if(!$vendor): ?>
                        <span class="badge bg-secondary"><?php echo e(trans('labels.unavailable')); ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($ddata->requested_domain ?: '-'); ?></td>
                <td><?php echo e($ddata->current_domain ?: '-'); ?></td>
                <td>
                    <?php if($ddata->status == 1): ?>
                        <span class="badge bg-warning"><?php echo e(trans('labels.pending')); ?> </span>
                    <?php else: ?>
                        <span class="badge bg-success"><?php echo e(trans('labels.connected')); ?> </span>
                    <?php endif; ?>
                </td>

                <td>
                    <?php if($vendor): ?>
                        <?php if($ddata->status == 1): ?>
                            <a class="btn btn-sm btn-outline-success <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                tooltip="<?php echo e(trans('labels.active')); ?>"
                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/custom_domain/status_change-' . $vendorId) . '/2'); ?>')" <?php endif; ?>>
                                <i class="fas fa-check"></i>
                            </a>
                        <?php else: ?>
                            <a class="btn btn-sm btn-outline-danger <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/custom_domain/status_change-' . $vendorId) . '/1'); ?>')" <?php endif; ?>>
                                <i class="fas fa-close"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/customdomain/listcustomdomain_table.blade.php ENDPATH**/ ?>