<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $q = request()->get('search_input');
    $catSlug = request()->get('category');
    $filter = request()->get('filter');
    $baseSearch = URL::to($storeinfo->slug . '/search');
    $hasQuery = filled($q) || filled($catSlug);
?>

<main class="mp-search-page mp-body">
    <div class="mp-wrap mp-search-wrap">
        <form action="<?php echo e($baseSearch); ?>" method="GET" class="mp-underline-search" role="search">
            <?php if($catSlug): ?>
                <input type="hidden" name="category" value="<?php echo e($catSlug); ?>">
            <?php endif; ?>
            <?php if($filter): ?>
                <input type="hidden" name="filter" value="<?php echo e($filter); ?>">
            <?php endif; ?>
            <label class="mp-underline-label" for="mpPageSearch">بحث</label>
            <div class="mp-underline-row">
                <button type="submit" class="mp-underline-icon" aria-label="بحث">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input type="search" name="search_input" id="mpPageSearch" value="<?php echo e($q); ?>"
                    placeholder="" autocomplete="off">
            </div>
        </form>

        <?php if($hasQuery && $itemlist->count() > 0): ?>
            <div class="mp-results-meta">
                <div>
                    <strong><?php echo e($itemlist->firstItem()); ?>–<?php echo e($itemlist->lastItem()); ?></strong>
                    من <strong><?php echo e($itemlist->total()); ?></strong> نتيجة
                </div>
            </div>
            <div class="mp-grid">
                <?php $__currentLoopData = $itemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mp-pagination"><?php echo e($itemlist->withQueryString()->links()); ?></div>
        <?php elseif($hasQuery): ?>
            <div class="mp-search-empty">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>لم يتم العثور على نتائج</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\search.blade.php ENDPATH**/ ?>