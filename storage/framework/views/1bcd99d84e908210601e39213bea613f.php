<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <td></td>
            <?php if(@helper::checkaddons('bulk_delete')): ?>
                <?php if($getpromocodeslist->count() > 0): ?>
                    <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                <?php endif; ?>
            <?php endif; ?>
            <td><?php echo e(trans('labels.srno')); ?></td>
            <td><?php echo e(trans('labels.coupon_name')); ?></td>
            <td><?php echo e(trans('labels.coupon_code')); ?></td>
            <td><?php echo e(trans('labels.discount')); ?></td>
            <td><?php echo e(trans('labels.start_date')); ?></td>
            <td><?php echo e(trans('labels.end_date')); ?></td>
            <td><?php echo e(trans('labels.status')); ?></td>
            <td><?php echo e(trans('labels.created_date')); ?></td>
            <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>
        </tr>
    </thead>
    <tbody id="tabledetails" data-url="<?php echo e(url('admin/coupons/reorder_coupon')); ?>">
        <?php $i = 1; ?>
        <?php $__currentLoopData = $getpromocodeslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promocode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="fs-7  row1 align-middle" id="dataid<?php echo e($promocode->id); ?>" data-id="<?php echo e($promocode->id); ?>">
                <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                <?php if(@helper::checkaddons('bulk_delete')): ?>
                    <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($promocode->id); ?>"></td>
                <?php endif; ?>
                <td><?php echo $i++; ?></td>
                <td><?php echo e($promocode->offer_name); ?></td>
                <td><?php echo e($promocode->offer_code); ?></td>
                <td><?php echo e($promocode->offer_type == 1 ? helper::currency_formate($promocode->offer_amount, $vendor_id) : $promocode->offer_amount . '%'); ?>

                </td>
                <td><span class="badge bg-success"><?php echo e(helper::date_format($promocode->start_date, $vendor_id)); ?></span>
                </td>
                <td><span class="badge bg-danger"><?php echo e(helper::date_format($promocode->exp_date, $vendor_id)); ?></span>
                </td>
                <td>
                    <?php if($promocode->is_available == '1'): ?>
                        <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.active')); ?>"
                            onclick="statusupdate('<?php echo e(URL::to('admin/coupons/status-' . $promocode->id . '/2')); ?>')"
                            class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                            <i class="fa-regular fa-check"></i> </a>
                    <?php else: ?>
                        <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.inactive')); ?>"
                            onclick="statusupdate('<?php echo e(URL::to('admin/coupons/status-' . $promocode->id . '/1')); ?>')"
                            class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                            <i class="fa-regular fa-xmark"></i> </a>
                    <?php endif; ?>
                </td>
                <td><?php echo e(helper::date_format($promocode->created_at, $vendor_id)); ?><br>
                    <?php echo e(helper::time_format($promocode->created_at, $vendor_id)); ?>

                </td>
                <td><?php echo e(helper::date_format($promocode->updated_at, $vendor_id)); ?><br>
                    <?php echo e(helper::time_format($promocode->updated_at, $vendor_id)); ?>

                </td>
                <td>
                    <div class="d-flex flex-wrap gap-1">
                        <a href="<?php echo e(URL::to('admin/coupons/edit-' . $promocode->id)); ?>"
                            class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                            tooltip="<?php echo e(trans('labels.edit')); ?>"> <i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="javascript:void(0)"
                            onclick="deletedata('<?php echo e(URL::to('admin/coupons/delete-' . $promocode->id)); ?>')"
                            class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                            tooltip="<?php echo e(trans('labels.delete')); ?>"> <i class="fa-regular fa-trash"></i></a>
                        <a class="btn btn-sm btn-secondary hov"
                            href="<?php echo e(URL::to('admin/coupons/details-' . $promocode->offer_code)); ?>"
                            tooltip="<?php echo e(trans('labels.view')); ?>"> <i class="fa-regular fa-eye"></i> </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/envato_storemart/Storemart_V4.4/Storemart_Addon/resources/views/admin/included/coupons/coupons_table.blade.php ENDPATH**/ ?>