<?php
    $items = $section->meta['items'] ?? [];
    if (empty($items) && !empty($section->body)) {
        $items = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $section->body))));
    }
?>
<?php if(count($items)): ?>
<section class="mp-section mp-section-trust">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <div class="mp-trust-banner">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mp-trust-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span><?php echo e(is_array($item) ? ($item['text'] ?? $item['title'] ?? '') : $item); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\trust.blade.php ENDPATH**/ ?>