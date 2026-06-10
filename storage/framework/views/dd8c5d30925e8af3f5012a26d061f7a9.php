<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">شركة الشحن الخاصة بمتجري</h5>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/my-shipping-companies/save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $shippingCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingCompany): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label class="border rounded p-3 w-100 h-100">
                                        <div class="d-flex align-items-start gap-2">
                                            <input class="form-check-input mt-1" type="radio" name="shipping_company_id"
                                                value="<?php echo e($shippingCompany->id); ?>"
                                                <?php echo e((int) old('shipping_company_id', $selectedShippingCompanyId) === (int) $shippingCompany->id ? 'checked' : ''); ?>

                                                required>
                                            <div>
                                                <div class="fw-600 text-dark"><?php echo e($shippingCompany->name); ?></div>
                                                <div class="text-muted fs-7"><?php echo e($shippingCompany->delivery_duration); ?></div>
                                                <div class="text-muted fs-7"><?php echo e($shippingCompany->whatsapp_number); ?></div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">
                                    <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $__errorArgs = ['shipping_company_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger fs-7"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button class="btn btn-primary px-sm-4" <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/shipping_companies/vendor_settings.blade.php ENDPATH**/ ?>