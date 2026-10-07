<?php
    $specs = $section->meta['items'] ?? [];
    if (empty($specs) && !empty($section->body)) {
        $lines = preg_split('/\r\n|\r|\n/', $section->body);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || !str_contains($line, ':')) continue;
            [$k, $v] = array_map('trim', explode(':', $line, 2));
            $specs[] = ['label' => $k, 'value' => $v];
        }
    }
?>
<?php if(count($specs)): ?>
<section class="mp-section mp-section-specifications">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <dl class="mp-specs">
            <?php $__currentLoopData = $specs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $label = is_array($spec) ? ($spec['label'] ?? '') : '';
                    $value = is_array($spec) ? ($spec['value'] ?? '') : $spec;
                ?>
                <div class="mp-spec-row">
                    <dt><?php echo e($label); ?></dt>
                    <dd><?php echo e($value); ?></dd>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </dl>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\specifications.blade.php ENDPATH**/ ?>