
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
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $io=0;
            ?>
            <?php $__currentLoopData = $possibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $possibility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $name = App\Models\Variants::variant_name($possibility, $io, $item_id);
                
                if ($name['has_variant'] == 0) {
                    $io++;
                }
                ?>
            <tr class="fs-7 fw-500 align-middle">
                <?php $__currentLoopData = explode('|', $possibility); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center align-middle">
                        <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 14px !important; color: #0f172a !important; background-color: #f1f5f9 !important; border: 1.5px solid #cbd5e1 !important; display: inline-block; min-width: 45px;">
                            <?php echo e(trim($values)); ?>

                        </span>
                        <input name="<?php echo e(!empty($name['has_name'][$key]) ? $name['has_name'][$key] : $name['has_name'][0]); ?>" type="hidden" value="<?php echo e($possibility); ?>">
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td>
                    <input type="text" id="voriginal_price_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.original_price')); ?>" class="variant-input"
                    name="<?php echo e($name['original_price']); ?>" value="<?php echo e($name['original_price_val']); ?>" required>
                </td>
                <td>
                    <input type="text" id="vprice_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.selling_price')); ?>" class="variant-input"
                    name="<?php echo e($name['price']); ?>" value="<?php echo e($name['price_val']); ?>" required>
                </td>

                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vqty_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.stock_qty')); ?>" class="variant-input"
                    name="<?php echo e($name['qty']); ?>" value="<?php echo e($name['qty_val']); ?>">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vmin_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" class="variant-input"
                    name="<?php echo e($name['min_order']); ?>" value="<?php echo e($name['min_order_val']); ?>">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)"  id="vmax_order_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" class="variant-input"
                    name="<?php echo e($name['max_order']); ?>" value="<?php echo e($name['max_order_val']); ?>">
                </td>
                <td>
                    <input type="text" onkeypress="allowNumbersOnly(event)" id="vlow_qty_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(trans('labels.low_qty')); ?>" class="variant-input"
                    name="<?php echo e($name['low_qty']); ?>" value="<?php echo e($name['low_qty_val']); ?>">
                </td>
                <td class="text-center">
                    <input type="checkbox" id="vstockmanagement_<?php echo e($counter); ?>" class="form-check-input" 
                    name="<?php echo e($name['stock_management']); ?>" value="1" <?php echo e($name['stock_management_val'] == 1 ? 'checked' : ''); ?>  onclick="edit_stock_management(this.id)">
                </td>
                <td class="text-center">
                    <input type="checkbox" id="<?php echo e($counter); ?>" class="form-check-input product_available" id="<?php echo e($counter); ?>" onclick="edit_checkavailable(this.id)"
                    name="<?php echo e($name['is_available']); ?>" value="1" <?php echo e($name['is_available_val'] == 1 ? 'checked' : ''); ?>  <?php echo e($name['is_available_val'] == 1 ? 'checked' : ''); ?>>
                </td>
              
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product\variants\edit_list.blade.php ENDPATH**/ ?>