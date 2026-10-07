@include('front.theme.header')
{{-- theme_styles already included via template-22 layout header --}}

@php
    $homeSliders = isset($sliders) ? $sliders : collect();
    $categories = helper::getcategory($storeinfo->id);
    $allItems = collect($getitem ?? []);
@endphp

<main class="mp-home mp-body">
    @if ($homeSliders->count() > 0)
        <section class="mp-hero" id="mpHero">
            @foreach ($homeSliders as $i => $slide)
                @php
                    $slideLink = URL::to($storeinfo->slug . '/');
                    if (!empty($slide->product_id) && @$slide->product_info) {
                        $slideLink = URL::to($storeinfo->slug . '/detail-' . $slide->product_info->slug);
                    } elseif (!empty($slide->category_id) && @$slide->category_info) {
                        $slideLink = URL::to($storeinfo->slug . '/category/' . $slide->category_info->slug);
                    }
                @endphp
                <a href="{{ $slideLink }}" class="mp-hero-slide {{ $i === 0 ? 'is-active' : '' }}">
                    <img src="{{ helper::image_path($slide->image) }}" alt="{{ $slide->title ?? $storeinfo->name }}" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                    @if (!empty($slide->title))
                        <div class="mp-hero-caption"><h2>{{ $slide->title }}</h2></div>
                    @endif
                </a>
            @endforeach
        </section>
    @endif

    <div class="mp-wrap mp-home-sections">
        {{-- كل قسم: اسم القسم فوق + المنتجات تحته (زي الصورة) --}}
        @forelse ($categories as $category)
            @php
                $catProducts = $allItems->filter(function ($p) use ($category) {
                    $ids = preg_split('/[|,]/', (string) ($p->cat_id ?? ''));
                    return in_array((string) $category->id, $ids, true);
                })->take(10)->values();
            @endphp
            @include('front.template-22.partials.product_section', [
                'title' => $category->name,
                'products' => $catProducts,
                'storeinfo' => $storeinfo,
                'viewAllUrl' => URL::to($storeinfo->slug . '/category/' . $category->slug),
                'sectionId' => 'mp-cat-' . $category->id,
            ])
        @empty
            @if ($allItems->count() > 0)
                @include('front.template-22.partials.product_section', [
                    'title' => 'المنتجات',
                    'products' => $allItems->take(12),
                    'storeinfo' => $storeinfo,
                    'viewAllUrl' => URL::to($storeinfo->slug . '/search'),
                    'sectionId' => 'mp-all-products',
                ])
            @endif
        @endforelse

        @if (isset($bannerimage1) && $bannerimage1->count() > 0)
            <div class="mp-banner-row">
                @foreach ($bannerimage1->take(2) as $banner)
                    <img src="{{ helper::image_path($banner->image) }}" alt="" loading="lazy">
                @endforeach
            </div>
        @endif

        @if (isset($bannerimage2) && $bannerimage2->count() > 0)
            <div class="mp-banner-row">
                @foreach ($bannerimage2->take(2) as $banner)
                    <img src="{{ helper::image_path($banner->image) }}" alt="" loading="lazy">
                @endforeach
            </div>
        @endif
    </div>
</main>

<script>
(function () {
    document.querySelectorAll('[data-mp-scroll]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id = btn.getAttribute('data-mp-scroll');
            var rail = document.querySelector('[data-mp-rail="' + id + '"]');
            if (!rail) return;
            var dir = btn.getAttribute('data-dir');
            var amount = Math.max(280, rail.clientWidth * 0.75);
            // RTL: next scrolls toward start (negative in LTR scrollLeft logic varies)
            rail.scrollBy({ left: dir === 'prev' ? amount : -amount, behavior: 'smooth' });
        });
    });
    var slides = document.querySelectorAll('#mpHero .mp-hero-slide');
    if (slides.length > 1) {
        var i = 0;
        setInterval(function () {
            slides[i].classList.remove('is-active');
            i = (i + 1) % slides.length;
            slides[i].classList.add('is-active');
        }, 5000);
    }
})();
</script>

@include('front.theme.footer')
