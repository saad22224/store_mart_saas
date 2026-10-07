
<?php
    $lineTotal = $cart->price ?? ($cart->item_price * $cart->qty);
    $detailSlug = $cart->slug ?? optional(helper::getmin_maxorder($cart->item_id, $storeinfo->id))->slug;
    $detailUrl = $detailSlug ? URL::to($storeinfo->slug . '/detail-' . $detailSlug) : '#';
?>
<div class="mp-cart-item" data-cart-id="<?php echo e($cart->id); ?>">
    <a href="<?php echo e($detailUrl); ?>" class="mp-cart-item-img">
        <img src="<?php echo e(helper::image_path($cart->item_image)); ?>" alt="<?php echo e($cart->item_name); ?>" loading="lazy">
    </a>
    <div class="mp-cart-item-body">
        <div class="mp-cart-item-top">
            <a href="<?php echo e($detailUrl); ?>" class="mp-cart-item-name"><?php echo e($cart->item_name); ?></a>
            <button type="button" class="mp-cart-remove" aria-label="<?php echo e(trans('labels.remove')); ?>"
                onclick="RemoveCart('<?php echo e($cart->id); ?>','<?php echo e($storeinfo->id); ?>')">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
        <?php if(!empty($cart->variants_name) || !empty($cart->extras_name) || !empty($cart->color_choice)): ?>
            <div class="mp-cart-item-meta">
                <?php if(!empty($cart->variants_name)): ?>
                    <span><?php echo e($cart->variants_name); ?></span>
                <?php endif; ?>
                <?php if(!empty($cart->color_choice)): ?>
                    <span><?php echo e(trans('labels.colors') ?? 'اللون'); ?>: <?php echo e($cart->color_choice); ?></span>
                <?php endif; ?>
                <?php if(!empty($cart->extras_name)): ?>
                    <span><?php echo e($cart->extras_name); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="mp-cart-item-bottom">
            <div class="mp-qty">
                <button type="button" class="mp-qty-btn"
                    onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','decreaseValue')">
                    <i class="fa fa-minus"></i>
                </button>
                <input type="text" id="number_<?php echo e($cart->id); ?>" value="<?php echo e($cart->qty); ?>" readonly>
                <button type="button" class="mp-qty-btn"
                    onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','increase')">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="mp-cart-item-price">
                <span class="mp-price-now"><?php echo e(helper::currency_formate($lineTotal, $storeinfo->id, $cart->currency ?? null)); ?></span>
                <?php if(($cart->qty ?? 1) > 1): ?>
                    <small><?php echo e(helper::currency_formate($cart->item_price, $storeinfo->id, $cart->currency ?? null)); ?> × <?php echo e($cart->qty); ?></small>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\cart_item.blade.php ENDPATH**/ ?>