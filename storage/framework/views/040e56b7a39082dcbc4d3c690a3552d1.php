<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="breadcrumb-sec bg-change-mode">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug.'/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> text-dark active" aria-current="page"><?php echo e(trans('labels.about_us')); ?></li>

            </ol>

        </nav>

    </div>

</section>

<section class="product-prev-sec cms-section product-list-sec">

    <div class="container">

        <?php if(@$about->about_content != ""): ?>
            <?php echo @$about->about_content; ?>

        <?php else: ?>
            <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

</section>

<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/about.blade.php ENDPATH**/ ?>