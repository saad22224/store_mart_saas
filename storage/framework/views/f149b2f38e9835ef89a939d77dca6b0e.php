<style>
    .vela-header {
        background: #fff;
        border-bottom: 1px solid #e9e9e9;
        font-family: 'Inter', 'Cairo', sans-serif;
        position: relative;
        z-index: 20;
        width: 100%;
        max-width: 100%;
        overflow-x: clip;
    }

    body {
        overflow-x: hidden;
    }

    .vela-home,
    .vela-category-page {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    .vela-header-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 32px 20px;
    }

    .vela-header-top {
        min-height: 64px;
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        column-gap: 20px;
        direction: ltr;
    }

    .vela-header-left,
    .vela-header-right {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .vela-header-right {
        justify-content: flex-end;
    }

    .vela-language {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 8px;
        border: 1px solid transparent;
        border-radius: 999px;
        background: transparent;
        color: #111;
        box-shadow: none;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        text-decoration: none;
        letter-spacing: 0;
    }

    .vela-language:hover {
        background: #f7f7f7;
        color: #111;
    }

    .vela-language::after {
        display: none;
    }

    .vela-logo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
    }

    .vela-logo img {
        display: block;
        max-width: 220px;
        max-height: 58px;
        object-fit: contain;
    }

    .vela-header-icon,
    .vela-mobile-menu-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        background: transparent;
        color: #111;
        font-size: 0;
        line-height: 1;
        text-decoration: none;
        position: relative;
        padding: 0;
        transition: color .2s ease, transform .2s ease;
    }

    .vela-mobile-menu-btn {
        display: none;
    }

    .vela-header-icon:hover,
    .vela-mobile-menu-btn:hover {
        color: #111;
        transform: translateY(-1px);
    }

    .vela-cart-badge {
        min-width: 16px;
        height: 16px;
        padding: 0 5px;
        border-radius: 999px;
        background: #f7a9be;
        color: #fff;
        border: 2px solid #fff;
        font-size: 10px;
        font-weight: 800;
        line-height: 12px;
        position: absolute;
        top: -3px;
        right: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .vela-icon-menu,
    .vela-icon-search,
    .vela-icon-bag {
        display: block;
        position: relative;
        width: 24px;
        height: 24px;
        color: #050505;
    }

    .vela-icon-menu::before,
    .vela-icon-menu::after,
    .vela-icon-menu span {
        content: "";
        position: absolute;
        left: 2px;
        width: 20px;
        height: 2px;
        border-radius: 999px;
        background: currentColor;
    }

    .vela-icon-menu::before {
        top: 5px;
    }

    .vela-icon-menu span {
        top: 11px;
    }

    .vela-icon-menu::after {
        top: 17px;
    }

    .vela-icon-search::before {
        content: "";
        position: absolute;
        left: 2px;
        top: 2px;
        width: 15px;
        height: 15px;
        border: 2px solid currentColor;
        border-radius: 50%;
    }

    .vela-icon-search::after {
        content: "";
        position: absolute;
        left: 16px;
        top: 16px;
        width: 9px;
        height: 2px;
        border-radius: 999px;
        background: currentColor;
        transform: rotate(45deg);
        transform-origin: left center;
    }

    .vela-icon-bag::before {
        content: "";
        position: absolute;
        left: 4px;
        top: 8px;
        width: 16px;
        height: 14px;
        border: 2px solid currentColor;
        border-radius: 2px;
    }

    .vela-icon-bag::after {
        content: "";
        position: absolute;
        left: 8px;
        top: 3px;
        width: 8px;
        height: 8px;
        border: 2px solid currentColor;
        border-bottom: 0;
        border-radius: 999px 999px 0 0;
    }

    .vela-main-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 34px;
        padding-top: 18px;
        white-space: nowrap;
    }

    .vela-nav-link {
        color: #050505;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.4;
        text-decoration: none;
        text-transform: capitalize;
        transition: color .2s ease;
    }

    .vela-nav-link:hover,
    .vela-nav-link.active {
        color: #050505;
        text-decoration: none;
    }

    .vela-mobile-nav {
        max-width: min(86vw, 360px);
        overflow-x: hidden;
    }

    .vela-mobile-nav .offcanvas-header {
        min-height: 82px;
        justify-content: center !important;
        position: relative;
        padding-inline: 58px 18px;
        direction: ltr;
    }

    .vela-mobile-close {
        width: 34px;
        height: 34px;
        position: absolute;
        top: 24px;
        left: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        background: transparent;
        color: #111;
        padding: 0;
    }

    .vela-mobile-close::before,
    .vela-mobile-close::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 2px;
        border-radius: 999px;
        background: currentColor;
    }

    .vela-mobile-close::before {
        transform: rotate(45deg);
    }

    .vela-mobile-close::after {
        transform: rotate(-45deg);
    }

    .vela-mobile-nav-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .vela-mobile-nav-list a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #ededed;
        color: #111;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .vela-home .row,
        .vela-category-page .row {
            --bs-gutter-x: 1rem;
            margin-left: 0;
            margin-right: 0;
        }

        .vela-home .container,
        .vela-category-page .container {
            max-width: 100%;
            overflow-x: hidden;
        }

        .vela-header-inner {
            padding: 0 14px;
        }

        .vela-header-top {
            min-height: 88px;
            grid-template-columns: 76px 1fr 76px;
            column-gap: 0;
        }

        .vela-header-left {
            justify-content: flex-start;
            gap: 0;
        }

        .vela-header-right {
            gap: 12px;
        }

        .vela-language-wrap,
        .vela-main-nav {
            display: none;
        }

        .vela-mobile-menu-btn {
            display: inline-flex;
        }

        .vela-logo {
            min-width: 0;
        }

        .vela-logo img {
            max-width: 160px;
            max-height: 42px;
        }

        .vela-header-icon {
            width: 30px;
            height: 30px;
        }
    }

    @media (max-width: 380px) {
        .vela-header-top {
            grid-template-columns: 60px 1fr 68px;
        }

        .vela-logo img {
            max-width: 132px;
        }

        .vela-header-right {
            gap: 9px;
        }
    }
</style>

<?php
    $template17Categories = helper::getcategory($storeinfo->id);
    $cartCount = session()->get('cart') ?? 0;
?>

<header class="vela-header">
    <div class="vela-header-inner">
        <div class="vela-header-top">
            <div class="vela-header-left">
                <button class="vela-mobile-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#vela-mobile-nav" aria-controls="vela-mobile-nav" aria-label="Open menu">
                    <span class="vela-icon-menu" aria-hidden="true"><span></span></span>
                </button>

                <div class="dropdown vela-language-wrap">
                    <a class="vela-language dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(\App::getLocale() == 'ar' ? 'AR' : 'EN'); ?>

                    </a>
                    <ul class="dropdown-menu">
                        <?php if(\App::getLocale() == 'en'): ?>
                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/lang/change?lang=ar')); ?>">AR</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="<?php echo e(URL::to('/lang/change?lang=en')); ?>">EN</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="vela-logo" aria-label="<?php echo e($storeinfo->name); ?>">
                <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>" alt="<?php echo e($storeinfo->name); ?>">
            </a>

            <div class="vela-header-right">
                <a href="<?php echo e(URL::to($storeinfo->slug . '/search')); ?>" class="vela-header-icon" aria-label="<?php echo e(trans('labels.search')); ?>">
                    <span class="vela-icon-search" aria-hidden="true"></span>
                </a>

                <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
                    <a href="<?php echo e(URL::to($storeinfo->slug . '/cart/')); ?>" class="vela-header-icon" aria-label="<?php echo e(trans('labels.cart')); ?>">
                        <span class="vela-icon-bag" aria-hidden="true"></span>
                        <span class="vela-cart-badge" id="cartcnt"><?php echo e($cartCount); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <nav class="vela-main-nav" aria-label="Categories">
            <?php $__currentLoopData = $template17Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.$cat->slug)); ?>" class="vela-nav-link <?php echo e(request()->is($storeinfo->slug.'/category/'.$cat->slug) ? 'active' : ''); ?>"><?php echo e($cat->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>
</header>

<div class="offcanvas offcanvas-start vela-mobile-nav" tabindex="-1" id="vela-mobile-nav" aria-labelledby="vela-mobile-nav-title">
    <div class="offcanvas-header border-bottom">
        <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="vela-logo" id="vela-mobile-nav-title">
            <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>" alt="<?php echo e($storeinfo->name); ?>">
        </a>
        <button type="button" class="vela-mobile-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="vela-mobile-nav-list">
            <?php $__currentLoopData = $template17Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.$cat->slug)); ?>">
                        <span><?php echo e($cat->name); ?></span>
                        <i class="fa-light fa-angle-right"></i>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="dropdown mt-4">
            <a class="vela-language dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo e(\App::getLocale() == 'ar' ? 'AR' : 'EN'); ?>

            </a>
            <ul class="dropdown-menu">
                <?php if(\App::getLocale() == 'en'): ?>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/lang/change?lang=ar')); ?>">AR</a></li>
                <?php else: ?>
                    <li><a class="dropdown-item" href="<?php echo e(URL::to('/lang/change?lang=en')); ?>">EN</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-17/layout/header.blade.php ENDPATH**/ ?>