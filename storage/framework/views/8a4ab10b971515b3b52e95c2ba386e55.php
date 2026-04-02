<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $module = 'role_currency_settings';
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.currency')); ?></h5>
        
        <div class="d-flex align-items-center" style="gap: 10px;">
            <?php if(@helper::checkaddons('bulk_delete')): ?>
                <button id="bulkDeleteBtn"
                    <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/currencys/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                    <i class="fa-regular fa-trash"></i>
                </button>
            <?php endif; ?> 
            
            <?php if(helper::checkaddons('currency_settigns')): ?>
                <a href="<?php echo e(URL::to('admin/currencys/currency_add')); ?>"
                    class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
        <div class="alert alert-warning my-3" role="alert">
            <p><?php echo e(trans('labels.dont_change_default_currency')); ?></p>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($getcurrency->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                     <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.currency')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>


                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="">
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $getcurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($currency->id); ?>"
                                        data-id="<?php echo e($currency->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>">
                                                <i class="fa-light fa-up-down-left-right mx-2"></i>
                                            </a>
                                        </td>
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <?php if(Strtoupper($currency->currency) != 'USD'): ?>
                                                <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($currency->id); ?>"></td>
                                            <?php else: ?>
                                                <td></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td><?php
                                            echo $i++;
                                        ?> </td>
                                        <td><?php echo e($currency->currency); ?></td>

                                        <td>
                                            <?php echo e($currency->currency_symbol); ?>

                                        </td>
                                        <td>
                                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                <?php if($currency->is_available == '1'): ?>
                                                    <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currencys/currencystatus-' . $currency->code . '/2')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currencys/currencystatus-' . $currency->code . '/1')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                        <i class="fas fa-close mx-1"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($currency->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($currency->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($currency->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($currency->updated_at, $vendor_id)); ?>

                                        </td>
                                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                            <td>
                                                <?php if(Strtoupper($currency->currency) != 'USD'): ?>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <a href="<?php echo e(URL::to('admin/currencys/currency_edit-' . $currency->id)); ?>"
                                                            class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                            tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>

                                                        <a class="btn btn-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                            tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currencys/delete-' . $currency->id . '/1')); ?>')" <?php endif; ?>>
                                                            <i class="fa-regular fa-trash"></i>
                                                        </a>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/currency_settings/currencys/index.blade.php ENDPATH**/ ?>