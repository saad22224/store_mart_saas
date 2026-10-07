
<footer class="mp-footer">
    <div class="mp-footer-grid">
        <div class="mp-footer-news">
            <h5>اشترك في نشرتنا الإخبارية</h5>
            <form action="<?php echo e(URL::to(@$storeinfo->slug . '/subscribe')); ?>" method="POST" class="mp-news-form">
                <?php echo csrf_field(); ?>
                <input type="email" name="subscribe_email" placeholder="Email Address" required>
                <button type="submit" aria-label="اشتراك"><i class="fa-solid fa-arrow-left"></i></button>
            </form>
        </div>
        <div class="mp-footer-pages">
            <h5>الصفحات</h5>
            <ul>
                <li><a href="<?php echo e(URL::to(@$storeinfo->slug . '/privacy')); ?>">سياسات الخصوصية</a></li>
                <li><a href="<?php echo e(URL::to(@$storeinfo->slug . '/refund_policy')); ?>">سياسة الاستبدال و الاسترجاع</a></li>
                <li><a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">سياسة الشحن</a></li>
                <li><a href="<?php echo e(URL::to(@$storeinfo->slug . '/terms')); ?>">شروط الاستخدام</a></li>
            </ul>
        </div>
    </div>
    <div class="mp-footer-bottom">
        <?php echo e(helper::appdata(@$storeinfo->id)->copyright ?? ('© ' . date('Y') . ' ' . @$storeinfo->name)); ?>

    </div>
</footer>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\layout\footer.blade.php ENDPATH**/ ?>