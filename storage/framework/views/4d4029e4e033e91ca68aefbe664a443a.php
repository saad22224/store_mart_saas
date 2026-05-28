<?php
    /* ─── Price calculation (identical to template-7) ─── */
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
            $price          = $item['variation'][0]->price;
            $original_price = $item['variation'][0]->original_price;
        } else {
            $price          = $item->item_price;
            $original_price = $item->item_original_price;
        }
    }
    $off = ($original_price > 0 && $original_price > $price)
        ? number_format(100 - ($price * 100) / $original_price, 0)
        : 0;

    /* ─── Cart state from current session ─── */
    $cartQty = 0;
    $cartId  = null;
    foreach ($cartdata as $ci) {
        if ($ci->item_id == $item->id) {
            $cartQty += $ci->qty;
            $cartId   = $cartId ?? $ci->id;
        }
    }

    $imgSrc    = (@$item['product_image']->image)
        ? helper::image_path($item['product_image']->image)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');

    $stockMgmt  = $item->stock_management ?? 0;
    $isOut      = ($stockMgmt == 1 && helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1);
    $onlineOrder = helper::appdata($storeinfo->id)->online_order;

    /* unique id for this card's DOM elements */
    $uid = 't16_' . $item->id;
?>

<div class="t16-card" id="t16card_<?php echo e($item->id); ?>">

    
    <div class="t16-card-img">
        <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>">
            <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($item->item_name); ?>" loading="lazy">
        </a>
    </div>

    
    <div class="t16-card-body">
        <div>
            
            <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>" style="text-decoration:none;">
                <div class="t16-card-name"><?php echo e($item->item_name); ?></div>
            </a>

            
            <?php if(!empty($item->description)): ?>
                <div class="t16-card-desc"><?php echo Str::limit(strip_tags($item->description), 80); ?></div>
            <?php endif; ?>

            
            <?php if(@helper::checkaddons('product_reviews') && helper::appdata($storeinfo->id)->product_ratting_switch == 1 && $item->ratings_average > 0): ?>
                <div style="margin-top:4px;font-size:.75rem;display:flex;align-items:center;gap:3px;">
                    <i class="fa-solid fa-star" style="color:#f59e0b;"></i>
                    <span style="color:#666;"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="t16-card-footer">
            <div>
                
                <span class="t16-price">
                    <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                </span>
                <?php if($off > 0): ?>
                    <span class="t16-old-price">
                        <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                    </span>
                    <span class="t16-off-badge">-<?php echo e($off); ?>%</span>
                <?php endif; ?>

                
                <?php if($isOut): ?>
                    <div class="t16-out-stock mt-1">
                        <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                        <?php echo e(trans('labels.out_of_stock')); ?>

                    </div>
                <?php elseif($stockMgmt == 1): ?>
                    <div class="t16-in-stock mt-1">
                        <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                        <?php echo e(trans('labels.in_stock')); ?>

                    </div>
                <?php endif; ?>
            </div>

            
            <?php if($onlineOrder == 1 && !$isOut): ?>

                
                <input type="hidden" id="<?php echo e($uid); ?>_cartid"  value="<?php echo e($cartId); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_price"   value="<?php echo e($price); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_tax"     value="<?php echo e($item->tax); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_image"   value="<?php echo e(@$item['product_image']->image); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_name"    value="<?php echo e(addslashes($item->item_name)); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_stock"   value="<?php echo e($stockMgmt); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_min"     value="<?php echo e($item->min_order ?? 0); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_max"     value="<?php echo e($item->max_order ?? 0); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_vendor"  value="<?php echo e($storeinfo->id); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_slug"    value="<?php echo e($item->slug); ?>">
                <input type="hidden" id="<?php echo e($uid); ?>_qty"     value="<?php echo e($cartQty); ?>">

                <?php if($item->has_variants == 1): ?>
                    
                    <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$item->slug)); ?>"
                       class="t16-add-btn" style="display:flex;text-decoration:none;">
                        <i class="fa-regular fa-sliders" style="font-size:12px;"></i>
                        <?php echo e(trans('labels.view') ?? 'الخيارات'); ?>

                    </a>
                <?php else: ?>
                
                <button class="t16-add-btn"
                        id="<?php echo e($uid); ?>_addbtn"
                        style="<?php echo e($cartQty > 0 ? 'display:none;' : 'display:flex;'); ?>"
                        onclick="t16AddFirst('<?php echo e($item->id); ?>')">
                    <i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>
                    <?php echo e(trans('labels.add') ?? 'إضافة'); ?>

                </button>

                
                <div class="t16-qty"
                     id="<?php echo e($uid); ?>_stepper"
                     style="<?php echo e($cartQty > 0 ? 'display:flex;' : 'display:none;'); ?>">
                    <button class="t16-qty-btn minus"
                            onclick="t16Decrement('<?php echo e($item->id); ?>')">−</button>
                    <span class="t16-qty-num"
                          id="<?php echo e($uid); ?>_qtynum"><?php echo e(max(1, $cartQty)); ?></span>
                    <button class="t16-qty-btn plus"
                            onclick="t16Increment('<?php echo e($item->id); ?>')">⁺</button>
                </div>
                <?php endif; ?>

            <?php elseif($onlineOrder == 1 && $isOut): ?>
                <button class="t16-add-btn" style="opacity:.45;cursor:not-allowed;" disabled>
                    <i class="fa-regular fa-ban" style="font-size:12px;"></i>
                    <?php echo e(trans('labels.out_of_stock')); ?>

                </button>
            <?php else: ?>
                
                <button class="t16-add-btn"
                        id="iconverifybtn_t16_<?php echo e($item->id); ?>"
                        onclick="GetProductOverview('<?php echo e($item->slug); ?>', 'iconverifybtn_t16_<?php echo e($item->id); ?>')">
                    <i class="fa-regular fa-eye" style="font-size:12px;"></i>
                    <?php echo e(trans('labels.view') ?? 'عرض'); ?>

                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-16/_product_card.blade.php ENDPATH**/ ?>