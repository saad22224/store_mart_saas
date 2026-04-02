<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.cities')); ?></h5>
        
        <div class="d-flex align-items-center" style="gap: 10px;">
            <!-- Bulk Delete Button -->
            <?php if(@helper::checkaddons('bulk_delete')): ?>
            <button id="bulkDeleteBtn"
                <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/countries/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                <i class="fa-regular fa-trash"></i>
            </button>
            <?php endif; ?>

            <a href="<?php echo e(URL::to('admin/countries/add')); ?>"
                class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cities', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($allcontries->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.city')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>

                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/countries/reorder_city')); ?>">
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $allcontries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($country->id); ?>"
                                        data-id="<?php echo e($country->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>

                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                             <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($country->id); ?>"></td>
                                        <?php endif; ?>

                                        <td>
                                            <?php
                                                echo $i++;
                                            ?></td>
                                        <td><?php echo e($country->name); ?></td>
                                        <td>
                                            <?php if($country->is_available == '1'): ?>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/countries/change_status-' . $country->id . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cities', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    tooltip="<?php echo e(trans('labels.active')); ?>"><i class="fas fa-check"></i>
                                                </a>
                                            <?php else: ?>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/countries/change_status-' . $country->id . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cities', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    tooltip="<?php echo e(trans('labels.inactive')); ?>">
                                                    <i class="fas fa-close"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($country->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($country->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($country->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($country->updated_at, $vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="<?php echo e(URL::to('admin/countries/edit-' . $country->id)); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cities', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/countries/delete-' . $country->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cities', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                    tooltip="<?php echo e(trans('labels.delete')); ?>">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/country/index.blade.php ENDPATH**/ ?>