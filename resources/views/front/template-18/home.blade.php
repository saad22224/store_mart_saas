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
        /* ===== Cinematic Full-Screen Slider ===== */
        .tpl18-hero-section {
            position: relative;
            width: 100%;
            height: 90vh;
            min-height: 480px;
            max-height: 860px;
            overflow: hidden;
            margin-bottom: 50px;
            background: #050505;
        }

        /* Slides container */
        .tpl18-slides-wrap {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Individual slide */
        .tpl18-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.9s ease;
            display: block;
            text-decoration: none;
        }
        .tpl18-slide.is-active {
            opacity: 1;
            z-index: 2;
        }
        .tpl18-slide.is-leaving {
            opacity: 0;
            z-index: 1;
        }

        /* The image itself — Ken Burns effect */
        .tpl18-slide-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center center;
            transform: scale(1);
            transition: none;
        }
        .tpl18-slide.is-active .tpl18-slide-img {
            animation: tpl18KenBurns 8s ease forwards;
        }
        @keyframes tpl18KenBurns {
            0%   { transform: scale(1);    }
            100% { transform: scale(1.08); }
        }

        /* Timeline Progress Bar (Video style) */
        .tpl18-progress-wrapper {
            position: absolute;
            bottom: 70px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: none;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 10;
            border-radius: 0;
            overflow: hidden;
        }
        .tpl18-progress-fill {
            height: 100%;
            width: 0%;
            background: #d4af37;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.9);
            transition: width 0.05s linear;
        }

        /* Bottom Video Controls (Prev, Pause/Play, Next) */
        .tpl18-video-controls {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 16px;
            background: transparent;
            backdrop-filter: none;
            padding: 0;
            border-radius: 0;
            border: none;
        }
        .tpl18-ctrl-btn {
            background: transparent;
            border: none;
            color: #000;
            cursor: pointer;
            padding: 4px 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s, transform 0.2s;
            /* filter: drop-shadow(0px 1px 2px rgba(255, 255, 255, 0.5)); */
        }
        /* .tpl18-ctrl-btn:hover {
            color: #000000;
            transform: scale(1.15);
        } */
        .tpl18-ctrl-divider {
            width: 1px;
            height: 14px;
            background: rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 767px) {
            .tpl18-hero-section { height: 60vw; min-height: 260px; max-height: 480px; }
            .tpl18-progress-wrapper { width: 100%; left: 0; bottom: 38px; }
            .tpl18-video-controls { gap: 12px; padding: 0; }
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

    <!-- Cinematic Full-Screen Hero Slider -->
    <section class="tpl18-hero-section" id="tpl18HeroSlider">
        <div class="tpl18-slides-wrap" id="tpl18SlidesWrap">
            @php
                $sliderItems = $homeSliders->count() > 0 ? $homeSliders : collect([null]);
            @endphp

            @foreach ($sliderItems as $slider)
                @php
                    $sliderHref = 'javascript:void(0)';
                    $sliderOnClick = '';
                    if ($slider && ($slider->product_id != 0 || $slider->category_id != 0)) {
                        if ($slider->type == 1 && !empty($slider['category_info'])) {
                            /* ---- Link to category page ---- */
                            $sliderHref = URL::to($storeinfo->slug . '/category/' . $slider['category_info']->slug);
                        } elseif ($slider->type == 2) {
                            $item = helper::itemdetails($slider->product_id, $storeinfo->id);
                            if (!empty($item)) {
                                $sliderOnClick = "GetProductOverview('{$item->slug}','')";
                            }
                        }
                    }
                    $imgSrc = ($slider && !empty($slider->banner_image))
                        ? helper::image_path($slider->banner_image)
                        : url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/banner-placeholder.png');
                @endphp

                <a href="{{ $sliderHref }}"
                   class="tpl18-slide {{ $loop->first ? 'is-active' : '' }}"
                   @if($sliderOnClick) onclick="{{ $sliderOnClick }}" @endif
                   data-index="{{ $loop->index }}">
                    <img class="tpl18-slide-img"
                         src="{{ $imgSrc }}"
                         alt="{{ $storeinfo->name }}">
                </a>
            @endforeach
        </div>

        @if(count($sliderItems) > 1)
        {{-- Timeline Progress Bar --}}
        <div class="tpl18-progress-wrapper">
            <div class="tpl18-progress-fill" id="tpl18ProgressFill"></div>
        </div>

        {{-- Video Controls (Prev, Pause/Play, Next) --}}
        <div class="tpl18-video-controls">
            <button type="button" class="tpl18-ctrl-btn" id="tpl18PrevBtn" aria-label="Previous slide">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button type="button" class="tpl18-ctrl-btn" id="tpl18PauseBtn" aria-label="Pause / Play">
                <svg id="tpl18PauseIcon" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><rect x="7" y="4" width="2.5" height="16" rx="1"/><rect x="14.5" y="4" width="2.5" height="16" rx="1"/></svg>
            </button>
            <button type="button" class="tpl18-ctrl-btn" id="tpl18NextBtn" aria-label="Next slide">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div>
        @endif
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

        /* ===== Video-Style Slider Timeline & Controls ===== */
        (function() {
            var slides       = Array.from(document.querySelectorAll('.tpl18-slide'));
            var progressFill = document.getElementById('tpl18ProgressFill');
            var prevBtn      = document.getElementById('tpl18PrevBtn');
            var nextBtn      = document.getElementById('tpl18NextBtn');
            var pauseBtn     = document.getElementById('tpl18PauseBtn');
            var pauseIcon    = document.getElementById('tpl18PauseIcon');

            if (slides.length <= 1) {
                if (progressFill) progressFill.style.width = '100%';
                return;
            }

            var current     = 0;
            var isPlaying   = true;
            var elapsed     = 0;
            var DURATION    = 6000; // 6 seconds per slide
            var TICK        = 40;   // 40ms tick interval
            var timer       = null;

            function goTo(index) {
                var prev = current;
                current  = (index + slides.length) % slides.length;
                if (prev === current) return;

                slides[prev].classList.remove('is-active');
                slides[prev].classList.add('is-leaving');
                setTimeout(function() { slides[prev].classList.remove('is-leaving'); }, 950);

                slides[current].classList.add('is-active');

                var img = slides[current].querySelector('.tpl18-slide-img');
                if (img) {
                    img.style.animation = 'none';
                    img.offsetHeight;
                    img.style.animation = '';
                }
            }

            function resetProgress() {
                elapsed = 0;
                if (progressFill) progressFill.style.width = '0%';
            }

            function startTimer() {
                clearInterval(timer);
                timer = setInterval(function() {
                    if (!isPlaying) return;
                    elapsed += TICK;
                    var pct = Math.min((elapsed / DURATION) * 100, 100);
                    if (progressFill) progressFill.style.width = pct + '%';

                    if (elapsed >= DURATION) {
                        resetProgress();
                        goTo(current + 1);
                    }
                }, TICK);
            }

            function updatePauseUI() {
                if (!pauseIcon) return;
                if (isPlaying) {
                    // Pause icon (two vertical bars)
                    pauseIcon.innerHTML = '<rect x="7" y="4" width="2.5" height="16" rx="1"/><rect x="14.5" y="4" width="2.5" height="16" rx="1"/>';
                } else {
                    // Play icon (triangle)
                    pauseIcon.innerHTML = '<polygon points="7 4 19 12 7 20 7 4"/>';
                }
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    resetProgress();
                    goTo(current - 1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    resetProgress();
                    goTo(current + 1);
                });
            }

            if (pauseBtn) {
                pauseBtn.addEventListener('click', function() {
                    isPlaying = !isPlaying;
                    updatePauseUI();
                });
            }

            /* Touch / swipe support */
            var hero = document.getElementById('tpl18HeroSlider');
            var touchStartX = 0;
            if (hero) {
                hero.addEventListener('touchstart', function(e) { touchStartX = e.touches[0].clientX; }, { passive: true });
                hero.addEventListener('touchend', function(e) {
                    var diff = touchStartX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 40) {
                        resetProgress();
                        goTo(current + (diff > 0 ? 1 : -1));
                    }
                }, { passive: true });
            }

            startTimer();
        })();

        /* ===== Category Row Carousel ===== */
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
