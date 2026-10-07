<?php if(!empty($section->body) || !empty($section->title)): ?>
<section class="mp-section mp-section-rich_text">
    <div class="mp-section-inner mp-prose">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <?php if(!empty($section->body)): ?>
            <div class="mp-rich-body"><?php echo \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li><h3><h4><a>'); ?></div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\rich_text.blade.php ENDPATH**/ ?>