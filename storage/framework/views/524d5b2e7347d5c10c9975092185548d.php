<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $cartdata = $cartdata ?? collect();
    $getcategory = $getcategory ?? helper::getcategory($storeinfo->id);
?>

<div class="t16-shell" style="padding-top:18px;">
    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-link">
        <i class="fa-solid <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
        <?php echo e(App::getLocale() == 'ar' ? 'القائمة الرئيسية' : 'Back to menu'); ?>

    </a>

    <div class="t16-section-head" style="margin-top:8px;">
        <div>
            <h1 class="t16-section-title"><?php echo e($category->name); ?></h1>
            <p class="t16-section-sub"><?php echo e(App::getLocale() == 'ar' ? 'اختر أصنافك وأضفها للسلة' : 'Pick your items and add to cart'); ?></p>
        </div>
    </div>

    <?php if($getcategory->count() > 0): ?>
        <div class="t16-cat-chips" style="margin-bottom:8px;">
            <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to($storeinfo->slug.'/category/'.$cat->slug)); ?>"
                    class="t16-cat-chip <?php echo e($cat->id == $category->id ? 'is-active' : ''); ?>">
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

    <div class="t16-search-local">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" id="t16SearchInput" autocomplete="off"
            placeholder="<?php echo e(App::getLocale() == 'ar' ? 'ابحث داخل هذا القسم...' : 'Search in this category...'); ?>">
    </div>

    <?php if($products->count() > 0): ?>
        <div class="t16-menu-grid" id="t16ProductsGrid">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('front.template-16._product_card', [
                    'item' => $item,
                    'storeinfo' => $storeinfo,
                    'cartdata' => $cartdata,
                    'key' => $key,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="t16-empty" id="t16NoResults" style="display:none;margin-top:16px;">
            <i class="fa-regular fa-face-meh"></i>
            <?php echo e(App::getLocale() == 'ar' ? 'لا توجد نتائج مطابقة' : 'No matching items'); ?>

        </div>
        <?php if($products->hasPages()): ?>
            <div class="t16-pagination"><?php echo e($products->links()); ?></div>
        <?php endif; ?>
    <?php else: ?>
        <div class="t16-empty">
            <i class="fa-regular fa-utensils"></i>
            <?php echo e(App::getLocale() == 'ar' ? 'لا توجد أصناف في هذا القسم' : 'No items in this category'); ?>

        </div>
    <?php endif; ?>
</div>

<script>
(function () {
    var input = document.getElementById('t16SearchInput');
    var grid = document.getElementById('t16ProductsGrid');
    var empty = document.getElementById('t16NoResults');
    if (!input || !grid) return;
    input.addEventListener('input', function () {
        var q = (input.value || '').trim().toLowerCase();
        var cards = grid.querySelectorAll('.t16-card');
        var shown = 0;
        cards.forEach(function (card) {
            var name = (card.getAttribute('data-name') || '').toLowerCase();
            var ok = !q || name.indexOf(q) !== -1;
            card.style.display = ok ? '' : 'none';
            if (ok) shown++;
        });
        if (empty) empty.style.display = shown ? 'none' : 'block';
    });
})();
</script>
<?php echo $__env->make('front.template-16._cart_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-16/category.blade.php ENDPATH**/ ?>