
<?php if(!empty($section->title) || !empty($section->body)): ?>
<section class="mp-section mp-section-generic" data-section-type="<?php echo e($section->section_type); ?>">
    <div class="mp-section-inner mp-prose">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <?php if(!empty($section->body)): ?>
            <div class="mp-rich-body"><?php echo \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li>'); ?></div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\generic.blade.php ENDPATH**/ ?>