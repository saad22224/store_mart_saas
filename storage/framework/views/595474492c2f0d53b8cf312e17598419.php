<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="mp-category mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <div class="mp-page-head">
            <h1><?php echo e($category->name ?? trans('labels.category')); ?></h1>
            <?php if(!empty($category->description)): ?>
                <p><?php echo nl2br(e(strip_tags($category->description))); ?></p>
            <?php endif; ?>
        </div>

        <?php if(isset($getcategory) && $getcategory->count() > 0): ?>
            <div class="mp-cat-scroll">
                <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="mp-cat-chip <?php echo e(isset($category) && $category->id == $cat->id ? 'is-active' : ''); ?>"
                        href="<?php echo e(URL::to(@$storeinfo->slug . '/category/' . $cat->slug)); ?>">
                        <?php echo e($cat->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($products) && $products->count() > 0): ?>
            <div class="mp-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(method_exists($products, 'links')): ?>
                <div class="mp-pagination"><?php echo e($products->withQueryString()->links()); ?></div>
            <?php endif; ?>
        <?php else: ?>
            <div class="mp-search-empty">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>لم يتم العثور على نتائج</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\category.blade.php ENDPATH**/ ?>