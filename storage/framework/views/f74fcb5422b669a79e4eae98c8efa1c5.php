<?php
    $items = $section->meta['items'] ?? [];
    if (empty($items) && !empty($section->body)) {
        $items = preg_split('/\r\n|\r|\n/', $section->body);
    }
    $items = array_values(array_filter(array_map('trim', (array) $items)));
?>
<?php if(count($items)): ?>
<section class="mp-section mp-section-benefits">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <ul class="mp-benefits-list">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><i class="fa-solid fa-circle-check"></i><span><?php echo e($benefit); ?></span></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\benefits.blade.php ENDPATH**/ ?>