<?php $__env->startSection('content'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="breadcrumb-sec m-0 bg-light bg-changer">
        <div class="container">
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark color-changer"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"
                        aria-current="page"><?php echo e(trans('landing.contact_us')); ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <section>
        <div class="contact-bg-color py-0">
            <div class="container contact-container">
                <div class="contact-main">
                    <div class="row align-items-center g-3 mt-4 mb-5">
                        <div class="col-lg-6">
                            <form class="shadow-lg bg-white bg-changer rounded-3 px-4 py-4"
                                action="<?php echo e(URL::To('/inquiry')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <h5 class="contact-form-title color-changer text-center">
                                    <?php echo e(trans('landing.contact_us')); ?>

                                </h5>
                                <p class="contact-form-subtitle text-center text-muted">
                                    <?php echo e(trans('landing.contact_section_description')); ?></p>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label for="name"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.name')); ?></label>
                                        <input type="text" class="form-control contact-input" name="name"
                                            placeholder="<?php echo e(trans('landing.name')); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.email')); ?></label>
                                        <input type="email" class="form-control contact-input" name="email"
                                            placeholder="<?php echo e(trans('landing.email')); ?>" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.mobile')); ?></label>
                                        <input type="text" class="form-control contact-input mobile-number"
                                            name="mobile" placeholder="<?php echo e(trans('landing.mobile')); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.message')); ?></label>
                                        <textarea class="form-control contact-input" rows="3" name="message" placeholder="<?php echo e(trans('landing.message')); ?>"
                                            required></textarea>
                                    </div>
                                    <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="col-auto mx-auto">
                                        <button type="submit"
                                            class="btn-secondary rounded-2 text-center m-auto d-block w-100"><?php echo e(trans('landing.submit')); ?></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6 class="color-changer d-flex gap-2">
                                        <i class="fa-solid fa-envelope"></i>
                                        <?php echo e(trans('landing.email')); ?>

                                    </h6>

                                    <p class="mb-0"><a href="mailto:<?php echo e(helper::appdata('')->email); ?>"
                                            class="text-dark color-changer fs-7">
                                            <?php echo e(helper::appdata('')->email); ?></a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100 ">
                                    <h6 class="color-changer d-flex gap-2">
                                        <i class="fa-solid fa-phone"></i>
                                        <?php echo e(trans('landing.mobile')); ?>

                                    </h6>
                                    <p class="mb-0"><a href="tel:<?php echo e(helper::appdata('')->contact); ?>"
                                            class="text-dark color-changer fs-7"><?php echo e(helper::appdata('')->contact); ?></a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6 class="color-changer d-flex gap-2">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <?php echo e(trans('landing.address')); ?>

                                    </h6>
                                    <p class="mb-0 fs-7 color-changer">
                                        <?php echo e(helper::appdata('')->address); ?>

                                    </p>
                                </div>
                            </div>
                            <?php if(count(@helper::getsociallinks(1)) > 0): ?>
                                <div>
                                    <div class="card border-0 shadow rounded p-4 h-100 ">

                                        <div class="contact-icons d-flex">
                                            <?php $__currentLoopData = @helper::getsociallinks(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($links->link); ?>" target="_blank"
                                                    class="rounded-2 contact-icon"><?php echo $links->icon; ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- IF VERSION 2  -->
    <?php if(helper::appdata('')->recaptcha_version == 'v2'): ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php endif; ?>
    <!-- IF VERSION 3  -->
    <?php if(helper::appdata('')->recaptcha_version == 'v3'): ?>
        <?php echo RecaptchaV3::initJs(); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/landing/contact.blade.php ENDPATH**/ ?>