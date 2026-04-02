<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<input type="hidden" id="cat_id" value="<?php echo e($cat_id); ?>" />
<?php if(count($getitem) > 0): ?>
    <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2 g-xl-4 g-3 p-2">
        <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                if ($item['variation']->count() > 0) {
                    $price = $item['variation'][0]->price;
                    $original_price = $item['variation'][0]->original_price;
                } else {
                    $price = $item->item_price;
                    $original_price = $item->item_original_price;
                }
                $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
            ?>
            <div class="col">
                <a href="javascript:void(0);" onclick='showitems("<?php echo e($item->id); ?>","<?php echo e($item->slug); ?>")'>
                    <div class="card h-100 w-100 border rounded-4 overflow-hidden">
                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>" alt="product image"
                            class="card-img-top imgs object position-relative">
                        <?php if($off > 0): ?>
                            <div class="offer-box position-absolute">
                                <p class="m-0"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="card-body px-2 py-1">
                            <h5 class="product-name ">
                                <a href="javascript:void(0);"
                                    class="card-text color-changer fs-7 fw-semibold text-dark mb-0 mt-2 line-2">
                                    <?php echo e($item->item_name); ?>

                                </a>
                            </h5>
                        </div>
                        <div class="card-footer bg-transparent border-0 px-2 pb-2 pt-0">
                            <?php if($item->stock_management == 1): ?>
                                <?php if(helper::checklowqty($item->id, $vendor_id) == 2): ?>
                                    <div class="d-flex align-items-center my-1 gap-1">
                                        <span class="d-flex justify-content-center font-8px text-danger">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        <span class="text-danger fs-8">
                                            <?php echo e(trans('labels.out_of_stock')); ?>

                                        </span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="col-12 my-1">
                                <small
                                    class="fs-15 fw-600 text-dark color-changer mb-0 mt-1 d-flex flex-wrap lh-1 align-items-center gap-1">
                                    <?php echo e(helper::currency_formate($price, $vendor_id)); ?>

                                    <del class="fs-7 text-muted fw-medium">
                                        <?php if($original_price > $price): ?>
                                            <?php echo e(helper::currency_formate($original_price, $vendor_id)); ?>

                                        <?php endif; ?>
                                    </del>
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/ServerDemo_StoreMart/Storemart_v.4.4/Storemart/resources/views/admin/pos/positem.blade.php ENDPATH**/ ?>