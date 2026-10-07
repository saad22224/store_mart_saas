<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $homeSliders = isset($sliders) ? $sliders : collect();
    $categories = helper::getcategory($storeinfo->id);
    $allItems = collect($getitem ?? []);
?>

<main class="mp-home mp-body">
    <?php if($homeSliders->count() > 0): ?>
        <section class="mp-hero" id="mpHero">
            <?php $__currentLoopData = $homeSliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $slideLink = URL::to($storeinfo->slug . '/');
                    if (!empty($slide->product_id) && @$slide->product_info) {
                        $slideLink = URL::to($storeinfo->slug . '/detail-' . $slide->product_info->slug);
                    } elseif (!empty($slide->category_id) && @$slide->category_info) {
                        $slideLink = URL::to($storeinfo->slug . '/category/' . $slide->category_info->slug);
                    }
                ?>
                <a href="<?php echo e($slideLink); ?>" class="mp-hero-slide <?php echo e($i === 0 ? 'is-active' : ''); ?>">
                    <img src="<?php echo e(helper::image_path($slide->image)); ?>" alt="<?php echo e($slide->title ?? $storeinfo->name); ?>" loading="<?php echo e($i === 0 ? 'eager' : 'lazy'); ?>">
                    <?php if(!empty($slide->title)): ?>
                        <div class="mp-hero-caption"><h2><?php echo e($slide->title); ?></h2></div>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    <?php endif; ?>

    <div class="mp-wrap mp-home-sections">
        
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $catProducts = $allItems->filter(function ($p) use ($category) {
                    $ids = preg_split('/[|,]/', (string) ($p->cat_id ?? ''));
                    return in_array((string) $category->id, $ids, true);
                })->take(10)->values();
            ?>
            <?php echo $__env->make('front.template-22.partials.product_section', [
                'title' => $category->name,
                'products' => $catProducts,
                'storeinfo' => $storeinfo,
                'viewAllUrl' => URL::to($storeinfo->slug . '/category/' . $category->slug),
                'sectionId' => 'mp-cat-' . $category->id,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php if($allItems->count() > 0): ?>
                <?php echo $__env->make('front.template-22.partials.product_section', [
                    'title' => 'المنتجات',
                    'products' => $allItems->take(12),
                    'storeinfo' => $storeinfo,
                    'viewAllUrl' => URL::to($storeinfo->slug . '/search'),
                    'sectionId' => 'mp-all-products',
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($bannerimage1) && $bannerimage1->count() > 0): ?>
            <div class="mp-banner-row">
                <?php $__currentLoopData = $bannerimage1->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(helper::image_path($banner->image)); ?>" alt="" loading="lazy">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($bannerimage2) && $bannerimage2->count() > 0): ?>
            <div class="mp-banner-row">
                <?php $__currentLoopData = $bannerimage2->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(helper::image_path($banner->image)); ?>" alt="" loading="lazy">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
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

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/home.blade.php ENDPATH**/ ?>