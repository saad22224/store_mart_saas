<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $cartdata = $cartdata ?? collect();
    $allCategories = $category ?? helper::getcategory($storeinfo->id);
    $q = request('search_input');
    $activeCat = request('category');
?>

<div class="t16-shell" style="padding-top:18px;">
    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-link">
        <i class="fa-solid <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
        <?php echo e(App::getLocale() == 'ar' ? 'القائمة الرئيسية' : 'Back to menu'); ?>

    </a>

    <div class="t16-section-head" style="margin-top:8px;">
        <div>
            <h1 class="t16-section-title"><?php echo e(App::getLocale() == 'ar' ? 'بحث في القائمة' : 'Search the menu'); ?></h1>
            <p class="t16-section-sub">
                <?php if($q): ?>
                    <?php echo e(App::getLocale() == 'ar' ? 'نتائج البحث عن' : 'Results for'); ?> “<?php echo e($q); ?>”
                <?php else: ?>
                    <?php echo e(App::getLocale() == 'ar' ? 'ابحث عن طبق أو قسم' : 'Find a dish or category'); ?>

                <?php endif; ?>
            </p>
        </div>
    </div>

    <form class="t16-search-local" action="<?php echo e(URL::to($storeinfo->slug.'/search')); ?>" method="GET" role="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" name="search_input" value="<?php echo e($q); ?>" autocomplete="off"
            placeholder="<?php echo e(App::getLocale() == 'ar' ? 'ابحث عن صنف...' : 'Search for a dish...'); ?>">
        <?php if($activeCat): ?>
            <input type="hidden" name="category" value="<?php echo e($activeCat); ?>">
        <?php endif; ?>
    </form>

    <?php if($allCategories->count() > 0): ?>
        <div class="t16-cat-chips" style="margin-bottom:14px;">
            <a href="<?php echo e(URL::to($storeinfo->slug.'/search'.($q ? '?search_input='.urlencode($q) : ''))); ?>"
                class="t16-cat-chip <?php echo e(empty($activeCat) ? 'is-active' : ''); ?>">
                <span class="t16-cat-chip-name"><?php echo e(App::getLocale() == 'ar' ? 'الكل' : 'All'); ?></span>
            </a>
            <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to($storeinfo->slug.'/search?category='.$cat->slug.($q ? '&search_input='.urlencode($q) : ''))); ?>"
                    class="t16-cat-chip <?php echo e($activeCat == $cat->slug ? 'is-active' : ''); ?>">
                    <span class="t16-cat-chip-img">
                        <?php if(! empty($cat->image) && $cat->image !== 'default.png'): ?>
                            <img src="<?php echo e(helper::image_path($cat->image)); ?>" alt="" loading="lazy">
                        <?php else: ?>
                            <i class="fa-solid fa-utensils"></i>
                        <?php endif; ?>
                    </span>
                    <span class="t16-cat-chip-name"><?php echo e($cat->name); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($itemlist->count() > 0): ?>
        <div class="t16-menu-grid">
            <?php $__currentLoopData = $itemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('front.template-16._product_card', [
                    'item' => $item,
                    'storeinfo' => $storeinfo,
                    'cartdata' => $cartdata,
                    'key' => $key,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if($itemlist->hasPages()): ?>
            <div class="t16-pagination"><?php echo e($itemlist->withQueryString()->links()); ?></div>
        <?php endif; ?>
    <?php else: ?>
        <div class="t16-empty">
            <i class="fa-regular fa-magnifying-glass"></i>
            <?php echo e(App::getLocale() == 'ar' ? 'لا توجد نتائج' : 'No results found'); ?>

        </div>
    <?php endif; ?>
</div>

<?php echo $__env->make('front.template-16._cart_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/search.blade.php ENDPATH**/ ?>