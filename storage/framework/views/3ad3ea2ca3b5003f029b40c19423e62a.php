<?php
    $features = $section->meta['items'] ?? [];
    if (empty($features) && !empty($section->body)) {
        $lines = preg_split('/\r\n|\r|\n/', $section->body);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;
            $parts = explode('|', $line, 2);
            $features[] = [
                'title' => trim($parts[0]),
                'text' => trim($parts[1] ?? ''),
            ];
        }
    }
?>
<?php if(count($features)): ?>
<section class="mp-section mp-section-features">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <div class="mp-features-grid">
            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $ft = is_array($feature) ? ($feature['title'] ?? '') : $feature;
                    $fx = is_array($feature) ? ($feature['text'] ?? '') : '';
                ?>
                <div class="mp-feature-card">
                    <div class="mp-feature-icon"><i class="fa-solid fa-sparkles"></i></div>
                    <h3><?php echo e($ft); ?></h3>
                    <?php if($fx): ?><p><?php echo e($fx); ?></p><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\features.blade.php ENDPATH**/ ?>