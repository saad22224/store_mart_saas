<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $price = $getitem->item_price ?? 0;
    $original_price = $getitem->item_original_price ?? 0;
    if ($getitem->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
        $top = helper::top_deals($storeinfo->id);
        $base = $getitem['variation']->count() > 0 ? $getitem['variation'][0]->price : $getitem->item_price;
        $original_price = $base;
        if ($top->offer_type == 1) {
            $price = $base > $top->offer_amount ? $base - $top->offer_amount : $base;
        } else {
            $price = $base - $base * ($top->offer_amount / 100);
        }
    } elseif ($getitem['variation']->count() > 0) {
        $price = $getitem['variation'][0]->price;
        $original_price = $getitem['variation'][0]->original_price;
    }
    $off = $original_price > $price && $original_price > 0 ? round((($original_price - $price) / $original_price) * 100) : 0;

    $gallery = collect();
    if (count($getitem['multi_image']) > 0) {
        $gallery = $getitem['multi_image'];
    } else {
        $fallbackImg = $getitem['product_image']?->image ?? ($getitem->image_name ?? ($getitem->image ?? null));
        if (! empty($fallbackImg) && $fallbackImg !== 'default.png') {
            $gallery = collect([(object) ['image' => $fallbackImg]]);
        }
    }
    $detailImgFile = $getitem['product_image']?->image ?? ($getitem->image_name ?? null);
    $t16Rtl = session()->get('direction') == 2;
?>

<style>
.t16-detail { max-width: 1100px; margin: 0 auto; padding: 20px 16px 56px; }
.t16-detail-grid {
    display: grid; grid-template-columns: 1.05fr .95fr; gap: 28px; align-items: start;
}
.t16-detail-media {
    background: #fff; border-radius: 22px; overflow: hidden;
    border: 1px solid var(--t16-line); box-shadow: var(--t16-shadow);
}
.t16-detail-main-img { aspect-ratio: 1; background: #efe8e1; }
.t16-detail-main-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.t16-detail-thumbs { display: flex; gap: 8px; padding: 12px; overflow-x: auto; }
.t16-detail-thumbs button {
    width: 64px; height: 64px; border-radius: 12px; border: 2px solid transparent;
    padding: 0; overflow: hidden; background: #f3ebe3; cursor: pointer; flex-shrink: 0;
}
.t16-detail-thumbs button.is-active { border-color: var(--t16-primary); }
.t16-detail-thumbs img { width: 100%; height: 100%; object-fit: cover; }
.t16-detail-panel h1 {
    font-size: clamp(1.35rem, 2.6vw, 1.85rem); font-weight: 800;
    letter-spacing: -.03em; margin: 0 0 10px; line-height: 1.3;
}
.t16-detail-prices { display: flex; align-items: baseline; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
.t16-detail-prices .now { font-size: 1.45rem; font-weight: 800; color: var(--t16-primary); }
.t16-detail-prices .was { font-size: .95rem; color: #9a9088; text-decoration: line-through; }
.t16-detail-desc {
    background: #fff; border: 1px solid var(--t16-line); border-radius: 16px;
    padding: 14px 16px; margin-bottom: 16px; color: var(--t16-muted); line-height: 1.7; font-size: .95rem;
}
.t16-detail-label { font-weight: 800; color: var(--t16-ink); margin: 14px 0 8px; font-size: .92rem; }
.t16-detail-actions {
    display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-top: 18px;
}
.t16-detail-actions .qty-input2 {
    display: inline-flex; align-items: center; height: 46px; border-radius: 999px;
    border: 1px solid var(--t16-line); background: #fff; overflow: hidden;
}
.t16-detail-actions .qty-input2 button {
    width: 42px; height: 46px; border: 0; background: transparent; color: var(--t16-ink);
}
.t16-detail-actions .qty-input2 input {
    width: 42px; border: 0; text-align: center; font-weight: 800; background: transparent;
}
.t16-detail-actions .btn-store,
.t16-detail-actions .btn-store-outline {
    height: 46px; border-radius: 999px; padding: 0 22px; font-weight: 800;
    display: inline-flex; align-items: center; justify-content: center;
}
.t16-detail-actions .btn-store {
    background: var(--t16-primary) !important; border-color: var(--t16-primary) !important; color: #fff !important;
}
.t16-related { margin-top: 36px; }
.t16-related h2 { font-size: 1.3rem; font-weight: 800; margin-bottom: 14px; }
@media (max-width: 900px) {
    .t16-detail-grid { grid-template-columns: 1fr; gap: 18px; }
    .t16-detail-actions { flex-direction: column; align-items: stretch; }
    .t16-detail-actions .qty-input2 { width: 100%; justify-content: space-between; }
    .t16-detail-actions .btn-store,
    .t16-detail-actions .btn-store-outline { width: 100%; }
}
</style>

<div class="t16-detail">
    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-link">
        <i class="fa-solid <?php echo e($t16Rtl ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
        <?php echo e(App::getLocale() == 'ar' ? 'العودة للقائمة' : 'Back to menu'); ?>

    </a>

    <?php if($item_check != null): ?>
        <div class="t16-detail-grid">
            <div class="t16-detail-media">
                <div class="t16-detail-main-img">
                    <?php if($gallery->count() > 0): ?>
                        <img id="t16MainImage" src="<?php echo e(helper::image_path($gallery->first()->image)); ?>" alt="<?php echo e($getitem->item_name); ?>">
                    <?php else: ?>
                        <img id="t16MainImage"
                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                            alt="<?php echo e($getitem->item_name); ?>">
                    <?php endif; ?>
                </div>
                <?php if($gallery->count() > 1): ?>
                    <div class="t16-detail-thumbs">
                        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="<?php echo e($idx === 0 ? 'is-active' : ''); ?>"
                                onclick="t16SwapImage(this, '<?php echo e(helper::image_path($image->image)); ?>')">
                                <img src="<?php echo e(helper::image_path($image->image)); ?>" alt="" loading="lazy">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="t16-detail-panel">
                <?php if($off > 0): ?>
                    <span class="t16-card-off" style="position:static;display:inline-block;margin-bottom:8px;">-<?php echo e($off); ?>%</span>
                <?php endif; ?>
                <h1 id="item_name"><?php echo e($getitem->item_name); ?></h1>

                <div class="t16-detail-prices product-detail-price">
                    <span class="now detail_item_price pricing"><?php echo e(helper::currency_formate($price, $storeinfo->id)); ?></span>
                    <?php if($original_price > $price): ?>
                        <span class="was detail_original_price"><?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?></span>
                    <?php endif; ?>
                </div>

                <?php if(! empty($getitem->description)): ?>
                    <div class="t16-detail-desc"><?php echo \Illuminate\Support\Str::of($getitem->description)->stripTags('<p><br><strong><b><em><i><ul><ol><li>'); ?></div>
                <?php endif; ?>

                <?php if($getitem->has_variants == 1 && is_array($getitem->variants_json)): ?>
                    <div class="product-variations-wrapper" id="detail_variation">
                        <?php for($i = 0; $i < count($getitem->variants_json); $i++): ?>
                            <div class="t16-detail-label"><?php echo e($getitem->variants_json[$i]['variant_name']); ?></div>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <?php for($t = 0; $t < count($getitem->variants_json[$i]['variant_options']); $t++): ?>
                                    <label class="checkbox-inline check<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?> <?php echo e($t == 0 ? 'active' : ''); ?>"
                                        id="check_<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                        for="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                        style="border:1px solid var(--t16-line);border-radius:999px;padding:7px 14px;font-weight:700;cursor:pointer;background:#fff;">
                                        <input type="checkbox" class="d-none" name="skills"
                                            <?php echo e($t == 0 ? 'checked' : ''); ?>

                                            value="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                            id="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
                                        <?php echo e($getitem->variants_json[$i]['variant_options'][$t]); ?>

                                    </label>
                                <?php endfor; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <?php if(count($getitem['extras']) > 0): ?>
                    <div id="extras">
                        <div class="t16-detail-label"><?php echo e(trans('labels.extras')); ?></div>
                        <div id="pricelist">
                            <?php $__currentLoopData = $getitem['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label style="display:flex;align-items:center;gap:8px;margin-bottom:8px;font-weight:600;">
                                    <input type="checkbox" name="addons[]" extras_name="<?php echo e($extras->name); ?>"
                                        class="Checkbox" value="<?php echo e($extras->id); ?>" price="<?php echo e($extras->price); ?>">
                                    <span><?php echo e($extras->name); ?> — <?php echo e(helper::currency_formate($extras->price, $getitem->vendor_id)); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                    <div class="t16-detail-actions" id="detail_plus_minus">
                        <div class="qty-input2">
                            <button type="button" class="change-qty-1" data-item_id="<?php echo e($getitem->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'minus')"><i class="fa fa-minus"></i></button>
                            <input type="number" class="item_qty_<?php echo e($getitem->id); ?>" name="number" value="1" readonly>
                            <button type="button" class="change-qty-1" data-item_id="<?php echo e($getitem->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'plus')"><i class="fa fa-plus"></i></button>
                        </div>
                        <button type="button"
                            class="btn btn-store addtocart <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                            onclick="AddtoCart('0')"><?php echo e(trans('labels.add_to_cart')); ?></button>
                        <?php if(@helper::checkaddons('customer_login') && helper::appdata($storeinfo->id)->checkout_login_required == 1 && helper::appdata($storeinfo->id)->is_checkout_login_required == 1): ?>
                            <button type="button"
                                class="btn btn-store-outline buynow <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                onclick="login()"><?php echo e(trans('labels.buy_now')); ?></button>
                        <?php else: ?>
                            <button type="button"
                                class="btn btn-store-outline buynow <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                onclick="AddtoCart('1')"><?php echo e(trans('labels.buy_now')); ?></button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <input type="hidden" name="vendor" id="overview_vendor" value="<?php echo e($getitem->vendor_id); ?>">
                <input type="hidden" name="item_id" id="overview_item_id" value="<?php echo e($getitem->id); ?>">
                <input type="hidden" name="item_name" id="overview_item_name" value="<?php echo e($getitem->item_name); ?>">
                <input type="hidden" name="item_image" id="overview_item_image" value="<?php echo e($detailImgFile); ?>">
                <input type="hidden" name="item_min_order" id="item_min_order" value="<?php echo e($getitem->min_order); ?>">
                <input type="hidden" name="item_max_order" id="item_max_order" value="<?php echo e($getitem->max_order); ?>">
                <input type="hidden" name="item_price" id="overview_item_price" value="<?php echo e($price); ?>">
                <input type="hidden" name="item_original_price" id="overview_item_original_price" value="<?php echo e($original_price); ?>">
                <input type="hidden" name="tax" id="tax_val" value="<?php echo e($getitem->tax); ?>">
                <input type="hidden" name="variants_name" id="variants_name">
                <input type="hidden" name="variants_id" id="variants_id" value="0">
                <input type="hidden" name="stock_management" id="stock_management" value="<?php echo e($getitem->stock_management); ?>">
                <input type="hidden" id="item_price" value="<?php echo e($price); ?>">
                <input type="hidden" id="item_orignal_price" value="<?php echo e($original_price); ?>">
            </div>
        </div>

        <?php if(isset($relateditem) && $relateditem->count() > 0): ?>
            <div class="t16-related">
                <h2><?php echo e(App::getLocale() == 'ar' ? 'قد يعجبك أيضاً' : 'You may also like'); ?></h2>
                <div class="t16-menu-grid">
                    <?php $__currentLoopData = $relateditem->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.template-16._product_card', [
                            'item' => $item,
                            'storeinfo' => $storeinfo,
                            'cartdata' => $cartdata ?? collect(),
                            'key' => $key,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(@helper::checkaddons('sticky_cart_bar')): ?>
            <?php echo $__env->make('front.view-cart-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php else: ?>
        <div class="t16-empty">
            <i class="fa-regular fa-face-meh"></i>
            <?php echo e(App::getLocale() == 'ar' ? 'المنتج غير متوفر' : 'Product unavailable'); ?>

        </div>
    <?php endif; ?>
</div>

<script>
function t16SwapImage(btn, src) {
    var main = document.getElementById('t16MainImage');
    if (main) main.src = src;
    document.querySelectorAll('.t16-detail-thumbs button').forEach(function (b) { b.classList.remove('is-active'); });
    btn.classList.add('is-active');
}
</script>
<?php echo $__env->make('front.template-16._cart_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/detail.blade.php ENDPATH**/ ?>