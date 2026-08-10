<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Alex+Brush&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<main class="tpl19-home" style="background: #ffffff; padding-bottom: 50px;">

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
        /* Template 19 - Nature Perfumes & Beauty Curved Peek Slider (Screenshot 2 Match) */
        .tpl19-peek-slider-container {
            width: 100%;
            overflow: hidden;
            padding: 0 0 40px;
            margin-bottom: 40px;
        }

        .tpl19-peek-carousel .owl-stage-outer {
            padding: 20px 0;
            overflow: visible;
        }

        .tpl19-peek-slide {
            height: clamp(340px, 46vw, 540px);
            border-radius: 36px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            transition: all 0.5s ease;
            transform: scale(0.92);
            opacity: 0.7;
            background: #f9f9f9;
        }

        .tpl19-peek-carousel .owl-item.active.center .tpl19-peek-slide {
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .tpl19-peek-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tpl19-peek-caption {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 60%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .tpl19-peek-btn {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #111;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 12px 36px;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .tpl19-peek-btn:hover {
            background: #111;
            color: #fff;
            transform: translateY(-2px);
        }

        .tpl19-dots-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
        }

        .tpl19-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #cbd5e1;
            transition: all 0.3s ease;
        }

        .tpl19-dot.active {
            width: 24px;
            border-radius: 12px;
            background: #1e293b;
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


    <!-- Nature Perfumes Peek Carousel Slider -->
    <section class="tpl19-peek-slider-container">
        <div class="tpl19-peek-carousel owl-carousel owl-theme" data-aos="zoom-in">
            <?php if($homeSliders->count() > 0): ?>
                <?php $__currentLoopData = $homeSliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $sliderHref = 'javascript:void(0)';
                        $sliderAttrs = '';
                        if ($slider->product_id != 0 || $slider->category_id != 0) {
                            if ($slider->type == 1 && !empty($slider['category_info'])) {
                                $sliderHref = URL::to($storeinfo->slug . '/category/' . $slider['category_info']->slug);
                            } elseif ($slider->type == 2) {
                                $item = helper::itemdetails($slider->product_id, $storeinfo->id);
                                if (!empty($item)) {
                                    $sliderHref = 'javascript:void(0)';
                                    $sliderAttrs = "onclick=\"GetProductOverview('{$item->slug}','')\"";
                                }
                            }
                        }
                    ?>
                    <a href="<?php echo e($sliderHref); ?>" class="tpl19-peek-slide" <?php echo $sliderAttrs; ?> style="display:block;text-decoration:none;">
                        <img src="<?php echo e(helper::image_path($slider->banner_image)); ?>" alt="<?php echo e($storeinfo->name); ?>">
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="tpl19-peek-slide">
                    <img src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png')); ?>" alt="<?php echo e($storeinfo->name); ?>">
                </div>
            <?php endif; ?>
        </div>

        <!-- Pill Dots (dynamic) -->
        <div class="tpl19-dots-wrap" id="tpl19DotsWrap"></div>
    </section>

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
                                        <?php echo $__env->make('front.template-19.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                        <?php echo $__env->make('front.template-19.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                <?php echo $__env->make('front.template-19.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            var $carousel = jQuery('.tpl19-peek-carousel');
            var slideCount = $carousel.find('.tpl19-peek-slide').length;
            var dotsWrap = document.getElementById('tpl19DotsWrap');

            // Build dots dynamically
            if (dotsWrap && slideCount > 0) {
                for (var i = 0; i < slideCount; i++) {
                    var dot = document.createElement('span');
                    dot.className = 'tpl19-dot' + (i === 0 ? ' active' : '');
                    dot.setAttribute('data-index', i);
                    dotsWrap.appendChild(dot);
                }
            }

            $carousel.owlCarousel({
                center: true,
                items: 1.35,
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                smartSpeed: 700,
                nav: false,
                dots: false,
                responsive: {
                    0: { items: 1.1 },
                    768: { items: 1.25 },
                    1024: { items: 1.4 }
                },
                rtl: document.documentElement.dir === 'rtl'
            });

            // Update dots on slide change
            $carousel.on('translated.owl.carousel', function (e) {
                var total = e.item.count;
                var current = e.item.index % total;
                // Owl loop adds clones, center item index may shift
                // Use the center item
                var centerIndex = e.item.index - e.relatedTarget._clones.length / 2;
                if (centerIndex < 0) centerIndex += total;
                if (centerIndex >= total) centerIndex -= total;

                var dots = dotsWrap ? dotsWrap.querySelectorAll('.tpl19-dot') : [];
                dots.forEach(function(d, idx) {
                    d.classList.toggle('active', idx === centerIndex);
                });
            });

            // Click dot to go to slide
            if (dotsWrap) {
                dotsWrap.querySelectorAll('.tpl19-dot').forEach(function(dot) {
                    dot.addEventListener('click', function() {
                        $carousel.trigger('to.owl.carousel', [parseInt(dot.getAttribute('data-index')), 400]);
                    });
                });
            }
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
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-19/home.blade.php ENDPATH**/ ?>