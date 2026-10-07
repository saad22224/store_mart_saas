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
                        <div class="feature-box rounded-4">
                            <img src='<?php echo e(helper::image_path($image->banner_image)); ?>' alt="" class="rounded-4">
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
        <section class="mb-5">
            <div class="container">
                <div class="sec-header mb-3">
                    <h4 class="text-captalize color-changer text-center main-title m-0"><?php echo e(trans('labels.selling_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center fw-500 mt-2 text-muted">
                        <?php echo e(trans('labels.selling_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 g-4">
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
                            <div class="card border rounded-4 h-100 card__article bg-transparent">
                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>"
                                    class=" position-relative">
                                    <?php if(@$item['product_image']->image == null): ?>
                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                            class="card-img-top rounded-4" alt="product image">
                                    <?php else: ?>
                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                            class="card-img-top rounded-4" alt="product image">
                                    <?php endif; ?>
                                </a>
                                <div
                                    class="pro-9 p-3 w-100 d-flex justify-content-between align-items-center position-absolute">
                                    <?php if($off > 0): ?>
                                        <div class="discount text-bg-primary fs-13 px-2 py-1 rounded">
                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
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
                                <div class="card__data p-3">
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <span class="card__description text-dark line-2">
                                                <?php echo e($item->item_name); ?></span>
                                        </a>
                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                            <div class="d-flex align-items-center justify-content-between mb-2 ">
                                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                    <p class="m-0 fs-8 d-flex gap-1 align-items-center fw-500 cursor-pointer"
                                                        onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                        <i class="fa-solid fa-star text-warning"></i>
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
                                                <span class="out-stock-indicator-dot"></span>
                                                <p class="out-stock-text">
                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                </p>
                                            </div>
                                        <?php else: ?>
                                            <div class="in-stock my-1">
                                                <span class="in-stock-indicator-dot"></span>
                                                <p class="in-stock-text">
                                                    <?php echo e(trans('labels.in_stock')); ?>

                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
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
                    <h5 class="fw-500 color-changer line-1 mb-3"><?php echo e(helper::appdata($storeinfo->id)->whoweare_title); ?></h5>
                    <h3 class="line-2 main-title color-changer fw-600"><?php echo e(helper::appdata($storeinfo->id)->whoweare_subtitle); ?></h3>
                    <p class="m-0 text-muted fs-15 line-3"><?php echo e(helper::appdata($storeinfo->id)->whoweare_description); ?>

                    </p>
                    <div class="col-12">
                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $whowearedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whoweare): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="card border rounded-4 h-100">
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

<!-- category with products -->
<?php if(helper::getcategory($storeinfo->id)->count() > 0): ?>
    <div class="product-sec2 theme-12">
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
                <section class="mb-4 py-lg-5">
                    <div class="container">
                        <div class="card card-bg card-header sec-header bg-transparent px-0 mb-3" id="<?php echo e($category->slug); ?>">
                            <h2 class="fw-600 color-changer text-center"> <?php echo e($category->name); ?> (<?php echo e($check_cat_count); ?>)
                            </h2>
                        </div>
                        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 g-4">
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
                                        <div class="col">
                                            <div class="card border rounded-4 h-100 card__article bg-transparent">

                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>"
                                                    class=" position-relative">
                                                    <?php if(@$item['product_image']->image == null): ?>
                                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                                            class="card-img-top rounded-4" alt="product image">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                                            class="card-img-top rounded-4" alt="product image">
                                                    <?php endif; ?>
                                                </a>
                                                <div
                                                    class="pro-9 p-3 w-100 d-flex justify-content-between align-items-center position-absolute">
                                                    <?php if($off > 0): ?>
                                                        <div class="discount text-bg-primary fs-13 px-2 py-1 rounded">
                                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
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
                                                <div class="card__data p-3">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center gap-2">
                                                        <a
                                                            href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                                            <span class="card__description text-dark line-2">
                                                                <?php echo e($item->item_name); ?></span>
                                                        </a>
                                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-2 ">
                                                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                                    <p class="m-0 fs-8 d-flex gap-1 align-items-center fw-500 cursor-pointer"
                                                                        onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                                        <i class="fa-solid fa-star text-warning"></i>
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
                                                                <span class="out-stock-indicator-dot"></span>
                                                                <p class="out-stock-text">
                                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                                </p>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="in-stock my-1">
                                                                <span class="in-stock-indicator-dot"></span>
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
                                                            id="iconverifybtn<?php echo e($key); ?>_<?php echo e($category->id); ?>"
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
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<!-- feature-sec -->
<?php if($bannerimage2->count() > 0): ?>
    <section class="feature-sec my-4 my-md-5">
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

<!--------- storereview --------->
<?php if(@helper::checkaddons('store_reviews')): ?>
    <?php if($testimonials->count() > 0): ?>
        <section class="storereview-sec mb-5">
            <div class="container">
                <div class="sec-header mb-3">
                    <h4 class="text-captalize text-center color-changer main-title m-0"><?php echo e(trans('labels.testimonials')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center fw-500 mt-2 text-muted">
                        <?php echo e(trans('labels.testimonials_subtitle')); ?></p>
                </div>
                <div class="testimonial-area mb-5">
                    <div class="store-review-12 owl-carousel owl-theme">
                        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100">
                                <div class="card card-bg p-1 bg-transparent position-relative h-100">
                                    <div class="card-body p-0">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 gap-sm-4  justify-content-md-start">
                                            <img src="<?php echo e(helper::image_path($item->image)); ?>" alt="">
                                            <div class="d-flex gap-3 gap-sm-4 flex-column flex-md-row">
                                                <div
                                                    class="icons-review text-center <?php echo e(session()->get('direction') == 2 ? 'text-md-end' : 'text-md-start'); ?>">
                                                    <i class="fa-solid fa-quote-left"></i>
                                                </div>
                                                <div class="review_description d-flex flex-column">
                                                    <p
                                                        class="text-center <?php echo e(session()->get('direction') == 2 ? 'text-md-end' : 'text-md-start'); ?> fs-15 m-0 fw-500">
                                                        <?php echo e($item->description); ?>

                                                    </p>
                                                    <div
                                                        class="mt-3 text-center <?php echo e(session()->get('direction') == 2 ? 'text-md-end' : 'text-md-start'); ?>">
                                                        <h6
                                                            class="line-1 mb-1 text-secondary fw-600 d-flex justify-content-center aling-items-center justify-content-md-start gap-2">
                                                            <i class="fa-light fa-minus fw-600"></i>
                                                            <?php echo e($item->name); ?>

                                                        </h6>
                                                        <p class="review_date fs-7">
                                                            <?php echo e(helper::date_format($item->created_at, $storeinfo->id)); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


<!-- Top-Rated-Items -->
<?php if(helper::appdata($storeinfo->id)->product_section_display == 2 ||
        helper::appdata($storeinfo->id)->product_section_display == 3): ?>
    <?php if(count($toprateditems) > 0): ?>
        <section class="mb-5">
            <div class="container">
                <div class="sec-header mb-3">
                    <h4 class="text-captalize color-changer text-center main-title m-0"><?php echo e(trans('labels.top_rated_product')); ?></h4>
                    <p class="m-0 line-2 fs-15 text-center fw-500 mt-2 text-muted">
                        <?php echo e(trans('labels.top_rated_product_subtitle')); ?></p>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 g-4">
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
                            <div class="card border rounded-4 h-100 card__article bg-transparent">
                                <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>"
                                    class=" position-relative">
                                    <?php if(@$item['product_image']->image == null): ?>
                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/item-placeholder.png')); ?>"
                                            class="card-img-top rounded-4" alt="product image">
                                    <?php else: ?>
                                        <img src="<?php echo e(@helper::image_path($item['product_image']->image)); ?>"
                                            class="card-img-top rounded-4" alt="product image">
                                    <?php endif; ?>
                                </a>
                                <div
                                    class="pro-9 p-3 w-100 d-flex justify-content-between align-items-center position-absolute">
                                    <?php if($off > 0): ?>
                                        <div class="discount text-bg-primary fs-13 px-2 py-1 rounded">
                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
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
                                <div class="card__data p-3">
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . $item->slug)); ?>">
                                            <span class="card__description text-dark line-2">
                                                <?php echo e($item->item_name); ?></span>
                                        </a>
                                        <?php if(@helper::checkaddons('product_reviews')): ?>
                                            <div class="d-flex align-items-center justify-content-between mb-2 ">
                                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                                    <p class="m-0 fs-8 d-flex gap-1 align-items-center fw-500 cursor-pointer"
                                                        onclick="rattingmodal('<?php echo e($item->id); ?>','<?php echo e($storeinfo->id); ?>','<?php echo e($item->item_name); ?>')">
                                                        <i class="fa-solid fa-star text-warning"></i>
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
                                                <span class="out-stock-indicator-dot"></span>
                                                <p class="out-stock-text">
                                                    <?php echo e(trans('labels.out_of_stock')); ?>

                                                </p>
                                            </div>
                                        <?php else: ?>
                                            <div class="in-stock my-1">
                                                <span class="in-stock-indicator-dot"></span>
                                                <p class="in-stock-text">
                                                    <?php echo e(trans('labels.in_stock')); ?>

                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
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
                                            id="iconverifybtn3<?php echo e($key); ?>_<?php echo e($item->id); ?>"
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
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<!--------- newsletter --------->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- blogs -->
<?php if(helper::getblogs($storeinfo->id)->count() > 0): ?>
    <section class="blog-6-sec my-5">
        <?php
            $blog = helper::getblogs($storeinfo->id);
        ?>
        <div class="container">
            <div class="sec-header mb-3">
                <h4 class="text-captalize color-changer text-center main-title m-0"><?php echo e(trans('labels.our_latest_blogs')); ?></h4>
                <p class="m-0 line-2 fs-15 text-center fw-500 mt-2 text-muted">
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
                        <div class="blogs-12 owl-carousel owl-theme overflow-hidden">
                            <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 mx-1">
                                    <div class="card border rounded-4 h-100 overflow-hidden card-rounded">
                                        <div class="card-body">
                                            <h5 class="fw-600 line-2">
                                                <a class="text-secondary"
                                                    href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                            </h5>
                                            <span class="blog-created color-changer">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                <span
                                                    class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                            </span>
                                            <div class="description text-muted line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                        </div>
                                        <div class="blog-6-img">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="280"
                                                    alt="blog img" class="w-100 object-fit-cover">
                                            </a>
                                            <div class="post-image-hover">
                                                <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                    class="blog-btn blog-8-2" title="Read More">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <div class="blogs-12 owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100 mx-1">
                                <div class="card border rounded-4 h-100 overflow-hidden card-rounded">
                                    <div class="card-body">
                                        <h5 class="fw-600 line-2">
                                            <a class="text-secondary"
                                                href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                        </h5>
                                        <span class="blog-created color-changer">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            <span
                                                class="date"><?php echo e(helper::date_format($blog->created_at, $storeinfo->id)); ?></span>
                                        </span>
                                        <div class="description text-muted line-2"><?php echo Str::limit($blog->description, 200); ?></div>
                                    </div>
                                    <div class="blog-6-img">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>">
                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>" height="280"
                                                alt="blog img" class="w-100 object-fit-cover">
                                        </a>
                                        <div class="post-image-hover">
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/blogs-' . $blog->slug)); ?>"
                                                class="blog-btn blog-8-2" title="Read More">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </div>
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
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-12\home.blade.php ENDPATH**/ ?>