@include('front.theme.header')
@include('front.template-16._theme_styles')

@php
    $allCategories = helper::getcategory($storeinfo->id);
    $storeName = helper::appdata($storeinfo->id)->app_name ?? $storeinfo->name;
    $cartdata = $cartdata ?? collect();

    $allMenuItems = \App\Models\Item::with(['variation', 'extras', 'product_image', 'multi_image'])
        ->where('vendor_id', $storeinfo->id)
        ->where('is_available', 1)
        ->where('is_deleted', 2)
        ->orderBy('reorder_id', 'ASC')
        ->get();

    $menuSections = [];
    foreach ($allCategories as $cat) {
        $catItems = $allMenuItems->filter(function ($item) use ($cat) {
            $ids = preg_split('/[|,]/', (string) $item->cat_id);
            return in_array((string) $cat->id, array_map('strval', $ids), true);
        })->values();
        if ($catItems->count() > 0) {
            $menuSections[] = ['category' => $cat, 'items' => $catItems];
        }
    }
@endphp

{{-- Optional banner --}}
@if ($sliders->count() > 0)
<div class="t16-hero">
    <div class="t16-slider-wrap" id="t16HeroSlider">
        @foreach ($sliders as $si => $slider)
            @php
                $isActive = $si === 0;
                $linkOpen = '';
                $linkClose = '';
                if ($slider->product_id != 0 || $slider->category_id != 0) {
                    if ($slider->type == 1) {
                        $linkOpen = '<a href="'.URL::to($storeinfo->slug.'/search?category='.@$slider->category_info->slug).'">';
                        $linkClose = '</a>';
                    } elseif ($slider->type == 2) {
                        $sItem = helper::itemdetails($slider->product_id, $storeinfo->id);
                        if ($sItem && ! empty($sItem->slug)) {
                            $linkOpen = '<a href="'.URL::to($storeinfo->slug.'/detail-'.$sItem->slug).'">';
                            $linkClose = '</a>';
                        }
                    }
                }
            @endphp
            <div class="t16-slide{{ $isActive ? ' active' : '' }}" data-slide="{{ $si }}"
                style="position:{{ $isActive ? 'relative' : 'absolute' }};inset:0;opacity:{{ $isActive ? '1' : '0' }};transition:opacity .7s ease;{{ ! $isActive ? 'z-index:0;' : 'z-index:10;' }}">
                {!! $linkOpen !!}
                <img class="t16-slide-img" src="{{ helper::image_path($slider->banner_image) }}" alt="{{ $storeName }}">
                {!! $linkClose !!}
            </div>
        @endforeach
        @if ($sliders->count() > 1)
            <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);z-index:30;display:flex;gap:8px;">
                @foreach ($sliders as $di => $dot)
                    <button type="button" onclick="t16GoSlide({{ $di }})" data-t16dot="{{ $di }}"
                        style="width:9px;height:9px;border-radius:50%;border:none;background:#fff;opacity:{{ $di === 0 ? '1' : '.4' }};cursor:pointer;padding:0;"></button>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endif

<div class="t16-shell t16-menu-home">
    @if (count($menuSections) > 0)
        <div class="t16-sticky-chips" id="t16StickyChips">
            <div class="t16-cat-chips">
                @foreach ($menuSections as $section)
                    <a href="#t16-cat-{{ $section['category']->id }}" class="t16-cat-chip" data-t16-chip="{{ $section['category']->id }}">
                        <span class="t16-cat-chip-img">
                            @if (! empty($section['category']->image) && $section['category']->image !== 'default.png')
                                <img src="{{ helper::image_path($section['category']->image) }}" alt="" loading="lazy">
                            @else
                                <i class="fa-solid fa-utensils"></i>
                            @endif
                        </span>
                        <span class="t16-cat-chip-name">{{ $section['category']->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <script>
        (function () {
            var header = document.querySelector('.t16-header');
            var chips = document.getElementById('t16StickyChips');
            function syncOffset() {
                if (!header) return;
                document.documentElement.style.setProperty('--t16-header-offset', header.offsetHeight + 'px');
            }
            if (header && chips) {
                header.appendChild(chips);
                chips.classList.add('t16-chips-in-header');
            }
            syncOffset();
            requestAnimationFrame(syncOffset);
            window.addEventListener('resize', syncOffset);
        })();
        </script>

        @foreach ($menuSections as $sIdx => $section)
            <section class="t16-menu-section" id="t16-cat-{{ $section['category']->id }}" data-t16-section="{{ $section['category']->id }}">
                <div class="t16-section-head">
                    <div>
                        <h2 class="t16-section-title">{{ $section['category']->name }}</h2>
                        <p class="t16-section-sub">
                            {{ $section['items']->count() }}
                            {{ App::getLocale() == 'ar' ? 'صنف' : 'items' }}
                        </p>
                    </div>
                    <a href="{{ URL::to($storeinfo->slug.'/category/'.$section['category']->slug) }}" class="t16-section-more">
                        {{ App::getLocale() == 'ar' ? 'عرض الكل' : 'View all' }}
                    </a>
                </div>
                <div class="t16-menu-grid">
                    @foreach ($section['items'] as $key => $item)
                        @include('front.template-16._product_card', [
                            'item' => $item,
                            'storeinfo' => $storeinfo,
                            'cartdata' => $cartdata,
                            'key' => ($sIdx * 20) + $key,
                        ])
                    @endforeach
                </div>
            </section>
        @endforeach
    @else
        <div class="t16-empty mt-4">
            <i class="fa-regular fa-utensils"></i>
            {{ App::getLocale() == 'ar' ? 'لا توجد أصناف بعد' : 'No menu items yet' }}
        </div>
    @endif
</div>

<script>
(function () {
    var slider = document.getElementById('t16HeroSlider');
    if (slider) {
        var slides = slider.querySelectorAll('.t16-slide');
        var dots = slider.querySelectorAll('[data-t16dot]');
        var current = 0, timer;
        function show(i) {
            slides.forEach(function (s, idx) {
                s.style.opacity = idx === i ? '1' : '0';
                s.style.position = idx === i ? 'relative' : 'absolute';
                s.style.zIndex = idx === i ? '10' : '0';
            });
            dots.forEach(function (d, idx) { d.style.opacity = idx === i ? '1' : '.4'; });
            current = i;
        }
        window.t16GoSlide = function (i) { show(i); reset(); };
        function auto() { timer = setInterval(function () { show((current + 1) % slides.length); }, 4200); }
        function reset() { clearInterval(timer); auto(); }
        if (slides.length > 1) auto();
    }

    var chipsWrap = document.getElementById('t16StickyChips');
    var sections = document.querySelectorAll('[data-t16-section]');
    var header = document.querySelector('.t16-header');

    // Keep chips inside the sticky header so they never float over the menu grid.
    if (header && chipsWrap && chipsWrap.parentElement !== header) {
        header.appendChild(chipsWrap);
        chipsWrap.classList.add('t16-chips-in-header');
    }

    var chips = document.querySelectorAll('[data-t16-chip]');

    function syncHeaderOffset() {
        var h = header ? header.offsetHeight : 72;
        document.documentElement.style.setProperty('--t16-header-offset', h + 'px');
        return h;
    }
    syncHeaderOffset();
    window.addEventListener('resize', syncHeaderOffset);
    if (window.ResizeObserver && header) {
        new ResizeObserver(syncHeaderOffset).observe(header);
    }

    if (!chipsWrap || !sections.length) return;

    function stickyOffset() {
        return syncHeaderOffset() + 12;
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function (e) {
            var href = chip.getAttribute('href');
            if (!href || href.charAt(0) !== '#') return;
            var target = document.querySelector(href);
            if (!target) return;
            e.preventDefault();
            var top = target.getBoundingClientRect().top + window.pageYOffset - stickyOffset();
            window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
        });
    });

    function setActive(id) {
        chips.forEach(function (c) {
            c.classList.toggle('is-active', String(c.getAttribute('data-t16-chip')) === String(id));
        });
        var active = chipsWrap.querySelector('.t16-cat-chip.is-active');
        if (active && active.scrollIntoView) {
            active.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    }

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActive(entry.target.getAttribute('data-t16-section'));
                }
            });
        }, { rootMargin: '-40% 0px -50% 0px', threshold: 0 });
        sections.forEach(function (s) { observer.observe(s); });
    }
})();
</script>
@include('front.template-16._cart_scripts')
@include('front.theme.footer')
