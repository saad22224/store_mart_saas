
<?php
    $sectionId = $sectionId ?? ('mp-sec-' . uniqid());
    $viewAllUrl = $viewAllUrl ?? null;
    $products = $products ?? collect();
?>
<?php if($products->count() > 0): ?>
<section class="mp-product-sec" id="<?php echo e($sectionId); ?>">
    <div class="mp-sec-bar">
        <h2 class="mp-sec-title"><?php echo e($title); ?></h2>
        <div class="mp-sec-controls">
            <?php if($viewAllUrl): ?>
                <a href="<?php echo e($viewAllUrl); ?>" class="mp-view-all">عرض الكل</a>
            <?php endif; ?>
            <button type="button" class="mp-scroll-btn" data-mp-scroll="<?php echo e($sectionId); ?>" data-dir="next" aria-label="التالي">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <button type="button" class="mp-scroll-btn" data-mp-scroll="<?php echo e($sectionId); ?>" data-dir="prev" aria-label="السابق">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
        </div>
    </div>
    <div class="mp-product-rail" data-mp-rail="<?php echo e($sectionId); ?>">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\product_section.blade.php ENDPATH**/ ?>