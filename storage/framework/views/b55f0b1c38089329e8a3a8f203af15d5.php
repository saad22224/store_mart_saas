
<style>
.variant-input {
    display: block;
    width: 100%;
    padding: 0.45rem 0.65rem;
    font-size: 0.88rem;
    font-weight: 500;
    line-height: 1.5;
    color: #0f172a !important;
    background-color: #ffffff !important;
    background-clip: padding-box;
    border: 1.5px solid #cbd5e1 !important;
    border-radius: 8px !important;
    outline: none;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.variant-input:focus {
    border-color: var(--bs-primary) !important;
    box-shadow: 0 0 0 3px rgba(21, 172, 130, 0.15) !important;
}
</style>

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
                    <td class="text-center align-middle">
                        <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 14px !important; color: #0f172a !important; background-color: #f1f5f9 !important; border: 1.5px solid #cbd5e1 !important; display: inline-block; min-width: 45px;">
                            <?php echo e(trim($values)); ?>

                        </span>
                        <input type="hidden" autocomplete="off" value="<?php echo e($possibility); ?>" name="verians[<?php echo e($counter); ?>][name]">
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td> 
                    <input type="text" id="voriginal_price_<?php echo e($counter); ?>" placeholder="<?php echo e(trans('labels.original_price')); ?>" class="variant-input" name="verians[<?php echo e($counter); ?>][original_price]" required>
                </td>
                <td>
                    <input type="text" id="vprice_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.selling_price')); ?>" class="variant-input" name="verians[<?php echo e($counter); ?>][price]" required>
                </td>
               
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vquantity_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.stock_qty')); ?>" class="variant-input" name="verians[<?php echo e($counter); ?>][qty]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmin_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" class="variant-input" name="verians[<?php echo e($counter); ?>][min_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmax_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" class="variant-input" name="verians[<?php echo e($counter); ?>][max_order]">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vlow_qty_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?> " class="variant-input" name="verians[<?php echo e($counter); ?>][low_qty]">
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
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product\variants\list.blade.php ENDPATH**/ ?>