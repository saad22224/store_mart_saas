<form action="<?php echo e($action); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                value="<?php echo e(old('name', $shippingCompany->name ?? '')); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">رقم واتساب الشركة<span class="text-danger"> *</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['whatsapp_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="whatsapp_number"
                value="<?php echo e(old('whatsapp_number', $shippingCompany->whatsapp_number ?? '')); ?>" placeholder="01000000000" required>
            <?php $__errorArgs = ['whatsapp_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">مدة التوصيل<span class="text-danger"> *</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['delivery_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="delivery_duration"
                value="<?php echo e(old('delivery_duration', $shippingCompany->delivery_duration ?? '')); ?>" placeholder="24 ساعة، 3 أيام، 5-7 أيام" required>
            <?php $__errorArgs = ['delivery_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label d-block"><?php echo e(trans('labels.status')); ?></label>
            <input type="hidden" name="is_active" value="0">
            <input id="shipping-company-status" type="checkbox" class="checkbox-switch" name="is_active" value="1"
                <?php echo e(old('is_active', $shippingCompany->is_active ?? true) ? 'checked' : ''); ?>>
            <label for="shipping-company-status" class="switch">
                <span class="switch__circle"><span class="switch__circle-inner"></span></span>
                <span class="switch__left ps-2"><?php echo e(trans('labels.active')); ?></span>
                <span class="switch__right pe-2"><?php echo e(trans('labels.inactive')); ?></span>
            </label>
        </div>
        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
            <a href="<?php echo e(URL::to('admin/shipping-companies')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
            <button class="btn btn-primary px-sm-4" <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
        </div>
    </div>
</form>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/shipping_companies/form.blade.php ENDPATH**/ ?>