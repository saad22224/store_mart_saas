<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $price = $getitem->item_price;
    $original_price = $getitem->item_original_price;
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
    } elseif (!empty($getitem->image_name) || !empty($getitem->image)) {
        $gallery = collect([(object) ['image' => $getitem->image_name ?? $getitem->image]]);
    }
    $contentSections = $contentSections ?? collect();
    $hasVideoSection = $contentSections->where('section_type', 'video')->isNotEmpty();
    $productVideoUrl = $getitem->video_url ?? null;
?>

<style>
    .mp-detail { padding-bottom: 40px; }
    .mp-detail-hero {
        display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 32px;
        max-width: 1120px; margin: 0 auto; padding: 28px 16px 36px; direction: rtl;
    }
    .mp-gallery-main {
        background: #fff; border-radius: 16px; overflow: hidden;
        aspect-ratio: 1; position: relative; box-shadow: 0 2px 16px rgba(0,0,0,.05);
    }
    .mp-gallery-main img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .mp-thumbs { display: flex; gap: 8px; margin-top: 12px; overflow-x: auto; padding-bottom: 2px; }
    .mp-thumbs button {
        border: 1.5px solid transparent; border-radius: 10px; padding: 0; background: #fff;
        width: 60px; height: 60px; overflow: hidden; flex-shrink: 0; cursor: pointer;
    }
    .mp-thumbs button.is-active { border-color: #111; }
    .mp-thumbs img { width: 100%; height: 100%; object-fit: cover; }
    .mp-buy-panel { padding: 4px 4px 0; height: fit-content; }
    .mp-buy-panel h1 {
        font-size: clamp(1.25rem, 2.4vw, 1.55rem); font-weight: 700;
        margin: 0 0 12px; line-height: 1.45; color: #111;
    }
    .mp-off-badge {
        display: inline-block; background: #e53935; color: #fff;
        border-radius: 6px; padding: 2px 8px; font-size: 0.72rem; font-weight: 700; margin-bottom: 10px;
    }
    .mp-hero-prices { display: flex; align-items: baseline; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
    .mp-hero-prices .mp-price-now { font-size: 1.35rem; font-weight: 800; color: #e53935; }
    .mp-hero-prices .mp-price-was { font-size: 0.95rem; color: #999; text-decoration: line-through; }
    .mp-product-desc {
        margin: 0 0 18px; padding: 14px 16px; background: #f7f5f1;
        border-radius: 12px; border: 1px solid #ebe6de;
    }
    .mp-product-desc-label {
        font-size: 0.95rem; font-weight: 800; color: #111; margin: 0 0 8px;
    }
    .mp-short-desc { color: #555; line-height: 1.8; margin: 0; font-size: 0.9rem; }
    .mp-short-desc p { margin: 0 0 8px; }
    .mp-short-desc p:last-child { margin-bottom: 0; }
    .mp-rating { font-size: 0.88rem; font-weight: 600; color: #444; margin-bottom: 10px; }
    .mp-variant-label { font-size: 0.88rem; font-weight: 700; margin: 14px 0 8px; color: #222; }
    .mp-variant-opts { display: flex; flex-wrap: wrap; gap: 8px; }
    .mp-variant-opts label {
        border: 1px solid #d5d5d5; border-radius: 8px; padding: 7px 14px;
        font-size: 0.85rem; font-weight: 600; cursor: pointer; background: #fff; color: #222;
        transition: .15s;
    }
    .mp-variant-opts label.active,
    .mp-variant-opts label:has(input:checked) {
        border-color: #111; background: #111; color: #fff;
    }
    .mp-purchase-row {
        display: flex; align-items: center; gap: 10px; margin-top: 20px; flex-wrap: wrap;
    }
    .mp-qty-compact {
        display: inline-flex; align-items: center; border: 1px solid #ddd;
        border-radius: 10px; overflow: hidden; background: #fff; height: 42px;
    }
    .mp-qty-compact button {
        width: 36px; height: 42px; border: 0; background: transparent;
        color: #222; cursor: pointer; font-size: 0.8rem;
    }
    .mp-qty-compact input {
        width: 40px; border: 0; text-align: center; font-weight: 700;
        font-size: 0.95rem; background: transparent; color: #111;
    }
    .mp-btn {
        display: inline-flex; align-items: center; justify-content: center;
        height: 42px; padding: 0 20px; border-radius: 10px;
        font-size: 0.9rem; font-weight: 700; cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        text-decoration: none; border: 1px solid transparent;
        font-family: inherit; white-space: nowrap;
    }
    .mp-btn-cart {
        flex: 1; min-width: 140px; background: #111; color: #fff; border-color: #111;
    }
    .mp-btn-cart:hover { background: #000; color: #fff; }
    .mp-btn-buy {
        flex: 1; min-width: 120px; background: #fff; color: #111; border-color: #111;
    }
    .mp-btn-buy:hover { background: #f5f5f5; color: #111; }
    .mp-btn.disabled, .mp-btn:disabled { opacity: .45; pointer-events: none; }
    .mp-extras { margin-top: 14px; font-size: 0.88rem; }
    .mp-extras label { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: #333; }
    .mp-related { max-width: 1120px; margin: 0 auto; padding: 10px 16px 72px; }
    .mp-detail .mp-section { padding: 36px 0; }
    .mp-detail .mp-section-heading { font-size: 1.25rem; font-weight: 800; }
    .mp-detail .mp-btn-primary,
    .mp-detail .mp-cta-box .mp-btn-primary {
        height: 42px; padding: 0 22px; border-radius: 10px;
        font-size: 0.9rem; font-weight: 700; background: #111;
    }
    .mp-detail .mp-faq-item {
        border: 1px solid #e5e5e5; box-shadow: none; border-radius: 10px;
        background: #fff; margin-bottom: 10px;
    }
    .mp-detail .mp-faq-item summary { font-weight: 700; font-size: 0.95rem; }
    .mp-share {
        margin-top: 18px; padding-top: 16px; border-top: 1px solid #ececec;
    }
    .mp-share-label {
        font-size: 0.86rem; font-weight: 700; color: #444; margin: 0 0 10px;
    }
    .mp-share-actions {
        display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
    }
    .mp-share-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        height: 36px; padding: 0 12px; border-radius: 9px; border: 1px solid #e0e0e0;
        background: #fff; color: #222; font-size: 0.8rem; font-weight: 600;
        text-decoration: none; cursor: pointer; font-family: inherit;
        transition: background .15s, border-color .15s;
    }
    .mp-share-btn:hover { background: #f7f7f7; border-color: #ccc; color: #111; }
    .mp-share-btn i { font-size: 0.95rem; }
    .mp-share-btn.is-copied { border-color: #2e7d32; color: #2e7d32; background: #f1f8f2; }
    @media (max-width: 900px) {
        .mp-detail-hero { grid-template-columns: 1fr; gap: 20px; padding-top: 16px; }
        .mp-purchase-row { flex-direction: column; align-items: stretch; }
        .mp-qty-compact { width: 100%; justify-content: space-between; }
        .mp-btn-cart, .mp-btn-buy { width: 100%; }
    }
</style>

<main class="mp-detail mp-body">
    <?php if($item_check != null): ?>
        <div id="mpProductHero" class="mp-detail-hero">
            <div>
                <div class="mp-gallery-main">
                    <?php if($gallery->count() > 0): ?>
                        <img id="mpMainImage" src="<?php echo e(helper::image_path($gallery->first()->image)); ?>" alt="<?php echo e($getitem->item_name); ?>">
                    <?php else: ?>
                        <img id="mpMainImage"
                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                            alt="<?php echo e($getitem->item_name); ?>">
                    <?php endif; ?>
                </div>
                <?php if($gallery->count() > 1): ?>
                    <div class="mp-thumbs">
                        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="<?php echo e($idx === 0 ? 'is-active' : ''); ?>"
                                onclick="mpSwapImage(this, '<?php echo e(helper::image_path($image->image)); ?>')">
                                <img src="<?php echo e(helper::image_path($image->image)); ?>" alt="" loading="lazy">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mp-buy-panel">
                <?php if($off > 0): ?>
                    <span class="mp-off-badge">-<?php echo e($off); ?>%</span>
                <?php endif; ?>
                <h1 id="item_name"><?php echo e($getitem->item_name); ?></h1>

                <?php if(@helper::checkaddons('product_reviews') && helper::appdata($storeinfo->id)->product_ratting_switch == 1 && ($getitem->ratings_average ?? 0) > 0): ?>
                    <div class="mp-rating">
                        <i class="fa-solid fa-star" style="color:#f5b301;"></i>
                        <?php echo e(number_format($getitem->ratings_average, 1)); ?>

                    </div>
                <?php endif; ?>

                <div class="mp-hero-prices product-detail-price">
                    <span class="mp-price-now detail_item_price pricing"><?php echo e(helper::currency_formate($price, $storeinfo->id)); ?></span>
                    <?php if($original_price > $price): ?>
                        <span class="mp-price-was detail_original_price"><?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?></span>
                    <?php endif; ?>
                </div>

                <?php if(!empty($getitem->description)): ?>
                    <div class="mp-product-desc" id="mpProductDesc">
                        <div class="mp-product-desc-label"><?php echo e(trans('labels.description')); ?></div>
                        <div class="mp-short-desc mp-rich-body"><?php echo \Illuminate\Support\Str::of($getitem->description)->stripTags('<p><br><strong><b><em><i><ul><ol><li><h3><h4><a>'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if($getitem->has_variants == 1 && is_array($getitem->variants_json)): ?>
                    <div class="product-variations-wrapper" id="detail_variation">
                        <?php for($i = 0; $i < count($getitem->variants_json); $i++): ?>
                            <div class="mp-variant-label"><?php echo e($getitem->variants_json[$i]['variant_name']); ?></div>
                            <div class="mp-variant-opts d-flex flex-wrap gap-2 mb-2">
                                <?php for($t = 0; $t < count($getitem->variants_json[$i]['variant_options']); $t++): ?>
                                    <label class="checkbox-inline check<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?> <?php echo e($t == 0 ? 'active' : ''); ?>"
                                        id="check_<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                        for="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
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
                    <div class="mp-extras" id="extras">
                        <div class="mp-variant-label"><?php echo e(trans('labels.extras')); ?></div>
                        <div id="pricelist">
                            <?php $__currentLoopData = $getitem['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label>
                                    <input type="checkbox" name="addons[]" extras_name="<?php echo e($extras->name); ?>"
                                        class="Checkbox" value="<?php echo e($extras->id); ?>" price="<?php echo e($extras->price); ?>">
                                    <span><?php echo e($extras->name); ?> — <?php echo e(helper::currency_formate($extras->price, $getitem->vendor_id)); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                    <div class="mp-purchase-row" id="detail_plus_minus">
                        <div class="mp-qty-compact qty-input2">
                            <button type="button" class="change-qty-1" data-item_id="<?php echo e($getitem->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'minus')"><i class="fa fa-minus"></i></button>
                            <input type="number" class="item_qty_<?php echo e($getitem->id); ?>" name="number" value="1" readonly>
                            <button type="button" class="change-qty-1" data-item_id="<?php echo e($getitem->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'plus')"><i class="fa fa-plus"></i></button>
                        </div>
                        <button type="button"
                            class="mp-btn mp-btn-cart addtocart <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                            onclick="AddtoCart('0')"><?php echo e(trans('labels.add_to_cart')); ?></button>
                        <?php if(@helper::checkaddons('customer_login') && helper::appdata($storeinfo->id)->checkout_login_required == 1 && helper::appdata($storeinfo->id)->is_checkout_login_required == 1): ?>
                            <button type="button"
                                class="mp-btn mp-btn-buy buynow <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                onclick="login()"><?php echo e(trans('labels.buy_now')); ?></button>
                        <?php else: ?>
                            <button type="button"
                                class="mp-btn mp-btn-buy buynow <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                onclick="AddtoCart('1')"><?php echo e(trans('labels.buy_now')); ?></button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php
                    $mpShareUrl = url()->current();
                    $mpShareTitle = $getitem->item_name;
                    $mpShareText = $mpShareTitle . ' ' . $mpShareUrl;
                ?>
                <div class="mp-share" id="mpProductShare"
                    data-url="<?php echo e($mpShareUrl); ?>"
                    data-title="<?php echo e(e($mpShareTitle)); ?>"
                    data-text="<?php echo e(e($mpShareText)); ?>">
                    <p class="mp-share-label">مشاركة المنتج</p>
                    <div class="mp-share-actions">
                        <button type="button" class="mp-share-btn" id="mpNativeShare" hidden>
                            <i class="fa-light fa-share-nodes"></i> مشاركة
                        </button>
                        <a class="mp-share-btn" target="_blank" rel="noopener"
                            href="https://wa.me/?text=<?php echo e(rawurlencode($mpShareText)); ?>">
                            <i class="fa-brands fa-whatsapp"></i> واتساب
                        </a>
                        <a class="mp-share-btn" target="_blank" rel="noopener"
                            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(rawurlencode($mpShareUrl)); ?>">
                            <i class="fa-brands fa-facebook-f"></i> فيسبوك
                        </a>
                        <a class="mp-share-btn" target="_blank" rel="noopener"
                            href="https://twitter.com/intent/tweet?text=<?php echo e(rawurlencode($mpShareTitle)); ?>&url=<?php echo e(rawurlencode($mpShareUrl)); ?>">
                            <i class="fa-brands fa-x-twitter"></i> X
                        </a>
                        <a class="mp-share-btn" target="_blank" rel="noopener"
                            href="https://t.me/share/url?url=<?php echo e(rawurlencode($mpShareUrl)); ?>&text=<?php echo e(rawurlencode($mpShareTitle)); ?>">
                            <i class="fa-brands fa-telegram"></i> تيليجرام
                        </a>
                        <button type="button" class="mp-share-btn" id="mpCopyLink">
                            <i class="fa-light fa-link"></i> <span>نسخ الرابط</span>
                        </button>
                    </div>
                </div>

                
                <input type="hidden" name="vendor" id="overview_vendor" value="<?php echo e($getitem->vendor_id); ?>">
                <input type="hidden" name="item_id" id="overview_item_id" value="<?php echo e($getitem->id); ?>">
                <input type="hidden" name="item_name" id="overview_item_name" value="<?php echo e($getitem->item_name); ?>">
                <input type="hidden" name="item_image" id="overview_item_image" value="<?php echo e(@$getitem['product_image']->image); ?>">
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

        <?php $__currentLoopData = $contentSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $view = 'front.template-22.partials.sections.' . $section->section_type; ?>
            <?php if(view()->exists($view)): ?>
                <?php echo $__env->make($view, ['section' => $section, 'storeinfo' => $storeinfo, 'getitem' => $getitem], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('front.template-22.partials.sections.generic', ['section' => $section], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if(! $hasVideoSection && ! empty($productVideoUrl)): ?>
            <?php echo $__env->make('front.template-22.partials.sections.video', [
                'section' => (object) [
                    'title' => 'فيديو المنتج',
                    'body' => null,
                    'media' => ['url' => $productVideoUrl],
                    'meta' => ['url' => $productVideoUrl],
                ],
                'storeinfo' => $storeinfo,
                'getitem' => $getitem,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(isset($relateditem) && $relateditem->count() > 0): ?>
            <div class="mp-related">
                <div class="mp-sec-head">
                    <h2><?php echo e(trans('labels.related_products') ?? 'منتجات مشابهة'); ?></h2>
                </div>
                <div class="mp-grid">
                    <?php $__currentLoopData = $relateditem->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('front.template-22.partials.sticky_buy_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <div class="mp-empty"><p><?php echo e(trans('messages.wrong') ?? 'المنتج غير متوفر'); ?></p></div>
    <?php endif; ?>
</main>

<script>
    function mpSwapImage(btn, src) {
        var main = document.getElementById('mpMainImage');
        if (main) main.src = src;
        document.querySelectorAll('.mp-thumbs button').forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
    }

    (function () {
        var box = document.getElementById('mpProductShare');
        if (!box) return;
        var url = box.getAttribute('data-url') || window.location.href;
        var title = box.getAttribute('data-title') || document.title;
        var text = box.getAttribute('data-text') || (title + ' ' + url);

        var nativeBtn = document.getElementById('mpNativeShare');
        if (nativeBtn && navigator.share) {
            nativeBtn.hidden = false;
            nativeBtn.addEventListener('click', function () {
                navigator.share({ title: title, text: title, url: url }).catch(function () {});
            });
        }

        var copyBtn = document.getElementById('mpCopyLink');
        if (copyBtn) {
            copyBtn.addEventListener('click', function () {
                var label = copyBtn.querySelector('span');
                var done = function () {
                    copyBtn.classList.add('is-copied');
                    if (label) label.textContent = 'تم النسخ';
                    if (typeof toastr !== 'undefined') toastr.success('تم نسخ رابط المنتج');
                    setTimeout(function () {
                        copyBtn.classList.remove('is-copied');
                        if (label) label.textContent = 'نسخ الرابط';
                    }, 1800);
                };
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(done).catch(function () {
                        var tmp = document.createElement('input');
                        tmp.value = url;
                        document.body.appendChild(tmp);
                        tmp.select();
                        document.execCommand('copy');
                        document.body.removeChild(tmp);
                        done();
                    });
                } else {
                    var tmp = document.createElement('input');
                    tmp.value = url;
                    document.body.appendChild(tmp);
                    tmp.select();
                    document.execCommand('copy');
                    document.body.removeChild(tmp);
                    done();
                }
            });
        }
    })();
</script>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/detail.blade.php ENDPATH**/ ?>