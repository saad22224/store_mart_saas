<?php
    if(Auth::user()->type == 4)
    {
        $vendor_id = Auth::user()->vendor_id;
    }else{
        $vendor_id = Auth::user()->id;
    }
?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4 color-changer"><?php echo e(trans('labels.shopify')); ?></h5>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(env('Environment') == 'sendbox'): ?>
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <th>#</th>
                                    <th><?php echo e(trans('labels.name')); ?></th>
                                    <th><?php echo e(trans('labels.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="align-middle">
                                        <td> <?php echo $i++; ?> </td>
                                        <td> <?php echo e($category->name); ?></td>
                                        <td>
                                            <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to('admin/shopify-category/add-category-' . $cat_data['id'])); ?>" <?php endif; ?> tooltip="<?php echo e(trans('labels.add_category')); ?>"
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
                                    <th><?php echo e(trans('labels.name')); ?></th>
                                    <th><?php echo e(trans('labels.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $category['custom_collections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="align-middle">
                                        <td> <?php echo e($key+1); ?> </td>
                                        <td> <?php echo e($cat_data['title']); ?> </td>
                                        <td>
                                            <a href="<?php echo e(URL::to('admin/shopify-category/add-category-' . $cat_data['id'])); ?>" tooltip="<?php echo e(trans('labels.add_category')); ?>"
                                                class="btn btn-info hov btn-sm"> <i class="fa-solid fa-plus"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\shopify\category.blade.php ENDPATH**/ ?>