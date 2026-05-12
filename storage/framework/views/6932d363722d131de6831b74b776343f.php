<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $primaryColor = helper::appdata($storeinfo->id)->primary_color ?? '#E84393';
    $allCategories = helper::getcategory($storeinfo->id);
?>

<style>
    :root {
        --t7-primary: <?php echo e($primaryColor); ?>;
        --t7-primary-light: <?php echo e($primaryColor); ?>18;
    }

    /* ── Banner ── */
    .furniture_home .item img.banner-bg {
        width: 100%;
        height: 420px;
        object-fit: cover;
    }

    @media(max-width:576px) {
        .furniture_home .item img.banner-bg {
            height: 220px;
        }
    }

    /* ── Category Circles ── */
    .t7-cats-section {
        background: #fff;
        padding: 40px 0 30px;
    }

    .t7-cats-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #222;
        font-family: 'Cairo', sans-serif;
        position: relative;
        display: inline-block;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
    }

    .t7-cats-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 5px;
        background: var(--t7-primary);
        border-radius: 10px;
    }

    /* wrap: center items, allow wrapping on small screens */
    .t7-cats-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px 20px;
        padding: 10px 0;
    }

    .t7-cat-item {
        text-align: center;
        min-width: 140px;
        max-width: 160px;
        cursor: pointer;
        text-decoration: none;
        transition: transform .25s;
    }

    .t7-cat-item:hover {
        transform: translateY(-5px);
    }

    .t7-cat-img-wrap {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        background: #fff;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 5px solid #fff;
        outline: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .t7-cat-item:hover .t7-cat-img-wrap {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
        outline: 2px solid var(--t7-primary);
    }

    .t7-cat-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .t7-cat-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--t7-primary-light);
        font-size: 40px;
        color: var(--t7-primary);
    }

    .t7-cat-name {
        margin-top: 12px;
        font-size: 15px;
        font-weight: 700;
        color: #333;
        font-family: 'Cairo', 'Tajawal', sans-serif;
        max-width: 150px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.4;
        word-break: break-word;
    }

    /* mobile: scroll horizontally on very small screens */
    @media(max-width:480px) {
        .t7-cats-grid {
            flex-wrap: nowrap;
            overflow-x: auto;
            justify-content: flex-start;
            scrollbar-width: none;
            padding-bottom: 8px;
        }

        .t7-cats-grid::-webkit-scrollbar {
            display: none;
        }

        .t7-cat-item {
            min-width: 120px;
        }

        .t7-cat-img-wrap {
            width: 110px;
            height: 110px;
        }
    }

    /* ── Section titles ── */
    .t7-section-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #222;
        position: relative;
        display: inline-block;
        margin-bottom: 4px;
    }

    .t7-section-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--t7-primary);
        border-radius: 2px;
    }

    .t7-subtitle {
        color: #888;
        font-size: .9rem;
        margin-top: 10px;
    }

    /* ── Product cards ── */
    .t7-pro-card {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, .07);
        background: #fff;
        transition: transform .3s, box-shadow .3s;
        border: none;
    }

    .t7-pro-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 36px rgba(0, 0, 0, .14);
    }

    .t7-pro-img-wrap {
        position: relative;
        overflow: hidden;
    }

    .t7-pro-img-wrap img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform .4s;
    }

    .t7-pro-card:hover .t7-pro-img-wrap img {
        transform: scale(1.06);
    }

    .t7-badge-off {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--t7-primary);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .t7-wish-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
        transition: .3s;
        cursor: pointer;
    }

    .t7-wish-btn:hover {
        background: var(--t7-primary);
        color: #fff;
    }

    .t7-cart-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--t7-primary);
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
        transition: .3s;
        cursor: pointer;
        opacity: 0;
    }

    .t7-pro-card:hover .t7-cart-btn {
        opacity: 1;
    }

    .t7-item-name {
        font-size: .9rem;
        font-weight: 600;
        color: #222;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .t7-price-main {
        color: var(--t7-primary);
        font-weight: 700;
        font-size: 1rem;
    }

    .t7-price-old {
        color: #aaa;
        text-decoration: line-through;
        font-size: .8rem;
        margin-right: 6px;
    }

    .t7-rating-star {
        color: #FFC107;
        font-size: 11px;
    }

    /* ── View-all button ── */
    .t7-view-all {
        border: 1.5px solid #8e24aa;
        /* Purple border like the image button */
        color: #8e24aa;
        background: transparent;
        border-radius: 8px;
        padding: 10px 45px;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Cairo', sans-serif;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }

    .t7-view-all:hover {
        background: #8e24aa;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(142, 36, 170, 0.2);
    }

    /* ── Featured products section (reference-like layout) ── */
    .t7-featured-title {
        font-size: 2.6rem;
        font-weight: 800;
        color: #2b0f13;
        margin-bottom: 6px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .t7-featured-title i {
        color: #ff7a00;
        font-size: 1.9rem;
    }

    .t7-featured-wrap .card-bg {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: none;
        background: transparent;
    }

    .t7-featured-wrap .pro-7-img {
        border-radius: 14px;
        overflow: hidden;
        background: #f8f8f8;
        position: relative;
    }

    .t7-featured-wrap .pro-7-img img {
        aspect-ratio: 4 / 5;
        object-fit: cover;
        width: 100%;
    }

    .t7-featured-wrap .outer-functional .wishlist {
        position: absolute;
        left: 10px;
        top: 10px;
        z-index: 3;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .t7-featured-wrap .outer-functional .product-add {
        position: absolute;
        left: 10px;
        bottom: 10px;
        z-index: 3;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .t7-featured-wrap .outer-functional {
        position: static;
        margin: 0;
        padding: 0;
    }

    .t7-featured-wrap .outer-functional .product-add i,
    .t7-featured-wrap .outer-functional .wishlist i {
        color: #7a0f1f;
        font-size: 15px;
    }

    .t7-featured-wrap .card-body {
        padding-top: 12px !important;
        text-align: center;
    }

    .t7-featured-wrap .card-footer {
        text-align: center;
    }

    .t7-featured-wrap .title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2b0f13 !important;
        line-height: 1.45;
        margin-bottom: 8px !important;
    }

    .t7-featured-wrap .pro-pricing {
        color: #2b0f13 !important;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .t7-featured-wrap .old-price {
        color: #9f9f9f !important;
        font-size: 1rem;
    }

    .t7-featured-wrap .pro-rating,
    .t7-featured-wrap .out-stock,
    .t7-featured-wrap .in-stock {
        justify-content: center;
    }

    @media(max-width:992px) {
        .t7-featured-title {
            font-size: 2rem;
        }

        .t7-featured-wrap .pro-7-img img {
            aspect-ratio: 4 / 4.8;
        }

        .t7-featured-wrap .title {
            font-size: 1.05rem;
        }

        .t7-featured-wrap .pro-pricing {
            font-size: 1.1rem;
        }

        .t7-featured-wrap .old-price {
            font-size: .9rem;
        }
    }

    @media(max-width:576px) {
        .t7-featured-title {
            font-size: 1.6rem;
        }

        .t7-featured-wrap .pro-7-img img {
            aspect-ratio: 4 / 4.6;
        }

        .t7-featured-wrap .title {
            font-size: .95rem;
        }

        .t7-featured-wrap .pro-pricing {
            font-size: 1rem;
        }
    }

    /* ── Promo banners ── */
    .t7-promo-wrap {
        border-radius: 16px;
        overflow: hidden;
    }

    .t7-promo-wrap img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform .4s;
    }

    .t7-promo-wrap:hover img {
        transform: scale(1.04);
    }

    /* ── Testimonials ── */
    .t7-testimonial {
        background: #fff;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .07);
        transition: .3s;
        position: relative;
        overflow: hidden;
    }

    .t7-testimonial::before {
        content: '\201C';
        font-size: 80px;
        color: var(--t7-primary);
        opacity: .12;
        position: absolute;
        top: -10px;
        left: 14px;
        font-family: serif;
        line-height: 1;
    }

    .t7-testimonial:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(0, 0, 0, .12);
    }

    /* ── Animations ── */
    @keyframes t7FadeUp {
        from {
            opacity: 0;
            transform: translateY(24px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .t7-fade-up {
        animation: t7FadeUp .6s ease both;
    }

    .t7-fade-up:nth-child(2) {
        animation-delay: .1s
    }

    .t7-fade-up:nth-child(3) {
        animation-delay: .2s
    }

    .t7-fade-up:nth-child(4) {
        animation-delay: .3s
    }

    /* ── Category tabs modern ── */
    .t7-tab-btn {
        border: 1.5px solid #eee;
        background: #f9f9f9;
        color: #555;
        border-radius: 50px;
        padding: 7px 20px;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer;
        transition: .3s;
        white-space: nowrap;
    }

    .t7-tab-btn:hover,
    .t7-tab-btn.active {
        background: var(--t7-primary);
        color: #fff;
        border-color: var(--t7-primary);
    }
</style>

<?php if($sliders->count() > 0): ?>
    <div class="card border-0">

        <div class="furniture_home owl-carousel owl-theme">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <?php if($slider->product_id != 0 || $slider->category_id != 0): ?>
                        <?php if($slider->type == 1): ?>
                            <a
                                href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . $slider['category_info']->slug)); ?>">
                            <?php elseif($slider->type == 2): ?>
                                <?php
                                    $item = helper::itemdetails($slider->product_id, $storeinfo->id);
                                ?>
                                <a onclick="GetProductOverview('<?php echo e($item->slug); ?>')" class="cursor-pointer">
                                <?php else: ?>
                                    <a href="javascript:void(0)">
                        <?php endif; ?>
                    <?php endif; ?>

                    <img class="banner-bg" src=" <?php echo e(helper::image_path($slider->banner_image)); ?>" alt="">
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php else: ?>
    <div class="furniture_home owl-carousel owl-theme">
        <div class="item"><img class="banner-bg"
                src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png')); ?> "
                alt="">
        </div>
    </div>
<?php endif; ?>


<?php if($allCategories->count() > 0): ?>
    <section class="t7-cats-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="t7-cats-title">التصنيفات</h2>
                <p class="t7-subtitle">اكتشف أفضل المجموعات المختارة بعناية لتناسب ذوقك الرفيع</p>
            </div>

            <div class="t7-cats-grid">

                <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . $cat->slug)); ?>" class="t7-cat-item">
                        <div class="t7-cat-img-wrap">
                            <?php if(!empty($cat->image) && $cat->image !== 'default.png'): ?>
                                <img src="<?php echo e(helper::image_path($cat->image)); ?>" alt="<?php echo e($cat->name); ?>"
                                    loading="lazy">
                            <?php else: ?>
                                <div class="t7-cat-placeholder"><i class="fa-solid fa-tag" style="font-size:40px"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="t7-cat-name"><?php echo e($cat->name); ?></div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="text-center mt-4">
                <a href="<?php echo e(URL::to($storeinfo->slug . '/search')); ?>"
                    class="t7-view-all"><?php echo e(trans('labels.view_more')); ?></a>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Best-selling-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 1 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($bestsellingitems) > 0): ?>
        <section class="my-5 pro-7-sec">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="main-title-7 mb-2 color-changer main-title text-center">
                        <?php echo e(trans('labels.selling_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center mb-2 fw-500 text-muted">
                        <?php echo e(trans('labels.selling_product_subtitle')); ?></p>
                </div>
                <div class="pro-7">
                    <div class="row g-sm-4 g-3 row-cols-xl-4 row-cols-lg-3 row-cols-2">
                        <?php $__currentLoopData = $bestsellingitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($item->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
                                    if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                        if ($item['variation']->count() > 0) {
                                            if (
                                                $item['variation'][0]->price >
                                                @helper::top_deals($storeinfo->id)->offer_amount
                                            ) {
                                                $price =
                                                    $item['variation'][0]->price -
                                                    @helper::top_deals($storeinfo->id)->offer_amount;
                                            } else {
                                                $price = $item['variation'][0]->price;
                                            }
                                        } else {
                                            if ($item->item_price > @helper::top_deals($storeinfo->id)->offer_amount) {
                                                $price =
                                                    $item->item_price -
                                                    @helper::top_deals($storeinfo->id)->offer_amount;
                                            } else {
                                                $price = $item->item_price;
                                            }
                                        }
                                    } else {
                                        if ($item['variation']->count() > 0) {
                                            $price =
                                                $item['variation'][0]->price -
                                                $item['variation'][0]->price *
                                                    (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                        } else {
                                            $price =
                                                $item->item_price -
                                                $item->item_price *
                                                    (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                        }
                                    }
                                    if ($item['variation']->count() > 0) {
                                        $original_price = $item['variation'][0]->price;
                                    } else {
                                        $original_price = $item->item_price;
                                    }
                                    $off =
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                } else {
                                    if ($item['variation']->count() > 0) {
                                        $price = $item['variation'][0]->price;
                                        $original_price = $item['variation'][0]->original_price;
                                    } else {
                                        $price = $item->item_price;
                                        $original_price = $item->item_original_price;
                                    }
                                    $off =
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                }
                            ?>
                            <div class="col">
                                <div class="card card-bg h-100 rounded-0">
                                    <div class="pro-7-img">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <?php if(@$item['product_image']->image == null): ?>
                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                    alt="pro img" class="w-100 object-fit-cover cursor-pointer img-1">
                                            <?php else: ?>
                                                <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                    alt="pro img" class="w-100 object-fit-cover cursor-pointer img-1">
                                            <?php endif; ?>
                                        </a>
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <?php if($item['multi_image']->count() > 1): ?>
                                                <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                    alt="pro img" class="w-100 obaject-fit-cover cursor-pointer img-2">
                                            <?php endif; ?>
                                        </a>

                                        <?php if($off > 0): ?>
                                            <div class="offer-7 rounded-0 ltr"><?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <ul class="outer-functional">
                                            <?php if(@helper::checkaddons('customer_login')): ?>
                                                <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                    <li class="wishlist">
                                                        <a
                                                            onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')">
                                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                <?php

                                                                    $favorite = helper::ceckfavorite(
                                                                        $item->id,
                                                                        $storeinfo->id,
                                                                        Auth::user()->id,
                                                                    );

                                                                ?>
                                                                <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                    <i class="fa-solid fa-heart"></i>
                                                                <?php else: ?>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <i class="fa-regular fa-heart"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <li class="product-add">
                                                <button class="btn p-0 rounded-0 border-0"
                                                    id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                    <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                        <i class="fa-regular fa-cart-shopping"></i>
                                                    <?php else: ?>
                                                        <i class="fa-regular fa-eye"></i>
                                                    <?php endif; ?>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                <p class="m-0 pro-rating cursor-pointer"
                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span
                                                        class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <h4 id="itemname" class="title mb-2 color-changer text-dark line-2">
                                                <?php echo e($item->item_name); ?></h4>
                                        </a>
                                    </div>
                                    <div class="card-footer px-0 bg-transparent border-0">
                                        <p class="pro-pricing color-changer line-1 m-0">
                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                            <?php if($original_price > $price): ?>
                                                <span class="old-price">
                                                    <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        <?php if($item->stock_management == 1): ?>
                                            <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                <div class="out-stock mt-1">
                                                    <span class="out-stock-indicator-dot"></span>
                                                    <p class="out-stock-text">
                                                        <?php echo e(trans('labels.out_of_stock')); ?></p>
                                                </div>
                                            <?php else: ?>
                                                <div class="in-stock mt-1">
                                                    <span class="in-stock-indicator-dot"></span>
                                                    <p class="in-stock-text">
                                                        <?php echo e(trans('labels.in_stock')); ?>

                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<!-- feature-sec -->
<?php if($bannerimage1->count() > 0): ?>
    <section class="feature-sec my-5">
        <div class="container">
            <div class="feature-slider-6 owl-carousel owl-rtl owl-theme">

                <?php $__currentLoopData = $bannerimage1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <?php if($image->type == 1): ?>
                            <a href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . @$image['category_info']->slug)); ?>"
                                class="cursor-pointer">
                            <?php elseif($image->type == 2): ?>
                                <?php
                                    $item = helper::itemdetails($image->product_id, $storeinfo->id);
                                ?>
                                <a onclick="GetProductOverview('<?php echo e($item->slug); ?>')" class="cursor-pointer">
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="cursor-pointer">
                        <?php endif; ?>
                        <img src='<?php echo e(helper::image_path($image->banner_image)); ?>' alt="" class=""></a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- new product-sec -->
<?php if(count($getitem) > 0): ?>
    <section class="pro-7-sec my-sm-5 my-3">
        <div class="container">
            <div class="sec-header mb-4 text-center">
                <h4 class="t7-featured-title">
                    <i class="fa-solid fa-fire"></i>
                    <?php echo e(trans('labels.featured_products')); ?>

                </h4>
            </div>
            <div class="pro-7 t7-featured-wrap">
                <div class="row g-sm-4 g-3 row-cols-lg-2 row-cols-2">
                    <?php $__currentLoopData = $getitem->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            if ($item->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
                                if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                    if ($item['variation']->count() > 0) {
                                        if (
                                            $item['variation'][0]->price >
                                            @helper::top_deals($storeinfo->id)->offer_amount
                                        ) {
                                            $price =
                                                $item['variation'][0]->price -
                                                @helper::top_deals($storeinfo->id)->offer_amount;
                                        } else {
                                            $price = $item['variation'][0]->price;
                                        }
                                    } else {
                                        if ($item->item_price > @helper::top_deals($storeinfo->id)->offer_amount) {
                                            $price =
                                                $item->item_price - @helper::top_deals($storeinfo->id)->offer_amount;
                                        } else {
                                            $price = $item->item_price;
                                        }
                                    }
                                } else {
                                    if ($item['variation']->count() > 0) {
                                        $price =
                                            $item['variation'][0]->price -
                                            $item['variation'][0]->price *
                                                (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                    } else {
                                        $price =
                                            $item->item_price -
                                            $item->item_price *
                                                (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                    }
                                }
                                if ($item['variation']->count() > 0) {
                                    $original_price = $item['variation'][0]->price;
                                } else {
                                    $original_price = $item->item_price;
                                }
                                $off =
                                    $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                            } else {
                                if ($item['variation']->count() > 0) {
                                    $price = $item['variation'][0]->price;
                                    $original_price = $item['variation'][0]->original_price;
                                } else {
                                    $price = $item->item_price;
                                    $original_price = $item->item_original_price;
                                }
                                $off =
                                    $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                            }
                        ?>
                        <div class="col">
                            <div class="card card-bg h-100 rounded-0">
                                <div class="pro-7-img">
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <?php if(@$item['product_image']->image == null): ?>
                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                alt="pro img" class="w-100 object-fit-cover cursor-pointer img-1">
                                        <?php else: ?>
                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                alt="pro img" class="w-100 object-fit-cover cursor-pointer img-1">
                                        <?php endif; ?>
                                    </a>
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <?php if($item['multi_image']->count() > 1): ?>
                                            <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                alt="pro img" class="w-100 obaject-fit-cover cursor-pointer img-2">
                                        <?php endif; ?>
                                    </a>

                                    <?php if($off > 0): ?>
                                        <div class="offer-7 rounded-0 ltr"><?php echo e($off); ?>%
                                            <?php echo e(trans('labels.off')); ?></div>
                                    <?php endif; ?>
                                    <ul class="outer-functional">
                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                <li class="wishlist">
                                                    <a href="javascript:void(0)"
                                                        onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')">
                                                        <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                            <?php
                                                                $favorite = helper::ceckfavorite(
                                                                    $item->id,
                                                                    $storeinfo->id,
                                                                    Auth::user()->id,
                                                                );
                                                            ?>
                                                            <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                <i class="fa-solid fa-heart"></i>
                                                            <?php else: ?>
                                                                <i class="fa-regular fa-heart"></i>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <i class="fa-regular fa-heart"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <li class="product-add">
                                            <button class="btn p-0 rounded-0 border-0"
                                                id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                    <i class="fa-regular fa-cart-shopping"></i>
                                                <?php else: ?>
                                                    <i class="fa-regular fa-eye"></i>
                                                <?php endif; ?>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                            <p class="m-0 pro-rating cursor-pointer"
                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                <i class="fa-solid fa-star text-warning"></i>
                                                <span
                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                            </p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <h4 id="itemname" class="title mb-2 color-changer text-dark line-2">
                                            <?php echo e($item->item_name); ?></h4>
                                    </a>
                                </div>
                                <div class="card-footer px-0 bg-transparent border-0">
                                    <p class="pro-pricing color-changer line-1 m-0">
                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, helper::currencyinfo($storeinfo->id)->currency)); ?>

                                        
                                        
                                        <?php if($original_price > $price): ?>
                                            <span class="old-price">
                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, helper::currencyinfo($storeinfo->id)->currency)); ?>

                                            </span>
                                        <?php endif; ?>
                                    </p>
                                    <?php if($item->stock_management == 1): ?>
                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                            <div class="out-stock mt-1">
                                                <span class="out-stock-indicator-dot"></span>
                                                <p class="out-stock-text"><?php echo e(trans('labels.out_of_stock')); ?></p>
                                            </div>
                                        <?php else: ?>
                                            <div class="in-stock mt-1">
                                                <span class="in-stock-indicator-dot"></span>
                                                <p class="in-stock-text"><?php echo e(trans('labels.in_stock')); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="d-flex justify-content-center my-4">
                <a href="<?php echo e(URL::to($storeinfo->slug . '/search')); ?>"
                    class="t7-view-all"><?php echo e(trans('labels.view_more')); ?></a>
            </div>
        </div>
    </section>
<?php endif; ?>

<!---------- WHO WE ARE START ---------->
<?php if($whowearedata->count() > 0): ?>
    <section class="my-5 my-lg-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="sec-header">
                        <h4 class="line-1 mb-2 color-changer fs-5">
                            <?php echo e(helper::appdata($storeinfo->id)->whoweare_title); ?>

                        </h4>
                    </div>
                    <h3 class="line-2 main-title color-changer fw-600">
                        <?php echo e(helper::appdata($storeinfo->id)->whoweare_subtitle); ?></h3>
                    <p class="m-0 text-muted line-3 fs-15"><?php echo e(helper::appdata($storeinfo->id)->whoweare_description); ?>

                    </p>
                    <div class="col-12">
                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $whowearedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whoweare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="card bg-primary rounded-0 border h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="icon-img-15">
                                                    <img src="<?php echo e(helper::image_path($whoweare->image)); ?>"
                                                        alt="" class="border">
                                                </div>
                                                <div class="tital-15">
                                                    <h6 class="line-1 text-white fw-600">
                                                        <?php echo e($whoweare->title); ?>

                                                    </h6>
                                                    <p class="m-0 fs-8 text-white fw-500 mt-1 line-2">
                                                        <?php echo e($whoweare->sub_title); ?>.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img-15">
                        <img src="<?php echo e(helper::image_path(helper::appdata($storeinfo->id)->whoweare_image)); ?>"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!---------- WHO WE ARE END ---------->

<!-- Top-Rated-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 2 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($toprateditems) > 0): ?>
        <section class="mb-5 pro-7-sec">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="main-title-7 mb-2 color-changer main-title text-center">
                        <?php echo e(trans('labels.top_rated_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center mb-2 fw-500 text-muted">
                        <?php echo e(trans('labels.top_rated_product_subtitle')); ?></p>
                </div>
                <div class="pro-7">
                    <div class="row g-sm-4 g-3 row-cols-xl-4 row-cols-lg-3 row-cols-2">
                        <?php $__currentLoopData = $toprateditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($item->top_deals == 1 && helper::top_deals($storeinfo->id) != null) {
                                    if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                        if ($item['variation']->count() > 0) {
                                            if (
                                                $item['variation'][0]->price >
                                                @helper::top_deals($storeinfo->id)->offer_amount
                                            ) {
                                                $price =
                                                    $item['variation'][0]->price -
                                                    @helper::top_deals($storeinfo->id)->offer_amount;
                                            } else {
                                                $price = $item['variation'][0]->price;
                                            }
                                        } else {
                                            if ($item->item_price > @helper::top_deals($storeinfo->id)->offer_amount) {
                                                $price =
                                                    $item->item_price -
                                                    @helper::top_deals($storeinfo->id)->offer_amount;
                                            } else {
                                                $price = $item->item_price;
                                            }
                                        }
                                    } else {
                                        if ($item['variation']->count() > 0) {
                                            $price =
                                                $item['variation'][0]->price -
                                                $item['variation'][0]->price *
                                                    (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                        } else {
                                            $price =
                                                $item->item_price -
                                                $item->item_price *
                                                    (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                                        }
                                    }
                                    if ($item['variation']->count() > 0) {
                                        $original_price = $item['variation'][0]->price;
                                    } else {
                                        $original_price = $item->item_price;
                                    }
                                    $off =
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                } else {
                                    if ($item['variation']->count() > 0) {
                                        $price = $item['variation'][0]->price;
                                        $original_price = $item['variation'][0]->original_price;
                                    } else {
                                        $price = $item->item_price;
                                        $original_price = $item->item_original_price;
                                    }
                                    $off =
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                }
                            ?>
                            <div class="col">
                                <div class="card card-bg h-100 rounded-0">
                                    <div class="pro-7-img">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <?php if(@$item['product_image']->image == null): ?>
                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                    alt="pro img"
                                                    class="w-100 object-fit-cover cursor-pointer img-1">
                                            <?php else: ?>
                                                <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                    alt="pro img"
                                                    class="w-100 object-fit-cover cursor-pointer img-1">
                                            <?php endif; ?>
                                        </a>
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <?php if($item['multi_image']->count() > 1): ?>
                                                <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                    alt="pro img"
                                                    class="w-100 obaject-fit-cover cursor-pointer img-2">
                                            <?php endif; ?>
                                        </a>

                                        <?php if($off > 0): ?>
                                            <div class="offer-7 rounded-0 ltr"><?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <ul class="outer-functional">
                                            <?php if(@helper::checkaddons('customer_login')): ?>
                                                <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                    <li class="wishlist">
                                                        <a
                                                            onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')">
                                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                <?php

                                                                    $favorite = helper::ceckfavorite(
                                                                        $item->id,
                                                                        $storeinfo->id,
                                                                        Auth::user()->id,
                                                                    );

                                                                ?>
                                                                <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                    <i class="fa-solid fa-heart"></i>
                                                                <?php else: ?>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <i class="fa-regular fa-heart"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <li class="product-add">
                                                <button class="btn p-0 rounded-0 border-0"
                                                    id="iconverifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                    <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                        <i class="fa-regular fa-cart-shopping"></i>
                                                    <?php else: ?>
                                                        <i class="fa-regular fa-eye"></i>
                                                    <?php endif; ?>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                <p class="m-0 pro-rating cursor-pointer"
                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span
                                                        class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <h4 id="itemname" class="title mb-2 color-changer text-dark line-2">
                                                <?php echo e($item->item_name); ?></h4>
                                        </a>
                                    </div>
                                    <div class="card-footer px-0 bg-transparent border-0">
                                        <p class="pro-pricing color-changer line-1 m-0">
                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                            <?php if($original_price > $price): ?>
                                                <span class="old-price">
                                                    <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        <?php if($item->stock_management == 1): ?>
                                            <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                <div class="out-stock mt-1">
                                                    <span class="out-stock-indicator-dot"></span>
                                                    <p class="out-stock-text">
                                                        <?php echo e(trans('labels.out_of_stock')); ?></p>
                                                </div>
                                            <?php else: ?>
                                                <div class="in-stock mt-1">
                                                    <span class="in-stock-indicator-dot"></span>
                                                    <p class="in-stock-text">
                                                        <?php echo e(trans('labels.in_stock')); ?>

                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php if($bannerimage2->count() > 0): ?>
    <section class="feature-sec my-5">
        <div class="container">
            <div class="feature-carousel-15 owl-carousel owl-theme">
                <?php $__currentLoopData = $bannerimage2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($image->type == 1): ?>
                        <a href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . @$image['category_info']->slug)); ?>"
                            class="cursor-pointer">
                        <?php elseif($image->type == 2): ?>
                            <?php
                                $item = helper::itemdetails($image->product_id, $storeinfo->id);
                            ?>
                            <a href="javascript:void(0)" onclick="GetProductOverview('<?php echo e($item->slug); ?>','')"
                                class="cursor-pointer">
                            <?php else: ?>
                                <a href="javascript:void(0)" class="cursor-pointer">
                    <?php endif; ?>
                    <div class="item">
                        <div class="feature">
                            <img src="<?php echo e(helper::image_path($image->banner_image)); ?>" alt=""
                                class="rounded">
                        </div>
                    </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!--------- storereview --------->
<?php if(@helper::checkaddons('store_reviews')): ?>
    <?php if($testimonials->count() > 0): ?>
        <section class="storereview-sec mb-lg-5 mb-4">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="main-title-7 mb-2 color-changer main-title text-center">
                        <?php echo e(trans('labels.testimonials')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center mb-2 fw-500 text-muted">
                        <?php echo e(trans('labels.testimonials_subtitle')); ?></p>
                </div>
                <div class="store-review-8 owl-carousel owl-theme">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item h-100">
                            <div class="card h-100 border p-4">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="review-img">
                                            <img src="<?php echo e(helper::image_path($item->image)); ?>" alt="">
                                        </div>
                                        <div class="px-3">
                                            <h5 class="line-1 color-changer mb-1 review_title"><?php echo e($item->name); ?>

                                            </h5>
                                            <p class="review_date text-muted fs-7">
                                                <?php echo e(helper::date_format($item->created_at, $storeinfo->id)); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        $count = $item->star;
                                    ?>
                                    <div class="d-flex gap-1 pb-2">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <?php if($i < $count): ?>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fa-solid fa-star text-warning"></i>
                                                </li>
                                            <?php else: ?>
                                                <li class="list-inline-item me-0 small"><i
                                                        class="fa-regular fa-star text-warning"></i>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="review_description">
                                        <p class="text-muted"><?php echo e($item->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<!--------- newsletter --------->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- blog -->
<?php if(helper::getblogs($storeinfo->id)->count() > 0): ?>
    <section class="blog-6-sec pro-7-sec my-5">
        <?php
            $blog = helper::getblogs($storeinfo->id);
        ?>
        <div class="container">
            <div class="sec-header mb-4">
                <h4 class="main-title-7 mb-2 color-changer main-title text-center">
                    <?php echo e(trans('labels.our_latest_blogs')); ?></h4>
                <p class="m-0 line-2 fs-15 text-center mb-2 fw-500 text-muted">
                    <?php echo e(trans('labels.our_latest_blogs_subtitle')); ?></p>
            </div>
            <!-- blogs -->
            <?php if(@helper::checkaddons('subscription')): ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <?php
                        $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)
                            ->orderByDesc('id')
                            ->first();
                        if ($storeinfo->allow_without_subscription == 1) {
                            $blogs_allow = 1;
                        } else {
                            $blogs_allow = @$checkplan->blogs;
                        }
                    ?>
                    <?php if($blogs_allow == 1): ?>
                        <div class="blog-7 owl-carousel owl-theme">
                            <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 mx-1">
                                    <div class="card card-bg border h-100 rounded-0 border-0 overflow-hidden">
                                        <div class="blog-6-img">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                    alt="blog img" class="w-100 object-fit-cover">
                                            </a>
                                            <div class="post-image-hover">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                    class="blog-btn">
                                                    <i class="fa-regular fa-link"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                            <h4 class="title line-2">
                                                <a class="color-changer text-dark"
                                                    href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                            </h4>
                                            <span class="blog-created text-muted">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                <span
                                                    class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                            </span>
                                            <div class="description color-changer line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <div class="blog-6 owl-carousel owl-theme">
                        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100 mx-1">
                                <div class="card border h-100 rounded-0 border-0 overflow-hidden">
                                    <div class="blog-6-img">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                alt="blog img" class="w-100 object-fit-cover">
                                        </a>
                                        <div class="post-image-hover">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                class="blog-btn">
                                                <i class="fa-regular fa-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <h4 class="title line-2">
                                            <a class="color-changer text-dark"
                                                href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                        </h4>
                                        <span class="blog-created text-muted">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span class="date"><?php echo e(helper::date_format($blog->created_at)); ?></span>
                                        </span>
                                        <div class="description color-changer line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>



<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-7/home.blade.php ENDPATH**/ ?>