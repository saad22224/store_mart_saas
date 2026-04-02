<?php if($testimonials->count() > 0): ?>

    <section class="storereview-sec mb-5">

        <div class="container">
            <div class="sec-header py-2 mb-3">
                <h4 class="main-title color-changer mb-2"><?php echo e(trans('labels.testimonials')); ?></h4>
                <p class="m-0 line-2 fs-15 text-muted"><?php echo e(trans('labels.testimonials_subtitle')); ?></p>
            </div>

            <div class="store-review owl-carousel owl-theme">

                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">

                        <div class="card h-100 bg-light rounded p-4">

                            <div class="card-body p-0">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="review-img">

                                        <img src="<?php echo e(helper::image_path($item->image)); ?>" alt="">

                                    </div>

                                    <div class="px-3">

                                        <h5 class="line-1 mb-1 color-changer review_title"><?php echo e($item->name); ?></h5>

                                        <p class="review_date color-changer fs-8">
                                            <?php echo e(helper::date_format($item->created_at, $item->vendor_id)); ?></p>

                                    </div>

                                </div>

                                <?php

                                    $count = $item->star;

                                ?>

                                <div class="d-flex gap-1 pb-2">

                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <?php if($i < $count): ?>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fa-solid fa-star text-warning"></i>

                                            </li>
                                        <?php else: ?>
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fa-regular fa-star text-warning"></i>

                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                </div>

                                <div class="review_description">

                                    <p class="text-muted"><?php echo e($item->description); ?></p>

                                </div>

                            </div>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

<?php endif; ?>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/front/testimonial.blade.php ENDPATH**/ ?>