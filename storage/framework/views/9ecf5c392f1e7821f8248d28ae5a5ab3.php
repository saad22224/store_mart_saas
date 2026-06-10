<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">شركات الشحن</h5>
        <a href="<?php echo e(URL::to('admin/shipping-companies/add')); ?>" class="btn btn-secondary px-sm-4 d-flex">
            <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td>رقم واتساب</td>
                                    <td>مدة التوصيل</td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $shippingCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shippingCompany): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($shippingCompany->name); ?></td>
                                        <td><?php echo e($shippingCompany->whatsapp_number); ?></td>
                                        <td><?php echo e($shippingCompany->delivery_duration); ?></td>
                                        <td>
                                            <?php if($shippingCompany->is_active): ?>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/shipping-companies/change_status-' . $shippingCompany->id . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov" tooltip="<?php echo e(trans('labels.active')); ?>">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php else: ?>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/shipping-companies/change_status-' . $shippingCompany->id . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov" tooltip="<?php echo e(trans('labels.inactive')); ?>">
                                                    <i class="fas fa-close"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($shippingCompany->created_at, Auth::user()->id)); ?><br>
                                            <?php echo e(helper::time_format($shippingCompany->created_at, Auth::user()->id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="<?php echo e(URL::to('admin/shipping-companies/edit-' . $shippingCompany->id)); ?>"
                                                    class="btn btn-info hov btn-sm" tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/shipping-companies/delete-' . $shippingCompany->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm" tooltip="<?php echo e(trans('labels.delete')); ?>">
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/shipping_companies/index.blade.php ENDPATH**/ ?>