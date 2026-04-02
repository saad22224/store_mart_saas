<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <td></td>
            <?php if(@helper::checkaddons('bulk_delete')): ?>
                <?php if($getbannerlist->count() > 0): ?>
                    <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                <?php endif; ?>
            <?php endif; ?>
            <td><?php echo e(trans('labels.srno')); ?></td>
            <td><?php echo e(trans('labels.image')); ?></td>
            <td><?php echo e(trans('labels.category')); ?></td>
            <td><?php echo e(trans('labels.product')); ?></td>
            <td><?php echo e(trans('labels.created_date')); ?></td>
            <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>
        </tr>
    </thead>
    <tbody id="tabledetails" data-url="<?php echo e(url('admin/' . $url . '/reorder_banner')); ?>">
        <?php $i = 1; ?>

        <?php $__currentLoopData = $getbannerlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($banner->section == $section): ?>
                <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($banner->id); ?>" data-id="<?php echo e($banner->id); ?>">
                    <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a>
                    </td>
                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                        <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($banner->id); ?>"></td>
                    <?php endif; ?>
                    <td><?php echo $i++; ?></td>
                    <td>
                        <img src="<?php echo e(helper::image_path($banner->banner_image)); ?>"
                            class="img-fluid rounded hight-50 object-fit-cover" alt="">
                    </td>
                    <td><?php echo e($banner->type == '1' ? @$banner['category_info']->name : '--'); ?></td>
                    <td><?php echo e($banner->type == '2' ? @$banner['product_info']->item_name : '--'); ?></td>
                    <td><?php echo e(helper::date_format($banner->created_at, $vendor_id)); ?><br>
                        <?php echo e(helper::time_format($banner->created_at, $vendor_id)); ?>


                    </td>
                    <td><?php echo e(helper::date_format($banner->updated_at, $vendor_id)); ?><br>
                        <?php echo e(helper::time_format($banner->updated_at, $vendor_id)); ?>

                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            <a tooltip="<?php echo e(trans('labels.edit')); ?>"
                                href="<?php echo e(URL::to('admin/' . $url . '/edit-' . $banner->id)); ?>"
                                class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_banner', Auth::user()->role_id, $vendor_id, 'edit') == 1 || helper::check_access('role_sliders', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <a tooltip="<?php echo e(trans('labels.delete')); ?>" href="javascript:void(0)"
                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
                        onclick="deletedata('<?php echo e(URL::to('admin/' . $url . '/delete-' . $banner->id)); ?>')" <?php endif; ?>
                                class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_banner', Auth::user()->role_id, $vendor_id, 'delete') == 1 || helper::check_access('role_sliders', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                <i class="fa-regular fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/banner/table.blade.php ENDPATH**/ ?>