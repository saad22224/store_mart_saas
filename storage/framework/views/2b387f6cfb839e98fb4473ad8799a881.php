<?php
    $url = $section->media['url'] ?? ($section->meta['url'] ?? $section->body);
    $embed = null;
    if (!empty($url) && is_string($url)) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/', $url, $m)) {
            $embed = 'https://www.youtube.com/embed/' . $m[1];
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            $embed = 'https://player.vimeo.com/video/' . $m[1];
        }
    }
?>
<?php if($embed || (!empty($url) && str_ends_with(strtolower((string) $url), '.mp4'))): ?>
<section class="mp-section mp-section-video">
    <div class="mp-section-inner">
        <?php if(!empty($section->title)): ?>
            <h2 class="mp-section-heading"><?php echo e($section->title); ?></h2>
        <?php endif; ?>
        <div class="mp-video-wrap">
            <?php if($embed): ?>
                <iframe src="<?php echo e($embed); ?>" title="<?php echo e($section->title ?? 'video'); ?>" allowfullscreen loading="lazy"></iframe>
            <?php else: ?>
                <video controls preload="metadata" src="<?php echo e($url); ?>"></video>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\partials\sections\video.blade.php ENDPATH**/ ?>