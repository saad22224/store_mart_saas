@include('front.theme.header')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<main class="tpl18-home" style="background: #ffffff; padding-bottom: 50px;">

    @php
        $homeSliders = isset($sliders) ? $sliders : collect();
        $theme_sections = collect([
            (object)['section_key' => 'categories', 'title' => trans('labels.categories') ?? 'Shop by Category', 'is_active' => 1],
            (object)['section_key' => 'best_sellers', 'title' => trans('labels.best_sellers') ?? 'Best Sellers', 'is_active' => 1],
            (object)['section_key' => 'exclusive', 'title' => trans('labels.exclusive_offers') ?? 'Exclusive Offers', 'is_active' => 1],
            (object)['section_key' => 'new_arrivals', 'title' => trans('labels.new_arrivals') ?? 'New Arrivals', 'is_active' => 1],
            (object)['section_key' => 'featured', 'title' => trans('labels.featured_products') ?? 'Featured Products', 'is_active' => 1],
        ]);
    @endphp

    <style>
        /* Template 18 - LA PERAL Jewelry Hero Slider (Screenshot 1 Match) */
        .tpl18-top-announcement {
            background: #02140d;
            color: #d4af37;
            font-size: 13px;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 8px 0;
            text-align: center;
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
        }

        .tpl18-hero-section {
            position: relative;
            background: radial-gradient(circle at 60% 40%, #0d382a 0%, #051a13 70%, #020f0a 100%);
            min-height: 580px;
            overflow: hidden;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 50px;
        }

        .tpl18-hero-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 50px 30px;
            position: relative;
            z-index: 2;
        }

        .tpl18-brand-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .tpl18-brand-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700;
            letter-spacing: 8px;
            color: #ffffff;
            text-transform: uppercase;
            margin: 0;
            text-shadow: 0 0 20px rgba(255,255,255,0.2);
        }

        .tpl18-subtagline {
            font-size: 11px;
            letter-spacing: 4px;
            color: #d4af37;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .tpl18-hero-grid {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            align-items: center;
            gap: 40px;
            min-height: 400px;
        }

        .tpl18-hero-content {
            padding-right: 20px;
        }

        .tpl18-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 5.5vw, 64px);
            font-weight: 400;
            line-height: 1.1;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .tpl18-hero-desc {
            font-size: 16px;
            font-weight: 300;
            color: #d1d5db;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        .tpl18-shop-btn {
            display: inline-block;
            background: #d4af37;
            color: #051a13;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 14px 42px;
            border-radius: 40px;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .tpl18-shop-btn:hover {
            background: #ffffff;
            color: #051a13;
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .tpl18-hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tpl18-main-img-card {
            width: 100%;
            max-width: 440px;
            height: 440px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .tpl18-main-img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tpl18-floating-thumb {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 160px;
            height: 160px;
            border-radius: 16px;
            overflow: hidden;
            border: 3px solid #d4af37;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            background: #000;
        }

        .tpl18-floating-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tpl18-gold-quote {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: rgba(212, 175, 55, 0.4);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-top: 20px;
            line-height: 1.2;
        }

        .tpl18-slider-progress-bar {
            width: 100%;
            height: 2px;
            background: rgba(255,255,255,0.15);
            margin-top: 40px;
            position: relative;
        }

        .tpl18-slider-progress-active {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 35%;
            background: #d4af37;
            box-shadow: 0 0 10px #d4af37;
        }

        @media (max-width: 991px) {
            .tpl18-hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .tpl18-hero-content { padding-right: 0; }
            .tpl18-floating-thumb { display: none; }
            .tpl18-main-img-card { height: 320px; margin: 0 auto; }
        }

        /* Categories Section Fix */
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

    <!-- Announcement Bar -->
    <div class="tpl18-top-announcement">
        ✦ Welcome to Our Store — Exclusive Jewelry & Accessories Collection ✦
    </div>

    <!-- LA PERAL Emerald Hero Slider Section -->
    <section class="tpl18-hero-section">
        <div class="tpl18-hero-inner">

            <!-- Brand Logo Header -->
            <div class="tpl18-brand-header" data-aos="fade-down">
                <h1 class="tpl18-brand-logo-text">{{ $storeinfo->name ?? 'LA PERAL' }}</h1>
                <div class="tpl18-subtagline">Elegância Que Dura</div>
            </div>

            <!-- Owl Carousel Hero -->
            <div class="tpl18-hero-owl owl-carousel owl-theme">
                @if($homeSliders->count() > 0)
                    @foreach ($homeSliders as $slider)
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
                        <div class="tpl18-hero-grid">
                            <div class="tpl18-hero-content" data-aos="fade-right">
                                <h2 class="tpl18-hero-title">Necklaces & Fine Jewelry</h2>
                                <p class="tpl18-hero-desc">Curated silhouettes with signature detail. Crafted with pure elegance for timeless beauty.</p>
                                <a href="{{ $sliderHref }}" class="tpl18-shop-btn" {!! $sliderAttrs !!}>Shop Now</a>
                                <div class="tpl18-gold-quote">UM TOQUE DE OURO NO SEU DIA A DIA</div>
                            </div>
                            <div class="tpl18-hero-visual" data-aos="fade-left">
                                <div class="tpl18-main-img-card">
                                    <img src="{{ helper::image_path($slider->banner_image) }}" alt="{{ $storeinfo->name }}">
                                </div>
                                <div class="tpl18-floating-thumb">
                                    <img src="{{ helper::image_path($slider->banner_image) }}" alt="Detail">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="tpl18-hero-grid">
                        <div class="tpl18-hero-content" data-aos="fade-right">
                            <h2 class="tpl18-hero-title">Necklaces & Fine Jewelry</h2>
                            <p class="tpl18-hero-desc">Curated silhouettes with signature detail. Crafted with pure elegance for timeless beauty.</p>
                            <a href="javascript:void(0)" class="tpl18-shop-btn">Shop Now</a>
                            <div class="tpl18-gold-quote">UM TOQUE DE OURO NO SEU DIA A DIA</div>
                        </div>
                        <div class="tpl18-hero-visual" data-aos="fade-left">
                            <div class="tpl18-main-img-card">
                                <img src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png') }}" alt="{{ $storeinfo->name }}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Slider Progress Line -->
            <div class="tpl18-slider-progress-bar">
                <div class="tpl18-slider-progress-active"></div>
            </div>

        </div>
    </section>

    <!-- Theme Sections -->
    @foreach($theme_sections as $section)
        @if($section->section_key == 'categories')
            @php $categories = helper::getcategory($storeinfo->id); @endphp
            @if(count($categories) > 0)
            <section class="tpl17-categories-section" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <h2 class="tpl17-section-title" data-aos="zoom-in" data-aos-duration="800">
                        {{ $section->title }}
                    </h2>
                    <div class="tpl17-category-carousel">
                        @if(count($categories) > 4)
                            <button class="tpl17-category-nav tpl17-category-prev" type="button" aria-label="Previous categories"></button>
                            <button class="tpl17-category-nav tpl17-category-next" type="button" aria-label="Next categories"></button>
                        @endif
                        <div class="tpl17-category-track" id="tpl17CategoryTrack">
                            @foreach($categories as $category)
                                <a href="{{ URL::to(@$storeinfo->slug.'/category/'.$category->slug) }}" class="tpl17-category-card">
                                    <span class="tpl17-category-image">
                                        <img src="{{ @helper::image_path($category->image) }}" alt="{{ $category->name }}">
                                    </span>
                                    <span class="tpl17-category-name">
                                        <span>{{ $category->name }}</span>
                                        <span class="tpl17-category-arrow" aria-hidden="true"></span>
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
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
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
                                    <a href="{{ URL::to(@$storeinfo->slug.'/category/'.@$best_sellers[0]->category_info->slug) }}" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">{{ trans('labels.view_all') ?? 'View All' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                @foreach($best_sellers as $product)
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                        @include('front.template-18.partials.product_card', ['product' => $product])
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
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
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
                                    <a href="{{ URL::to(@$storeinfo->slug.'/category/'.@$featured_products[0]->category_info->slug) }}" class="btn" style="background: #000; color: #fff; border-radius: 30px; padding: 10px 35px; font-weight: 600; font-size: 15px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">{{ trans('labels.view_all') ?? 'View All' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-4">
                                @foreach($featured_products as $product)
                                    <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                        @include('front.template-18.partials.product_card', ['product' => $product])
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
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                        <h2 style="font-size: 36px; font-weight: 800; color: #111;">{{ $section->title }}</h2>
                    </div>
                    <div class="row g-4">
                        @foreach($new_arrivals as $product)
                            <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                @include('front.template-18.partials.product_card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

        @elseif($section->section_key == 'exclusive')
            @php $exclusive_offers = helper::get_exclusive_offers($storeinfo->id, 4); @endphp
            @if(count($exclusive_offers) > 0)
            <section class="tpl17-section" style="margin-bottom: 60px;" data-aos="fade-up" data-aos-duration="1000">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.jQuery && jQuery.fn.owlCarousel) {
            jQuery('.tpl18-hero-owl').owlCarousel({
                items: 1,
                loop: jQuery('.tpl18-hero-owl .tpl18-hero-grid').length > 1,
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
@include('front.theme.footer')
