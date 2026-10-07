<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(helper::appdata('')->website_title); ?></title>
    <link rel="icon" href="<?php echo e(helper::image_path(helper::appdata('')->favicon)); ?>" type="image" sizes="16x16">
    <!-- Favicon icon -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/responsive.css')); ?>">
    <style>
        :root {
            /* Color */
            --primary-color: <?php echo e(helper::landingsettings()->primary_color); ?>;
            --secondary-color: <?php echo e(helper::landingsettings()->secondary_color); ?>;
        }
    </style>
</head>

<body>
    <div class="d-none d-xl-block">
        <div class="arrow">
            <div class="arrow__body"></div>
        </div>
    </div>
    <section class="bg-gradient-color2 h-100 custom-padding">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="h-100 d-flex gap-3 justify-content-center flex-column">
                        <div class="logo">
                            <a href="<?php echo e(URL::to('/')); ?>">
                                <img src="<?php echo e(helper::image_path(helper::appdata('')->logo)); ?>" height="50"
                                    alt="">
                            </a>
                        </div>
                        <h1 class="text-capitalize text-dark fw-bold col-xl-10 lh-base col-12">
                            <?php echo e(trans('labels.pwa_tital')); ?>

                        </h1>
                        <p class="text-muted text-capitalize col-xl-10 fw-500 col-12 fs-17">
                            <?php echo e(trans('labels.description_pwa')); ?>

                        </p>
                        <?php
                            $getuserslist = App\Models\User::where('type', 2)->where('is_deleted', 2)->get();
                        ?>
                        <div class="d-flex flex-wrap gap-3">
                            <?php $__currentLoopData = $getuserslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(URL::to($user->slug . '/pwa')); ?>"
                                    class="<?php echo e(request()->is($user->slug . '/pwa') ? 'btn-secondary text-white' : 'btn-primary'); ?> rounded-5 p-2 px-4 shadow fs-6 m-0 fw-500">
                                    <?php echo e($user->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="h-100 d-flex justify-content-center flex-column">
                        <div class="smartphone shadow-lg">
                            <div class="content">
                                <iframe src="<?php echo e(URL::to($storeinfo->slug)); ?>"
                                    style="width:100%; border:none; height:100%"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap JS -->
</body>

</html>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\themepwa.blade.php ENDPATH**/ ?>