<?php
    $stickyPrice = $price ?? $getitem->item_price;
    $stickyOriginal = $original_price ?? $getitem->item_original_price;
?>
<div class="mp-sticky-buy" id="mpStickyBuy" aria-hidden="false">
    <div class="mp-sticky-inner">
        <div class="mp-sticky-info">
            <p class="mp-sticky-title"><?php echo e($getitem->item_name); ?></p>
            <div class="mp-sticky-prices">
                <span class="mp-price-now" id="mpStickyPrice"><?php echo e(helper::currency_formate($stickyPrice, @$storeinfo->id)); ?></span>
                <?php if($stickyOriginal > $stickyPrice): ?>
                    <span class="mp-price-was" id="mpStickyOriginal"><?php echo e(helper::currency_formate($stickyOriginal, @$storeinfo->id)); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
            <button type="button"
                class="mp-btn mp-btn-cart mp-sticky-cta addtocart <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                onclick="AddtoCart('0')"
                <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>>
                <?php echo e(trans('labels.add_to_cart')); ?>

            </button>
        <?php endif; ?>
    </div>
</div>
<style>
    .mp-sticky-buy {
        position: fixed; bottom: 0; left: 0; right: 0; z-index: 1050;
        background: rgba(255,255,255,0.97); backdrop-filter: blur(10px);
        border-top: 1px solid #ececec;
        box-shadow: 0 -6px 24px rgba(0,0,0,0.06);
        padding: 10px 14px calc(10px + env(safe-area-inset-bottom));
        direction: rtl; transform: translateY(110%); transition: transform .28s ease;
    }
    .mp-sticky-buy.is-visible { transform: translateY(0); }
    .mp-sticky-inner {
        max-width: 720px; margin: 0 auto;
        display: flex; align-items: center; gap: 12px; justify-content: space-between;
    }
    .mp-sticky-title {
        margin: 0 0 2px; font-size: 0.82rem; font-weight: 700; color: #111;
        max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .mp-sticky-prices { display: flex; align-items: baseline; gap: 8px; }
    .mp-sticky-prices .mp-price-now { font-size: 0.95rem; font-weight: 800; color: #e53935; }
    .mp-sticky-prices .mp-price-was { font-size: 0.78rem; color: #999; text-decoration: line-through; }
    .mp-sticky-cta {
        flex-shrink: 0; min-width: 120px; height: 40px !important;
        padding: 0 16px !important; border-radius: 10px !important; font-size: 0.85rem !important;
    }
    @media (min-width: 992px) {
        .mp-sticky-buy { display: none !important; }
    }
</style>
<script>
(function () {
    var bar = document.getElementById('mpStickyBuy');
    var hero = document.getElementById('mpProductHero');
    if (!bar || !hero) return;
    function toggle() {
        var rect = hero.getBoundingClientRect();
        if (rect.bottom < 80) bar.classList.add('is-visible');
        else bar.classList.remove('is-visible');
    }
    window.addEventListener('scroll', toggle, { passive: true });
    toggle();
})();
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/sticky_buy_bar.blade.php ENDPATH**/ ?>