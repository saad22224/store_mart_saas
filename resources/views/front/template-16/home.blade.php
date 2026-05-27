@include('front.theme.header')

@php
    $primaryColor  = helper::appdata($storeinfo->id)->primary_color ?? '#9d4300';
    $allCategories = helper::getcategory($storeinfo->id);
    $storeName     = helper::appdata($storeinfo->id)->app_name ?? $storeinfo->name;
    $cartCount     = session('cart', 0);
@endphp

{{-- ═══════════════ SCOPED STYLES ═══════════════ --}}
<style>
    /* ── CSS variables ── */
    :root {
        --t16-primary:        {{ $primaryColor }};
        --t16-primary-light:  {{ $primaryColor }}22;
        --t16-surface:        #fcf9f8;
        --t16-bg:             #fcf9f8;
        --t16-on-surface:     #1c1b1b;
        --t16-muted:          #584237;
        --t16-border:         #e0c0b1;
        --t16-card:           #ffffff;
        --t16-radius:         0.75rem;
        --t16-shadow:         0 4px 12px rgba(49,48,48,.07);
        --t16-shadow-hover:   0 14px 36px rgba(49,48,48,.14);
    }

    /* ── Scrollbar hide ── */
    .t16-hide-scroll::-webkit-scrollbar { display:none; }
    .t16-hide-scroll { -ms-overflow-style:none; scrollbar-width:none; }

    /* ── Slider ── */
    .t16-slider-wrap {
        position:relative; overflow:hidden;
        border-radius:var(--t16-radius);
        background:#f0eded;
    }
    .t16-slider-wrap img.t16-slide-img {
        width:100%; height:280px; object-fit:cover;
        display:block;
    }
    @media(max-width:576px){
        .t16-slider-wrap img.t16-slide-img { height:180px; }
    }

    /* ── Sticky category tabs ── */
    .t16-tabs-bar {
        position:sticky; top:64px; z-index:40;
        background:rgba(252,249,248,.95);
        backdrop-filter:blur(10px);
        padding:14px 0;
    }
    .t16-tab-scroll {
        display:flex; gap:10px;
        overflow-x:auto;
        padding-bottom:4px;
    }
    .t16-tab-btn {
        white-space:nowrap;
        padding:8px 22px;
        border-radius:999px;
        border:1.5px solid var(--t16-border);
        background:#f6f3f2;
        color:var(--t16-muted);
        font-size:.85rem; font-weight:600;
        cursor:pointer;
        transition:.25s;
        flex-shrink:0;
    }
    .t16-tab-btn:hover,
    .t16-tab-btn.active {
        background:var(--t16-primary);
        color:#fff;
        border-color:var(--t16-primary);
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
        display:flex; gap:14px;
        padding:14px;
        box-shadow:var(--t16-shadow);
        transition:box-shadow .3s;
    }
    .t16-card:hover { box-shadow:var(--t16-shadow-hover); }

    .t16-card-img {
        width:110px; height:110px;
        border-radius:.5rem;
        overflow:hidden; flex-shrink:0;
        background:#f0eded;
    }
    .t16-card-img img {
        width:100%; height:100%; object-fit:cover;
        transition:transform .4s;
    }
    .t16-card:hover .t16-card-img img { transform:scale(1.07); }

    .t16-card-body { display:flex; flex-direction:column; justify-content:space-between; flex-grow:1; }

    .t16-card-name {
        font-size:.95rem; font-weight:600; color:var(--t16-on-surface);
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        margin-bottom:4px;
    }
    .t16-card-desc {
        font-size:.8rem; color:var(--t16-muted);
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .t16-card-footer { display:flex; align-items:center; justify-content:space-between; margin-top:10px; }

    .t16-price { font-size:1.05rem; font-weight:700; color:var(--t16-primary); }
    .t16-old-price { font-size:.8rem; color:#aaa; text-decoration:line-through; margin-right:4px; }

    /* Qty stepper */
    .t16-qty { display:flex; align-items:center; gap:6px; }
    .t16-qty-btn {
        width:30px; height:30px; border-radius:50%;
        border:1.5px solid var(--t16-border);
        background:#fff; color:var(--t16-muted);
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; transition:.2s; font-size:16px; line-height:1;
    }
    .t16-qty-btn.plus { background:var(--t16-primary); color:#fff; border-color:var(--t16-primary); }
    .t16-qty-btn:active { transform:scale(.9); }
    .t16-qty-num { width:22px; text-align:center; font-weight:700; font-size:.9rem; }

    /* Add to cart button (for items at qty=0) */
    .t16-add-btn {
        display:flex; align-items:center; gap:6px;
        background:var(--t16-primary); color:#fff;
        border:none; border-radius:999px;
        padding:7px 16px; font-size:.8rem; font-weight:600;
        cursor:pointer; transition:.25s;
    }
    .t16-add-btn:hover { opacity:.88; }
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
</style>

{{-- ═══════════════ HERO SLIDER ═══════════════ --}}
<div class="container-fluid px-3 px-md-4 mt-4" style="max-width:1280px;margin-left:auto;margin-right:auto;">
    <div class="t16-slider-wrap" id="t16HeroSlider">
        @if($sliders->count() > 0)
            @foreach($sliders as $si => $slider)
                @php
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
                @endphp
                <div class="t16-slide{{ $isActive ? ' active' : '' }}" data-slide="{{ $si }}"
                     style="position:{{ $isActive ? 'relative' : 'absolute' }};inset:0;opacity:{{ $isActive ? '1' : '0' }};transition:opacity .8s ease-in-out;{{ !$isActive ? 'z-index:0;' : 'z-index:10;' }}">
                    {!! $linkOpen !!}
                    <img class="t16-slide-img"
                         src="{{ helper::image_path($slider->banner_image) }}"
                         alt="{{ $storeName }}">
                    {!! $linkClose !!}
                </div>
            @endforeach

            {{-- Dots --}}
            @if($sliders->count() > 1)
                <div style="position:absolute;bottom:12px;left:50%;transform:translateX(-50%);z-index:30;display:flex;gap:8px;">
                    @foreach($sliders as $di => $dot)
                        <button onclick="t16GoSlide({{ $di }})" data-t16dot="{{ $di }}"
                                style="width:10px;height:10px;border-radius:50%;border:none;background:#fff;
                                       opacity:{{ $di===0?'1':'.45' }};cursor:pointer;transition:.3s;padding:0;"></button>
                    @endforeach
                </div>
                {{-- Arrows --}}
                <button onclick="t16MoveSlide(-1)"
                        style="position:absolute;left:10px;top:50%;transform:translateY(-50%);z-index:30;
                               width:36px;height:36px;border-radius:50%;border:none;
                               background:rgba(255,255,255,.25);backdrop-filter:blur(6px);
                               color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button onclick="t16MoveSlide(1)"
                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);z-index:30;
                               width:36px;height:36px;border-radius:50%;border:none;
                               background:rgba(255,255,255,.25);backdrop-filter:blur(6px);
                               color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @endif
        @else
            <img class="t16-slide-img"
                 src="{{ url(env('ASSETPATHURL').'admin-assets/images/about/defaultimages/banner-placeholder.png') }}"
                 alt="{{ $storeName }}">
        @endif
    </div>
</div>

{{-- ═══════════════ MENU SECTION: TABS + PRODUCTS ═══════════════ --}}
<section style="max-width:1280px;margin:0 auto;padding:0 16px;" class="mt-4">

    {{-- ── Sticky Tab Bar ── --}}
    @if($allCategories->count() > 0)
    <div class="t16-tabs-bar">
        <div class="t16-tab-scroll t16-hide-scroll">
            {{-- "All" tab --}}
            <button class="t16-tab-btn active"
                    data-t16tab="all"
                    onclick="t16SwitchTab('all',this)">
                {{ trans('labels.all') ?? 'الكل' }}
            </button>
            @foreach($allCategories as $cat)
                <button class="t16-tab-btn"
                        data-t16tab="cat-{{ $cat->id }}"
                        onclick="t16SwitchTab('cat-{{ $cat->id }}',this)">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── "All" Products Pane ── --}}
    <div class="t16-tab-pane active" id="t16-pane-all">
        @php
            $allItems = $getitem;
        @endphp
        @if($allItems->count() > 0)
            <div class="t16-product-grid">
                @foreach($allItems as $key => $item)
                    @include('front.template-16._product_card', ['item' => $item, 'key' => 'all'.$key])
                @endforeach
            </div>
        @else
            <div class="t16-empty">
                <i class="fa-regular fa-face-sad-tear d-block"></i>
                {{ trans('labels.no_product_found') == 'labels.no_product_found' ? 'لا توجد منتجات' : trans('labels.no_product_found') }}
            </div>
        @endif
    </div>

    {{-- ── Per-Category Panes ── --}}
    @foreach($allCategories as $cat)
        @php
            $catItems = $getitem->filter(function($item) use ($cat) {
                $cats = array_map('trim', explode('|', str_replace(',','|',$item->cat_id)));
                return in_array((string)$cat->id, $cats);
            });
        @endphp
        <div class="t16-tab-pane" id="t16-pane-cat-{{ $cat->id }}">
            @if($catItems->count() > 0)
                <div class="t16-product-grid">
                    @foreach($catItems as $key => $item)
                        @include('front.template-16._product_card', ['item' => $item, 'key' => 'c'.$cat->id.'k'.$key])
                    @endforeach
                </div>
            @else
                <div class="t16-empty">
                    <i class="fa-regular fa-face-sad-tear d-block"></i>
                    {{ trans('labels.no_product_found') ?? 'لا توجد منتجات' }}
                </div>
            @endif
        </div>
    @endforeach

</section>

{{-- ═══════════════ JAVASCRIPT ═══════════════ --}}
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

    function auto() { timer = setInterval(function(){ show((current+1) % slides.length); }, 5000); }
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
        url:      '{{ URL::to("/add-to-cart") }}',
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
                toastr.success('{{ trans("messages.add_to_cart_msg") }}');
            } else {
                toastr.error(res.message);
            }
            $('#' + uid + '_addbtn').prop('disabled', false)
                .html('<i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>&nbsp;{{ trans("labels.add") ?? "إضافة" }}');
        },
        error: function() {
            toastr.error(wrong);
            $('#' + uid + '_addbtn').prop('disabled', false)
                .html('<i class="fa-regular fa-cart-shopping" style="font-size:12px;"></i>&nbsp;{{ trans("labels.add") ?? "إضافة" }}');
        }
    });
}

/* ── POST /{slug}/qtyupdate ── */
function t16DoUpdate(itemId, uid, d, newQty) {
    $.ajax({
        headers:  { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:      '{{ URL::to("/cart/qtyupdate") }}',
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
        url:      '{{ URL::to("/cart/deletecartitem") }}',
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

@include('front.theme.footer')