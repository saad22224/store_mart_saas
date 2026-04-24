<?php if(request()->is('admin/products/edit-*')): ?>
    <?php if(@helper::checkaddons('digital_product')): ?>
        <?php if(helper::appdata($vendor_id)->product_type == 2): ?>
            <div class="col-md-6 form-group">
                <label class="col-form-label"><?php echo e(trans('labels.downloadfile')); ?></label>
                <input type="file" class="form-control" name="downloadfile" id="downloadfile">
                <p class="text-danger mt-2"><?php echo e(trans('labels.downloadfile')); ?> : <span class="text-dark"> <a
                            href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $getproductdata->download_file)); ?>"
                            target="_blank"><?php echo e($getproductdata->download_file); ?></a></span></p>
                <?php $__errorArgs = ['download_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span> <br>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(@helper::checkaddons('digital_product')): ?>
        <?php if(helper::appdata($vendor_id)->product_type == 2): ?>
            <div class="col-md-6 form-group">
                <label class="col-form-label"><?php echo e(trans('labels.downloadfile')); ?></label>
                <input type="file" class="form-control" name="downloadfile" id="downloadfile" <?php echo e(helper::appdata($vendor_id)->product_type == 2 ? 'required' : ''); ?>>
                <?php $__errorArgs = ['downloadfile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span> <br>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/product/digital_product.blade.php ENDPATH**/ ?>