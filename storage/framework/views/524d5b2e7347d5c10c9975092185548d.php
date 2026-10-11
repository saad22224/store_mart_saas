<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-16._theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $cartdata = $cartdata ?? collect();
    $appdata = helper::appdata($storeinfo->id);
    $address = trim((string) ($appdata->address ?? ''));
    $contact = trim((string) ($appdata->contact ?? ''));
    if ($contact === '-') {
        $contact = '';
    }
    $t16Rtl = session()->get('direction') == 2;
?>

<div class="t16-shell" style="padding-top:8px;">
    <?php if($address !== '' || $contact !== ''): ?>
        <div class="t16-cat-topmeta">
            <?php if($address !== ''): ?>
                <a href="https://maps.google.com/?q=<?php echo e(urlencode($address)); ?>" target="_blank" rel="noopener">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    <span><?php echo e($address); ?></span>
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
            <?php if($contact !== ''): ?>
                <a href="tel:<?php echo e(preg_replace('/\s+/', '', $contact)); ?>">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <span><?php echo e($contact); ?></span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>" class="t16-back-circle" aria-label="<?php echo e(App::getLocale() == 'ar' ? 'رجوع' : 'Back'); ?>">
        <i class="fa-solid <?php echo e($t16Rtl ? 'fa-arrow-right' : 'fa-arrow-left'); ?>"></i>
    </a>

    <h1 class="t16-section-title"><?php echo e($category->name); ?></h1>

    <form class="t16-search-pill" action="<?php echo e(URL::to($storeinfo->slug.'/search')); ?>" method="GET" role="search" style="margin-bottom:20px;">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="hidden" name="category" value="<?php echo e($category->slug); ?>">
        <input type="search" name="search_input" id="t16SearchInput" autocomplete="off"
            placeholder="<?php echo e(App::getLocale() == 'ar' ? 'بحث' : 'Search'); ?>"
            aria-label="<?php echo e(trans('labels.search')); ?>">
    </form>

    <?php if($products->count() > 0): ?>
        <div class="t16-menu-list" id="t16ProductsGrid">
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
        <?php if(method_exists($products, 'hasPages') && $products->hasPages()): ?>
            <div class="t16-pagination"><?php echo e($products->withQueryString()->links()); ?></div>
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
            var name = card.getAttribute('data-name') || '';
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