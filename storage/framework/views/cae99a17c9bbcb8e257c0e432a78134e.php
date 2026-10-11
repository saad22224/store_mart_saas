<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $cartdata = $cartdata ?? collect();
    $allCategories = $category ?? helper::getcategory($storeinfo->id);
    $q = request('search_input');
    $activeCat = request('category');
    $t16Rtl = session()->get('direction') == 2;
?>

<div class="t16-shell" style="padding-top:12px;">
    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-circle" aria-label="<?php echo e(App::getLocale() == 'ar' ? 'رجوع' : 'Back'); ?>">
        <i class="fa-solid <?php echo e($t16Rtl ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
    </a>

    <h1 class="t16-section-title" style="text-transform:none;letter-spacing:-.02em;">
        <?php echo e(App::getLocale() == 'ar' ? 'بحث في القائمة' : 'Search'); ?>

    </h1>
    <?php if($q): ?>
        <p class="t16-section-sub">
            <?php echo e(App::getLocale() == 'ar' ? 'نتائج البحث عن' : 'Results for'); ?> “<?php echo e($q); ?>”
        </p>
    <?php endif; ?>

    <form class="t16-search-pill" action="<?php echo e(URL::to($storeinfo->slug.'/search')); ?>" method="GET" role="search">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="search" name="search_input" value="<?php echo e($q); ?>" autocomplete="off"
            placeholder="<?php echo e(App::getLocale() == 'ar' ? 'بحث' : 'Search'); ?>"
            aria-label="<?php echo e(trans('labels.search')); ?>">
        <?php if($activeCat): ?>
            <input type="hidden" name="category" value="<?php echo e($activeCat); ?>">
        <?php endif; ?>
    </form>

    <?php if($allCategories->count() > 0): ?>
        <div class="t16-cat-chips">
            <a href="<?php echo e(URL::to($storeinfo->slug.'/search'.($q ? '?search_input='.urlencode($q) : ''))); ?>"
                class="t16-cat-chip <?php echo e(empty($activeCat) ? 'is-active' : ''); ?>">
                <span class="t16-cat-chip-name"><?php echo e(App::getLocale() == 'ar' ? 'الكل' : 'All'); ?></span>
            </a>
            <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to($storeinfo->slug.'/search?category='.$cat->slug.($q ? '&search_input='.urlencode($q) : ''))); ?>"
                    class="t16-cat-chip <?php echo e($activeCat == $cat->slug ? 'is-active' : ''); ?>">
                    <span class="t16-cat-chip-name"><?php echo e($cat->name); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($itemlist->count() > 0): ?>
        <div class="t16-menu-list">
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