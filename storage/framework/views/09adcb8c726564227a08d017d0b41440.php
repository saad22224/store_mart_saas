<?php
    $faqs = $section->meta['items'] ?? [];
    if (empty($faqs) && !empty($section->body)) {
        $blocks = preg_split('/\r\n\r\n|\n\n/', $section->body);
        foreach ($blocks as $block) {
            $lines = preg_split('/\r\n|\r|\n/', trim($block));
            if (count($lines) >= 2) {
                $faqs[] = [
                    'q' => trim($lines[0]),
                    'a' => trim(implode("\n", array_slice($lines, 1))),
                ];
            }
        }
    }
?>
<?php if(count($faqs)): ?>
<section class="mp-section mp-section-faq">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <div class="mp-faq-list">
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $q = is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : '';
                    $a = is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : '';
                ?>
                <details class="mp-faq-item" <?php if($i === 0): ?> open <?php endif; ?>>
                    <summary><?php echo e($q); ?></summary>
                    <div class="mp-faq-body"><?php echo e($a); ?></div>
                </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/sections/faq.blade.php ENDPATH**/ ?>