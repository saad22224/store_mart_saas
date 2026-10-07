<?php
    $image = $section->media['image'] ?? ($section->media['url'] ?? null);
    $position = $section->meta['image_position'] ?? 'start';
?>
<?php if(!empty($section->body) || !empty($image) || !empty($section->title)): ?>
<section class="mp-section mp-section-image_text">
    <div class="mp-section-inner mp-image-text <?php echo e($position === 'end' ? 'mp-image-end' : ''); ?>">
        <?php if(!empty($image)): ?>
            <div class="mp-image-text-media">
                <img src="<?php echo e(helper::image_path($image)); ?>" alt="<?php echo e($section->title ?? ''); ?>" loading="lazy">
            </div>
        <?php endif; ?>
        <div class="mp-image-text-copy">
            <?php if(!empty($section->title)): ?>
                <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
            <?php endif; ?>
            <?php if(!empty($section->body)): ?>
                <div class="mp-rich-body"><?php echo \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li>'); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\image_text.blade.php ENDPATH**/ ?>