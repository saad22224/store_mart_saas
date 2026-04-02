<?php
    $i = 1;
?>

<?php $__currentLoopData = helper::storedata(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col" data-aos="fade-up" data-aos-delay="<?php echo e($i++); ?>00" data-aos-duration="1000">
        <a href="<?php echo e(URL::to($user->slug . '/')); ?>" target="_blank">
            <div class="post-slide h-100 card card-bg border-0">
                <div class="post-img rounded-3 overflow-hidden">
                    <span class="over-layer">
                    </span>
                    <img src="<?php echo e(@helper::image_path(@$user->cover_image)); ?>" alt="">
                </div>
                <div class="card-body pt-3 p-0">
                    <h3 class="fs-6 post-title color-changer text-capitalize fw-600 line-2 m-0">
                        <?php echo e(@$user->website_title); ?>

                    </h3>
                </div>
            </div>
        </a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/landing/storelist.blade.php ENDPATH**/ ?>