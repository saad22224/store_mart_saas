<section class="mp-section mp-section-cta">
    <div class="mp-section-inner mp-cta-box">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <?php if(!empty($section->body)): ?>
            <p class="mp-cta-text"><?php echo e(strip_tags($section->body)); ?></p>
        <?php endif; ?>
        <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
            <button type="button" class="mp-btn-primary addtocart" onclick="AddtoCart('0')">
                <?php echo e($section->meta['button_label'] ?? trans('labels.add_to_cart')); ?>

            </button>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\cta.blade.php ENDPATH**/ ?>