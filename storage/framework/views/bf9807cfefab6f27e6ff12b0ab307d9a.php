<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.products')); ?></h5>
        <div class="d-flex">
            <div class="d-flex align-items-center" style="gap: 10px;">
                <!-- Bulk Delete Button -->
                <?php if(@helper::checkaddons('bulk_delete')): ?>
                    <button id="bulkDeleteBtn"
                        <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/products/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                        <i class="fa-regular fa-trash"></i>
                    </button>
                <?php endif; ?>
                <a href="<?php echo e(URL::to('admin/products/add')); ?>"
                    class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                </a>
            </div>
            <?php if(@helper::checkaddons('product_import')): ?>
                <?php if($getproductslist->count() > 0): ?>
                    <a href="<?php echo e(URL::to('/admin/exportproduct')); ?>"
                        class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?> mx-2"><?php echo e(trans('labels.export')); ?></a>
                <?php endif; ?>
            <?php endif; ?>

        </div>

    </div>
    <div class="row">

        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td></td>
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($getproductslist->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.image')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.price')); ?></td>
                                    <td><?php echo e(trans('labels.stock')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/products/reorder_category')); ?>">
                                <?php $i = 1; ?>
                                <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($product->id); ?>"
                                        data-id="<?php echo e($product->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($product->id); ?>"></td>
                                        <?php endif; ?>
                                        <td><?php echo $i++; ?></td>
                                        <td><img src="<?php echo e(@helper::image_path($product['product_image']->image)); ?>"
                                                class="img-fluid rounded hw-50 object-fit-cover" alt=""> </td>

                                        <td><?php echo e($product->item_name); ?> <br>
                                            <?php if($product->view_count > 0): ?>
                                                <span class="badge bg-success"><i class="fa-solid fa-eye"></i>
                                                    <?php echo e($product->view_count); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->has_variants == 1): ?>
                                                <span class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span><br>
                                            <?php else: ?>
                                                <?php echo e(helper::currency_formate($product->item_price, $vendor_id)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->has_variants == 1): ?>
                                                <span class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span><br>
                                                <?php if(helper::checklowqty($product->id, $product->vendor_id) == 1): ?>
                                                    <span class="badge bg-warning"><?php echo e(trans('labels.low_qty')); ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($product->stock_management == 1): ?>
                                                    <?php if(helper::checklowqty($product->id, $product->vendor_id) == 1): ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e(trans('labels.in_stock')); ?></span><br>
                                                        <span class="badge bg-warning"><?php echo e(trans('labels.low_qty')); ?></span>
                                                    <?php elseif(helper::checklowqty($product->id, $product->vendor_id) == 2): ?>
                                                        <span
                                                            class="badge bg-danger"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                    <?php elseif(helper::checklowqty($product->id, $product->vendor_id) == 3): ?>
                                                        -
                                                    <?php else: ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e(trans('labels.in_stock')); ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if($product->is_available == '1'): ?>
                                                <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/status-' . $product->slug . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fas fa-check"></i></a>
                                            <?php else: ?>
                                                <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/status-' . $product->slug . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fas fa-close"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_format($product->created_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($product->created_at, $vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($product->updated_at, $vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($product->updated_at, $vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    href="<?php echo e(URL::to('admin/products/edit-' . $product->slug)); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                                <a tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/delete-' . $product->slug)); ?>')" <?php endif; ?>>
                                                    <i class="fa-regular fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/product/product.blade.php ENDPATH**/ ?>