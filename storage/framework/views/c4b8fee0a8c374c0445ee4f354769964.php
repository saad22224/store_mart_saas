<form method="POST" class="m-0" action="<?php echo e(URL::to('admin/products/get-product-variants-possibilities')); ?>" id="editvariants">
    <?php echo csrf_field(); ?>
    <input name="variant_edit" type="hidden" value="edit">

    <?php $__currentLoopData = $productVariantOption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kry => $variantOpt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h6 class="text-dark color-changer mb-3"> <?php echo e($variantOpt['variant_name']); ?>: <small><?php echo e(__('Variant Options')); ?></small> </h6>
        <div class="form-group">
            <input class="form-control" name="variant_edt[<?php echo e($kry); ?>][variant_name]" type="hidden"
                id="variant_name<?php echo e($kry); ?>" value="<?php echo e($variantOpt['variant_name']); ?>"
                onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
            <input class="form-control" name="variant_edt[<?php echo e($kry); ?>][variant_options]" type="text"
                onkeyup="regularexpession(this.id);" id="variant_options<?php echo e($kry); ?>"
                placeholder="<?php echo e(__('Variant Options separated by|pipe symbol, i.e Black|Blue|Red')); ?>">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="mt-3 col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
        <input type="button" value="<?php echo e(__('Add Variants')); ?>" class="btn btn-primary px-sm-4 addOredit-variants ms-2">
    </div>
</form>
<script>
    $(document).on('click', '.addOredit-variants', function(e) {
        e.preventDefault();
        var forms = $(this).parents('form');

        var hiddenVariantOptions = $('#hiddenVariantOptions').val();
        let form = document.getElementById('editvariants');
        let fd = new FormData(form);

        fd.append('hiddenVariantOptions', hiddenVariantOptions);
        $.ajax({
            type: 'POST',
            url: "<?php echo e(URL::to('admin/products/product-variants-possibilities', ['item_id' => $item_id])); ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {

                $('#hiddenVariantOptions').val(data.hiddenVariantOptions);
                $('.variant-table').html(data.varitantHTML);
                $("#commonModal").modal('hide');
            },
        });
    });
</script>
<script>
    function regularexpession(id) {
        $('#' + id).keypress(function(e) {
            var txt = String.fromCharCode(e.which);
            if (!txt.match(/[A-Za-z0-9|. ]/)) {
                return false;
            }
        });

        $('#' + id).bind('paste', function() {
            setTimeout(function() {
                var value = $('#' + id).val();
                var updated = value.replace(/[^A-Za-z0-9&. ]/g, '');
                $('#' + id).val(updated);
            });
        });
    }
</script>
<script>
    function validation(value, id) {
        if (value.includes('@')) {
            newval = value.replaceAll('@', '');
            $('#' + id).val(newval);
        }
        if (value.includes('\\')) {
            newval = value.replaceAll('\\', '');
            $('#' + id).val(newval);
        }
    }
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product\variants\edit.blade.php ENDPATH**/ ?>