<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $primaryColor  = helper::appdata($storeinfo->id)->primary_color ?? '#9d4300';
    $allCategories = helper::getcategory($storeinfo->id);
    $storeName     = helper::appdata($storeinfo->id)->app_name ?? $storeinfo->name;
    $cartCount     = session('cart', 0);
?>


<style>
    /* ── CSS variables ── */
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

    /* ── Scrollbar hide ── */
    .t16-hide-scroll::-webkit-scrollbar { display:none; }
    .t16-hide-scroll { -ms-overflow-style:none; scrollbar-width:none; }

    /* ── Slider ── */
    .t16-slider-wrap {
        position:relative; overflow:hidden;
        border-radius:var(--t16-radius);
        background:#f0eded;
        box-shadow:0 12px 40px rgba(0,0,0,.12);
    }
    .t16-slider-wrap::before {
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(180deg,transparent 0%,rgba(0,0,0,.4) 100%);
        z-index:5;
        pointer-events:none;
    }
    .t16-slider-wrap img.t16-slide-img {
        width:100%; height:350px; object-fit:cover;
        display:block;
        transition:transform .6s ease;
    }
    .t16-slider-wrap:hover img.t16-slide-img {
        transform:scale(1.05);
    }
    @media(max-width:576px){
        .t16-slider-wrap img.t16-slide-img { height:220px; }
    }

    /* ── Slider arrows hover effect ── */
    .t16-slider-arrow:hover {
        background:rgba(255,255,255,.5) !important;
        transform:translateY(-50%) scale(1.1) !important;
    }

    /* ── Sticky category tabs ── */
    .t16-tabs-bar {
        position:sticky; top:64px; z-index:40;
        background:rgba(255,255,255,.95);
        backdrop-filter:blur(16px);
        padding:18px 0;
        box-shadow:0 4px 20px rgba(0,0,0,.04);
    }
    .t16-tab-scroll {
        display:flex; gap:12px;
        overflow-x:auto;
        padding-bottom:6px;
    }
    .t16-tab-btn {
        white-space:nowrap;
        padding:10px 24px;
        border-radius:999px;
        border:2px solid var(--t16-border);
        background:#f8f6f4;
        color:var(--t16-muted);
        font-size:.9rem; font-weight:600;
        cursor:pointer;
        transition:.3s cubic-bezier(.4,0,.2,1);
        flex-shrink:0;
        box-shadow:0 2px 8px rgba(0,0,0,.04);
    }
    .t16-tab-btn:hover {
        transform:translateY(-2px);
        box-shadow:0 6px 16px rgba(0,0,0,.08);
    }
    .t16-tab-btn.active {
        background:var(--t16-primary-gradient);
        color:#fff;
        border-color:transparent;
        transform:translateY(-2px);
        box-shadow:0 8px 20px rgba(0,0,0,.15);
    }

    /* ── Product grid ── */
    .t16-product-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:16px;
    }
    @media(max-width:480px){
        .t16-product-grid { grid-template-columns:1fr; }
    }

    /* ── Product card ── */
    .t16-card {
        background:var(--t16-card);
        border-radius:var(--t16-radius);
        overflow:hidden;
        display:flex; gap:16px;
        padding:16px;
        box-shadow:var(--t16-shadow);
        transition:all .4s cubic-bezier(.4,0,.2,1);
        border:1px solid rgba(0,0,0,.04);
    }
    .t16-card:hover {
        box-shadow:var(--t16-shadow-hover);
        transform:translateY(-4px);
        border-color:rgba(0,0,0,.08);
    }

    .t16-card-img {
        width:120px; height:120px;
        border-radius:1rem;
        overflow:hidden; flex-shrink:0;
        background:#f0eded;
        box-shadow:0 4px 12px rgba(0,0,0,.08);
    }
    .t16-card-img img {
        width:100%; height:100%; object-fit:cover;
        transition:transform .5s cubic-bezier(.4,0,.2,1);
    }
    .t16-card:hover .t16-card-img img { transform:scale(1.1); }

    .t16-card-body { display:flex; flex-direction:column; justify-content:space-between; flex-grow:1; }

    .t16-card-name {
        font-size:.95rem; font-weight:600; color:var(--t16-on-surface);
        display:-webkit-box; -webkit-line-clamp:2; line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        margin-bottom:4px;
    }
    .t16-card-desc {
        font-size:.8rem; color:var(--t16-muted);
        display:-webkit-box; -webkit-line-clamp:2; line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .t16-card-footer { display:flex; align-items:center; justify-content:space-between; margin-top:10px; }

    .t16-price { font-size:1.05rem; font-weight:700; color:var(--t16-primary); }
    .t16-old-price { font-size:.8rem; color:#aaa; text-decoration:line-through; margin-right:4px; }

    /* Qty stepper */
    .t16-qty { display:flex; align-items:center; gap:8px; }
    .t16-qty-btn {
        width:34px; height:34px; border-radius:50%;
        border:2px solid var(--t16-border);
        background:#fff; color:var(--t16-muted);
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; transition:.3s; font-size:18px; line-height:1;
        box-shadow:0 2px 8px rgba(0,0,0,.06);
    }
    .t16-qty-btn:hover { border-color:var(--t16-primary); color:var(--t16-primary); }
    .t16-qty-btn.plus { background:var(--t16-primary-gradient); color:#fff; border-color:transparent; box-shadow:0 4px 12px rgba(0,0,0,.15); }
    .t16-qty-btn:active { transform:scale(.9); }
    .t16-qty-num { width:28px; text-align:center; font-weight:700; font-size:1rem; color:var(--t16-on-surface); }

    /* Add to cart button (for items at qty=0) */
    .t16-add-btn {
        display:flex; align-items:center; gap:8px;
        background:var(--t16-primary-gradient); color:#fff;
        border:none; border-radius:999px;
        padding:10px 18px; font-size:.85rem; font-weight:600;
        cursor:pointer; transition:.3s;
        box-shadow:0 4px 12px rgba(0,0,0,.12);
    }
    .t16-add-btn:hover {
        transform:translateY(-2px);
        box-shadow:0 8px 20px rgba(0,0,0,.18);
    }
    .t16-add-btn:active { transform:scale(.95); }

    /* Off badge */
    .t16-off-badge {
        display:inline-block;
        background:var(--t16-primary); color:#fff;
        font-size:10px; font-weight:700;
        padding:2px 8px; border-radius:999px;
        margin-left:6px;
    }

    /* Stock badges */
    .t16-out-stock { color:#ba1a1a; font-size:.75rem; font-weight:600; }
    .t16-in-stock  { color:#006e2f; font-size:.75rem; font-weight:600; }

    /* ── Loading skeleton ── */
    .t16-skeleton {
        background:linear-gradient(90deg,#f0eded 25%,#e5e2e1 50%,#f0eded 75%);
        background-size:200% 100%;
        animation:t16Shimmer 1.2s infinite;
        border-radius:6px;
    }
    @keyframes t16Shimmer {
        0%   { background-position:200% 0; }
        100% { background-position:-200% 0; }
    }

    /* ── Empty state ── */
    .t16-empty {
        text-align:center; padding:40px 20px;
        color:var(--t16-muted); font-size:.9rem;
    }
    .t16-empty i { font-size:3rem; margin-bottom:12px; opacity:.4; }

    /* ── Tab content transition ── */
    .t16-tab-pane { display:none; }
    .t16-tab-pane.active {
        display:block;
        animation:t16FadeIn .35s ease both;
    }
    @keyframes t16FadeIn {
        from { opacity:0; transform:translateY(10px); }
        to   { opacity:1; transform:translateY(0); }
    }

    /* ── Footer override for template-16 ── */
    .footer-sec2 {
        background: linear-gradient(180deg, var(--t16-primary) 0%, color-mix(in srgb, var(--t16-primary) 85%, #000 15%) 100%) !important;
        border-top: none !important;
        box-shadow: 0 -10px 40px rgba(0,0,0,.12);
    }
    .copy-right-sec {
        background: color-mix(in srgb, var(--t16-primary) 80%, #000 20%) !important;
        border-top: 1px solid rgba(255,255,255,.12) !important;
    }
    .t7-footer-icon {
        background: rgba(255,255,255,.15) !important;
        border: 1px solid rgba(255,255,255,.2) !important;
    }
    .t7-footer-social a {
        background: rgba(255,255,255,.12) !important;
        border: 1px solid rgba(255,255,255,.25) !important;
        transition: .3s !important;
    }
    .t7-footer-social a:hover {
        background: rgba(255,255,255,.25) !important;
        transform: translateY(-2px) !important;
    }
    .t7-footer-menu a:hover {
        color: #fff !important;
        opacity: 1 !important;
        transform: translateX(-4px) !important;
    }
    .t7-footer-newsletter .input-group {
        border: 2px solid rgba(255,255,255,.25) !important;
        background: rgba(255,255,255,.1) !important;
    }
    .t7-footer-newsletter .btn-store {
        background: #fff !important;
        color: var(--t16-primary) !important;
        font-weight: 700 !important;
        transition: .3s !important;
    }
    .t7-footer-newsletter .btn-store:hover {
        transform: scale(1.02) !important;
        box-shadow: 0 6px 20px rgba(0,0,0,.2) !important;
    }

    /* ── Additional animations & effects ── */
    @keyframes t16Pulse {
        0%, 100% { box-shadow: 0 0 0 0 var(--t16-primary); opacity: .8; }
        50% { box-shadow: 0 0 0 10px var(--t16-primary); opacity: 0; }
    }
    @keyframes t16Float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    /* ── Category badge animation ── */
    .t16-off-badge {
        animation: t16Pulse 2s infinite;
    }

    /* ── Enhance empty state ── */
    .t16-empty {
        background: linear-gradient(135deg, rgba(255,255,255,.5) 0%, rgba(255,255,255,.8) 100%);
        border-radius: var(--t16-radius);
        border: 2px dashed var(--t16-border);
    }

    /* ── Header overlap fix ── */
    body {
        background: var(--t16-bg);
    }
</style>


<div class="container-fluid px-3 px-md-4 mt-4" style="max-width:1280px;margin-left:auto;margin-right:auto;">
    <div class="t16-slider-wrap" id="t16HeroSlider">
        <?php if($sliders->count() > 0): ?>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $si => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isActive = $si === 0;
                    $linkOpen  = '';
                    $linkClose = '';
                    if ($slider->product_id != 0 || $slider->category_id != 0) {
                        if ($slider->type == 1) {
                            $linkOpen  = '<a href="'.URL::to($storeinfo->slug.'/search?category='.@$slider->category_info->slug).'">';
                            $linkClose = '</a>';
                        } elseif ($slider->type == 2) {
                            $sItem     = helper::itemdetails($slider->product_id, $storeinfo->id);
                            $linkOpen  = '<a href="javascript:void(0)" onclick="GetProductOverview(\''.$sItem->slug.'\')">';
                            $linkClose = '</a>';
                        }
                    }
                ?>
                <div class="t16-slide<?php echo e($isActive ? ' active' : ''); ?>" data-slide="<?php echo e($si); ?>"
                     style="position:<?php echo e($isActive ? 'relative' : 'absolute'); ?>;inset:0;opacity:<?php echo e($isActive ? '1' : '0'); ?>;transition:opacity .8s ease-in-out;<?php echo e(!$isActive ? 'z-index:0;' : 'z-index:10;'); ?>">
                    <?php echo $linkOpen; ?>

                    <img class="t16-slide-img"
                         src="<?php echo e(helper::image_path($slider->banner_image)); ?>"
                         alt="<?php echo e($storeName); ?>">
                    <?php echo $linkClose; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($sliders->count() > 1): ?>
                <div style="position:absolute;bottom:20px;left:50%;transform:translateX(-50%);z-index:30;display:flex;gap:10px;padding:8px 16px;background:rgba(255,255,255,.2);backdrop-filter:blur(10px);border-radius:30px;">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $di => $dot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button onclick="t16GoSlide(<?php echo e($di); ?>)" data-t16dot="<?php echo e($di); ?>"
                                style="width:12px;height:12px;border-radius:50%;border:none;background:#fff;
                                       opacity:<?php echo e($di===0?'1':'.4'); ?>;cursor:pointer;transition:.3s;padding:0;box-shadow:0 2px 8px rgba(0,0,0,.1);"></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <button onclick="t16MoveSlide(-1)" class="t16-slider-arrow"
                        style="position:absolute;left:16px;top:50%;transform:translateY(-50%);z-index:30;
                               width:48px;height:48px;border-radius:50%;border:none;
                               background:rgba(255,255,255,.35);backdrop-filter:blur(12px);
                               color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;
                               transition:.3s;box-shadow:0 8px 24px rgba(0,0,0,.15);">
                    <i class="fa-solid fa-chevron-left" style="font-size:18px;"></i>
                </button>
                <button onclick="t16MoveSlide(1)" class="t16-slider-arrow"
                        style="position:absolute;right:16px;top:50%;transform:translateY(-50%);z-index:30;
                               width:48px;height:48px;border-radius:50%;border:none;
                               background:rgba(255,255,255,.35);backdrop-filter:blur(12px);
                               color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;
                               transition:.3s;box-shadow:0 8px 24px rgba(0,0,0,.15);">
                    <i class="fa-solid fa-chevron-right" style="font-size:18px;"></i>
                </button>
            <?php endif; ?>
        <?php else: ?>
            <img class="t16-slide-img"
                 src="<?php echo e(url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/banner-placeholder.png')); ?>"
                 alt="<?php echo e($storeName); ?>">
        <?php endif; ?>
    </div>
</div>


<section style="max-width:1280px;margin:0 auto;padding:0 16px;" class="mt-4">

    
    <?php if($allCategories->count() > 0): ?>
    <div class="t16-tabs-bar">
        <div class="t16-tab-scroll t16-hide-scroll">
            
            <button class="t16-tab-btn active"
                    data-t16tab="all"
                    onclick="t16SwitchTab('all',this)">
                <?php echo e(trans('labels.all') ?? 'الكل'); ?>

            </button>
            <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button class="t16-tab-btn"
                        data-t16tab="cat-<?php echo e($cat->id); ?>"
                        onclick="t16SwitchTab('cat-<?php echo e($cat->id); ?>',this)">
                    <?php echo e($cat->name); ?>

                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="t16-tab-pane active" id="t16-pane-all">
        <?php
            $allItems = $getitem;
        ?>
        <?php if($allItems->count() > 0): ?>
            <div class="t16-product-grid">
                <?php $__currentLoopData = $allItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.template-16._product_card', ['item' => $item, 'key' => 'all'.$key], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="t16-empty">
                <i class="fa-regular fa-face-sad-tear d-block"></i>
                <?php echo e(trans('labels.no_product_found') == 'labels.no_product_found' ? 'لا توجد منتجات' : trans('labels.no_product_found')); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $catItems = $getitem->filter(function($item) use ($cat) {
                $cats = array_map('trim', explode('|', str_replace(',','|',$item->cat_id)));
                return in_array((string)$cat->id, $cats);
            });
        ?>
        <div class="t16-tab-pane" id="t16-pane-cat-<?php echo e($cat->id); ?>">
            <?php if($catItems->count() > 0): ?>
                <div class="t16-product-grid">
                    <?php $__currentLoopData = $catItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('front.template-16._product_card', ['item' => $item, 'key' => 'c'.$cat->id.'k'.$key], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="t16-empty">
                    <i class="fa-regular fa-face-sad-tear d-block"></i>
                    <?php echo e(trans('labels.no_product_found') ?? 'لا توجد منتجات'); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</section>


<script>
/* ─── Slider ─── */
(function(){
    var slider  = document.getElementById('t16HeroSlider');
    if (!slider) return;
    var slides  = slider.querySelectorAll('.t16-slide');
    var dots    = slider.querySelectorAll('[data-t16dot]');
    var current = 0;
    var timer;

    function show(i) {
        slides.forEach(function(s, idx) {
            s.style.opacity   = idx === i ? '1'  : '0';
            s.style.position  = idx === i ? 'relative' : 'absolute';
            s.style.zIndex    = idx === i ? '10' : '0';
        });
        dots.forEach(function(d, idx) {
            d.style.opacity = idx === i ? '1' : '.45';
        });
        current = i;
    }

    window.t16MoveSlide = function(dir) {
        show((current + dir + slides.length) % slides.length);
        reset();
    };
    window.t16GoSlide = function(i) { show(i); reset(); };

    function auto() { timer = setInterval(function(){ show((current+1) % slides.length); }, 4000); }
    function reset(){ clearInterval(timer); auto(); }
    if (slides.length > 1) auto();
})();

/* ─── Category Tabs ─── */
window.t16SwitchTab = function(tabId, btn) {
    document.querySelectorAll('.t16-tab-btn').forEach(function(b){ b.classList.remove('active'); });
    btn.classList.add('active');
    document.querySelectorAll('.t16-tab-pane').forEach(function(p){ p.classList.remove('active'); });
    var pane = document.getElementById('t16-pane-' + tabId);
    if (pane) pane.classList.add('active');
};

/* ══════════════════════════════════════════════════════
   CART — jQuery + نفس API routes الموجودة في النظام
   ══════════════════════════════════════════════════════ */

/**
 * اقرأ بيانات المنتج من الـ hidden fields
 */
function t16Data(itemId) {
    var uid = 't16_' + itemId;
    return {
        cartId:   $('#' + uid + '_cartid').val()  || '',
        price:    $('#' + uid + '_price').val()   || 0,
        tax:      $('#' + uid + '_tax').val()     || '',
        image:    $('#' + uid + '_image').val()   || '',
        name:     $('#' + uid + '_name').val()    || '',
        stock:    $('#' + uid + '_stock').val()   || 0,
        min:      $('#' + uid + '_min').val()     || 0,
        max:      $('#' + uid + '_max').val()     || 0,
        vendor:   $('#' + uid + '_vendor').val()  || '',
    };
}

/* "+" زيادة الكمية أو أول إضافة */
window.t16Increment = function(itemId) {
    var d    = t16Data(itemId);
    var uid  = 't16_' + itemId;
    var curQ = parseInt($('#' + uid + '_qtynum').text()) || 0;
    if (curQ === 0) {
        t16DoAdd(itemId, uid, d, 1);
    } else {
        t16DoUpdate(itemId, uid, d, curQ + 1);
    }
};

/* "−" تقليل أو حذف */
window.t16Decrement = function(itemId) {
    var d    = t16Data(itemId);
    var uid  = 't16_' + itemId;
    var curQ = parseInt($('#' + uid + '_qtynum').text()) || 1;
    if (curQ <= 1) {
        t16DoRemove(itemId, uid, d);
    } else {
        t16DoUpdate(itemId, uid, d, curQ - 1);
    }
};

/* زرار "إضافة" الأول */
window.t16AddFirst = function(itemId) {
    var d   = t16Data(itemId);
    var uid = 't16_' + itemId;
    t16DoAdd(itemId, uid, d, 1);
};

/* ── POST /add-to-cart ── */
function t16DoAdd(itemId, uid, d, qty) {
    $('#' + uid + '_addbtn').prop('disabled', true)
        .html('<span class="loader"></span>');

    $.ajax({
        headers:  { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:      '<?php echo e(URL::to("/add-to-cart")); ?>',
        method:   'POST',
        dataType: 'json',
        data: {
            vendor_id:           d.vendor,
            item_id:             itemId,
            item_name:           d.name,
            item_image:          d.image,
            item_price:          d.price,
            item_original_price: d.price,
            tax:                 d.tax,
            qty:                 qty,
            min_order:           d.min,
            max_order:           d.max,
            stock_management:    d.stock,
            buynow:              0,
            variants_name:       '',
            extras_id:           '',
            extras_name:         '',
            extras_price:        '',
        },
        success: function(res) {
            if (res.status == 1) {
                /* تحديث badge عدد السلة */
                $('#cartcnt').text(res.cartcnt).removeClass('d-none');
                $('.cart-count').text(res.cartcnt);
                /* اظهر الـ stepper واخبي زر الإضافة */
                $('#' + uid + '_addbtn').hide();
                $('#' + uid + '_stepper').css('display', 'flex');
                $('#' + uid + '_qtynum').text(qty);
                toastr.success('<?php echo e(trans("messages.add_to_cart_msg")); ?>');
            } else {
                toastr.error(res.message);
            }
            $('#' + uid + '_addbtn').prop('disabled', false)
                .html('<i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>&nbsp;<?php echo e(trans("labels.add") ?? "إضافة"); ?>');
        },
        error: function() {
            toastr.error(wrong);
            $('#' + uid + '_addbtn').prop('disabled', false)
                .html('<i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>&nbsp;<?php echo e(trans("labels.add") ?? "إضافة"); ?>');
        }
    });
}

/* ── POST /{slug}/qtyupdate ── */
function t16DoUpdate(itemId, uid, d, newQty) {
    $.ajax({
        headers:  { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:      '<?php echo e(URL::to("/cart/qtyupdate")); ?>',
        method:   'POST',
        dataType: 'json',
        data: {
            vendor_id:        d.vendor,
            item_id:          itemId,
            cart_id:          d.cartId,
            qty:              newQty,
            price:            parseFloat(d.price) * newQty,
            stock_management: d.stock,
            variants_id:      null,
        },
        success: function(res) {
            if (res.status == 1) {
                $('#' + uid + '_qtynum').text(newQty);
            } else {
                toastr.error(res.message);
                /* رجّع القيمة اللي رجّعها السيرفر لو رفض */
                if (res.qty !== undefined) {
                    $('#' + uid + '_qtynum').text(res.qty);
                }
            }
        },
        error: function() { toastr.error(wrong); }
    });
}

/* ── POST /cart/deletecartitem ── */
function t16DoRemove(itemId, uid, d) {
    if (!d.cartId) {
        /* لو cart_id مش موجود — بس reset الـ UI */
        $('#' + uid + '_stepper').hide();
        $('#' + uid + '_addbtn').show();
        $('#' + uid + '_qtynum').text(1);
        return;
    }
    $.ajax({
        headers:  { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:      '<?php echo e(URL::to("/cart/deletecartitem")); ?>',
        method:   'POST',
        dataType: 'json',
        data: {
            cart_id:   d.cartId,
            vendor_id: d.vendor,
        },
        success: function(res) {
            if (res.status == 1) {
                /* تحديث badge */
                $('#cartcnt').text(res.cartcnt);
                $('.cart-count').text(res.cartcnt);
                /* أظهر زر الإضافة وأخبي الـ stepper */
                $('#' + uid + '_stepper').hide();
                $('#' + uid + '_addbtn').show();
                $('#' + uid + '_qtynum').text(1);
                $('#' + uid + '_cartid').val('');
            } else {
                toastr.error(wrong);
            }
        },
        error: function() { toastr.error(wrong); }
    });
}
</script>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-16/home.blade.php ENDPATH**/ ?>