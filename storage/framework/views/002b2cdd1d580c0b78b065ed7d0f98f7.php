
<div class="table-responsive">
    <table class="table table-bordered" id='tblvariants'>
        <thead>
        <tr class="text-center align-middle fs-15 fw-600">
          
            <?php $__currentLoopData = $variantArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><span class="fs-15 fw-600"><?php echo e(ucwords($variant)); ?></span></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.original_price')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.selling_price')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.stock_qty')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.min_order_qty')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.max_order_qty')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.product_low_qty_warning')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.stock_management')); ?></span></th>
            <th><span class="fs-15 fw-600"><?php echo e(trans('labels.is_available')); ?></span></th>
        </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $possibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $possibility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="fs-7 fw-500 align-middle">
              
                <?php $__currentLoopData = explode('|', $possibility); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <input type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?php echo e($values); ?>" name="verians[<?php echo e($counter); ?>][name]" readonly>
                        <input type="hidden" autocomplete="off" spellcheck="false" class="form-control" value="<?php echo e($possibility); ?>" name="verians[<?php echo e($counter); ?>][name]" readonly>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td> 
                    <input type="number" step="any" id="voriginal_price_<?php echo e($counter); ?>" placeholder="<?php echo e(trans('labels.original_price')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][original_price]"  required>
                </td>
                <td>
                    <input type="number" step="any" id="vprice_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.selling_price')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][price]" required>
                </td>
               
                <td>
                    <input type="text"  onkeypress="allowNumbersOnly(event)" id="vquantity_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.stock_qty')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][qty]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmin_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][min_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmax_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][max_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vlow_qty_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?> " class="form-control" name="verians[<?php echo e($counter); ?>][low_qty]">
                </td>
                <td class="text-center">
                    <input class="form-check-input stock_management" type="checkbox" value="1" onclick="stock_management(this.id)"
                    name="verians[<?php echo e($counter); ?>][stock_management]" id="vstockmanagement_<?php echo e($counter); ?>">
                </td>
                <td class="text-center">
                    <input class="form-check-input product_available" type="checkbox" value="1" name="verians[<?php echo e($counter); ?>][is_available]" id="<?php echo e($counter); ?>" onclick="checkavailable(this.id)" checked>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/product/variants/list.blade.php ENDPATH**/ ?>