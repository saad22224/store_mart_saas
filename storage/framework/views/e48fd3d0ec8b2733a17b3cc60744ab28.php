<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                <a onclick="GetProductOverview('<?php echo e($item->slug); ?>','')" class="cursor-pointer">
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

<!---------- WHO WE ARE START ---------->
<?php if($whowearedata->count() > 0): ?>
    <section class="my-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-6">
                    <h4 class="fs-5 line-1 color-changer fw-500"><?php echo e(helper::appdata($storeinfo->id)->whoweare_title); ?>

                    </h4>
                    <h3 class="line-2 main-title color-changer fw-600">
                        <?php echo e(helper::appdata($storeinfo->id)->whoweare_subtitle); ?></h3>
                    <p class="m-0 text-muted line-3 fs-15"><?php echo e(helper::appdata($storeinfo->id)->whoweare_description); ?>

                    </p>
                    <div class="col-12">
                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $whowearedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whoweare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="card border rounded-4 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="icon-img-15">
                                                    <img src="<?php echo e(helper::image_path($whoweare->image)); ?>" alt=""
                                                        class="rounded-4 border">
                                                </div>
                                                <div class="tital-15">
                                                    <h6 class="line-1 color-changer fw-600">
                                                        <?php echo e($whoweare->title); ?>

                                                    </h6>
                                                    <p class="m-0 fs-7 fw-500 text-muted mt-1 line-2">
                                                        <?php echo e($whoweare->sub_title); ?></p>
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

<!-- Best-selling-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 1 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($bestsellingitems) > 0): ?>
        <section class="mb-5 product-prev-sec p-0">
            <div class="container">
                <div class="sec-header py-2 mb-3">
                    <h4 class="main-title color-changer mb-2"><?php echo e(trans('labels.selling_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.selling_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 g-3 recipe-card">
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
                            <div class="product-card-box h-100">
                                <div class="product-details-wrap">
                                    <div class="reponsive-flex gap-2">
                                        <div class="content-side w-100 p-0">
                                            <div>
                                                <div class="d-flex gap-2 mb-1">
                                                    <?php if($off > 0): ?>
                                                        <div class="sale-label-on rounded-1 position-static res-bg">
                                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($item->stock_management == 1): ?>
                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                            <div class="out-stock">
                                                                <span class="out-stock-indicator-dot"></span>
                                                                <p class="out-stock-text m-0">
                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                </p>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="in-stock">
                                                                <span class="in-stock-indicator-dot"></span>
                                                                <p class="in-stock-text m-0">
                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                    <h4 id="itemname"
                                                        class="line-2 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> color-changer text-dark">
                                                        <?php echo e($item->item_name); ?>

                                                    </h4>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="pro-pricing m-0 ">
                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                    </p>
                                                </div>
                                                <?php if($original_price > $price): ?>
                                                    <p class="text-muted pro-org-value">
                                                        <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                        <p class="m-0 rating-star d-inline cursor-pointer"
                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                            <span
                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                        </p>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                        <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                            class="btn-sm btn-Wishlist3 cursor-pointer">
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
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="content-side p-0">

                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                <div class="product-img mb-3">
                                                    <?php if(@$item['product_image']->image == null): ?>
                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                            class="cursor-pointer" alt="product image">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                            class="cursor-pointer" alt="product image">
                                                    <?php endif; ?>

                                                </div>
                                            </a>
                                            <button class="btn btn-sm m-0 py-1 p-0 btn-content"
                                                id="verifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>"
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
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<!-- feature-sec -->
<?php if($bannerimage2->count() > 0): ?>
    <section class="feature-sec my-5 my-md-5">
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

<?php if(helper::getcategory($storeinfo->id)->count() > 0): ?>
    <div class="product-sec2 mt-sm-5 mt-3">
        <div class="container">
            <div class="product-display mt-4 mb-5 row">
                <div class="side-sticky col-lg-3 col-xl-3 d-none d-lg-block">
                    <div class="side-menu-list <?php echo e(session()->get('direction') == 2 ? 'text-right' : 'text-left'); ?>">
                        <div class="card card-bg card-header cat-dispaly bg-transparent px-0">
                            <div class=" d-inline-block">
                                <h4
                                    class="theme-4-title color-changer <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> m-0">
                                    <?php echo e(trans('labels.category')); ?>

                                </h4>
                            </div>
                        </div>

                        <?php $__currentLoopData = helper::getcategory($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $check_cat_count = 0;
                            ?>
                            <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($category->id, explode('|', $item->cat_id))): ?>
                                    <?php
                                        $check_cat_count++;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($check_cat_count > 0): ?>
                                <div>
                                    <a class="nav-link  <?php echo e(session()->get('direction') == 2 ? 'rtl-side-cat-check' : 'side-cat-check'); ?> btn-sm <?php echo e($key == 0 ? 'active' : ''); ?> <?php echo e($category->slug); ?>"
                                        href="#<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div
                    class="cat-product col-lg-9 col-xl-9 <?php echo e(session()->get('direction') == 2 ? 'pr-3' : 'pl-3'); ?> custom-categories-main-sec">
                    <?php $__currentLoopData = helper::getcategory($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $check_cat_count = 0;
                        ?>
                        <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(in_array($category->id, explode('|', $item->cat_id))): ?>
                                <?php
                                    $check_cat_count++;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($check_cat_count > 0): ?>
                            <div class="card card-header card-bg responsive-padding-top bg-transparent px-0 custom-cat-name-sec mb-1 mt-4"
                                id="<?php echo e($category->slug); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-inline-block">
                                        <h4 class="theme-4-title m-0 color-changer"><?php echo e($category->name); ?> (<?php echo e($check_cat_count); ?>)
                                        </h4>
                                    </div>
                                    <div class="d-none">
                                        <a href="#" class="btn-category"><?php echo e(trans('labels.view_all')); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div
                            class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 recipe-card custom-product-card g-3">
                            <?php if(!helper::getcategory($storeinfo->id)->isEmpty()): ?>
                                <?php $i = 0; ?>
                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                    if (
                                                        $item->item_price >
                                                        @helper::top_deals($storeinfo->id)->offer_amount
                                                    ) {
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
                                    <?php if(in_array($category->id, explode('|', $item->cat_id))): ?>
                                        <div class="col custom-product-column" id="pro-box">
                                            <div class="product-card-box h-100">
                                                <div class="product-details-wrap">
                                                    <div class="reponsive-flex gap-2">
                                                        <div class="content-side w-100 p-0">
                                                            <div>
                                                                <div class="d-flex gap-2 mb-1">
                                                                    <?php if($off > 0): ?>
                                                                        <div
                                                                            class="sale-label-on rounded-1 position-static res-bg">
                                                                            <?php echo e($off); ?>%
                                                                            <?php echo e(trans('labels.off')); ?></div>
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
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                    <h4 id="itemname" class="line-2 color-changer text-dark <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                                        <?php echo e($item->item_name); ?>

                                                                    </h4>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <p class="pro-pricing m-0 ">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                    </p>
                                                                </div>
                                                                <?php if($original_price > $price): ?>
                                                                    <p class="text-muted pro-org-value">
                                                                        <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                        <p class="m-0 rating-star d-inline cursor-pointer"
                                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')"
                                                                            aria-controls="offcanvasRight">
                                                                            <i
                                                                                class="fa-solid fa-star text-warning"></i>
                                                                            <span
                                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                                            class="btn-sm btn-Wishlist3 cursor-pointer">
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
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="content-side p-0">
                                                            <a
                                                                href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                                <div class="product-img mb-3">
                                                                    <?php if(@$item['product_image']->image == null): ?>
                                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                            class="cursor-pointer"
                                                                            alt="product image">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                            class="cursor-pointer"
                                                                            alt="product image">
                                                                    <?php endif; ?>

                                                                </div>
                                                            </a>
                                                            <button class="btn btn-sm m-0 py-1 p-0 btn-content"
                                                                id="verifybtn<?php echo e($key); ?>_<?php echo e($category->id); ?>"
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
                                            </div>
                                        </div>
                                        <?php $i += 1; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($bannerimage1->count() > 0): ?>
    <section class="feature-sec my-4 my-lg-5">
        <div class="container">
            <div class="feature-carousel owl-carousel owl-rtl owl-theme">
                <?php $__currentLoopData = $bannerimage1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($image->type == 1): ?>
                        <a href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . @$image['category_info']->slug)); ?>"
                            class="cursor-pointer">
                        <?php elseif($image->type == 2): ?>
                            <?php
                                $item = helper::itemdetails($image->product_id, $storeinfo->id);
                            ?>
                            <a onclick="GetProductOverview('<?php echo e($item->slug); ?>','')" class="cursor-pointer">
                            <?php else: ?>
                                <a href="javascript:void(0)" class="cursor-pointer">
                    <?php endif; ?>
                    <div class="item ">
                        <div class="feature-box">
                            <img src='<?php echo e(helper::image_path($image->banner_image)); ?>' alt="" class="">
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
    <?php echo $__env->make('front.testimonial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!-- Top-Rated-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 2 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($toprateditems) > 0): ?>
        <section class="mb-5 product-prev-sec p-0">
            <div class="container">
                <div class="sec-header py-2 mb-3">
                    <h4 class="main-title color-changer mb-2"><?php echo e(trans('labels.top_rated_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.top_rated_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 g-3 recipe-card">
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
                            <div class="product-card-box h-100">
                                <div class="product-details-wrap">
                                    <div class="reponsive-flex gap-2">
                                        <div class="content-side w-100 p-0">
                                            <div>
                                                <div class="d-flex gap-2 mb-1">
                                                    <?php if($off > 0): ?>
                                                        <div class="sale-label-on rounded-1 position-static res-bg">
                                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($item->stock_management == 1): ?>
                                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                            <div class="out-stock">
                                                                <span class="out-stock-indicator-dot"></span>
                                                                <p class="out-stock-text m-0">
                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                </p>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="in-stock">
                                                                <span class="in-stock-indicator-dot"></span>
                                                                <p class="in-stock-text m-0">
                                                                    <?php echo e(trans('labels.in_stock')); ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                    <h4 id="itemname" class="line-2 color-changer text-dark <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                        <?php echo e($item->item_name); ?>

                                                    </h4>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="pro-pricing m-0 ">
                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                    </p>
                                                </div>
                                                <?php if($original_price > $price): ?>
                                                    <p class="text-muted pro-org-value">
                                                        <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                        <p class="m-0 rating-star d-inline cursor-pointer"
                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                            <span
                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                        </p>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                        <a onclick="managefavorite('<?php echo e($item->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                                            class="btn-sm btn-Wishlist3 cursor-pointer">
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
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="content-side p-0">

                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                <div class="product-img mb-3">
                                                    <?php if(@$item['product_image']->image == null): ?>
                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                            class="cursor-pointer" alt="product image">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                            class="cursor-pointer" alt="product image">
                                                    <?php endif; ?>

                                                </div>
                                            </a>
                                            <button class="btn btn-sm m-0 py-1 p-0 btn-content"
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
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<!-- blog -->
<?php if(helper::getblogs($storeinfo->id)->count() > 0): ?>
    <section class="blog-6-sec">
        <?php
            $blog = helper::getblogs($storeinfo->id);
        ?>
        <div class="container">
            <div class="sec-header py-2 mb-3">
                <h4 class="main-title color-changer mb-2"><?php echo e(trans('labels.our_latest_blogs')); ?></h4>
                <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.our_latest_blogs_subtitle')); ?></p>
            </div>
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
                        <div class="blog-6 owl-carousel owl-theme overflow-hidden">
                            <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 mx-1">
                                    <div class="card border h-100 rounded-3 p-2">
                                        <div class="blog-6-img rounded-3">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                    alt="blog img" class="w-100 object-fit-cover">
                                            </a>
                                            <div class="post-image-hover">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                    class="blog-btn">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                            <h4 class="title line-2">
                                                <a
                                                    href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>" class="color-changer text-dark"><?php echo e($blog->title); ?></a>
                                            </h4>
                                            <span class="blog-created text-muted">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                <span
                                                    class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                            </span>
                                            <div class="description text-muted line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <div class="blog-6 owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100 mx-1">
                                <div class="card border h-100 rounded-3 p-2">
                                    <div class="blog-6-img rounded-3">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                alt="blog img" class="w-100 object-fit-cover">
                                        </a>
                                        <div class="post-image-hover">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                class="blog-btn">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <h4 class="title line-2">
                                            <a
                                                href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                        </h4>
                                        <span class="blog-created">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span
                                                class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                        </span>
                                        <div class="description line-2"><?php echo Str::limit($blog->description, 200); ?></div>
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
<!--------- newsletter --------->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-3/home.blade.php ENDPATH**/ ?>