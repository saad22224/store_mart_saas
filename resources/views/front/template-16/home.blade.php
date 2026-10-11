@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $appdata = helper::appdata($storeinfo->id);
    $storeName = $appdata->app_name ?? ($storeinfo->name ?? '');
    $address = trim((string) ($appdata->address ?? ''));
    $contact = trim((string) ($appdata->contact ?? ''));
    if ($contact === '-') {
        $contact = '';
    }
    $description = trim(strip_tags((string) ($appdata->description ?? '')));
    $categories = helper::getcategory($storeinfo->id);

    $bannerSlides = collect();
    if (isset($sliders) && $sliders->count() > 0) {
        foreach ($sliders as $slider) {
            $bannerFile = trim((string) ($slider->banner_image ?? ''));
            if ($bannerFile === '' || $bannerFile === 'default.png') {
                continue;
            }
            $src = helper::image_path($bannerFile);
            if (str_contains(strtolower($src), 'placeholder') || str_contains(strtolower($src), 'defaultimages')) {
                continue;
            }
            $href = null;
            if (($slider->type ?? 0) == 1 && ! empty($slider->category_info?->slug)) {
                $href = URL::to($storeinfo->slug.'/category/'.$slider->category_info->slug);
            } elseif (($slider->type ?? 0) == 2) {
                $sItem = helper::itemdetails($slider->product_id, $storeinfo->id);
                if ($sItem && ! empty($sItem->slug)) {
                    $href = URL::to($storeinfo->slug.'/detail-'.$sItem->slug);
                }
            }
            $bannerSlides->push((object) [
                'src' => $src,
                'href' => $href,
            ]);
        }
    }
@endphp

<div class="t16-page">
    <div class="t16-cover" id="t16Cover">
        @if ($bannerSlides->count() > 0)
            <div class="t16-cover-slider" id="t16CoverSlider">
                @foreach ($bannerSlides as $bi => $slide)
                    @php $isFirst = $bi === 0; @endphp
                    <div class="t16-cover-slide{{ $isFirst ? ' is-active' : '' }}" data-t16-slide="{{ $bi }}">
                        @if ($slide->href)
                            <a href="{{ $slide->href }}" class="t16-cover-slide-link">
                                <img src="{{ $slide->src }}" alt="{{ $storeName }}" {{ $isFirst ? 'loading=eager' : 'loading=lazy' }}>
                            </a>
                        @else
                            <img src="{{ $slide->src }}" alt="{{ $storeName }}" {{ $isFirst ? 'loading=eager' : 'loading=lazy' }}>
                        @endif
                    </div>
                @endforeach
                @if ($bannerSlides->count() > 1)
                    <div class="t16-cover-dots" id="t16CoverDots" aria-hidden="true">
                        @foreach ($bannerSlides as $bi => $slide)
                            <button type="button" class="t16-cover-dot{{ $bi === 0 ? ' is-active' : '' }}" data-t16-dot="{{ $bi }}" aria-label="Slide {{ $bi + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="t16-cover-fallback" aria-hidden="true"></div>
        @endif
    </div>

    <div class="t16-sheet">
        <h1 class="t16-store-title">{{ $storeName }}</h1>

        @if ($address !== '' || $contact !== '')
            <div class="t16-meta">
                @if ($address !== '')
                    <a class="t16-meta-row" href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" rel="noopener">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span>{{ $address }}</span>
                    </a>
                @endif
                @if ($contact !== '')
                    <a class="t16-meta-row" href="tel:{{ preg_replace('/\s+/', '', $contact) }}">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <span>{{ $contact }}</span>
                    </a>
                @endif
            </div>
        @endif

        @if ($description !== '')
            <p class="t16-store-desc">{{ $description }}</p>
        @endif

        <form class="t16-search-pill" action="{{ URL::to($storeinfo->slug.'/search') }}" method="GET" role="search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <input type="search" name="search_input" value="{{ request('search_input') }}"
                placeholder="{{ App::getLocale() == 'ar' ? 'بحث' : 'Search' }}"
                autocomplete="off" aria-label="{{ trans('labels.search') }}">
        </form>

        @if ($categories->count() > 0)
            <div class="t16-cat-covers">
                @foreach ($categories as $cat)
                    @php
                        $catImg = (! empty($cat->image) && $cat->image !== 'default.png')
                            ? helper::image_path($cat->image)
                            : null;
                    @endphp
                    <a href="{{ URL::to($storeinfo->slug.'/category/'.$cat->slug) }}" class="t16-cat-cover">
                        @if ($catImg)
                            <img src="{{ $catImg }}" alt="{{ $cat->name }}" loading="lazy">
                        @else
                            <div class="t16-cat-cover-ph" aria-hidden="true"></div>
                        @endif
                        <span class="t16-cat-cover-overlay">
                            <span class="t16-cat-cover-name">{{ $cat->name }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="t16-empty">
                <i class="fa-regular fa-utensils"></i>
                {{ App::getLocale() == 'ar' ? 'لا توجد أقسام بعد' : 'No categories yet' }}
            </div>
        @endif
    </div>
</div>

@if ($bannerSlides->count() > 1)
<script>
(function () {
    var root = document.getElementById('t16CoverSlider');
    if (!root) return;
    var slides = root.querySelectorAll('.t16-cover-slide');
    var dots = root.querySelectorAll('[data-t16-dot]');
    var current = 0;
    var timer = null;

    function show(i) {
        if (!slides.length) return;
        current = (i + slides.length) % slides.length;
        slides.forEach(function (s, idx) {
            s.classList.toggle('is-active', idx === current);
        });
        dots.forEach(function (d, idx) {
            d.classList.toggle('is-active', idx === current);
        });
    }

    function next() { show(current + 1); }
    function start() {
        stop();
        timer = setInterval(next, 4200);
    }
    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            show(parseInt(dot.getAttribute('data-t16-dot'), 10) || 0);
            start();
        });
    });

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    root.addEventListener('touchstart', stop, { passive: true });
    root.addEventListener('touchend', start, { passive: true });

    show(0);
    start();
})();
</script>
@endif

@include('front.template-16._cart_scripts')
@include('front.theme.footer')
