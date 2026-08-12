<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $primaryColor  = helper::appdata($storeinfo->id)->primary_color ?? '#9d4300';
    $storeName     = helper::appdata($storeinfo->id)->app_name ?? $storeinfo->name;
    $onlineOrder   = helper::appdata($storeinfo->id)->online_order;
    $cartdata      = session()->has('cart') ? session('cart') : collect();
    if (!($cartdata instanceof \Illuminate\Support\Collection)) {
        $cartdata = collect($cartdata);
    }
?>

<style>
    :root {
        --t16-primary:        <?php echo e($primaryColor); ?>;
        --t16-primary-light:  <?php echo e($primaryColor); ?>15;
        --t16-primary-gradient: linear-gradient(135deg, <?php echo e($primaryColor); ?> 0%, <?php echo e($primaryColor); ?>dd 100%);
        --t16-surface:        #fcf9f8;
        --t16-bg:             linear-gradient(180deg, #faf8f6 0%, #f5f2ef 100%);
        --t16-on-surface:     #1c1b1b;
        --t16-muted:          #584237;
        --t16-border:         #e0c0b1;
        --t16-card:           #ffffff;
        --t16-radius:         1.25rem;
        --t16-shadow:         0 8px 24px rgba(49,48,48,.08);
        --t16-shadow-hover:   0 20px 48px rgba(49,48,48,.16);
        --t16-accent:         #ff6b35;
    }

    body {
        background: var(--t16-bg);
    }

    /* ── Search Bar ── */
    .t16-search-bar {
        max-width: 1280px;
        margin: 0 auto;
        padding: 16px;
    }
    .t16-search-input {
        width: 100%;
        padding: 14px 20px 14px 48px;
        border: 1px solid rgba(0,0,0,.08);
        border-radius: 999px;
        font-size: 1rem;
        background: #fff;
        color: var(--t16-on-surface);
        outline: none;
        box-shadow: 0 4px 16px rgba(0,0,0,.04);
        transition: all .3s ease;
    }
    .t16-search-input:focus {
        border-color: var(--t16-primary);
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
    }
    .t16-search-input::placeholder {
        color: #aaa;
    }
    .t16-search-wrap {
        position: relative;
    }
    .t16-search-icon {
        position: absolute;
        top: 50%;
        <?php echo e(session()->get('direction') == 2 ? 'right: 18px;' : 'left: 18px;'); ?>

        transform: translateY(-50%);
        color: #aaa;
        font-size: 1rem;
        pointer-events: none;
    }

    /* ── Header bar (Back + Category name) ── */
    .t16-cat-header {
        max-width: 1280px;
        margin: 0 auto;
        padding: 8px 16px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .t16-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: var(--t16-on-surface);
        font-size: 1rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 12px;
        transition: all .3s ease;
        background: transparent;
    }
    .t16-back-btn:hover {
        background: rgba(0,0,0,.04);
        transform: translateX(-4px);
        color: var(--t16-on-surface);
        text-decoration: none;
    }
    .t16-back-btn i {
        font-size: .85rem;
        transition: transform .3s ease;
    }
    .t16-back-btn:hover i {
        transform: translateX(-3px);
    }
    .t16-cat-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--t16-primary);
        letter-spacing: -0.5px;
    }

    /* ── Product Grid (3-column Walashi style) ── */
    .t16-cat-grid {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 16px 40px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    @media(max-width: 991px) {
        .t16-cat-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    }
    @media(max-width: 576px) {
        .t16-cat-grid { grid-template-columns: 1fr; gap: 16px; }
        .t16-cat-name { font-size: 1.15rem; }
        .t16-cat-header { flex-wrap: wrap; gap: 8px; }
    }

    /* ── Product Card (image + badge + name) ── */
    .t16-item-card {
        background: var(--t16-card);
        border-radius: var(--t16-radius);
        overflow: hidden;
        box-shadow: var(--t16-shadow);
        transition: all .4s cubic-bezier(.4,0,.2,1);
        border: 1px solid rgba(0,0,0,.04);
        text-decoration: none;
        color: inherit;
        display: block;
        animation: t16CardIn .5s ease both;
    }
    .t16-item-card:hover {
        box-shadow: var(--t16-shadow-hover);
        transform: translateY(-6px);
        border-color: rgba(0,0,0,.08);
        text-decoration: none;
        color: inherit;
    }

    .t16-item-card-img {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #f0eded;
    }
    .t16-item-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s cubic-bezier(.4,0,.2,1);
    }
    .t16-item-card:hover .t16-item-card-img img {
        transform: scale(1.08);
    }
    .t16-item-badge {
        position: absolute;
        top: 12px;
        <?php echo e(session()->get('direction') == 2 ? 'left: 12px;' : 'right: 12px;'); ?>

        background: var(--t16-primary-gradient);
        color: #fff;
        font-size: .75rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 999px;
        box-shadow: 0 4px 12px rgba(0,0,0,.2);
        z-index: 2;
    }

    .t16-item-card-body {
        padding: 16px 18px 18px;
    }
    .t16-item-card-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--t16-on-surface);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .t16-item-card-price {
        margin-top: 8px;
        font-size: 1rem;
        font-weight: 700;
        color: var(--t16-primary);
    }
    .t16-item-card-old-price {
        font-size: .85rem;
        color: #aaa;
        text-decoration: line-through;
        margin-inline-start: 6px;
    }

    @keyframes t16CardIn {
        from { opacity: 0; transform: translateY(20px) scale(0.96); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── Empty & Pagination ── */
    .t16-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--t16-muted);
        font-size: .95rem;
        background: linear-gradient(135deg, rgba(255,255,255,.5) 0%, rgba(255,255,255,.8) 100%);
        border-radius: var(--t16-radius);
        border: 2px dashed var(--t16-border);
    }
    .t16-empty i {
        font-size: 3rem;
        margin-bottom: 12px;
        opacity: .4;
    }

    .t16-pagination {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 16px 40px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }
    .t16-pagination .page-item .page-link {
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,.06);
        color: var(--t16-muted);
        padding: 8px 14px;
        font-weight: 600;
        transition: all .3s ease;
    }
    .t16-pagination .page-item.active .page-link {
        background: var(--t16-primary-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 12px var(--t16-primary-light);
    }
    .t16-pagination .page-item .page-link:hover {
        background: rgba(0,0,0,.04);
        transform: translateY(-2px);
    }

    /* ── No results (search) ── */
    .t16-no-results {
        display: none;
        text-align: center;
        padding: 60px 20px;
        color: var(--t16-muted);
        font-size: .95rem;
        grid-column: 1 / -1;
    }

    /* ── Footer overrides ── */
    .footer-sec2 {
        background: linear-gradient(180deg, var(--t16-primary) 0%, color-mix(in srgb, var(--t16-primary) 85%, #000 15%) 100%) !important;
        border-top: none !important;
        box-shadow: 0 -10px 40px rgba(0,0,0,.12);
    }
    .copy-right-sec {
        background: color-mix(in srgb, var(--t16-primary) 80%, #000 20%) !important;
        border-top: 1px solid rgba(255,255,255,.12) !important;
    }
</style>


<div class="t16-search-bar">
    <div class="t16-search-wrap">
        <i class="fa-solid fa-magnifying-glass t16-search-icon"></i>
        <input type="text"
               class="t16-search-input"
               id="t16SearchInput"
               placeholder="<?php echo e(trans('labels.search') == 'labels.search' ? 'Search for categories, products...' : trans('labels.search')); ?>"
               autocomplete="off">
    </div>
</div>


<div class="t16-cat-header">
    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        <?php echo e(trans('labels.back') == 'labels.back' ? 'Back' : trans('labels.back')); ?>

    </a>
    <h1 class="t16-cat-name"><?php echo e($category->name); ?></h1>
</div>


<?php if($products->count() > 0): ?>
    <div class="t16-cat-grid" id="t16ProductsGrid">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $imgSrc = (@$product['product_image']->image)
                    ? helper::image_path($product['product_image']->image)
                    : url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/item-placeholder.png');

                if ($product['variation']->count() > 0) {
                    $price = $product['variation'][0]->price;
                    $original_price = $product['variation'][0]->original_price;
                } else {
                    $price = $product->item_price;
                    $original_price = $product->item_original_price;
                }
                $off = ($original_price > 0 && $original_price > $price)
                    ? number_format(100 - ($price * 100) / $original_price, 0)
                    : 0;
            ?>
            <a href="<?php echo e(URL::to($storeinfo->slug.'/detail-'.$product->slug)); ?>"
               class="t16-item-card"
               data-name="<?php echo e(strtolower($product->item_name)); ?>"
               style="animation-delay: <?php echo e(($index % 9) * 0.06); ?>s;">
                <div class="t16-item-card-img">
                    <span class="t16-item-badge"><?php echo e($category->name); ?></span>
                    <img src="<?php echo e($imgSrc); ?>"
                         alt="<?php echo e($product->item_name); ?>"
                         loading="lazy">
                </div>
                <div class="t16-item-card-body">
                    <div class="t16-item-card-name"><?php echo e($product->item_name); ?></div>
                    <div class="t16-item-card-price">
                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $product->currency)); ?>

                        <?php if($off > 0): ?>
                            <span class="t16-item-card-old-price">
                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $product->currency)); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <div class="t16-no-results" id="t16NoResults">
            <i class="fa-regular fa-face-sad-tear d-block" style="font-size:2.5rem;margin-bottom:10px;opacity:.4;"></i>
            <?php echo e(trans('labels.no_product_found') == 'labels.no_product_found' ? 'لا توجد منتجات مطابقة' : trans('labels.no_product_found')); ?>

        </div>
    </div>

    
    <?php if($products->hasPages()): ?>
        <div class="t16-pagination">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>
<?php else: ?>
    <div style="max-width:1280px;margin:0 auto;padding:0 16px 40px;">
        <div class="t16-empty">
            <i class="fa-regular fa-face-sad-tear d-block"></i>
            <?php echo e(trans('labels.no_product_found') == 'labels.no_product_found' ? 'لا توجد منتجات' : trans('labels.no_product_found')); ?>

        </div>
    </div>
<?php endif; ?>


<script>
/* ─── Search filter ─── */
(function() {
    var input = document.getElementById('t16SearchInput');
    var grid  = document.getElementById('t16ProductsGrid');
    if (!input || !grid) return;

    var cards     = Array.from(grid.querySelectorAll('.t16-item-card'));
    var noResults = document.getElementById('t16NoResults');

    input.addEventListener('input', function() {
        var q = this.value.trim().toLowerCase();
        var found = 0;

        cards.forEach(function(card) {
            var name = card.getAttribute('data-name') || '';
            if (!q || name.indexOf(q) !== -1) {
                card.style.display = '';
                found++;
            } else {
                card.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.style.display = (found === 0 && q) ? 'block' : 'none';
        }
    });
})();
</script>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/category.blade.php ENDPATH**/ ?>