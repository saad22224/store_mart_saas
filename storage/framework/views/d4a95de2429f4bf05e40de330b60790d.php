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
    $cartImage = @$product->product_image->image ?? $product->image;
    $hasVariants = (int) ($product->has_variants ?? 2) === 1;
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
            <?php if($hasVariants): ?>
                <a href="<?php echo e($url); ?>" class="mp-card-quick" title="<?php echo e(trans('labels.view')); ?>">
                    <i class="fa-solid fa-bag-shopping"></i>
                </a>
            <?php else: ?>
                <button type="button" class="mp-card-quick"
                    title="<?php echo e(trans('labels.add_to_cart')); ?>"
                    data-mp-quick-add
                    data-item-id="<?php echo e($product->id); ?>"
                    data-item-name="<?php echo e(e($product->item_name)); ?>"
                    data-item-image="<?php echo e($cartImage); ?>"
                    data-item-price="<?php echo e($price); ?>"
                    data-item-original="<?php echo e($original); ?>"
                    data-tax="<?php echo e($product->tax); ?>"
                    data-min="<?php echo e($product->min_order ?? 0); ?>"
                    data-max="<?php echo e($product->max_order ?? 0); ?>"
                    data-stock="<?php echo e($product->stock_management); ?>"
                    data-vendor="<?php echo e(@$storeinfo->id); ?>">
                    <i class="fa-solid fa-bag-shopping"></i>
                </button>
            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/product_card.blade.php ENDPATH**/ ?>