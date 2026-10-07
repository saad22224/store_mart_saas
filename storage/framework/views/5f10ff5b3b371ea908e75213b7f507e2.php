
<form method="POST" action="<?php echo e(URL::to('admin/products/get-product-variants-possibilities')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group">

        <label for="variant_name" class="form-label"><?php echo e(__('Variant Name')); ?></label>
        <input class="form-control" name="variant_name" type="text" id="variant_name" placeholder="<?php echo e(__('Variant Name, i.e Size, Color etc')); ?>">
    </div>
    <div class="form-group">
        <label for="variant_options" class="form-label"><?php echo e(__('Variant Options')); ?></label>
        <input class="form-control" name="variant_options" type="text" id="variant_options" placeholder="<?php echo e(__('Variant Options separated by|pipe symbol, i.e Black|Blue|Red')); ?>">
    </div>
    <div class="mt-3 col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
        <input type="button" value="<?php echo e(__('Add Variants')); ?>" class="btn btn-primary add-variants ms-2">
    </div>
</form>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product\variants\create.blade.php ENDPATH**/ ?>