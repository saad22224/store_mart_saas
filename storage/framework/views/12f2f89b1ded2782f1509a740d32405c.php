<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- furniture_home -->
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

<!-- feature-sec -->
<?php if($bannerimage1->count() > 0): ?>
    <section class="feature-sec my-5">
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
                        <div class="feature-box m-0">
                            <img src='<?php echo e(helper::image_path($image->banner_image)); ?>' alt="" class="">
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
        <section class="theme-10">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="text-center color-changer text-captalize main-title m-0"><?php echo e(trans('labels.selling_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 fw-500 mt-2 text-center text-muted">
                        <?php echo e(trans('labels.selling_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3">
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
                            <div class="card card-bg pro-9 h-100 bg-transparent">
                                <div class="pro-9-img">
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <?php if(@$item['product_image']->image == null): ?>
                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                class="card-img-top rounded-2" alt="product image">
                                        <?php else: ?>
                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                class="card-img-top rounded-2" alt="product image">
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

                                    <!-- add to cart -->
                                    <div class="position-absolute bottom-12 w-100 d-flex">
                                        <button class="btn pro-9-add mx-3 hover-none"
                                            id="verifybtn<?php echo e($key); ?>_<?php echo e($item->id); ?>" title="cart"
                                            onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                        </button>
                                    </div>

                                    <!-- stock -->
                                    <?php if($item->stock_management == 1): ?>
                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                            <div
                                                class="out-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                <span class="out-stock-indicator-dot"></span>
                                                <p class="out-stock-text">
                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                </p>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="in-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                <span class="in-stock-indicator-dot"></span>
                                                <p class="in-stock-text"><?php echo e(trans('labels.in_stock')); ?>

                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>


                                <div class="card-body p-2 p-sm-3 pb-0 pb-sm-0">
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <h4 class="title line-2 color-changer text-dark">
                                            <?php echo e($item->item_name); ?>

                                        </h4>
                                    </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 p-2 p-sm-3">
                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                        <div class="d-flex alogn-items-center justify-content-between mb-2 ">
                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                <p class="m-0 rating-star cursor-pointer"
                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span
                                                        class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- price -->
                                    <div class="d-flex flex-wrap gap-1 justify-content-between">
                                        <p class="price color-changer m-0 d-flex gap-1 align-items-center">
                                            <?php echo e(helper::currency_formate($price, $storeinfo->id)); ?>

                                            <!-- old-price -->
                                            <?php if($original_price > $price): ?>
                                                <span class="old-price">
                                                    <?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        <?php if($off > 0): ?>
                                            <div class="discount ltr fs-7 fw-500">(<?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>)
                                            </div>
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

<!---------- WHO WE ARE START ---------->
<?php if($whowearedata->count() > 0): ?>
    <section class="my-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="img-15 rounded">
                        <img src="<?php echo e(helper::image_path(helper::appdata($storeinfo->id)->whoweare_image)); ?>"
                            alt="" class="rounded">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="fs-5 fw-500 color-changer line-1 mb-2"><?php echo e(helper::appdata($storeinfo->id)->whoweare_title); ?></h4>
                    <h3 class="line-2 main-title fw-600 color-changer"><?php echo e(helper::appdata($storeinfo->id)->whoweare_subtitle); ?></h3>
                    <p class="m-0 text-muted fs-15 line-3"><?php echo e(helper::appdata($storeinfo->id)->whoweare_description); ?>

                    </p>
                    <div class="col-12">
                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $whowearedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whoweare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center gap-3">
                                                <div class="icon-img-15">
                                                    <img src="<?php echo e(helper::image_path($whoweare->image)); ?>"
                                                        alt=""
                                                        class="rounded-circle border border-secondary p-1 border-2">
                                                </div>
                                                <div class="tital-15 text-center">
                                                    <h6 class="line-1 text-secondary text-center fw-600">
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
            </div>
        </div>
    </section>
<?php endif; ?>
<!---------- WHO WE ARE END ---------->

<!-- category with products -->
<?php if(helper::getcategory($storeinfo->id)->count() > 0): ?>
    <div class="product-sec2 my-md-5 my-2">
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
            <section class="mb-4">
                <div class="container">
                    <?php if($check_cat_count > 0): ?>
                        <div class="card card-bg card-header sec-header bg-transparent px-0 mb-3" id="<?php echo e($category->slug); ?>">
                            <h4 class="title-9 color-changer text-center"> <?php echo e($category->name); ?> (<?php echo e($check_cat_count); ?>) </h4>
                        </div>
                    <?php endif; ?>
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3">
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
                                                    $item->item_price > @helper::top_deals($storeinfo->id)->offer_amount
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
                                    <div class="col">
                                        <div class="card card-bg pro-9 h-100 bg-transparent">

                                            <div class="pro-9-img">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                    <?php if(@$item['product_image']->image == null): ?>
                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                            class="card-img-top rounded-2" alt="product image">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                            class="card-img-top rounded-2" alt="product image">
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

                                                <!-- add to cart -->
                                                <div class="position-absolute bottom-12 w-100 d-flex">
                                                    <button class="btn pro-9-add mx-3 hover-none"
                                                        id="verifybtn<?php echo e($key); ?>_<?php echo e($category->id); ?>"
                                                        title="cart"
                                                        onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                                    </button>
                                                </div>

                                                <!-- stock -->
                                                <?php if($item->stock_management == 1): ?>
                                                    <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                                        <div
                                                            class="out-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                            <span class="out-stock-indicator-dot"></span>
                                                            <p class="out-stock-text">
                                                                <?php echo e(trans('labels.out_of_stock')); ?>

                                                            </p>
                                                        </div>
                                                    <?php else: ?>
                                                        <div
                                                            class="in-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                            <span class="in-stock-indicator-dot"></span>
                                                            <p class="in-stock-text"><?php echo e(trans('labels.in_stock')); ?>

                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>


                                            <div class="card-body p-2 p-sm-3 pb-0 pb-sm-0">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                    <h4 class="title line-2 color-changer text-dark">
                                                        <?php echo e($item->item_name); ?>

                                                    </h4>
                                                </a>
                                            </div>
                                            <div class="card-footer bg-transparent border-0 p-2 p-sm-3">
                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                    <div
                                                        class="d-flex alogn-items-center justify-content-between mb-2 ">
                                                        <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                            <p class="m-0 rating-star cursor-pointer"
                                                                onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                                <span
                                                                    class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <!-- price -->
                                                <div class="d-flex flex-wrap gap-1 justify-content-between">
                                                    <p class="price color-changer m-0 d-flex gap-1 align-items-center">
                                                        <?php echo e(helper::currency_formate($price, $storeinfo->id)); ?>


                                                        <!-- old-price -->
                                                        <?php if($original_price > $price): ?>
                                                            <span class="old-price">
                                                                <?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <?php if($off > 0): ?>
                                                        <div class="discount ltr fs-7 fw-500">(<?php echo e($off); ?>%
                                                            <?php echo e(trans('labels.off')); ?>)</div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <div class="d-none">
                            <a href="#" class="btn btn-store mobile-btn"><?php echo e(trans('labels.view_all')); ?>

                                <i class="fa-solid fa-arrow-right px-1"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
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

<!-- Top-Rated-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 2 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($toprateditems) > 0): ?>
        <section class="theme-10">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="text-center color-changer text-captalize main-title m-0"><?php echo e(trans('labels.top_rated_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 fw-500 mt-2 text-center text-muted">
                        <?php echo e(trans('labels.top_rated_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3">
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
                            <div class="card card-bg pro-9 h-100 bg-transparent">
                                <div class="pro-9-img">
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <?php if(@$item['product_image']->image == null): ?>
                                            <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                class="card-img-top rounded-2" alt="product image">
                                        <?php else: ?>
                                            <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                class="card-img-top rounded-2" alt="product image">
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

                                    <!-- add to cart -->
                                    <div class="position-absolute bottom-12 w-100 d-flex">
                                        <button class="btn pro-9-add mx-3 hover-none"
                                            id="verifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>" title="cart"
                                            onclick="GetProductOverview('<?php echo e($item->slug); ?>',this.id)"><?php echo e(helper::appdata($storeinfo->id)->online_order == 1 ? trans('labels.add_to_cart') : trans('labels.view')); ?>

                                        </button>
                                    </div>

                                    <!-- stock -->
                                    <?php if($item->stock_management == 1): ?>
                                        <?php if(helper::checklowqty($item->id, $storeinfo->id) == 2 && $item->has_variants != 1): ?>
                                            <div
                                                class="out-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                <span class="out-stock-indicator-dot"></span>
                                                <p class="out-stock-text">
                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                </p>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="in-stock m-0 badge bg-white shadow rounded-pill <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                <span class="in-stock-indicator-dot"></span>
                                                <p class="in-stock-text"><?php echo e(trans('labels.in_stock')); ?>

                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>


                                <div class="card-body p-2 p-sm-3 pb-0 pb-sm-0">
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                        <h4 class="title line-2 color-changer text-dark">
                                            <?php echo e($item->item_name); ?>

                                        </h4>
                                    </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 p-2 p-sm-3">
                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                        <div class="d-flex alogn-items-center justify-content-between mb-2 ">
                                            <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                <p class="m-0 rating-star cursor-pointer"
                                                    onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span
                                                        class="px-1 color-changer"><?php echo e(number_format($item->ratings_average, 1)); ?></span>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- price -->
                                    <div class="d-flex flex-wrap gap-1 justify-content-between">
                                        <p class="price m-0 color-changer d-flex gap-1 align-items-center">
                                            <?php echo e(helper::currency_formate($price, $storeinfo->id)); ?>

                                            <!-- old-price -->
                                            <?php if($original_price > $price): ?>
                                                <span class="old-price">
                                                    <?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </p>
                                        <?php if($off > 0): ?>
                                            <div class="discount ltr fs-7 fw-500">(<?php echo e($off); ?>%
                                                <?php echo e(trans('labels.off')); ?>)
                                            </div>
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



<!-- blogs -->
<?php if(helper::getblogs($storeinfo->id)->count() > 0): ?>
    <section class="blog-6-sec my-5">
        <?php
            $blog = helper::getblogs($storeinfo->id);
        ?>
        <div class="container">
            <div class="sec-header mb-4">
                <h4 class="text-center text-captalize color-changer main-title m-0"><?php echo e(trans('labels.our_latest_blogs')); ?></h4>
                <p class="m-0 line-2 fs-15 fw-500 mt-2 text-center text-muted">
                    <?php echo e(trans('labels.our_latest_blogs_subtitle')); ?></p>
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
                        <div class="blogs-8 owl-carousel owl-theme overflow-hidden">
                            <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 mx-1">
                                    <div class="card border rounded h-100 overflow-hidden card-rounded">
                                        <div class="blog-6-img">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                    alt="blog img" class="w-100 object-fit-cover">
                                            </a>
                                            <div class="post-image-hover">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                    class="blog-btn blog-8-2" title="Read More">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="title line-2">
                                                <a class="color-changer text-dark"
                                                    href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
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
                    <div class="blogs-8 owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100 mx-1">
                                <div class="card border rounded h-100 overflow-hidden card-rounded">
                                    <div class="blog-6-img">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="300"
                                                alt="blog img" class="w-100 object-fit-cover">
                                        </a>
                                        <div class="post-image-hover">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                class="blog-btn blog-8-2" title="Read More">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="title line-2">
                                            <a class="color-changer text-dark"
                                                href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                        </h4>
                                        <span class="blog-created text-muted">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span class="date"><?php echo e(helper::date_format($blog->created_at)); ?></span>
                                        </span>
                                        <div class="description text-muted line-2"><?php echo Str::limit($blog->description, 200); ?></div>
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

<!--------- storereview --------->
<?php if(@helper::checkaddons('store_reviews')): ?>
    <?php if($testimonials->count() > 0): ?>
        <section class="storereview-sec my-5">
            <div class="container">
                <div class="sec-header mb-4">
                    <h4 class="text-center color-changer text-captalize main-title m-0"><?php echo e(trans('labels.testimonials')); ?></h4>
                    <p class="m-0 line-2 fs-15 fw-500 mt-2 text-center text-muted">
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
                                            <h5 class="line-1 color-changer mb-1 review_title"><?php echo e($item->name); ?></h5>
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

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/template-9/home.blade.php ENDPATH**/ ?>