<?php
    $cartdata = $cartdata ?? collect();
    $key = $key ?? 0;

    if ($item->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
        $deal = helper::top_deals($storeinfo->id);
        if ($item['variation']->count() > 0) {
            $basePrice = $item['variation'][0]->price;
            $price = ($deal->offer_type == 1)
                ? ($basePrice > $deal->offer_amount ? $basePrice - $deal->offer_amount : $basePrice)
                : ($basePrice - $basePrice * ($deal->offer_amount / 100));
            $original_price = $basePrice;
        } else {
            $basePrice = $item->item_price;
            $price = ($deal->offer_type == 1)
                ? ($basePrice > $deal->offer_amount ? $basePrice - $deal->offer_amount : $basePrice)
                : ($basePrice - $basePrice * ($deal->offer_amount / 100));
            $original_price = $basePrice;
        }
    } else {
        if ($item['variation']->count() > 0) {
            $price = $item['variation'][0]->price;
            $original_price = $item['variation'][0]->original_price;
        } else {
            $price = $item->item_price;
            $original_price = $item->item_original_price;
        }
    }
    $off = ($original_price > 0 && $original_price > $price)
        ? number_format(100 - ($price * 100) / $original_price, 0)
        : 0;

    $cartQty = 0;
    $cartId = null;
    foreach ($cartdata as $ci) {
        if ((int) $ci->item_id === (int) $item->id) {
            $cartQty += $ci->qty;
            $cartId = $cartId ?? $ci->id;
        }
    }

    $imgFile = $item['product_image']?->image ?? ($item->image ?? null);
    $imgSrc = $imgFile
        ? helper::image_path($imgFile)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');

    $stockMgmt = $item->stock_management ?? 0;
    $isOut = ($stockMgmt == 1 && helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1);
    $onlineOrder = helper::appdata($storeinfo->id)->online_order;
    $uid = 't16_'.$item->id;
    $desc = ! empty($item->description) ? \Illuminate\Support\Str::limit(strip_tags($item->description), 90) : '';
?>

<article class="t16-card" id="t16card_<?php echo e($item->id); ?>" data-name="<?php echo e(mb_strtolower($item->item_name)); ?>"
    style="animation-delay: <?php echo e((is_numeric($key) ? ($key % 10) : 0) * 0.05); ?>s;">
    <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>" class="t16-card-media">
        <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($item->item_name); ?>" loading="lazy">
        <?php if($off > 0): ?>
            <span class="t16-card-off">-<?php echo e($off); ?>%</span>
        <?php endif; ?>
    </a>

    <div class="t16-card-body">
        <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>" class="t16-card-name"><?php echo e($item->item_name); ?></a>
        <?php if($desc !== ''): ?>
            <p class="t16-card-desc"><?php echo e($desc); ?></p>
        <?php endif; ?>

        <div class="t16-card-footer">
            <div class="t16-card-price-wrap">
                <span class="t16-price"><?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?></span>
                <?php if($off > 0): ?>
                    <span class="t16-old-price"><?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?></span>
                <?php endif; ?>
            </div>

            <?php if($onlineOrder == 1 && ! $isOut): ?>
                <input type="hidden" id="<?php echo e($uid); ?>_cartid" value="<?php echo e($cartId); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_price" value="<?php echo e($price); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_tax" value="<?php echo e($item->tax); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_image" value="<?php echo e($imgFile); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_name" value="<?php echo e(addslashes($item->item_name)); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_stock" value="<?php echo e($stockMgmt); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_min" value="<?php echo e($item->min_order ?? 0); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_max" value="<?php echo e($item->max_order ?? 0); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_vendor" value="<?php echo e($storeinfo->id); ?>">

                <?php if($item->has_variants == 1): ?>
                    <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>" class="t16-add-btn">
                        <i class="fa-regular fa-sliders"></i>
                        <span><?php echo e(App::getLocale() == 'ar' ? 'الخيارات' : 'Options'); ?></span>
                    </a>
                <?php else: ?>
                    <button type="button" class="t16-add-btn" id="<?php echo e($uid); ?>_addbtn"
                        style="<?php echo e($cartQty > 0 ? 'display:none;' : ''); ?>"
                        onclick="t16AddFirst('<?php echo e($item->id); ?>')">
                        <i class="fa-regular fa-plus"></i>
                        <span><?php echo e(trans('labels.add')); ?></span>
                    </button>
                    <div class="t16-qty" id="<?php echo e($uid); ?>_stepper"
                        style="<?php echo e($cartQty > 0 ? 'display:flex;' : 'display:none;'); ?>">
                        <button type="button" class="t16-qty-btn" onclick="t16Decrement('<?php echo e($item->id); ?>')">−</button>
                        <span class="t16-qty-num" id="<?php echo e($uid); ?>_qtynum"><?php echo e(max(1, $cartQty)); ?></span>
                        <button type="button" class="t16-qty-btn" onclick="t16Increment('<?php echo e($item->id); ?>')">+</button>
                    </div>
                <?php endif; ?>
            <?php elseif($onlineOrder == 1 && $isOut): ?>
                <span class="t16-out-badge"><?php echo e(trans('labels.out_of_stock')); ?></span>
            <?php else: ?>
                <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>" class="t16-add-btn">
                    <i class="fa-regular fa-eye"></i>
                    <span><?php echo e(trans('labels.view')); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/_product_card.blade.php ENDPATH**/ ?>