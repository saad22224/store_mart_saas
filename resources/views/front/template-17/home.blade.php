@include('front.theme.header')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<main class="vela-home" style="background: #ffffff; padding-bottom: 50px;">

    @php
        $homeSliders = isset($sliders) ? $sliders : collect();
        $theme_sections = App\Models\ThemeSection::where('vendor_id', $storeinfo->id)
            ->where('is_active', 1)
            ->orderBy('reorder_id')
            ->get();
        
        if ($theme_sections->isEmpty()) {
            $theme_sections = collect([
                (object)['section_key' => 'categories', 'title' => trans('labels.categories') ?? 'Shop by Category', 'is_active' => 1],
                (object)['section_key' => 'best_sellers', 'title' => trans('labels.best_sellers') ?? 'Best Sellers', 'is_active' => 1],
                (object)['section_key' => 'exclusive', 'title' => trans('labels.exclusive_offers') ?? 'Exclusive Offers', 'is_active' => 1],
                (object)['section_key' => 'new_arrivals', 'title' => trans('labels.new_arrivals') ?? 'New Arrivals', 'is_active' => 1],
                (object)['section_key' => 'featured', 'title' => trans('labels.featured_products') ?? 'Featured Products', 'is_active' => 1],
            ]);
        }
    @endphp

    <style>
        .vela-hero-slider {
            width: 100%;
            background: #fff;
            overflow: hidden;
            margin-bottom: 46px;
        }

        .vela-hero-slider .owl-stage-outer,
        .vela-hero-slider .owl-stage,
        .vela-hero-slider .owl-item {
            /* removed height 100% to fix vertical overflow */
        }

        .vela-hero-slide,
        .vela-hero-slide-link {
            height: 100%;
        }

        .vela-hero-slide {
            height: clamp(260px, 49vw, 635px);
            display: block;
            background: #f7f7f7;
            overflow: hidden;
        }

        .vela-hero-slide img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .vela-hero-slider .owl-dots {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 14px;
            display: flex;
            justify-content: center;
            gap: 7px;
        }

        .vela-hero-slider .owl-dot span {
            width: 8px;
            height: 8px;
            margin: 0;
            border-radius: 999px;
            background: rgba(255, 255, 255, .72);
            transition: .2s ease;
        }

        .vela-hero-slider .owl-dot.active span {
            width: 20px;
            background: #fff;
        }

        .vela-categories-section {
            margin-bottom: 64px;
            position: relative;
        }

        .vela-section-title {
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 800;
            color: #050505;
            line-height: 1.15;
            margin: 0 0 34px;
            text-align: center;
        }

        .vela-category-carousel {
            position: relative;
            padding: 0 24px;
        }

        .vela-category-track {
            display: flex;
            gap: 32px;
            overflow-x: hidden;
            overflow-y: hidden;
            scroll-behavior: smooth;
            padding: 20px 0;
        }

        .vela-category-card {
            display: block;
            flex: 0 0 calc((100% - 96px) / 4);
            min-width: 0;
            color: #111;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .vela-category-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 12px;
            overflow: hidden;
            background: #f4f4f4;
            display: block;
        }

        .vela-category-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .vela-category-card:hover {
            color: #111;
            text-decoration: none;
            transform: scale(1.05);
        }

        html[dir="rtl"] .vela-category-card:hover .vela-category-arrow {
            transform: translateX(-5px) rotate(45deg);
        }
        html[dir="ltr"] .vela-category-card:hover .vela-category-arrow,
        .vela-category-card:hover .vela-category-arrow {
            transform: translateX(5px) rotate(45deg);
        }

        .vela-category-name {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.25;
        }

        .vela-category-arrow {
            width: 8px;
            height: 8px;
            border-top: 1.5px solid currentColor;
            border-right: 1.5px solid currentColor;
            transform: rotate(45deg);
            flex: 0 0 8px;
            transition: transform 0.3s ease;
        }

        .vela-category-nav {
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 4px 14px rgba(0,0,0,.16);
            color: #111;
            position: absolute;
            top: calc(50% - 32px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .vela-category-nav::before {
            content: "";
            width: 11px;
            height: 11px;
            border-top: 2px solid currentColor;
            border-right: 2px solid currentColor;
        }

        .vela-category-prev {
            left: -15px;
        }

        .vela-category-prev::before {
            transform: rotate(-135deg);
        }

        .vela-category-next {
            right: -15px;
        }

        .vela-category-next::before {
            transform: rotate(45deg);
        }

        @media (min-width: 992px) {
            .vela-category-nav {
                display: inline-flex;
            }
        }

        @media (max-width: 991px) {
            .vela-hero-slider {
                margin-bottom: 34px;
            }

            .vela-hero-slide {
                height: clamp(220px, 72vw, 430px);
            }

            .vela-categories-section {
                margin-bottom: 48px;
            }

            .vela-category-carousel {
                padding: 0;
            }

            .vela-category-track {
                display: flex;
                gap: 14px;
                overflow-x: auto;
                overflow-y: hidden;
                scroll-snap-type: x mandatory;
                padding: 15px 10px;
                scrollbar-width: none;
            }

            .vela-category-track::-webkit-scrollbar {
                display: none;
            }

            .vela-category-card {
                flex: 0 0 min(40vw, 140px);
                scroll-snap-align: start;
            }

            .vela-category-name {
                font-size: 16px;
                margin-top: 12px;
            }
        }

        @media (max-width: 480px) {
            .vela-hero-slide {
                height: 210px;
            }

            .vela-section-title {
                margin-bottom: 24px;
            }
        }
    </style>

    <section class="vela-hero-slider">
        <div class="vela-hero-carousel owl-carousel owl-theme">
            @if($homeSliders->count() > 0)
                @foreach ($homeSliders as $slider)
                    <div class="vela-hero-slide">
                        @php
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
                        @endphp
                        <a href="{{ $sliderHref }}" class="vela-hero-slide-link" {!! $sliderAttrs !!}>
                            <img src="{{ helper::image_path($slider->banner_image) }}" alt="{{ $storeinfo->name }}">
                        </a>
                    </div>
                @endforeach
            @else
                <div class="vela-hero-slide">
                    <img src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png') }}" alt="{{ $storeinfo->name }}">
                </div>
            @endif
        </div>
    </section>

    @foreach($theme_sections as $section)
        
        @if($section->section_key == 'categories')
            @php $categories = helper::getcategory($storeinfo->id); @endphp
            @if(count($categories) > 0)
            <section class="vela-categories-section" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <h2 class="vela-section-title" data-aos="zoom-in" data-aos-duration="800">
                        {{ $section->title }}
                    </h2>
                    <div class="vela-category-carousel">
                        @if(count($categories) > 4)
                            <button class="vela-category-nav vela-category-prev" type="button" aria-label="Previous categories"></button>
                            <button class="vela-category-nav vela-category-next" type="button" aria-label="Next categories"></button>
                        @endif
                        <div class="vela-category-track" id="velaCategoryTrack">
                            @foreach($categories as $category)
                                <a href="{{ URL::to(@$storeinfo->slug.'/category/'.$category->slug) }}" class="vela-category-card">
                                    <span class="vela-category-image">
                                        <img src="{{ @helper::image_path($category->image) }}" alt="{{ $category->name }}">
                                    </span>
                                    <span class="vela-category-name">
                                        <span>{{ $category->name }}</span>
                                        <span class="vela-category-arrow" aria-hidden="true"></span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

        @elseif($section->section_key == 'best_sellers')
            @php $best_sellers = helper::get_best_sellers($storeinfo->id, 4); @endphp
            @if(count($best_sellers) > 0)
            <section class="vela-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;">{{ $section->title }}</h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-12">
                            <div style="border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; position: relative; padding: 20px; background: #f4f4f4;">
                                <img src="{{ @helper::image_path($best_sellers[0]->image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.15); z-index: 2;"></div>
                                <div style="position: relative; width: 100%; height: 100%; border: 2px solid #fff; border-radius: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 3;">
                                    <h3 class="text-white fw-bold" style="font-size: 38px; margin-bottom: 20px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ @$best_sellers[0]->category_info->name ?? trans('labels.category') }}</h3>
                                    <a href="{{ URL::to(@$storeinfo->slug.'/products') }}" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">{{ trans('labels.view_all') ?? 'View All' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                @foreach($best_sellers as $product)
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                        @include('front.template-17.partials.product_card', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

        @elseif($section->section_key == 'featured')
            @php 
                $featured_products = App\Models\Item::with(['variation', 'extras', 'category_info'])->where('vendor_id', $storeinfo->id)->where('top_deals', 1)->where('is_available', 1)->orderByDesc('id')->take(4)->get(); 
                if ($featured_products->isEmpty()) {
                    $featured_products = App\Models\Item::with(['variation', 'extras', 'category_info'])->where('vendor_id', $storeinfo->id)->where('is_available', 1)->orderByDesc('id')->take(4)->get();
                }
            @endphp
            @if(count($featured_products) > 0)
            <section class="vela-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;">{{ $section->title }}</h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-12">
                            <div style="border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; position: relative; padding: 20px; background: #f4f4f4;">
                                <img src="{{ @helper::image_path($featured_products[0]->image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.15); z-index: 2;"></div>
                                <div style="position: relative; width: 100%; height: 100%; border: 2px solid #fff; border-radius: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 3;">
                                    <h3 class="text-white fw-bold" style="font-size: 38px; margin-bottom: 20px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ @$featured_products[0]->category_info->name ?? trans('labels.category') }}</h3>
                                    <a href="{{ URL::to(@$storeinfo->slug.'/products') }}" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">{{ trans('labels.view_all') ?? 'View All' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                @foreach($featured_products as $product)
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                        @include('front.template-17.partials.product_card', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

        @elseif($section->section_key == 'new_arrivals')
            @php $new_arrivals = helper::get_new_arrivals($storeinfo->id, 4); @endphp
            @if(count($new_arrivals) > 0)
            <section class="vela-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;">{{ $section->title }}</h2>
                    </div>
                    <div class="row g-4">
                        @foreach($new_arrivals as $product)
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                @include('front.template-17.partials.product_card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

        @elseif($section->section_key == 'exclusive')
            @php $exclusive_offers = helper::get_exclusive_offers($storeinfo->id, 4); @endphp
            @if(count($exclusive_offers) > 0)
            <section class="vela-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;">{{ $section->title }}</h2>
                    </div>
                    <div class="row g-4">
                        @foreach($exclusive_offers as $product)
                        <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <a href="{{ URL::to(@$storeinfo->slug.'/detail-'.$product->slug) }}" style="display:block; border-radius: 12px; overflow: hidden; position: relative; aspect-ratio: 3/4; background: #f8f8f8;">
                                <img src="{{ helper::image_path($product->image) }}" alt="{{ $product->item_name }}" style="width:100%; height: 100%; object-fit:cover; transition: transform 0.4s ease;">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

        @endif
    @endforeach

</main>
<style>
/* Reset specific vela home elements that conflict */
.vela-home a:hover { color: inherit; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.jQuery && jQuery.fn.owlCarousel) {
            jQuery('.vela-hero-carousel').owlCarousel({
                items: 1,
                loop: jQuery('.vela-hero-carousel .vela-hero-slide').length > 1,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                smartSpeed: 700,
                nav: false,
                dots: true,
                rtl: document.documentElement.dir === 'rtl'
            });
        }

        var categoryTrack = document.getElementById('velaCategoryTrack');
        if (!categoryTrack) return;

        document.querySelectorAll('.vela-category-prev, .vela-category-next').forEach(function (button) {
            button.addEventListener('click', function () {
                var direction = button.classList.contains('vela-category-next') ? 1 : -1;
                var amount = categoryTrack.clientWidth * 0.75;
                categoryTrack.scrollBy({ left: amount * direction, behavior: 'smooth' });
            });
        });
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-in-out'
        });
    });
</script>
@include('front.theme.footer')
