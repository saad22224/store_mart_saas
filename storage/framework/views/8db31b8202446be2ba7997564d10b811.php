
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
?>
<header class="mp-header">
    <div class="mp-header-inner">
        
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>" class="mp-logo">
            <?php if(!empty(helper::appdata(@$storeinfo->id)->logo)): ?>
                <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>" alt="<?php echo e(@$storeinfo->name); ?>">
            <?php else: ?>
                <span class="mp-logo-text"><?php echo e(@$storeinfo->name); ?></span>
            <?php endif; ?>
        </a>

        
        <nav class="mp-nav-policies">
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/refund_policy')); ?>">سياسة الاستبدال و الاسترجاع</a>
            <a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">سياسة الشحن</a>
        </nav>

        
        <div class="mp-actions">
            <button type="button" class="mp-icon-plain mp-menu-btn" id="mpMenuToggle" aria-label="القائمة">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-cart aria-label="<?php echo e(trans('labels.cart')); ?>">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="mp-cart-count cart-count" id="cartcnt" <?php if($mpCartCount < 1): ?> style="display:none" <?php endif; ?>><?php echo e($mpCartCount); ?></span>
            </button>
            <button type="button" class="mp-icon-plain" data-mp-open-search aria-label="<?php echo e(trans('labels.search')); ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
    <div class="mp-mobile-nav" id="mpMobileNav">
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/refund_policy')); ?>">سياسة الاستبدال و الاسترجاع</a>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">سياسة الشحن</a>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/privacy')); ?>"><?php echo e(trans('labels.privacypolicy')); ?></a>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/contact')); ?>"><?php echo e(trans('labels.contact_us')); ?></a>
        <a href="<?php echo e(URL::to(@$storeinfo->slug . '/cart')); ?>"><?php echo e(trans('labels.cart')); ?></a>
    </div>
</header>
<?php echo $__env->make('front.template-22.partials.search_overlay', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.cart_drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('mpMenuToggle');
    var nav = document.getElementById('mpMobileNav');
    if (btn && nav) btn.addEventListener('click', function () { nav.classList.toggle('is-open'); });
});
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/layout/header.blade.php ENDPATH**/ ?>