<?php
    $price = $product->item_price;
    $original = $product->item_original_price;
    if (isset($product->variation) && count($product->variation) > 0) {
        $price = $product->variation[0]->price ?? $price;
        $original = $product->variation[0]->original_price ?? $original;
    }
    $hasDiscount = $original > $price && $price > 0;
    $discountPct = $hasDiscount ? round((($original - $price) / $original) * 100) : 0;
    $img = helper::image_path($product->image);
    $url = URL::to(@$storeinfo->slug . '/detail-' . $product->slug);
?>
<article class="mp-card">
    <div class="mp-card-media">
        <?php if($hasDiscount): ?>
            <span class="mp-badge mp-badge-sale">-<?php echo e($discountPct); ?>%</span>
        <?php endif; ?>
        <a href="<?php echo e($url); ?>" class="mp-card-img-link">
            <img src="<?php echo e($img); ?>" alt="<?php echo e($product->item_name); ?>" loading="lazy" class="mp-card-img"
                onerror="this.src='<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>'">
        </a>
        <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
            <a href="javascript:void(0)" class="mp-card-quick" onclick="GetProductOverview('<?php echo e($product->slug); ?>', '')"
                title="<?php echo e(trans('labels.add_to_cart')); ?>">
                <i class="fa-solid fa-bag-shopping"></i>
            </a>
        <?php endif; ?>
    </div>
    <div class="mp-card-body">
        <h3 class="mp-card-title">
            <a href="<?php echo e($url); ?>"><?php echo e($product->item_name); ?></a>
        </h3>
        <div class="mp-card-price">
            <?php if($hasDiscount): ?>
                <span class="mp-price-was"><?php echo e(helper::currency_formate($original, @$storeinfo->id)); ?></span>
            <?php endif; ?>
            <span class="mp-price-now"><?php echo e(helper::currency_formate($price, @$storeinfo->id)); ?></span>
        </div>
    </div>
</article>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\product_card.blade.php ENDPATH**/ ?>