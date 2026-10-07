<div class="row theme_image g-3">
    <?php $__currentLoopData = $newpath; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6">
            <div class="theme-selection border w-100 rounded cursor-pointer"><img src='<?php echo e($path); ?>' alt=""
                    class="w-100 rounded">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\theme\themeimages.blade.php ENDPATH**/ ?>