
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $mpCartCount = 0;
    if (isset($cartdata) && is_countable($cartdata)) {
        $mpCartCount = collect($cartdata)->filter(function ($c) {
            return ($c->buynow ?? 0) != 1;
        })->count();
    } else {
        $mpCountQ = \App\Models\Cart::where('vendor_id', @$storeinfo->id)->where('buynow', '!=', 1);
        if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->type == 3) {
            $mpCountQ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id);
        } else {
            $mpCountQ->where('session_id', \Illuminate\Support\Facades\Session::getId());
        }
        $mpCartCount = $mpCountQ->count();
    }
    $mpCategories = helper::getcategory(@$storeinfo->id);
    $mpContact = helper::appdata(@$storeinfo->id)->contact ?? null;
    $mpLogo = helper::appdata(@$storeinfo->id)->logo ?? null;
    $mpLogoUrl = null;
    if (!empty($mpLogo)) {
        $mpLogoCandidates = [
            'admin-assets/images/about/logo/' . $mpLogo,
            'admin-assets/images/about/defaultimages/' . $mpLogo,
        ];
        foreach ($mpLogoCandidates as $mpRel) {
            if (file_exists(storage_path('app/public/' . $mpRel))) {
                $mpLogoUrl = url(env('ASSETPATHURL') . $mpRel);
                break;
            }
        }
        if (!$mpLogoUrl) {
            $resolved = helper::image_path($mpLogo);
            if (!\Illuminate\Support\Str::contains($resolved, 'item-placeholder')) {
                $mpLogoUrl = $resolved;
            }
        }
    }
?>
<header class="mp-header">
    <div class="mp-header-inner">
        
        <button type="button" class="mp-icon-plain mp-menu-btn" id="mpMenuToggle" aria-label="القائمة" aria-expanded="false">
            <i class="fa-light fa-bars"></i>
        </button>

        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>" class="mp-logo">
            <?php if(!empty($mpLogoUrl)): ?>
                <img src="<?php echo e($mpLogoUrl); ?>" alt="<?php echo e(@$storeinfo->name); ?>">
            <?php else: ?>
                <span class="mp-logo-text"><?php echo e(@$storeinfo->name); ?></span>
            <?php endif; ?>
        </a>

        <nav class="mp-nav-policies mp-nav-policies-desktop">
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/refund_policy')); ?>">سياسة الاستبدال و الاسترجاع</a>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">سياسة الشحن</a>
        </nav>

        <div class="mp-actions">
            <button type="button" class="mp-icon-plain" data-mp-open-cart aria-label="<?php echo e(trans('labels.cart')); ?>">
                <i class="fa-light fa-bag-shopping"></i>
                <span class="mp-cart-count cart-count" id="cartcnt" <?php if($mpCartCount < 1): ?> style="display:none" <?php endif; ?>><?php echo e($mpCartCount); ?></span>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-search aria-label="<?php echo e(trans('labels.search')); ?>">
                <i class="fa-light fa-magnifying-glass"></i>
            </button>
        </div>
    </div>

    
    <div class="mp-policy-bar">
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/refund_policy')); ?>">سياسة الاستبدال و الاسترجاع</a>
        <span class="mp-policy-sep" aria-hidden="true"></span>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">سياسة الشحن</a>
    </div>
</header>


<div class="mp-nav-backdrop" id="mpNavBackdrop" hidden></div>
<aside class="mp-nav-drawer" id="mpNavDrawer" aria-hidden="true" dir="rtl">
    <div class="mp-nav-drawer-top">
        <button type="button" class="mp-nav-close" id="mpNavClose" aria-label="إغلاق">
            <i class="fa-light fa-xmark"></i>
        </button>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>" class="mp-nav-logo">
            <?php if(!empty($mpLogoUrl)): ?>
                <img src="<?php echo e($mpLogoUrl); ?>" alt="<?php echo e(@$storeinfo->name); ?>">
            <?php else: ?>
                <span><?php echo e(@$storeinfo->name); ?></span>
            <?php endif; ?>
        </a>
    </div>
    <nav class="mp-nav-drawer-links">
        <?php $__empty_1 = true; $__currentLoopData = $mpCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mpCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/category/' . $mpCat->slug)); ?>"><?php echo e($mpCat->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
        <?php endif; ?>
    </nav>
    <?php if(!empty($mpContact) && $mpContact !== '-'): ?>
        <div class="mp-nav-drawer-foot">
            <a href="tel:<?php echo e(preg_replace('/\s+/', '', $mpContact)); ?>" class="mp-nav-help">
                <strong><?php echo e($mpContact); ?></strong>
                <span>Need help? call us</span>
            </a>
        </div>
    <?php endif; ?>
</aside>

<?php echo $__env->make('front.template-22.partials.search_overlay', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.cart_drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('mpMenuToggle');
    var drawer = document.getElementById('mpNavDrawer');
    var backdrop = document.getElementById('mpNavBackdrop');
    var closeBtn = document.getElementById('mpNavClose');

    function openNav() {
        if (!drawer) return;
        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
        if (backdrop) {
            backdrop.hidden = false;
            backdrop.classList.add('is-open');
        }
        document.documentElement.classList.add('mp-drawer-lock');
    }
    function closeNav() {
        if (!drawer) return;
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        if (backdrop) {
            backdrop.hidden = true;
            backdrop.classList.remove('is-open');
        }
        document.documentElement.classList.remove('mp-drawer-lock');
    }

    window.mpOpenNavDrawer = openNav;
    window.mpCloseNavDrawer = closeNav;

    if (toggle) toggle.addEventListener('click', function (e) {
        e.preventDefault();
        openNav();
    });
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    if (backdrop) backdrop.addEventListener('click', closeNav);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeNav();
    });
});
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/layout/header.blade.php ENDPATH**/ ?>