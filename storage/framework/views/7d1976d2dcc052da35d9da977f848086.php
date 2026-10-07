<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------ breadcrumb ------>
<section class="breadcrumb-sec bg-change-mode">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>">Home</a>
                </li>
                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> active"
                    aria-current="page"><?php echo e(trans('labels.wishlist')); ?></li>
            </ol>
        </nav>
    </div>
</section>
<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="user-bg-color mb-5">
            <div class="container">
                <div class="row">
                    <?php echo $__env->make('front.theme.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-xl-9 col-lg-8 col-xxl-9 col-12">
                        <div class="card-v p-0 border rounded user-form">
                            <div class="settings-box">
                                <div class="settings-box-header border-bottom px-4 py-3">
                                    <h5 class="mb-0 color-changer"><i class="fa-regular fa-heart"></i><span
                                            class="px-2"><?php echo e(trans('labels.wishlist')); ?></span></h5>
                                </div>
                                <?php if($getitem->count() > 0): ?>
                                    <div class="p-3">
                                        <?php if(helper::appdata($storeinfo->id)->template == 1): ?>
                                            <div
                                                class="row recipe-card row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col custom-product-column">
                                                        <div class="pro-box">
                                                            <div class="pro-img ">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <?php
                                                                    if (
                                                                        $item->top_deals == 1 &&
                                                                        helper::top_deals($storeinfo->id) != null
                                                                    ) {
                                                                        if (
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_type == 1
                                                                        ) {
                                                                            if ($item['variation']->count() > 0) {
                                                                                if (
                                                                                    $item['variation'][0]->price >
                                                                                    @helper::top_deals($storeinfo->id)
                                                                                        ->offer_amount
                                                                                ) {
                                                                                    $price =
                                                                                        $item['variation'][0]->price -
                                                                                        @helper::top_deals(
                                                                                            $storeinfo->id,
                                                                                        )->offer_amount;
                                                                                } else {
                                                                                    $price =
                                                                                        $item['variation'][0]->price;
                                                                                }
                                                                            } else {
                                                                                if (
                                                                                    $item->item_price >
                                                                                    @helper::top_deals($storeinfo->id)
                                                                                        ->offer_amount
                                                                                ) {
                                                                                    $price =
                                                                                        $item->item_price -
                                                                                        @helper::top_deals(
                                                                                            $storeinfo->id,
                                                                                        )->offer_amount;
                                                                                } else {
                                                                                    $price = $item->item_price;
                                                                                }
                                                                            }
                                                                        } else {
                                                                            if ($item['variation']->count() > 0) {
                                                                                $price =
                                                                                    $item['variation'][0]->price -
                                                                                    $item['variation'][0]->price *
                                                                                        (@helper::top_deals(
                                                                                            $storeinfo->id,
                                                                                        )->offer_amount /
                                                                                            100);
                                                                            } else {
                                                                                $price =
                                                                                    $item->item_price -
                                                                                    $item->item_price *
                                                                                        (@helper::top_deals(
                                                                                            $storeinfo->id,
                                                                                        )->offer_amount /
                                                                                            100);
                                                                            }
                                                                        }
                                                                        if ($item['variation']->count() > 0) {
                                                                            $original_price =
                                                                                $item['variation'][0]->price;
                                                                        } else {
                                                                            $original_price = $item->item_price;
                                                                        }
                                                                        $off =
                                                                            $original_price > 0
                                                                                ? number_format(
                                                                                    100 -
                                                                                        ($price * 100) /
                                                                                            $original_price,
                                                                                    1,
                                                                                )
                                                                                : 0;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                        $original_price = $item->original_price;
                                                                        if ($item['variation']->count() > 0) {
                                                                            $price = $item['variation'][0]->price;
                                                                            $original_price =
                                                                                $item['variation'][0]->original_price;
                                                                        } else {
                                                                            $price = $item->item_price;
                                                                            $original_price =
                                                                                $item->item_original_price;
                                                                        }
                                                                        $off =
                                                                            $original_price > 0
                                                                                ? number_format(
                                                                                    100 -
                                                                                        ($price * 100) /
                                                                                            $original_price,
                                                                                    1,
                                                                                )
                                                                                : 0;
                                                                    }
                                                                ?>

                                                                <div class="sale-heart">
                                                                    <?php if($off > 0): ?>
                                                                        <div class="sale-label-on"><?php echo e($off); ?>%
                                                                            <?php echo e(trans('labels.off')); ?></div>
                                                                    <?php endif; ?>
                                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                            <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                class="btn-sm btn-Wishlist cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
                                                                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                    <?php

                                                                                        $favorite = helper::ceckfavorite(
                                                                                            $item->id,
                                                                                            $storeinfo->id,
                                                                                            Auth::user()->id,
                                                                                        );

                                                                                    ?>
                                                                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                        <i
                                                                                            class="fa-solid fa-heart"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="product-details-wrap">
                                                                <div class="product-details-inner  mb-2 line-2">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <h4 id="itemname"
                                                                            class="color-changer text-dark <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                                            <?php echo e($item->item_name); ?></h4>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="pro-footer">
                                                                <div class="d-flex justify-content-between">
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="m-0 rating-star d-inline cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text m-0">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text m-0">
                                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div
                                                                    class="d-flex align-items-baseline flex-wrap gap-1">
                                                                    <p class="pro-pricing color-changer line-1">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                    </p>
                                                                    <?php if($original_price > $price): ?>
                                                                        <p class="pro-pricing pro-org-value line-1 m-0">
                                                                            <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <button
                                                                    class="btn btn-sm m-0 py-1 w-100 btn-content rounded-5"
                                                                    id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 2): ?>
                                            <div
                                                class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 recipe-card">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="card p-2 border rounded-0 custom-product-column h-100"
                                                            id="pro-box">
                                                            <a
                                                                href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                <div class="image">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="cursor-pointer object w-100 theme-2-img"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="cursor-pointer object w-100 theme-2-img"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </a>
                                                            <?php if($off > 0): ?>
                                                                <div class="sale-heart">
                                                                    <div class="sale-label-on rounded-0">
                                                                        <?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="card-body pb-2 rounded-0 px-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h6 id="itemname"
                                                                        class="fw-600 color-changer text-dark line-2 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> cursor-pointer">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h6>
                                                                </a>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <span
                                                                                class="rating-star d-inline d-flex align-items-center cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')"
                                                                                aria-controls="offcanvasRight">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text m-0">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text m-0">
                                                                                    <?php echo e(trans('labels.in_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div class="item-stock text-center rounded-0">
                                                                            <span
                                                                                class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card-footer p-0 bg-transparent border-0">
                                                                <div
                                                                    class="d-flex align-items-center gap-2 justify-content-between w-100 mb-2">
                                                                    <div
                                                                        class="d-flex flex-wrap gap-1 align-items-center">
                                                                        <p class="card-text pro-value">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <del class="card-text pro-org-value m-0">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </del>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                            <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                class="btn-sm btn-Wishlist2 cursor-pointer">
                                                                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                    <?php

                                                                                        $favorite = helper::ceckfavorite(
                                                                                            $item->id,
                                                                                            $storeinfo->id,
                                                                                            Auth::user()->id,
                                                                                        );

                                                                                    ?>
                                                                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                        <i
                                                                                            class="fa-solid fa-heart"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <button
                                                                    class="btn btn-sm m-0 py-1 btn-content col-12 rounded-0 btn-100"
                                                                    id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                    <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 3): ?>
                                            <div
                                                class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 recipe-card">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="product-card-box card h-100">
                                                            <div class="product-details-wrap">
                                                                <div class="content-side p-0">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <div class="border rounded overflow-hidden">
                                                                            <?php if(@$item['product_image']->image == null): ?>
                                                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                                    class="cursor-pointer theme-3-img"
                                                                                    alt="product image">
                                                                            <?php else: ?>
                                                                                <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                                    class="cursor-pointer theme-3-img"
                                                                                    alt="product image">
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="card-body content-side w-100 p-3 px-0">
                                                                    <?php if($off > 0): ?>
                                                                        <div
                                                                            class="sale-label-on rounded-1 position-static res-bg">
                                                                            <?php echo e($off); ?>%
                                                                            <?php echo e(trans('labels.off')); ?>

                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <h4 id="itemname"
                                                                            class="line-2 color-changer text-dark fs-7 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                                            <?php echo e($item->item_name); ?>

                                                                        </h4>
                                                                    </a>
                                                                    <div
                                                                        class="d-flex justify-content-between gap-2 mb-1">
                                                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                                <p class="m-0 rating-star gap-1 d-inline cursor-pointer"
                                                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                    <i
                                                                                        class="fa-solid fa-star text-warning"></i>
                                                                                    <span
                                                                                        class="color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        <?php if($item->stock_management == 1): ?>
                                                                            <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                                <div class="out-stock">
                                                                                    <span
                                                                                        class="out-stock-indicator-dot"></span>
                                                                                    <p class="out-stock-text m-0">
                                                                                        <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                    </p>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="in-stock">
                                                                                    <span
                                                                                        class="in-stock-indicator-dot"></span>
                                                                                    <p class="in-stock-text m-0">
                                                                                        <?php echo e(trans('labels.in_stock')); ?>

                                                                                    </p>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center gap-2">
                                                                        <div
                                                                            class="d-flex flex-wrap align-items-center">
                                                                            <div>
                                                                                <p class="pro-pricing m-0">
                                                                                    <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                                </p>
                                                                            </div>
                                                                            <?php if($original_price > $price): ?>
                                                                                <p class="text-muted pro-org-value">
                                                                                    <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                                <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                    class="btn-sm btn-Wishlist3 cursor-pointer col-auto">
                                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                        <?php

                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $item->id,
                                                                                                $storeinfo->id,
                                                                                                Auth::user()->id,
                                                                                            );

                                                                                        ?>
                                                                                        <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div class="item-stock text-center"><span
                                                                                class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <div class="card-footer p-0 bg-transparent border-0">
                                                                    <button
                                                                        class="btn btn-sm m-0 py-1 w-100 p-0 btn-content"
                                                                        id="verifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 4): ?>
                                            <div
                                                class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3 recipe-card">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="card pro-card h-100">
                                                            <div class="sale-heart">
                                                                <?php if($off > 0): ?>
                                                                    <div class="sale-label-on rounded-1">
                                                                        <?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                            class="btn-sm btn-Wishlist cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
                                                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                <?php

                                                                                    $favorite = helper::ceckfavorite(
                                                                                        $item->id,
                                                                                        $storeinfo->id,
                                                                                        Auth::user()->id,
                                                                                    );

                                                                                ?>
                                                                                <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                    <i class="fa-solid fa-heart "></i>
                                                                                <?php else: ?>
                                                                                    <i class="fa-light fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                <i class="fa-light fa-heart"></i>
                                                                            <?php endif; ?>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>

                                                            <a
                                                                href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                <div class="rounded-0">
                                                                    <div class="position-relative">
                                                                        <?php if(@$item['product_image']->image == null): ?>
                                                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                                class="card-img-top  rounded-0 cursor-pointer"
                                                                                alt="product image">
                                                                        <?php else: ?>
                                                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                                class="card-img-top  rounded-0 cursor-pointer"
                                                                                alt="product image">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div class="card-body pro-body">
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div class="out-stock">
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text m-0">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="in-stock">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
                                                                            <p class="in-stock-text m-0">
                                                                                <?php echo e(trans('labels.in_stock')); ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <div class="h-60px">
                                                                        <h5 class="pro-title cp color-changer text-dark line-2"
                                                                            id="itemname">
                                                                            <?php echo e($item->item_name); ?>

                                                                        </h5>
                                                                    </div>
                                                                </a>
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                        <p class="my-2 rating-star cursor-pointer"
                                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                            <i
                                                                                class="fa-solid fa-star text-warning"></i>
                                                                            <span
                                                                                class="px-1 color-changer cp"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <div
                                                                    class="d-flex align-items-baseline justify-content-center">
                                                                    <div class="d-flex align-items-baseline">
                                                                        <p class="pro-text ">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <p
                                                                                class="pro-text pro-org-value text-muted">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-inline-block">
                                                                <button
                                                                    class="btn color-changer hide-cart-btn w-100 m-0"
                                                                    id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                                            </div>
                                                            <?php if($item->stock_management == 1): ?>
                                                                <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                    <div class="item-stock text-center"><span
                                                                            class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 5): ?>
                                            <div
                                                class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col them-5-card">
                                                        <div class="card h-100 w-100 product-card">
                                                            <div class="sale-heart">
                                                                <?php if($off > 0): ?>
                                                                    <div class="sale-label-on rounded-1">
                                                                        <?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                            class="btn-sm btn-Wishlist cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
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
                                                                                    <i class="fa-light fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                <i class="fa-light fa-heart"></i>
                                                                            <?php endif; ?>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="them-5img d-flex justify-content-center">
                                                                <div class="testing-card">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <?php if(@$item['product_image']->image == null): ?>
                                                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                                class="w-100 h-100 object-fit-cover rounded-2"
                                                                                alt="product image">
                                                                        <?php else: ?>
                                                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                                class="w-100 h-100 object-fit-cover rounded-2"
                                                                                alt="product image">
                                                                        <?php endif; ?>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="card-body them-5-card-body">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <div>
                                                                        <h4
                                                                            class="them-5-card-title color-changer text-dark mt-3 mb-2">
                                                                            <?php echo e($item->item_name); ?>

                                                                        </h4>
                                                                    </div>
                                                                </a>
                                                                <div
                                                                    class="d-flex flex-wrap gap-2 justify-content-between align-items-center my-2">
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="rating-star cursor-pointer cursor-pointer mb-0"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text m-0">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text m-0">
                                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-baseline">
                                                                        <p class="price color-changer m-0">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <p class="theme-5-false-price">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="card-footer border-0 bg-transparent px-0 pb-0">
                                                                    <button type="button"
                                                                        id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        class="btn-outline-dark them-5-btn-hover w-100 btn-sm rounded-1 p-1 m-0"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                                                </div>
                                                            </div>
                                                            <?php if($item->stock_management == 1): ?>
                                                                <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                    <div class="item-stock text-center"><span
                                                                            class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 6): ?>
                                            <div
                                                class="products-6 row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $i = 0; ?>
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col pro-6 sal-padding">
                                                        <div class="card product-grid-item">
                                                            <div class="sale-heart">
                                                                <?php if($off > 0): ?>
                                                                    <div class="sale-label-on"><?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <div
                                                                            class="pro-like <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
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
                                                                                        <i
                                                                                            class="fa-solid fa-heart text-white"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="pro-6-img">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-0"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-0"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                            </div>

                                                            <div class="card-body pb-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h4
                                                                        class="pro-6-title color-changer text-dark line-2">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h4>
                                                                </a>
                                                            </div>
                                                            <div class="card-footer">
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                        <p class="mb-2 rating-star cursor-pointer cursor-pointer"
                                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                            <i
                                                                                class="fa-solid fa-star text-warning"></i>
                                                                            <span
                                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <div class="d-flex justify-content-between ">
                                                                    <div class="d-flex">
                                                                        <p class="price color-changer m-0">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <p class="old-price">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text">
                                                                                    <?php echo e(trans('labels.in_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <button class="btn btn-cart m-0"
                                                                        id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        <?php endif; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 7): ?>
                                            <div
                                                class="row g-3 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 pro-7-sec">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col pro-7">
                                                        <div class="card card-bg h-100 rounded-0">
                                                            <div class="pro-7-img">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
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
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if($item['multi_image']->count() > 1): ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                                            alt="pro img"
                                                                            class="w-100 obaject-fit-cover cursor-pointer img-2">
                                                                    <?php endif; ?>
                                                                </a>

                                                                <?php if($off > 0): ?>
                                                                    <div class="offer-7 rounded-0 ltr">
                                                                        <?php echo e($off); ?>%
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
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
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
                                                                                <i
                                                                                    class="fa-regular fa-cart-shopping"></i>
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
                                                                            <i
                                                                                class="fa-solid fa-star text-warning"></i>
                                                                            <span
                                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h4 id="itemname"
                                                                        class="title color-changer text-dark mb-2 line-2">
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
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?></p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="in-stock mt-1">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
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
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 8): ?>
                                            <div
                                                class="pro-8 position-relative g-3 row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1">
                                                <?php $i = 0; ?>
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="card h-100 w-100 border overflow-hidden">
                                                            <?php if($off > 0): ?>
                                                                <div class="sale-label-on ltr"><?php echo e($off); ?>%
                                                                    <?php echo e(trans('labels.off')); ?></div>
                                                            <?php endif; ?>
                                                            <div class="pro-8-img position-relative">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if($item['multi_image']->count() > 1): ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                                            alt="product image"
                                                                            class="w-100 object-fit-cover img-flip">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <ul class="outer-functional">
                                                                    <li>
                                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                                <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                    class="cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>"
                                                                                    title="wishlist">
                                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                        <?php
                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $item->id,
                                                                                                $storeinfo->id,
                                                                                                Auth::user()->id,
                                                                                            );
                                                                                        ?>
                                                                                        <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                                    <li>
                                                                        <button class="btn p-0 border-0"
                                                                            title="cart"
                                                                            id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                            onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                            <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                                <i
                                                                                    class="fa-regular fa-cart-shopping"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa-regular fa-eye"></i>
                                                                            <?php endif; ?>
                                                                        </button>
                                                                    </li>
                                                                </ul>

                                                                <!-- in-stock -->
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div
                                                                            class="out-stock m-0 badge bg-white border rounded-pill rounded-0">
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div
                                                                            class="in-stock m-0 badge bg-white border rounded-pill rounded-0">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
                                                                            <p class="in-stock-text">
                                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="card-body pb-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h4 class="title line-2 text-secondary">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h4>
                                                                </a>
                                                            </div>
                                                            <div class="card-footer bg-transparent border-0">
                                                                <!-- rating -->
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mb-2 ">
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="m-0 rating-star cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <!-- price -->
                                                                <p class="price color-changer m-0">
                                                                    <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>


                                                                    <!-- false-price -->
                                                                    <?php if($original_price > $price): ?>
                                                                        <span class="theme-5-false-price">
                                                                            <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 9): ?>
                                            <div
                                                class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="card card-bg pro-9 h-100 bg-transparent">
                                                            <div class="pro-9-img">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <!-- wishlist -->
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <div
                                                                            class="wishlist <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                            <a onclick="managefavorite('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                title="wishlist">
                                                                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                    <?php

                                                                                        $favorite = helper::ceckfavorite(
                                                                                            $item->id,
                                                                                            $storeinfo->id,
                                                                                            Auth::user()->id,
                                                                                        );

                                                                                    ?>
                                                                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                        <i
                                                                                            class="fa-solid fa-heart"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <!-- add to cart -->
                                                                <div class="position-absolute bottom-12 w-100 d-flex">
                                                                    <button class="btn pro-9-add mx-3 hover-none"
                                                                        id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        title="cart"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                                                    </button>
                                                                </div>

                                                                <!-- stock -->
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div
                                                                            class="out-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div
                                                                            class="in-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
                                                                            <p class="in-stock-text">
                                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>


                                                            <div class="card-body p-2 p-sm-3 pb-0 pb-sm-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h4 class="title line-2 color-changer text-dark">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h4>
                                                                </a>
                                                            </div>
                                                            <div
                                                                class="card-footer bg-transparent border-0 p-2 p-sm-3">
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <div
                                                                        class="d-flex alogn-items-center justify-content-between mb-2 ">
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="m-0 rating-star cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <!-- price -->
                                                                <div
                                                                    class="d-flex flex-wrap gap-1 justify-content-between">
                                                                    <p
                                                                        class="price color-changer m-0 d-flex flex-wrap gap-1 align-items-center">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        <!-- old-price -->
                                                                        <?php if($original_price > $price): ?>
                                                                            <span class="old-price">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                    <?php if($off > 0): ?>
                                                                        <div class="discount ltr fs-7 fw-500">
                                                                            (<?php echo e($off); ?>%
                                                                            <?php echo e(trans('labels.off')); ?>)
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 10): ?>
                                            <div
                                                class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 theme-10">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div
                                                            class="card pro-box border h-100 rounded-0 position-relative p-0">
                                                            <div class="pro-img rounded-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-2"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                            </div>
                                                            <?php if($off > 0): ?>
                                                                <div
                                                                    class="ribbon-pop <?php echo e(session()->get('direction') == 2 ? 'rtl rounded-start-5' : 'rounded-end-5'); ?>">
                                                                    <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="card-body product-details-wrap p-2">
                                                                <div
                                                                    class="icon-cart-hart <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                                    <div class="d-flex gap-2 justify-content-end">
                                                                        <!-- wishlist -->
                                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                                <div
                                                                                    class="wishlist <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                                    <a onclick="managefavorite('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                        title="wishlist"
                                                                                        class="btn-sm btn-Wishlist shadow">
                                                                                        <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                            <?php
                                                                                                $favorite = helper::ceckfavorite(
                                                                                                    $item->id,
                                                                                                    $storeinfo->id,
                                                                                                    Auth::user()->id,
                                                                                                );
                                                                                            ?>
                                                                                            <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                                <i
                                                                                                    class="fa-solid fa-heart"></i>
                                                                                            <?php else: ?>
                                                                                                <i
                                                                                                    class="fa-regular fa-heart"></i>
                                                                                            <?php endif; ?>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    </a>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        <button
                                                                            class="btn m-0 btn-sm shadow btn-product-cart"
                                                                            title="cart"
                                                                            id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                            onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                            <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                                <i
                                                                                    class="fa-regular fa-cart-shopping"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa-regular fa-eye"></i>
                                                                            <?php endif; ?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2 line-2">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <h4
                                                                            class="fs-7 fw-600 color-changer text-dark">
                                                                            <?php echo e($item->item_name); ?>

                                                                        </h4>
                                                                    </a>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <!-- rating -->
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                                <p class="m-0 rating-star d-inline cursor-pointer"
                                                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                    <i
                                                                                        class="fa-solid fa-star text-warning"></i>
                                                                                    <span
                                                                                        class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <!-- stock -->
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text">
                                                                                    <?php echo e(trans('labels.in_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-2 border-0 bg-transparent">
                                                                <div
                                                                    class="d-flex align-items-baseline flex-wrap gap-1">
                                                                    <p class="pro-pricing color-changer line-1 m-0">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                    </p>
                                                                    <!-- false-price -->
                                                                    <?php if($original_price > $price): ?>
                                                                        <del class="fs-13 fw-600 text-muted m-0">
                                                                            <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                        </del>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 11): ?>
                                            <div
                                                class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 recipe-card g-3 theme-11-card">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="pro-box h-100 rounded p-0">
                                                            <div class="pro-img rounded-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-2 h-100"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-2 h-100"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <div
                                                                    class="sale-heart flex-wrap justify-content-end gap-2">
                                                                    <div
                                                                        class="d-flex w-100 justify-content-end align-items-center gap-2">
                                                                        <?php if($off > 0): ?>
                                                                            <div
                                                                                class="shadow <?php echo e(session()->get('direction') == 2 ? 'sale-label-on-rtl' : 'sale-label-on'); ?>">
                                                                                <?php echo e($off); ?>%
                                                                                <?php echo e(trans('labels.off')); ?>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                                <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                    class="btn-sm btn-Wishlist shadow cursor-pointer ">
                                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                        <?php
                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $item->id,
                                                                                                $storeinfo->id,
                                                                                                Auth::user()->id,
                                                                                            );
                                                                                        ?>
                                                                                        <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <button class="btn m-0 btn-sm shadow btn-cart"
                                                                        id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        <?php endif; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="product-details-wrap p-2">
                                                                <div class="product-details-inner mb-2 line-2">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <h4 id="itemname"
                                                                            class="color-changer text-dark <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                                            <?php echo e($item->item_name); ?>

                                                                        </h4>
                                                                    </a>
                                                                </div>
                                                                <div class="card-footer border-0 bg-transparent p-0">
                                                                    <div
                                                                        class="d-flex gap-2 flex-wrap justify-content-between">
                                                                        <!-- rating -->
                                                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-between">
                                                                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                                    <p class="m-0 rating-star gap-1 d-inline cursor-pointer"
                                                                                        onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                        <i
                                                                                            class="fa-solid fa-star text-warning"></i>
                                                                                        <span class="color-changer">
                                                                                            <?php echo e(number_format($item->ratings_average, 1)); ?>

                                                                                        </span>
                                                                                    </p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <!-- stock -->
                                                                        <?php if($item->stock_management == 1): ?>
                                                                            <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                                <div class="out-stock">
                                                                                    <span
                                                                                        class="out-stock-indicator-dot"></span>
                                                                                    <p class="out-stock-text m-0">
                                                                                        <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                    </p>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="in-stock">
                                                                                    <span
                                                                                        class="in-stock-indicator-dot"></span>
                                                                                    <p class="in-stock-text m-0">
                                                                                        <?php echo e(trans('labels.in_stock')); ?>

                                                                                    </p>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex align-items-baseline flex-wrap gap-1">
                                                                        <p
                                                                            class="pro-pricing color-changer line-1 m-0">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <p
                                                                                class="pro-pricing pro-org-value line-1 m-0">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 12): ?>
                                            <div
                                                class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div
                                                            class="card border rounded-4 h-100 card__article bg-transparent">
                                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>"
                                                                class=" position-relative">
                                                                <?php if(@$item['product_image']->image == null): ?>
                                                                    <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                        class="card-img-top rounded-4"
                                                                        alt="product image">
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                        class="card-img-top rounded-4"
                                                                        alt="product image">
                                                                <?php endif; ?>
                                                            </a>
                                                            <div
                                                                class="pro-9 p-3 w-100 d-flex justify-content-between align-items-center position-absolute">
                                                                <?php if($off > 0): ?>
                                                                    <div
                                                                        class="discount text-bg-primary fs-13 px-2 py-1 rounded">
                                                                        <?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <!-- wishlist -->
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <div class="wishlist ">
                                                                            <a onclick="managefavorite('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                title="wishlist">
                                                                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                    <?php
                                                                                        $favorite = helper::ceckfavorite(
                                                                                            $item->id,
                                                                                            $storeinfo->id,
                                                                                            Auth::user()->id,
                                                                                        );
                                                                                    ?>
                                                                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                        <i
                                                                                            class="fa-solid fa-heart"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card__data p-3">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-2">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <span
                                                                            class="card__description text-dark line-2">
                                                                            <?php echo e($item->item_name); ?></span>
                                                                    </a>
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <div
                                                                            class="d-flex align-items-center justify-content-between mb-2 ">
                                                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                                <p class="m-0 fs-8 d-flex gap-1 align-items-center fw-500 cursor-pointer"
                                                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                    <i
                                                                                        class="fa-solid fa-star text-warning"></i>
                                                                                    <span>
                                                                                        <?php echo e(number_format($item->ratings_average, 1)); ?>

                                                                                    </span>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <!-- stock -->
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div class="out-stock my-1">
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="in-stock my-1">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
                                                                            <p class="in-stock-text">
                                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <!-- price -->
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                                                    <p class="price m-0 fw-600">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        <!-- old-price -->
                                                                        <?php if($original_price > $price): ?>
                                                                            <del class="old-price fw-500 text-muted">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </del>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                    <button class="btn m-0 btn-sm shadow btn-cart"
                                                                        id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        <?php endif; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 13): ?>
                                            <div
                                                class="theme-13-card row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col sal-padding">
                                                        <div
                                                            class="card border p-sm-3 p-2 h-100 position-relative overflow-hidden">
                                                            <?php if($off > 0): ?>
                                                                <div
                                                                    class="<?php echo e(session()->get('direction') == 2 ? 'sale-label-on-rtl' : 'sale-label-on'); ?> shadow">
                                                                    <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="pro-6-list-img position-relative rounded">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <div class="sale-heart">
                                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                            <div class="pro-like">
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
                                                                                            <i
                                                                                                class="fa-solid fa-heart text-white"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="card-body px-0">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h6
                                                                        class="fw-600 color-changer text-dark line-2 <?php echo e(session()->get('direction') == 2 ? 'ps-1' : 'pe-1'); ?>">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h6>
                                                                </a>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text">
                                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="rating-star color-changer d-flex gap-1 fs-13 align-items-center cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-0 border-0 bg-transparent">
                                                                <div class="d-flex gap-2 justify-content-between">
                                                                    <div
                                                                        class="d-flex gap-1 align-items-center flex-wrap">
                                                                        <p class="price color-changer m-0">
                                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                        <?php if($original_price > $price): ?>
                                                                            <del class="text-muted fw-600 fs-13">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </del>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <button class="btn btn-cart m-0"
                                                                        id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        <?php endif; ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 14): ?>
                                            <div class="pro-7-sec">
                                                <div
                                                    class="row g-3 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 theme-14-card">
                                                    <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if (
                                                                $item->top_deals == 1 &&
                                                                helper::top_deals($storeinfo->id) != null
                                                            ) {
                                                                if (
                                                                    @helper::top_deals($storeinfo->id)->offer_type == 1
                                                                ) {
                                                                    if ($item['variation']->count() > 0) {
                                                                        if (
                                                                            $item['variation'][0]->price >
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount
                                                                        ) {
                                                                            $price =
                                                                                $item['variation'][0]->price -
                                                                                @helper::top_deals($storeinfo->id)
                                                                                    ->offer_amount;
                                                                        } else {
                                                                            $price = $item['variation'][0]->price;
                                                                        }
                                                                    } else {
                                                                        if (
                                                                            $item->item_price >
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount
                                                                        ) {
                                                                            $price =
                                                                                $item->item_price -
                                                                                @helper::top_deals($storeinfo->id)
                                                                                    ->offer_amount;
                                                                        } else {
                                                                            $price = $item->item_price;
                                                                        }
                                                                    }
                                                                } else {
                                                                    if ($item['variation']->count() > 0) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            $item['variation'][0]->price *
                                                                                (@helper::top_deals($storeinfo->id)
                                                                                    ->offer_amount /
                                                                                    100);
                                                                    } else {
                                                                        $price =
                                                                            $item->item_price -
                                                                            $item->item_price *
                                                                                (@helper::top_deals($storeinfo->id)
                                                                                    ->offer_amount /
                                                                                    100);
                                                                    }
                                                                }
                                                                if ($item['variation']->count() > 0) {
                                                                    $original_price = $item['variation'][0]->price;
                                                                } else {
                                                                    $original_price = $item->item_price;
                                                                }
                                                                $off =
                                                                    $original_price > 0
                                                                        ? number_format(
                                                                            100 - ($price * 100) / $original_price,
                                                                            1,
                                                                        )
                                                                        : 0;
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price = $item['variation'][0]->price;
                                                                    $original_price =
                                                                        $item['variation'][0]->original_price;
                                                                } else {
                                                                    $price = $item->item_price;
                                                                    $original_price = $item->item_original_price;
                                                                }
                                                                $off =
                                                                    $original_price > 0
                                                                        ? number_format(
                                                                            100 - ($price * 100) / $original_price,
                                                                            1,
                                                                        )
                                                                        : 0;
                                                            }
                                                        ?>
                                                        <div class="col">
                                                            <div class="card h-100 rounded-0 border">
                                                                <div class="card-img">
                                                                    <a
                                                                        href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                        <?php if(@$item['product_image']->image == null): ?>
                                                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                                class="card-img-top rounded"
                                                                                alt="product image">
                                                                        <?php else: ?>
                                                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                                class="card-img-top rounded"
                                                                                alt="product image">
                                                                        <?php endif; ?>
                                                                    </a>
                                                                    <?php if($item->stock_management == 1): ?>
                                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                            <div class="out-stock">
                                                                                <span
                                                                                    class="out-stock-indicator-dot"></span>
                                                                                <p class="out-stock-text">
                                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="in-stock">
                                                                                <span
                                                                                    class="in-stock-indicator-dot"></span>
                                                                                <p class="in-stock-text">
                                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if($off > 0): ?>
                                                                    <div class="offer-box shadow">
                                                                        <span class="offer-text text-white p-2">
                                                                            <?php echo e($off); ?>%
                                                                            <?php echo e(trans('labels.off')); ?>

                                                                        </span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="card-body border-top">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-start mb-2 gap-2">
                                                                        <a
                                                                            href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                            <h6 id="itemname"
                                                                                class="fs-15 color-changer text-dark fw-600 m-0 line-2">
                                                                                <?php echo e($item->item_name); ?></h6>
                                                                        </a>
                                                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                                <p class="m-0 fs-13 d-flex gap-1 align-items-center pro-rating cursor-pointer"
                                                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                    <i
                                                                                        class="fa-solid fa-star text-warning"></i>
                                                                                    <span
                                                                                        class="color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <p
                                                                        class="pro-pricing color-changer fs-15 line-1 m-0">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                        <?php if($original_price > $price): ?>
                                                                            <del
                                                                                class="old-price fs-13 text-muted fw-600">
                                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                            </del>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="card-footer p-0 overflow-hidden d-flex rounded-0">
                                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                            <a class="wishlist"
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
                                                                                        <i
                                                                                            class="fa-solid fa-heart"></i>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    <i class="fa-regular fa-heart"></i>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <button
                                                                        class="btn btn-sm m-0 btn-primary w-100 rounded-0"
                                                                        id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                        <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php elseif(helper::appdata($storeinfo->id)->template == 15): ?>
                                            <div
                                                class="pro-wishlist-15 row row-cols-xl-4 row-cols-lg-2 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (
                                                            $item->top_deals == 1 &&
                                                            helper::top_deals($storeinfo->id) != null
                                                        ) {
                                                            if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                                                                if ($item['variation']->count() > 0) {
                                                                    if (
                                                                        $item['variation'][0]->price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item['variation'][0]->price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item['variation'][0]->price;
                                                                    }
                                                                } else {
                                                                    if (
                                                                        $item->item_price >
                                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                                    ) {
                                                                        $price =
                                                                            $item->item_price -
                                                                            @helper::top_deals($storeinfo->id)
                                                                                ->offer_amount;
                                                                    } else {
                                                                        $price = $item->item_price;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($item['variation']->count() > 0) {
                                                                    $price =
                                                                        $item['variation'][0]->price -
                                                                        $item['variation'][0]->price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                } else {
                                                                    $price =
                                                                        $item->item_price -
                                                                        $item->item_price *
                                                                            (@helper::top_deals($storeinfo->id)
                                                                                ->offer_amount /
                                                                                100);
                                                                }
                                                            }
                                                            if ($item['variation']->count() > 0) {
                                                                $original_price = $item['variation'][0]->price;
                                                            } else {
                                                                $original_price = $item->item_price;
                                                            }
                                                            $off =
                                                                $original_price > 0
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
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
                                                                    ? number_format(
                                                                        100 - ($price * 100) / $original_price,
                                                                        1,
                                                                    )
                                                                    : 0;
                                                        }
                                                    ?>
                                                    <div class="col">
                                                        <div class="card h-100 rounded-0 w-100 border">
                                                            <div class="pro-8-img position-relative overflow-hidden">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="card-img-top rounded-0"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="card-img-top rounded-0"
                                                                            alt="product image">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <?php if($item['multi_image']->count() > 1): ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['multi_image'][1]->image)); ?>"
                                                                            alt="product image"
                                                                            class="w-100 object-fit-cover img-flip">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <?php if($off > 0): ?>
                                                                    <div class="sale-label-on ltr">
                                                                        <?php echo e($off); ?>%
                                                                        <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <!-- rating -->
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <div
                                                                        class="rating rounded-5 d-flex align-items-center justify-content-between">
                                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                            <p class="m-0 fw-600  d-flex align-items-center gap-1 cursor-pointer"
                                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                                <span
                                                                                    class=""><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                            </p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <ul class="p-0 d-flex flex-column gap-2 m-0 icons-hc">
                                                                    <li>
                                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                                <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                                    class="cursor-pointer wishlist"
                                                                                    title="wishlist">
                                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                        <?php
                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $item->id,
                                                                                                $storeinfo->id,
                                                                                                Auth::user()->id,
                                                                                            );
                                                                                        ?>
                                                                                        <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i
                                                                                            class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                                    <li>
                                                                        <button class="btn p-0 border-0 pro-8-add"
                                                                            title="cart"
                                                                            id="iconverifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                                            onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                            <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                                                                <i
                                                                                    class="fa-regular fa-cart-shopping"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa-regular fa-eye"></i>
                                                                            <?php endif; ?>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body pb-0">
                                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>"
                                                                    class="text-secondary">
                                                                    <h6 class="fs-15 line-2">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h6>
                                                                </a>
                                                                <!-- in-stock -->
                                                                <?php if($item->stock_management == 1): ?>
                                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                        <div class="out-stock m-0">
                                                                            <span
                                                                                class="out-stock-indicator-dot"></span>
                                                                            <p class="out-stock-text">
                                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="in-stock m-0">
                                                                            <span
                                                                                class="in-stock-indicator-dot"></span>
                                                                            <p class="in-stock-text">
                                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card-footer bg-transparent border-0">
                                                                <!-- price -->
                                                                <p class="price color-changer fs-15 m-0">
                                                                    <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                    <!-- false-price -->
                                                                    <?php if($original_price > $price): ?>
                                                                        <del class="fs-13 text-muted">
                                                                            <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                        </del>
                                                                    <?php endif; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <?php echo $getitem->links(); ?>

                                    </div>
                                <?php else: ?>
                                    <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\wishlist.blade.php ENDPATH**/ ?>