
<?php
    $image = $section->media['image'] ?? ($section->media['url'] ?? null);
?>
<?php if(!empty($image)): ?>
<section class="mp-section mp-section-image-only">
    <div class="mp-image-only-wrap">
        <img src="<?php echo e(helper::image_path($image)); ?>" alt="" loading="lazy">
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-22/partials/sections/image.blade.php ENDPATH**/ ?>