

<div class="row theme_image g-3">
    <?php $__currentLoopData = $newpath; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6">
        <div class="theme-selection rounded border cursor-pointer"><img src='<?php echo e($path); ?>' alt="" class="w-100 rounded"></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php /**PATH C:\laragon\www\matjarhub\resources\views\landing\themes.blade.php ENDPATH**/ ?>