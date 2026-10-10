<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $isMerchant = Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1);
        $activeCode = strtolower((string) (helper::appdata($vendor_id)->default_currency ?? ''));
        helper::ensure_base_currencies();
        if ($isMerchant) {
            $getcurrency = \App\Models\CurrencySettings::where('is_available', 1)
                ->orderByRaw("CASE WHEN LOWER(code)='syp' THEN 0 WHEN LOWER(code)='usd' THEN 1 ELSE 2 END")
                ->orderBy('name')
                ->get()
                ->unique(function ($row) {
                    return strtolower((string) $row->code);
                })
                ->values();
        }
    ?>

    <?php if($isMerchant): ?>
        
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="text-capitalize fw-600 text-dark color-changer fs-4 mb-1"><?php echo e(trans('labels.currency-settings')); ?></h5>
                <p class="text-muted mb-0 small">اختر عملة واحدة فقط لعرض الأسعار في متجرك. لا يتم تحويل الأسعار تلقائياً.</p>
            </div>
            <a href="<?php echo e(URL::to('admin/currency-settings/add')); ?>"
                class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

            </a>
        </div>

        <div class="row mt-3 g-3">
            <?php $__currentLoopData = $getcurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $isActive = $activeCode === strtolower((string) $currency->code); ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 box-shadow h-100 <?php echo e($isActive ? 'border border-success' : ''); ?>">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div>
                                    <h5 class="mb-1 fw-700 color-changer"><?php echo e($currency->name); ?></h5>
                                    <div class="text-muted small"><?php echo e(strtoupper($currency->code)); ?> · <?php echo e($currency->currency); ?></div>
                                </div>
                                <?php if($isActive): ?>
                                    <span class="badge bg-success px-3 py-2"><?php echo e(trans('labels.active_currency')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mt-auto pt-2">
                                <?php if($isActive): ?>
                                    <button type="button" class="btn btn-outline-success w-100" disabled>
                                        <?php echo e(trans('labels.active_currency')); ?>

                                    </button>
                                <?php else: ?>
                                    <a href="javascript:void(0)"
                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                                        <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currency-settings/setdefault-' . $currency->code . '/1')); ?>')" <?php endif; ?>
                                        class="btn btn-dark w-100 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                        <?php echo e(trans('labels.activate_currency')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.currency-settings')); ?></h5>
            <div class="d-flex align-items-center" style="gap: 10px;">
                <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                        <button id="bulkDeleteBtn"
                            <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/currency-settings/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                            <i class="fa-regular fa-trash"></i>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(helper::checkaddons('currency_settigns')): ?>
                    <a href="<?php echo e(URL::to('admin/currency-settings/add')); ?>"
                        class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                        <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                    </a>
                <?php endif; ?>
            </div>
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
                                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                            <?php if(@helper::checkaddons('bulk_delete')): ?>
                                                <?php if($getcurrency->count() > 0): ?>
                                                    <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td><?php echo e(trans('labels.srno')); ?></td>
                                        <td><?php echo e(trans('labels.name')); ?></td>
                                        <td><?php echo e(trans('labels.currency')); ?></td>
                                        <td><?php echo e(trans('labels.status')); ?></td>
                                        <td><?php echo e(trans('labels.is_default')); ?></td>
                                        <td><?php echo e(trans('labels.created_date')); ?></td>
                                        <td><?php echo e(trans('labels.updated_date')); ?></td>
                                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                            <td><?php echo e(trans('labels.action')); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody id="tabledetails" data-url="">
                                    <?php $i = 1; ?>
                                    <?php $__currentLoopData = $getcurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($currency->id); ?>" data-id="<?php echo e($currency->id); ?>">
                                            <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                <?php if(@helper::checkaddons('bulk_delete')): ?>
                                                    <?php if(Strtoupper($currency->name) != 'USD'): ?>
                                                        <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($currency->id); ?>"></td>
                                                    <?php else: ?>
                                                        <td></td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <td><?php echo e($i++); ?></td>
                                            <td><?php echo e($currency->name); ?></td>
                                            <td><?php echo e($currency->currency); ?></td>
                                            <td>
                                                <?php if($currency->is_available == '1'): ?>
                                                    <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currency-settings/changestatus-' . $currency->code . '/2')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-success hov"><i class="fas fa-check"></i></a>
                                                <?php else: ?>
                                                    <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currency-settings/changestatus-' . $currency->code . '/1')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-danger hov"><i class="fas fa-close mx-1"></i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(strtolower((string) helper::appdata($vendor_id)->default_currency) == strtolower((string) $currency->code)): ?>
                                                    <span class="badge bg-success"><?php echo e(trans('labels.active_currency')); ?></span>
                                                <?php else: ?>
                                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currency-settings/setdefault-' . $currency->code . '/1')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm btn-outline-dark hov"
                                                        tooltip="<?php echo e(trans('labels.activate_currency')); ?>"><?php echo e(trans('labels.activate_currency')); ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(helper::date_format($currency->created_at, $vendor_id)); ?><br><?php echo e(helper::time_format($currency->created_at, $vendor_id)); ?></td>
                                            <td><?php echo e(helper::date_format($currency->updated_at, $vendor_id)); ?><br><?php echo e(helper::time_format($currency->updated_at, $vendor_id)); ?></td>
                                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                <td>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <a href="<?php echo e(URL::to('admin/currency-settings/currency/edit-' . $currency->id)); ?>"
                                                            class="btn btn-info hov btn-sm" tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <?php if(Strtoupper($currency->name) != 'USD' && strtolower($currency->code) != 'syp'): ?>
                                                            <a class="btn btn-danger hov"
                                                                tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/currency-settings/delete-' . $currency->id . '/1')); ?>')" <?php endif; ?>>
                                                                <i class="fa-regular fa-trash"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/currency_settings/index.blade.php ENDPATH**/ ?>