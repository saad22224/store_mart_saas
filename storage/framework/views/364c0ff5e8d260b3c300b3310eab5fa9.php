<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<main class="tpl20-home" style="background: #ffffff; padding-bottom: 50px; overflow-x: hidden;">

    <?php
        $homeSliders = isset($sliders) ? $sliders : collect();
        $theme_sections = collect([
            (object)['section_key' => 'categories', 'title' => trans('labels.categories') ?? 'Shop by Category', 'is_active' => 1],
            (object)['section_key' => 'best_sellers', 'title' => trans('labels.best_sellers') ?? 'Best Sellers', 'is_active' => 1],
            (object)['section_key' => 'exclusive', 'title' => trans('labels.exclusive_offers') ?? 'Exclusive Offers', 'is_active' => 1],
            (object)['section_key' => 'new_arrivals', 'title' => trans('labels.new_arrivals') ?? 'New Arrivals', 'is_active' => 1],
            (object)['section_key' => 'featured', 'title' => trans('labels.featured_products') ?? 'Featured Products', 'is_active' => 1],
        ]);
    ?>

    <style>
        /* Template 20 - Pearl Bags Triptych Split Slider & Red Ticker (Screenshot 3 Match) */
        .tpl20-announcement {
            background: #111827;
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 0;
            text-align: center;
            letter-spacing: 1px;
        }

        .tpl20-hero-wrap {
            max-width: 1320px;
            margin: 30px auto 20px;
            padding: 0 20px;
        }

        .tpl20-triptych-card {
            background: #e2d2be;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.06);
            display: grid;
            grid-template-columns: 0.9fr 1.2fr 0.9fr;
            min-height: 480px;
            position: relative;
        }

        .tpl20-side-img-left, .tpl20-side-img-right {
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .tpl20-side-img-left img, .tpl20-side-img-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tpl20-center-paper {
            background: #d4beaa url('https://www.transparenttextures.com/patterns/paper-fibers.png');
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-left: 1px solid rgba(0,0,0,0.05);
            border-right: 1px solid rgba(0,0,0,0.05);
        }

        .tpl20-brand-title {
            font-family: 'Bodoni Moda', serif;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 4px;
            color: #111;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .tpl20-hero-heading {
            font-family: 'Bodoni Moda', serif;
            font-size: clamp(32px, 4.5vw, 54px);
            font-style: italic;
            font-weight: 700;
            line-height: 1.1;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.15);
            margin-bottom: 18px;
            text-transform: uppercase;
        }

        .tpl20-hero-desc {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            color: #4a3e35;
            max-width: 360px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .tpl20-outline-btn {
            border: 2px solid #ffffff;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
            color: #111;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 12px 40px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .tpl20-outline-btn:hover {
            background: #111;
            border-color: #111;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Diagonal Red Ticker Banner (Screenshot 3 Match) */
        .tpl20-red-ticker-container {
            margin-top: 30px;
            margin-bottom: 50px;
            transform: rotate(-2deg) scale(1.03);
            background: #e11d48;
            box-shadow: 0 10px 30px rgba(225, 29, 72, 0.3);
            padding: 14px 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .tpl20-red-ticker-track {
            display: inline-flex;
            animation: tpl20Ticker 25s linear infinite;
        }

        .tpl20-red-ticker-item {
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(22px, 3.5vw, 36px);
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-right: 40px;
            display: inline-flex;
            align-items: center;
            gap: 20px;
        }

        @keyframes tpl20Ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @media (max-width: 991px) {
            .tpl20-triptych-card {
                grid-template-columns: 1fr;
            }
            .tpl20-side-img-left, .tpl20-side-img-right {
                display: none;
            }
            .tpl20-center-paper {
                padding: 40px 20px;
            }
        }

        .tpl17-categories-section { margin-bottom: 64px; position: relative; }
        .tpl17-section-title { font-size: clamp(30px, 3vw, 40px); font-weight: 800; color: #050505; line-height: 1.15; margin: 0 0 34px; text-align: center; }
        .tpl17-category-carousel { position: relative; padding: 0 24px; }
        .tpl17-category-track { display: flex; gap: 32px; overflow-x: hidden; overflow-y: hidden; scroll-behavior: smooth; padding: 20px 0; }
        .tpl17-category-card { display: block; flex: 0 0 calc((100% - 96px) / 4); min-width: 0; color: #111; text-decoration: none; transition: transform 0.3s ease; }
        .tpl17-category-image { width: 100%; aspect-ratio: 1 / 1; border-radius: 12px; overflow: hidden; background: #f4f4f4; display: block; }
        .tpl17-category-image img { width: 100%; height: 100%; display: block; object-fit: cover; transition: transform .35s ease; }
        .tpl17-category-card:hover { color: #111; text-decoration: none; transform: scale(1.05); }
        .tpl17-category-name { display: flex; align-items: center; gap: 8px; margin-top: 16px; font-size: 18px; font-weight: 600; line-height: 1.25; }
        .tpl17-category-arrow { width: 8px; height: 8px; border-top: 1.5px solid currentColor; border-right: 1.5px solid currentColor; transform: rotate(45deg); flex: 0 0 8px; transition: transform 0.3s ease; }
        .tpl17-category-nav { width: 42px; height: 42px; border: 0; border-radius: 50%; background: #fff; box-shadow: 0 4px 14px rgba(0,0,0,.16); color: #111; position: absolute; top: calc(50% - 32px); display: none; align-items: center; justify-content: center; z-index: 2; }
        .tpl17-category-nav::before { content: ""; width: 11px; height: 11px; border-top: 2px solid currentColor; border-right: 2px solid currentColor; }
        .tpl17-category-prev { left: -15px; }
        .tpl17-category-prev::before { transform: rotate(-135deg); }
        .tpl17-category-next { right: -15px; }
        .tpl17-category-next::before { transform: rotate(45deg); }
        @media (min-width: 992px) { .tpl17-category-nav { display: inline-flex; } }
        @media (max-width: 991px) {
            .tpl17-categories-section { margin-bottom: 48px; overflow-x: scroll !important; }
            .tpl17-category-carousel { padding: 0; }
            .tpl17-category-track { display: flex; gap: 14px; overflow-x: auto; overflow-y: hidden; scroll-snap-type: x mandatory; padding: 15px 10px; scrollbar-width: none; }
            .tpl17-category-track::-webkit-scrollbar { display: none; }
            .tpl17-category-card { flex: 0 0 min(40vw, 140px); scroll-snap-align: start; }
            .tpl17-category-name { font-size: 16px; margin-top: 12px; }
        }
    </style>

    <!-- Top Announcement Bar -->
    <div class="tpl20-announcement">
        ✦ Welcome to Our Store ✦ Free Shipping on all Items ✦ Exclusive Handbag Collection ✦
    </div>

    <!-- Triptych Split Hero Slider Container -->
    <div class="tpl20-hero-wrap">
        <div class="tpl20-hero-owl owl-carousel owl-theme" data-aos="fade-up">
            <?php if($homeSliders->count() > 0): ?>
                <?php $__currentLoopData = $homeSliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $sliderHref = 'javascript:void(0)';
                        $sliderAttrs = '';
                        if ($slider->product_id != 0 || $slider->category_id != 0) {
                            if ($slider->type == 1 && !empty($slider['category_info'])) {
                                $sliderHref = URL::to($storeinfo->slug . '/search?category=' . $slider['category_info']->slug);
                            } elseif ($slider->type == 2) {
                                $item = helper::itemdetails($slider->product_id, $storeinfo->id);
                                if (!empty($item)) {
                                    $sliderHref = 'javascript:void(0)';
                                    $sliderAttrs = "onclick=\"GetProductOverview('{$item->slug}','')\"";
                                }
                            }
                        }
                    ?>
                    <div class="tpl20-triptych-card">
                        <div class="tpl20-side-img-left">
                            <img src="<?php echo e(helper::image_path($slider->banner_image)); ?>" alt="<?php echo e($storeinfo->name); ?>">
                        </div>
                        <div class="tpl20-center-paper">
                            <div class="tpl20-brand-title"><?php echo e($storeinfo->name ?? 'PEARL BAGS'); ?></div>
                            <h2 class="tpl20-hero-heading">HARVEST YOUR STYLE</h2>
                            <p class="tpl20-hero-desc">Fall is all about layering—and that includes your accessories. Discover the season's most-wanted bags.</p>
                            <a href="<?php echo e($sliderHref); ?>" class="tpl20-outline-btn" <?php echo $sliderAttrs; ?>>Shop Now</a>
                        </div>
                        <div class="tpl20-side-img-right">
                            <img src="<?php echo e(helper::image_path($slider->banner_image)); ?>" alt="<?php echo e($storeinfo->name); ?>">
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="tpl20-triptych-card">
                    <div class="tpl20-side-img-left">
                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png')); ?>" alt="<?php echo e($storeinfo->name); ?>">
                    </div>
                    <div class="tpl20-center-paper">
                        <div class="tpl20-brand-title">PEARL BAGS</div>
                        <h2 class="tpl20-hero-heading">HARVEST YOUR STYLE</h2>
                        <p class="tpl20-hero-desc">Fall is all about layering—and that includes your accessories. Discover the season's most-wanted bags.</p>
                        <a href="javascript:void(0)" class="tpl20-outline-btn">Shop Now</a>
                    </div>
                    <div class="tpl20-side-img-right">
                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png')); ?>" alt="<?php echo e($storeinfo->name); ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Diagonal Red Ticker Banner -->
    <div class="tpl20-red-ticker-container">
        <div class="tpl20-red-ticker-track">
            <span class="tpl20-red-ticker-item">✦ LIMITED EDITION COLLECTION ✦ NEW HANDBAG ARRIVALS</span>
            <span class="tpl20-red-ticker-item">✦ LIMITED EDITION COLLECTION ✦ NEW HANDBAG ARRIVALS</span>
            <span class="tpl20-red-ticker-item">✦ LIMITED EDITION COLLECTION ✦ NEW HANDBAG ARRIVALS</span>
            <span class="tpl20-red-ticker-item">✦ LIMITED EDITION COLLECTION ✦ NEW HANDBAG ARRIVALS</span>
        </div>
    </div>

    <!-- Theme Sections -->
    <?php $__currentLoopData = $theme_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($section->section_key == 'categories'): ?>
            <?php $categories = helper::getcategory($storeinfo->id); ?>
            <?php if(count($categories) > 0): ?>
            <section class="tpl17-categories-section" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <h2 class="tpl17-section-title" data-aos="zoom-in" data-aos-duration="800">
                        <?php echo e($section->title); ?>

                    </h2>
                    <div class="tpl17-category-carousel">
                        <?php if(count($categories) > 4): ?>
                            <button class="tpl17-category-nav tpl17-category-prev" type="button" aria-label="Previous categories"></button>
                            <button class="tpl17-category-nav tpl17-category-next" type="button" aria-label="Next categories"></button>
                        <?php endif; ?>
                        <div class="tpl17-category-track" id="tpl17CategoryTrack">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.$category->slug)); ?>" class="tpl17-category-card">
                                    <span class="tpl17-category-image">
                                        <img src="<?php echo e(@helper::image_path($category->image)); ?>" alt="<?php echo e($category->name); ?>">
                                    </span>
                                    <span class="tpl17-category-name">
                                        <span><?php echo e($category->name); ?></span>
                                        <span class="tpl17-category-arrow" aria-hidden="true"></span>
                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php elseif($section->section_key == 'best_sellers'): ?>
            <?php $best_sellers = helper::get_best_sellers($storeinfo->id, 4); ?>
            <?php if(count($best_sellers) > 0): ?>
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;"><?php echo e($section->title); ?></h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-12">
                            <div style="border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; position: relative; padding: 20px; background: #f4f4f4;">
                                <img src="<?php echo e(@helper::image_path($best_sellers[0]->image)); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.15); z-index: 2;"></div>
                                <div style="position: relative; width: 100%; height: 100%; border: 2px solid #fff; border-radius: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 3;">
                                    <h3 class="text-white fw-bold" style="font-size: 38px; margin-bottom: 20px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e(@$best_sellers[0]->category_info->name ?? trans('labels.category')); ?></h3>
                                    <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.@$best_sellers[0]->category_info->slug)); ?>" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);"><?php echo e(trans('labels.view_all') ?? 'View All'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                <?php $__currentLoopData = $best_sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo e($loop->iteration * 100); ?>">
                                        <?php echo $__env->make('front.template-20.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php elseif($section->section_key == 'featured'): ?>
            <?php 
                $featured_products = App\Models\Item::with(['variation', 'extras', 'category_info'])->where('vendor_id', $storeinfo->id)->where('top_deals', 1)->where('is_available', 1)->orderByDesc('id')->take(4)->get(); 
                if ($featured_products->isEmpty()) {
                    $featured_products = App\Models\Item::with(['variation', 'extras', 'category_info'])->where('vendor_id', $storeinfo->id)->where('is_available', 1)->orderByDesc('id')->take(4)->get();
                }
            ?>
            <?php if(count($featured_products) > 0): ?>
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;"><?php echo e($section->title); ?></h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-12">
                            <div style="border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; position: relative; padding: 20px; background: #f4f4f4;">
                                <img src="<?php echo e(@helper::image_path($featured_products[0]->image)); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.15); z-index: 2;"></div>
                                <div style="position: relative; width: 100%; height: 100%; border: 2px solid #fff; border-radius: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 3;">
                                    <h3 class="text-white fw-bold" style="font-size: 38px; margin-bottom: 20px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e(@$featured_products[0]->category_info->name ?? trans('labels.category')); ?></h3>
                                    <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.@$featured_products[0]->category_info->slug)); ?>" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);"><?php echo e(trans('labels.view_all') ?? 'View All'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                <?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo e($loop->iteration * 100); ?>">
                                        <?php echo $__env->make('front.template-20.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php elseif($section->section_key == 'new_arrivals'): ?>
            <?php $new_arrivals = helper::get_new_arrivals($storeinfo->id, 4); ?>
            <?php if(count($new_arrivals) > 0): ?>
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;"><?php echo e($section->title); ?></h2>
                    </div>
                    <div class="row g-4">
                        <?php $__currentLoopData = $new_arrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo e($loop->iteration * 100); ?>">
                                <?php echo $__env->make('front.template-20.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php elseif($section->section_key == 'exclusive'): ?>
            <?php $exclusive_offers = helper::get_exclusive_offers($storeinfo->id, 4); ?>
            <?php if(count($exclusive_offers) > 0): ?>
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;"><?php echo e($section->title); ?></h2>
                    </div>
                    <div class="row g-4">
                        <?php $__currentLoopData = $exclusive_offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo e($loop->iteration * 100); ?>">
                            <a href="<?php echo e(URL::to(@$storeinfo->slug.'/detail-'.$product->slug)); ?>" style="display:block; border-radius: 12px; overflow: hidden; position: relative; aspect-ratio: 3/4; background: #f8f8f8;">
                                <img src="<?php echo e(helper::image_path($product->image)); ?>" alt="<?php echo e($product->item_name); ?>" style="width:100%; height: 100%; object-fit:cover; transition: transform 0.4s ease;">
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.jQuery && jQuery.fn.owlCarousel) {
            jQuery('.tpl20-hero-owl').owlCarousel({
                items: 1,
                loop: jQuery('.tpl20-hero-owl .tpl20-triptych-card').length > 1,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                nav: false,
                dots: false,
                rtl: document.documentElement.dir === 'rtl'
            });
        }
        var categoryTrack = document.getElementById('tpl17CategoryTrack');
        if (!categoryTrack) return;
        document.querySelectorAll('.tpl17-category-prev, .tpl17-category-next').forEach(function (button) {
            button.addEventListener('click', function () {
                var direction = button.classList.contains('tpl17-category-next') ? 1 : -1;
                var amount = categoryTrack.clientWidth * 0.75;
                categoryTrack.scrollBy({ left: amount * direction, behavior: 'smooth' });
            });
        });
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({ once: true, offset: 50, duration: 800, easing: 'ease-in-out' });
    });
</script>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-20/home.blade.php ENDPATH**/ ?>