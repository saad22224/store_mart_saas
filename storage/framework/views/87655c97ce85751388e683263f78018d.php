<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
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
?>

<div class="t16-page">
    <div class="t16-cover" id="t16Cover">
        <?php if($bannerSlides->count() > 0): ?>
            <div class="t16-cover-slider" id="t16CoverSlider">
                <?php $__currentLoopData = $bannerSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bi => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isFirst = $bi === 0; ?>
                    <div class="t16-cover-slide<?php echo e($isFirst ? ' is-active' : ''); ?>" data-t16-slide="<?php echo e($bi); ?>">
                        <?php if($slide->href): ?>
                            <a href="<?php echo e($slide->href); ?>" class="t16-cover-slide-link">
                                <img src="<?php echo e($slide->src); ?>" alt="<?php echo e($storeName); ?>" <?php echo e($isFirst ? 'loading=eager' : 'loading=lazy'); ?>>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slide->src); ?>" alt="<?php echo e($storeName); ?>" <?php echo e($isFirst ? 'loading=eager' : 'loading=lazy'); ?>>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($bannerSlides->count() > 1): ?>
                    <div class="t16-cover-dots" id="t16CoverDots" aria-hidden="true">
                        <?php $__currentLoopData = $bannerSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bi => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="t16-cover-dot<?php echo e($bi === 0 ? ' is-active' : ''); ?>" data-t16-dot="<?php echo e($bi); ?>" aria-label="Slide <?php echo e($bi + 1); ?>"></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="t16-cover-fallback" aria-hidden="true"></div>
        <?php endif; ?>
    </div>

    <div class="t16-sheet">
        <h1 class="t16-store-title"><?php echo e($storeName); ?></h1>

        <?php if($address !== '' || $contact !== ''): ?>
            <div class="t16-meta">
                <?php if($address !== ''): ?>
                    <a class="t16-meta-row" href="https://maps.google.com/?q=<?php echo e(urlencode($address)); ?>" target="_blank" rel="noopener">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span><?php echo e($address); ?></span>
                    </a>
                <?php endif; ?>
                <?php if($contact !== ''): ?>
                    <a class="t16-meta-row" href="tel:<?php echo e(preg_replace('/\s+/', '', $contact)); ?>">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <span><?php echo e($contact); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($description !== ''): ?>
            <p class="t16-store-desc"><?php echo e($description); ?></p>
        <?php endif; ?>

        <form class="t16-search-pill" action="<?php echo e(URL::to($storeinfo->slug.'/search')); ?>" method="GET" role="search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <input type="search" name="search_input" value="<?php echo e(request('search_input')); ?>"
                placeholder="<?php echo e(App::getLocale() == 'ar' ? 'بحث' : 'Search'); ?>"
                autocomplete="off" aria-label="<?php echo e(trans('labels.search')); ?>">
        </form>

        <?php if($categories->count() > 0): ?>
            <div class="t16-cat-covers">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $catImg = (! empty($cat->image) && $cat->image !== 'default.png')
                            ? helper::image_path($cat->image)
                            : null;
                    ?>
                    <a href="<?php echo e(URL::to($storeinfo->slug.'/category/'.$cat->slug)); ?>" class="t16-cat-cover">
                        <?php if($catImg): ?>
                            <img src="<?php echo e($catImg); ?>" alt="<?php echo e($cat->name); ?>" loading="lazy">
                        <?php else: ?>
                            <div class="t16-cat-cover-ph" aria-hidden="true"></div>
                        <?php endif; ?>
                        <span class="t16-cat-cover-overlay">
                            <span class="t16-cat-cover-name"><?php echo e($cat->name); ?></span>
                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="t16-empty">
                <i class="fa-regular fa-utensils"></i>
                <?php echo e(App::getLocale() == 'ar' ? 'لا توجد أقسام بعد' : 'No categories yet'); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php if($bannerSlides->count() > 1): ?>
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
<?php endif; ?>

<?php echo $__env->make('front.template-16._cart_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/home.blade.php ENDPATH**/ ?>