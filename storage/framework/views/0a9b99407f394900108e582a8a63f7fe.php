<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('front.template-22.partials.theme_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
            <span>/</span>
            <span><?php echo e(trans('labels.contact_us')); ?></span>
        </nav>
        <div class="mp-page-head">
            <h1><?php echo e(trans('labels.contact_us')); ?></h1>
            <p><?php echo e(trans('labels.contact_further_question') ?? ''); ?></p>
        </div>

        <div class="mp-contact-grid">
            <div class="mp-contact-info">
                <?php if(!empty(helper::appdata($storeinfo->id)->email)): ?>
                    <a href="mailto:<?php echo e(helper::appdata($storeinfo->id)->email); ?>">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <strong><?php echo e(trans('labels.email')); ?></strong>
                            <div class="text-muted"><?php echo e(helper::appdata($storeinfo->id)->email); ?></div>
                        </div>
                    </a>
                <?php endif; ?>
                <?php if(!empty(helper::appdata($storeinfo->id)->contact)): ?>
                    <a href="tel:<?php echo e(helper::appdata($storeinfo->id)->contact); ?>">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <strong><?php echo e(trans('labels.mobile')); ?></strong>
                            <div class="text-muted"><?php echo e(helper::appdata($storeinfo->id)->contact); ?></div>
                        </div>
                    </a>
                <?php endif; ?>
                <?php if(!empty(helper::appdata($storeinfo->id)->address)): ?>
                    <a href="https://www.google.com/maps/place/<?php echo e(urlencode(helper::appdata($storeinfo->id)->address)); ?>" target="_blank" rel="noopener">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <strong><?php echo e(trans('labels.address')); ?></strong>
                            <div class="text-muted"><?php echo e(helper::appdata($storeinfo->id)->address); ?></div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

            <div class="mp-cms-card">
                <form method="POST" action="<?php echo e(URL::to($storeinfo->slug . '/submit')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="vendor_id" value="<?php echo e($storeinfo->id); ?>">
                    <div class="mp-form-row">
                        <div class="mp-form-group">
                            <label class="mp-form-label"><?php echo e(trans('labels.first_name')); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input" name="fname" required placeholder="<?php echo e(trans('labels.first_name')); ?>">
                        </div>
                        <div class="mp-form-group">
                            <label class="mp-form-label"><?php echo e(trans('labels.last_name')); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input" name="lname" required placeholder="<?php echo e(trans('labels.last_name')); ?>">
                        </div>
                    </div>
                    <div class="mp-form-row">
                        <div class="mp-form-group">
                            <label class="mp-form-label"><?php echo e(trans('labels.email')); ?> <span class="text-danger">*</span></label>
                            <input type="email" class="mp-input" name="email" required placeholder="<?php echo e(trans('labels.email')); ?>">
                        </div>
                        <div class="mp-form-group">
                            <label class="mp-form-label"><?php echo e(trans('labels.mobile')); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input mobile-number" name="mobile" required placeholder="<?php echo e(trans('labels.mobile')); ?>">
                        </div>
                    </div>
                    <div class="mp-form-group">
                        <label class="mp-form-label"><?php echo e(trans('labels.message')); ?> <span class="text-danger">*</span></label>
                        <textarea class="mp-textarea" name="message" required placeholder="<?php echo e(trans('labels.message')); ?>"></textarea>
                    </div>
                    <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <button type="submit" name="submit" id="btnsubmit" class="mp-btn-primary w-100"><?php echo e(trans('labels.submit')); ?></button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\template-22\contact.blade.php ENDPATH**/ ?>