<?php
    $sectionTitle = $section->title ?? null;
?>
<section class="mp-section mp-section-<?php echo e($section->section_type); ?>" data-section-type="<?php echo e($section->section_type); ?>">
    <div class="mp-section-inner">
        <?php if(!empty($sectionTitle)): ?>
            <h2 class="mp-section-heading"><?php echo e($sectionTitle); ?></h2>
        <?php endif; ?>
        <?php echo e($slot ?? ''); ?>

        <?php echo $__env->yieldContent('section_body'); ?>
    </div>
</section>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\_section_shell.blade.php ENDPATH**/ ?>