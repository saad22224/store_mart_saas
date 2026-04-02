<div class="card border-0 w-100">
    <div class="card-body">
        <div class="d-flex gap-2 align-items-center">
            <div class="col-auto">
                <img src="<?php echo e(helper::image_path($productdata->image)); ?>" class="rounded">
            </div>
            <div class="w-100">
                <h6 class="heading color-changer text-capitalize">
                    <?php echo e($productdata->item_name); ?>

                </h6>
                <p class="info text-muted line-2">
                    <?php echo e(trans('labels.recently_purchased')); ?>

                </p>
                <div class="read-more-wrapper">
                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $productdata->slug)); ?>" class="text-primary">
                        <span
                            class="read-more text-secondary text-decoration-underline"><?php echo e(trans('labels.view_product')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/ServerDemo_StoreMart/Storemart_v.4.4/Storemart/resources/views/front/sales_notification/index.blade.php ENDPATH**/ ?>