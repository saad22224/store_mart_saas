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
                    <div class="item">
                        <div class="feature-box rounded-0">
                            <img src='<?php echo e(helper::image_path($image->banner_image)); ?>' alt="">
                        </div>
                    </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Best-selling-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 1 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($bestsellingitems) > 0): ?>
        <section class="mb-5 product-prev-sec">
            <div class="container">
                <div class="sec-header py-2 mb-3">
                    <h4 class="main-title mb-2 color-changer"><?php echo e(trans('labels.selling_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.selling_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-1 g-3 recipe-card">
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
                            <div class="card box-border <?php echo e(session()->get('direction') == 2 ? 'flex-row-reverse' : ''); ?> custom-product-column"
                                id="pro-box">
                                <div
                                    class="card-body pro-card-body rounded-0 d-flex gap-3 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                    <?php if($off > 0): ?>
                                        <div class="sale-heart">
                                            <div class="sale-label-on rounded-0"><?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <div class="image2">
                                            <?php if(@$item['product_image']->image == null): ?>
                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                    class="card-pro-image cursor-pointer" alt="product image">
                                            <?php else: ?>
                                                <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                    class="card-pro-image cursor-pointer" alt="product image">
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="d-flex w-100 align-items-center">
                                        <div class="w-100">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                <h6 id="itemname"
                                                    class="fw-600 text-dark color-changer line-2 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> cursor-pointer">
                                                    <?php echo e($item->item_name); ?>

                                                </h6>
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center mb-2 ">
                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                        <span
                                                            class="rating-star d-inline d-flex align-items-center cursor-pointer"
                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')"
                                                            aria-controls="offcanvasRight">
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                            <span
                                                                class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                        </span>
                                                    <?php endif; ?>
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
                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-md-flex justify-content-between align-items-center ">
                                                <div class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <p class="card-text pro-value">
                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                        </p>
                                                        <?php if($original_price > $price): ?>
                                                            <p class="card-text pro-org-value">
                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                            <div
                                                                class="<?php echo e(session()->get('direction') == 2 ? 'ms-md-2' : 'me-md-2'); ?>">
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
                                                                            <i class="fa-solid fa-heart"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-heart"></i>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    <?php endif; ?>
                                                                </a>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <button
                                                    class="btn btn-sm mt-md-0 py-1 btn-content col-xl-3 col-lg-4 col-sm-3 col-12 rounded-0 btn-100"
                                                    id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                    <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                            </div>
                                            <?php if($item->stock_management == 1): ?>
                                                <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                    <div class="item-stock text-center rounded-0"><span
                                                            class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
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

<!---------- WHO WE ARE START ---------->
<?php if($whowearedata->count() > 0): ?>
    <section class="my-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-6">
                    <h4 class="fs-5 line-1 color-changer fw-500"><?php echo e(helper::appdata($storeinfo->id)->whoweare_title); ?>

                    </h4>
                    <h3 class="line-2 main-title fw-600 color-changer">
                        <?php echo e(helper::appdata($storeinfo->id)->whoweare_subtitle); ?></h3>
                    <p class="m-0 text-muted line-3 fs-15"><?php echo e(helper::appdata($storeinfo->id)->whoweare_description); ?>

                    </p>
                    <div class="col-12">
                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $whowearedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whoweare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="card border-0 rounded-4 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="icon-img-15">
                                                    <img src="<?php echo e(helper::image_path($whoweare->image)); ?>"
                                                        alt="" class="rounded-4 border">
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

<?php if(helper::getcategory($storeinfo->id)->count() > 0): ?>
    <section class="product-prev-sec product-list-sec pt-0 mt-sm-5 mt-3">
        <div class="container">
            <div class="row product-rev-wrap">
                <div class="col-lg-3 pro-sec pro-top">
                    <div class="card card-bg card-header cat-dispaly bg-transparent px-0">
                        <div class=" d-inline-block">
                            <h4 class="color-changer <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> m-0">
                                <?php echo e(trans('labels.category')); ?>

                            </h4>
                        </div>
                    </div>
                    <div class="cart-pro-head d-none d-lg-block">
                        <div class="cat-aside">
                            <div class="cat-aside-wrap">
                                <?php $__currentLoopData = helper::getcategory($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $check_cat_count = 0; ?>
                                    <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($category->id, explode('|', $item->cat_id))): ?>
                                            <?php $check_cat_count++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($check_cat_count > 0): ?>
                                        <div>
                                            <a href="#<?php echo e($category->slug); ?>"
                                                class="cat-check rounded-0 <?php echo e(session()->get('direction') == 2 ? 'cat-right-margin' : 'cat-left-margin'); ?> border-top-no <?php echo e($key == 0 ? 'active' : ''); ?>">
                                                <p><?php echo e($category->name); ?></p>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="<?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? 'col-lg-6' : 'col-lg-9'); ?> recipe-card custom-categories-main-sec">
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
                            <div class="card card-bg card-header responsive-padding bg-transparent px-0 custom-cat-name-sec mb-1"
                                id="<?php echo e($category->slug); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-inline-block">
                                        <h4
                                            class="sec-title m-0 color-changer <?php echo e(session()->get('direction') == 2 ? 'text-right ' : ''); ?>">
                                            <?php echo e($category->name); ?> (<?php echo e($check_cat_count); ?>)
                                        </h4>
                                    </div>
                                    <div class="d-none">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . $category->slug)); ?>"
                                            class="btn-category"><?php echo e(trans('labels.view_all')); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="custom-product-card">
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
                                        <div class="card mb-3 box-border <?php echo e(session()->get('direction') == 2 ? 'flex-row-reverse' : ''); ?> custom-product-column"
                                            id="pro-box">
                                            <div
                                                class="card-body pro-card-body rounded-0 d-flex gap-3 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                <?php if($off > 0): ?>
                                                    <div class="sale-heart">
                                                        <div class="sale-label-on rounded-0"><?php echo e($off); ?>%
                                                            <?php echo e(trans('labels.off')); ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                    <div class="image2">
                                                        <?php if(@$item['product_image']->image == null): ?>
                                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                                class="card-pro-image cursor-pointer"
                                                                alt="product image">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                                class="card-pro-image cursor-pointer"
                                                                alt="product image">
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                                <div class="d-flex w-100 align-items-center">
                                                    <div class="w-100">
                                                        <a
                                                            href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                            <h6 id="itemname"
                                                                class="fw-600 color-changer text-dark line-2 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> cursor-pointer">
                                                                <?php echo e($item->item_name); ?>

                                                            </h6>
                                                        </a>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2 ">
                                                            <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                    <span
                                                                        class="rating-star d-inline d-flex align-items-center cursor-pointer"
                                                                        onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')"
                                                                        aria-controls="offcanvasRight">
                                                                        <i class="fa-solid fa-star text-warning"></i>
                                                                        <span
                                                                            class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                                    </span>
                                                                <?php endif; ?>
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
                                                                            <?php echo e(trans('labels.in_stock')); ?>

                                                                        </p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div
                                                            class="d-md-flex justify-content-between align-items-center ">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between w-100">
                                                                <div class="d-flex align-items-center">
                                                                    <p class="card-text pro-value">
                                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                                    </p>
                                                                    <?php if($original_price > $price): ?>
                                                                        <p class="card-text pro-org-value">
                                                                            <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                                    <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                                        <div
                                                                            class="<?php echo e(session()->get('direction') == 2 ? 'ms-md-2' : 'me-md-2'); ?>">
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

                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <button
                                                                class="btn btn-sm mt-md-0 py-1 btn-content col-xl-3 col-lg-4 col-sm-3 col-12 rounded-0 btn-100"
                                                                id="verifybtn<?php echo e($key); ?>_<?php echo e($category->id); ?>"
                                                                onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                                <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                                        </div>
                                                        <?php if($item->stock_management == 1): ?>
                                                            <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                                <div class="item-stock text-center rounded-0"><span
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
                <!-- Right Site Cart View Start -->
                <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                    <div class="col-lg-3 d-none d-lg-block d-xl-block pro-sec pro-top">
                        <div class="card card-bg card-header bg-transparent px-0">
                            <div class="d-inline-block">
                                <h4
                                    class="color-changer <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> content">
                                    <?php echo e(trans('labels.cart')); ?>

                                </h4>
                            </div>
                        </div>
                        <div class="cart-pro-head cart-product-list">
                            <div class="cat-aside">
                                <div class="cat-aside-wrap cart-aside">
                                    <div class="card card-bg">
                                        <?php if(count($cartdata) == 0): ?>
                                            <?php
                                                $data = [];
                                            ?>
                                            <img src='<?php echo e(url(env('ASSETPATHURL') . 'front/images/cart.png')); ?>'
                                                alt="" class="shopping-cart content">
                                            <p class="shopping-cart-title mb-0 color-changer content">
                                                <?php echo e(trans('labels.empty_cart')); ?>

                                            </p>
                                            <p class="text-center text-muted content"><?php echo e(trans('labels.choice')); ?></p>
                                        <?php else: ?>
                                            <div
                                                class="card-body p-0  <?php echo e(session()->get('direction') == 2 ? 'pr-0' : 'pl-0'); ?>">
                                                <?php $__currentLoopData = $cartdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                    $data[] = [
                                                        'total_price' => $cart->qty * $cart->item_price,
                                                    ];
                                                    ?>
                                                    <div class="pb-3 border-bottom mb-3">
                                                        <div
                                                            class="d-flex justify-content-between px-0 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                            <h5
                                                                class="card-title color-changer card-font p-0 mb-2 col-8">
                                                                <?php echo e($cart->item_name); ?>

                                                            </h5>
                                                            <div class="pro-delete">
                                                                <i class="fas fa-trash-alt text-danger cp"
                                                                    onclick="RemoveCart('<?php echo e($cart->id); ?>')"></i>
                                                            </div>
                                                        </div>
                                                        <?php if($cart->extras_id != '' || $cart->extras_id != null): ?>
                                                            <p>
                                                                <span type="button" class="text-muted"
                                                                    onclick='showaddons("<?php echo e($cart->id); ?>","<?php echo e($cart->item_name); ?>","<?php echo e($cart->attribute); ?>","<?php echo e($cart->extras_name); ?>","<?php echo e($cart->extras_price); ?>","<?php echo e($cart->variants_name); ?>","<?php echo e($cart->item_price); ?>")'>
                                                                    <?php echo e(trans('labels.customize')); ?> </span>
                                                            </p>
                                                        <?php endif; ?>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p
                                                                class="total-price color-changer m-0 <?php echo e(session()->get('direction') == 2 ? 'text-left' : ''); ?>">
                                                                <?php echo e(helper::currency_formate($cart->item_price, $storeinfo->id, $cart->currency)); ?>

                                                            </p>
                                                            <div
                                                                class="d-flex qty-input2 align-items-center col-xl-4 col-lg-6 rounded-0">
                                                                <a class="btn btn-sm change-qty icon-position"
                                                                    data-type="minus" value="minus value"
                                                                    onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','decreaseValue')">
                                                                    <i class="fa fa-minus"></i>
                                                                </a>
                                                                <input type="number"
                                                                    class="border color-changer bg-transparent text-center"
                                                                    name="number" value="<?php echo e($cart->qty); ?>"
                                                                    id="number_<?php echo e($cart->id); ?>" min="1"
                                                                    max="10" readonly>
                                                                <a class="btn btn-sm change-qty icon-position"
                                                                    data-type="plus"
                                                                    onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','increase')"
                                                                    value="plus value"><i class="fa fa-plus"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(count($cartdata) > 0): ?>
                            <div class="card border rounded-0 bg-light">
                                <div class="card-body py-3 px-2">
                                    <div class="position p-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <?php
                                            $sub_total = array_sum(array_column(@$data, 'total_price'));
                                            $total = array_sum(array_column(@$data, 'total_price'));
                                            ?>
                                            <div
                                                class="col-8 px-0 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                                <h6 class="mb-0 color-changer fw-semibold">
                                                    <?php echo e(trans('labels.sub_total')); ?>

                                                </h6>
                                                <small class="text-muted"><?php echo e(trans('labels.extra_charges')); ?></small>
                                            </div>
                                            <div class="col-4 px-0">
                                                <h6 class="text-dark color-changer m-0 fw-semibold <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?> sub-total"
                                                    id="subtotal">
                                                    <?php echo e(helper::currency_formate($sub_total, $storeinfo->id)); ?>

                                                </h6>
                                            </div>
                                        </div>
                                        <div class="mt-3 check-btn">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/cart/')); ?>"
                                                class="btn w-100 btn-lg d-flex align-items-center justify-content-center rounded-0"><?php echo e(trans('labels.checkout')); ?>

                                                <div class="px-2">
                                                    <i class="fas fa-long-arrow-alt-right align-middle"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <!-- Right Site Cart View End -->
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- feature-sec -->
<?php if($bannerimage2->count() > 0): ?>
    <section class="feature-sec my-5 my-md-5">
        <div class="container">
            <div class="feature-carousel-12 owl-carousel owl-theme">
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


<!-- Top-Rated-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 2 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($toprateditems) > 0): ?>
        <section class="mb-5 product-prev-sec">
            <div class="container">
                <div class="sec-header py-2 mb-3">
                    <h4 class="main-title color-changer mb-2"><?php echo e(trans('labels.top_rated_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.top_rated_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-1 g-3 recipe-card">
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
                            <div class="card box-border <?php echo e(session()->get('direction') == 2 ? 'flex-row-reverse' : ''); ?> custom-product-column"
                                id="pro-box">
                                <div
                                    class="card-body pro-card-body rounded-0 d-flex gap-3 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?>">
                                    <?php if($off > 0): ?>
                                        <div class="sale-heart">
                                            <div class="sale-label-on rounded-0"><?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <div class="image2">
                                            <?php if(@$item['product_image']->image == null): ?>
                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                    class="card-pro-image cursor-pointer" alt="product image">
                                            <?php else: ?>
                                                <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                    class="card-pro-image cursor-pointer" alt="product image">
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="d-flex w-100 align-items-center">
                                        <div class="w-100">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                <h6 id="itemname"
                                                    class="fw-600 color-changer text-dark line-2 <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> cursor-pointer">
                                                    <?php echo e($item->item_name); ?>

                                                </h6>
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center mb-2 ">
                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                    <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                        <span
                                                            class="rating-star d-inline d-flex align-items-center cursor-pointer"
                                                            onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')"
                                                            aria-controls="offcanvasRight">
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                            <span class="px-1 color-changer">
                                                                <?php echo e(number_format($item->ratings_average, 1)); ?>

                                                            </span>
                                                        </span>
                                                    <?php endif; ?>
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
                                                                <?php echo e(trans('labels.in_stock')); ?>

                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-md-flex justify-content-between align-items-center ">
                                                <div class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <p class="card-text pro-value">
                                                            <?php echo e(helper::currency_formate($price, $storeinfo->id, $item->currency)); ?>

                                                        </p>
                                                        <?php if($original_price > $price): ?>
                                                            <p class="card-text pro-org-value">
                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id, $item->currency)); ?>

                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                            <div
                                                                class="<?php echo e(session()->get('direction') == 2 ? 'ms-md-2' : 'me-md-2'); ?>">
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
                                                                            <i class="fa-solid fa-heart"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-heart"></i>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    <?php endif; ?>
                                                                </a>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <button
                                                    class="btn btn-sm mt-md-0 py-1 btn-content col-xl-3 col-lg-4 col-sm-3 col-12 rounded-0 btn-100"
                                                    id="verifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>"
                                                    onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)">
                                                    <?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?></button>
                                            </div>
                                            <?php if($item->stock_management == 1): ?>
                                                <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                    <div class="item-stock text-center rounded-0"><span
                                                            class="bg-danger p-1 px-2 fs-8 rounded-1 text-white border border-white"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
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
    <section class="blog-6-sec my-5">
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
                        <!-- blogs -->
                        <div class="blog-2">
                            <div class="row g-4">
                                <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 col-12">
                                        <div class="card border h-100 rounded-0">
                                            <div class="row g-0">
                                                <div class="col-sm-5 col-12 blog-6-img">
                                                    <a
                                                        href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                        <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                            alt="blog img" class="h-100 w-100 object-fit-cover">
                                                    </a>
                                                </div>
                                                <div class="col-sm-7 col-12 card-body">
                                                    <h4 class="title line-2">
                                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                            class="color-changer text-dark">
                                                            <?php echo e($blog->title); ?>

                                                        </a>
                                                    </h4>
                                                    <span class="blog-created">
                                                        <i class="fa-regular fa-calendar-days"></i>
                                                        <span
                                                            class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                                    </span>
                                                    <div class="description text-muted line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <!-- blogs -->
                    <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-2">
                            <div class="row g-4">
                                <div class="col-sm-6 col-12">
                                    <div class="card border h-100 rounded-0">
                                        <div class="row g-2">
                                            <div class="col-sm-5 col-12 blog-6-img">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                    <img src="<?php echo e(helper::image_path($blog->image)); ?>" alt="blog img"
                                                        class="w-100 object-fit-cover">
                                                </a>
                                            </div>
                                            <div class="col-sm-7 col-12 card-body">
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
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>

<!--------- storereview --------->
<?php if(@helper::checkaddons('store_reviews')): ?>
    <?php echo $__env->make('front.testimonial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!--------- newsletter --------->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-2\home.blade.php ENDPATH**/ ?>