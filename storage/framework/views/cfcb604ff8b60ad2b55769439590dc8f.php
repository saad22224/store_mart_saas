<?php
      if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
?>

<?php if(env('Environment') == 'sendbox'): ?>
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.variants')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                <td><img src="<?php echo e(@helper::image_path($product['product_image']->image)); ?>"
                        class="img-fluid rounded hw-50 object-fit-cover" alt=""> </td>

                <td><?php echo e($product->item_name); ?></td>
                <td>
                <span class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span><br>
                </td>
                <td>
                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to('admin/shopify-products/add-' . $product_data['id'])); ?>" <?php endif; ?> tooltip="<?php echo e(trans('labels.add_product')); ?>"
                        class="btn btn-info hov btn-sm"> <i class="fa-solid fa-plus"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php else: ?>
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fw-500 fs-15">
            <th>#</th>
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.variants')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="align-middle">
                        <td> <?php echo e($key+1); ?> </td>
                        <td> <img src="<?php echo e($product_data['image']['src']); ?>" alt="" width="100"> </td>
                        <td> <?php echo e($product_data['title']); ?> </td>
                        <td> 
                        <?php if($product_data['variants']['0']['title'] != 'Default Title'): ?>
                            <span class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span>
                        <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(URL::to('admin/shopify-products/add-' . $product_data['id'])); ?>" tooltip="<?php echo e(trans('labels.add_product')); ?>"
                                class="btn btn-info hov btn-sm"> <i class="fa-solid fa-plus"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\shopify\table.blade.php ENDPATH**/ ?>