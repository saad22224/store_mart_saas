<?php
    $lineTotal = $cart->price ?? ($cart->item_price * $cart->qty);
    $detailSlug = $cart->slug ?? optional(helper::getmin_maxorder($cart->item_id, $storeinfo->id))->slug;
    $detailUrl = $detailSlug ? URL::to($storeinfo->slug.'/detail-'.$detailSlug) : '#';
    $imgSrc = (! empty($cart->item_image) && $cart->item_image !== 'default.png')
        ? helper::image_path($cart->item_image)
        : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');
?>
<div class="t16-cart-item" data-cart-id="<?php echo e($cart->id); ?>" data-unit-price="<?php echo e($cart->item_price); ?>">
    <a href="<?php echo e($detailUrl); ?>" class="t16-cart-item-img">
        <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($cart->item_name); ?>" loading="lazy">
    </a>
    <div class="t16-cart-item-body">
        <div class="t16-cart-item-top">
            <a href="<?php echo e($detailUrl); ?>" class="t16-cart-item-name"><?php echo e($cart->item_name); ?></a>
            <button type="button" class="t16-cart-remove" aria-label="<?php echo e(trans('labels.remove')); ?>"
                onclick="RemoveCart('<?php echo e($cart->id); ?>','<?php echo e($storeinfo->id); ?>')">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
        <?php if(! empty($cart->variants_name) || ! empty($cart->extras_name)): ?>
            <div class="t16-cart-item-meta">
                <?php if(! empty($cart->variants_name)): ?>
                    <span><?php echo e($cart->variants_name); ?></span>
                <?php endif; ?>
                <?php if(! empty($cart->extras_name)): ?>
                    <span><?php echo e($cart->extras_name); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="t16-cart-item-price">
            <span data-t16-line-price><?php echo e(helper::currency_formate($lineTotal, $storeinfo->id, $cart->currency ?? null)); ?></span>
        </div>
        <div class="t16-cart-item-qty">
            <button type="button" class="t16-cart-qty-btn change-qty"
                onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','decreaseValue')">
                <i class="fa fa-minus"></i>
            </button>
            <input type="text" id="number_<?php echo e($cart->id); ?>" value="<?php echo e($cart->qty); ?>" readonly>
            <button type="button" class="t16-cart-qty-btn change-qty"
                onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','increase')">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/partials/cart_item.blade.php ENDPATH**/ ?>