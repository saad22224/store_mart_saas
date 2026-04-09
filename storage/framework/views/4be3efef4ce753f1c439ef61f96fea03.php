<!DOCTYPE html>
<html lang="en" dir="<?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>" class="light">

<head>
    <title><?php echo e(helper::appdata(@$storeinfo->id)->website_title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.add('light');
        }
    </script>

    <link rel="icon" href='<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->favicon)); ?>' type="image/x-icon">
    <meta name="bingbot" content="nocache">
    <?php if(request()->is($storeinfo->slug . '/detail-*')): ?>
        <meta property="og:title" content="<?php echo e(@$getitem->item_name); ?>" />
        <meta property="og:description" content="<?php echo e(strip_tags(trim($getitem->description))); ?>" />
        <meta property="og:image" content="<?php echo e(@helper::image_path($getitem['product_image']->image)); ?>" />
    <?php elseif(request()->is($storeinfo->slug . '/blogs-*')): ?>
        <meta property="og:title" content="<?php echo e(@$blogdetail->title); ?>" />
        <meta property="og:description" content="<?php echo e(strip_tags(trim($blogdetail->description))); ?>" />
        <meta property="og:image" content="<?php echo e(@helper::image_path(@$blogdetail->image)); ?>" />
    <?php else: ?>
        <meta property="og:title" content="<?php echo e(helper::appdata(@$storeinfo->id)->meta_title); ?>" />
        <meta property="og:description" content="<?php echo e(helper::appdata(@$storeinfo->id)->meta_description); ?>" />
        <meta property="og:image" content='<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->og_image)); ?>' />
    <?php endif; ?>
    <!-- favicon-icon  -->

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/all.min.css')); ?>">
    <!-- font-awsome css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/bootstrap.min.css')); ?>">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/owl.carousel.min.css')); ?>">
    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/swiper-bundle.min.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/style.css')); ?>">
    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/slick.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/slick-theme.css')); ?>">
    <!-- style css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/fonts.css')); ?>">
    <!-- Fonts css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/responsive.css')); ?>">
    <!-- responsive css  -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/sweetalert/sweetalert2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'front/css/dataTables.bootstrap4.min.css')); ?>">

    <!-- IF VERSION 2  -->
    <?php if(helper::adminappdata()->recaptcha_version == 'v2'): ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php endif; ?>
    <!-- IF VERSION 3  -->
    <?php if(helper::adminappdata()->recaptcha_version == 'v3'): ?>
        <?php echo RecaptchaV3::initJs(); ?>

    <?php endif; ?>

    <style>
        #splash {
            background-color: #000;
        }

        :root {
            <?php if(helper::appdata(@$storeinfo->id)->template == 8): ?>
                --bs-secondary: <?php echo e(helper::appdata($storeinfo->id)->secondary_color . '10'); ?>;
            <?php endif; ?>
        }
    </style>
    <!-- PWA  -->
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('pwa')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', @$storeinfo->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', @$storeinfo->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $pwa = 1;
                } else {
                    $pwa = @$checkplan->pwa;
                }
            ?>

            <?php if($pwa == 1): ?>
                <?php if(helper::appdata(@$storeinfo->id)->pwa == 1): ?>
                    <?php echo $__env->make('front.pwa.pwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if(@helper::checkaddons('pwa')): ?>
                <?php if(helper::appdata(@$storeinfo->id)->pwa == 1): ?>
                    <?php echo $__env->make('front.pwa.pwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <!-- PIXEL  -->
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('pixel')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', @$storeinfo->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', @$storeinfo->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $pixel = 1;
                } else {
                    $pixel = @$checkplan->pixel;
                }

            ?>
            <?php if($pixel == 1): ?>
                <?php echo $__env->make('front.pixel.pixel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(@helper::checkaddons('pixel')): ?>
            <?php echo $__env->make('front.pixel.pixel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
</head>

<body>
    <div id="splash"></div>

    <!-- Age Modal -->
    <?php if(@helper::checkaddons('age_verification')): ?>
        <?php echo $__env->make('front.age_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- mobile category Modal -->

    <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mt-6 cat-over">
                <div class="modal-header justify-content-between py-2">
                    <h1 class="modal-title fs-5 color-changer" id="exampleModalLabel"><?php echo e(trans('labels.category')); ?>

                    </h1>
                    <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="card card-header cat-dispaly bg-transparent px-0">
                            <div class=" d-inline-block">
                                <h4
                                    class="theme-4-title  <?php echo e(session()->get('direction') == 2 ? 'text-right' : ''); ?> m-0">
                                    <?php echo e(trans('labels.category')); ?>

                                </h4>
                            </div>
                        </div>
                        <div>
                            <?php $__currentLoopData = helper::getcategory(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $check_cat_count = 0;
                                ?>
                                <?php $__currentLoopData = helper::getitems(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($category->id == $item->cat_id): ?>
                                        <?php
                                            $check_cat_count++;
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($check_cat_count > 0): ?>
                                    <div data-bs-dismiss="modal">
                                        <a class="nav-link mx-0 mt-0 border-0 py-2 fw-normal d-flex align-items-center justify-content-between <?php echo e(session()->get('direction') == 2 ? 'rtl-side-cat-check' : 'side-cat-check'); ?> btn-sm <?php echo e($category->slug); ?>"
                                            href="<?php echo e(URL::to($storeinfo->slug . '/search?category=' . $category->slug)); ?>"><?php echo e($category->name); ?>

                                            <div class="fw-semibold"><?php echo e($check_cat_count); ?></div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="catbox-arow"></div>
                </div>
            </div>
        </div>
    </div>

    <!---------------- mobile sider bar ---------------->
    <div class="offcanvas mobile-sidebar <?php echo e(session()->get('direction') == 2 ? 'offcanvas-end' : 'offcanvas-start'); ?>"
        tabindex="-1" id="mobile-sidebar" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header justify-content-between border-bottom">
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let logo = "";


                    if (localStorage.getItem('theme') === 'dark') {
                        logo = "<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->darklogo)); ?>";
                    } else {
                        logo = "<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>";
                    }

                    // Set logo image src
                    document.getElementById('logoimage').src = logo;
                });
            </script>

            <a href="<?php echo e(URL::to($storeinfo->slug)); ?>">
                <img id="logoimage" src="" alt="logo" class="object-fit-cover logo-h-55-px">
            </a>

            <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="fa-regular fa-xmark fs-4 color-changer"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                <?php if(@helper::checkaddons('blog')): ?>
                    <?php if(helper::getblogs(@$storeinfo->id)->count() > 0): ?>
                        <li class="list-group-item py-3 bg-transparent">
                            <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/blogs')); ?>"
                                class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-list"></i>
                                <span><?php echo e(trans('labels.blogs')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/contact')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-phone-flip"></i>
                        <span><?php echo e(trans('labels.contact_us')); ?></span>
                    </a>
                </li>
                <?php if(helper::getfaqs(@$storeinfo->id)->count() > 0): ?>
                    <li class="list-group-item py-3 bg-transparent">
                        <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/faqs')); ?>"
                            class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-question"></i>
                            <span><?php echo e(trans('labels.faqs')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/privacypolicy')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user-shield"></i>
                        <span><?php echo e(trans('labels.privacy_policy')); ?></span>
                    </a>
                </li>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/aboutus')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users"></i>
                        <span><?php echo e(trans('labels.about_us')); ?></span>
                    </a>
                </li>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/terms_condition')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <span><?php echo e(trans('labels.terms_condition')); ?></span>
                    </a>
                </li>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/refund_policy')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <span><?php echo e(trans('labels.refund_policy')); ?></span>
                    </a>
                </li>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="text-dark color-changer" href="<?php echo e(URL::to($storeinfo->slug . '/find-order')); ?>"
                        class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span><?php echo e(trans('labels.track_order')); ?></span>
                    </a>
                </li>
                <li class="list-group-item py-3 bg-transparent">
                    <a class="d-flex align-items-center gap-2 text-dark color-changer" data-bs-toggle="modal"
                        data-bs-target="#infomodal">
                        <i class="fa-solid fa-circle-info"></i>
                        <span><?php echo e(trans('labels.store_information')); ?></span>
                    </a>
                </li>
            </ul>
            <!-- app install btn -->
            <div class="justify-content-center d-flex gap-2 my-3">
                <?php if(@helper::checkaddons('subscription')): ?>
                    <?php if(@helper::checkaddons('user_app')): ?>
                        <?php
                            $checkplan = App\Models\Transaction::where('vendor_id', @$storeinfo->id)
                                ->orderByDesc('id')
                                ->first();

                            if (@$user->allow_without_subscription == 1) {
                                $user_app = 1;
                            } else {
                                $user_app = @$checkplan->customer_app;
                            }
                        ?>
                        <?php if($user_app == 1): ?>
                            <!-- Google play store button -->
                            <?php if(
                                @helper::getappsetting(@$storeinfo->id)->android_link != null &&
                                    @helper::getappsetting(@$storeinfo->id)->android_link != ''): ?>
                                <a href="<?php echo e(@helper::getappsetting(@$storeinfo->id)->android_link); ?>"> <img
                                        src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/google-play.svg')); ?>"
                                        class="app-btn" alt=""> </a>
                            <?php endif; ?>
                            <?php if(
                                @helper::getappsetting(@$storeinfo->id)->ios_link != null &&
                                    @helper::getappsetting(@$storeinfo->id)->ios_link != ''): ?>
                                <!-- App store button -->
                                <a href="<?php echo e(@helper::getappsetting(@$storeinfo->id)->ios_link); ?>"> <img
                                        src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/app-store.svg')); ?>"
                                        class="app-btn" alt=""> </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@helper::checkaddons('user_app')): ?>
                        <!-- Google play store button -->
                        <?php if(
                            @helper::getappsetting(@$storeinfo->id)->android_link != null &&
                                @helper::getappsetting(@$storeinfo->id)->android_link != ''): ?>
                            <a href="<?php echo e(@helper::getappsetting(@$storeinfo->id)->android_link); ?>"> <img
                                    src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/google-play.svg')); ?>"
                                    class="app-btn" alt=""> </a>
                        <?php endif; ?>
                        <?php if(
                            @helper::getappsetting(@$storeinfo->id)->ios_link != null &&
                                @helper::getappsetting(@$storeinfo->id)->ios_link != ''): ?>
                            <!-- App store button -->
                            <a href="<?php echo e(@helper::getappsetting(@$storeinfo->id)->ios_link); ?>"> <img
                                    src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/app-store.svg')); ?>"
                                    class="app-btn" alt=""> </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="offcanvas-footer">
            <div class="text-center color-changer border-top p-2 fs-8">
                <?php echo e(@helper::appdata(@$storeinfo->id)->copyright); ?></div>
        </div>
    </div>


    <!--------------------- login sidebar --------------------->
    <div class="offcanvas <?php echo e(session()->get('direction') == 2 ? 'offcanvas-start' : 'offcanvas-end'); ?>"
        tabindex="-1" id="loginpage" aria-labelledby="loginpageLabel">
        <div class="offcanvas-header justify-content-between py-4 border-bottom">
            <h5 class="offcanvas-title color-changer" id="auth_form_title"><?php echo e(trans('labels.login')); ?></h5>
            <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="fa-regular fa-xmark fs-4 color-changer"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <!-------------------------- login -------------------------->
            <div class="login input-14" id="login_form">
                <form method="POST" action="<?php echo e(URL::to($storeinfo->slug . '/checklogin-normal')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="emailid" class="form-label fw-semibold"><?php echo e(trans('labels.email')); ?></label>
                        <input type="email" class="form-control rounded-2 p-3" name="email" id="emailid"
                            placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label fw-semibold"><?php echo e(trans('labels.password')); ?></label>
                        <input type="password" class="form-control rounded-2 p-3" name="password" id="Password"
                            placeholder="Password" required>
                    </div>
                    <a class="forgot_password_btn color-changer fw-bolder pb-3 d-flex fs-7 <?php echo e(session()->get('direction') == 2 ? ' justify-content-start' : ' justify-content-end '); ?>"
                        href="javascript:void(0)"><?php echo e(trans('labels.forgot_password')); ?>?</a>
                    <button type="submit" id="btnsignin"
                        class="btn btn-store d-block w-100 mb-3"><?php echo e(trans('labels.login')); ?></button>
                </form>
                <p class="text-center color-changer mb-3"><?php echo e(trans('labels.dont_have_account')); ?> <a
                        class="signup-filter-btn fw-bolder create_account_btn text-secondary fw-semibold"
                        href="javascript:void(0)"><?php echo e(trans('labels.create_account')); ?></a></p>
                <div class="or_section">
                    <div class="line"></div>
                    <p class="mb-0 color-changer fw-medium"><?php echo e(trans('labels.or')); ?></p>
                    <div class="line"></div>
                </div>
                <?php
                    $setting = App\Models\Settings::where('vendor_id', @$storeinfo->id)->first();
                ?>
                <?php if(@helper::checkaddons('subscription')): ?>
                    <?php if(@helper::checkaddons('google_login')): ?>
                        <?php
                            $checkplan = App\Models\Transaction::where('vendor_id', @$storeinfo->id)
                                ->orderByDesc('id')
                                ->first();
                            $user = App\Models\User::where('id', @$storeinfo->id)->first();
                            if (@$user->allow_without_subscription == 1) {
                                $google_login = 1;
                            } else {
                                $google_login = @$checkplan->google_login;
                            }
                        ?>
                        <?php if($google_login == 1): ?>
                            <?php if(@$setting->google_mode == 1): ?>
                                <div class="d-sm-flex justify-content-between my-3">
                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($storeinfo->slug . '/login/google-user')); ?>" <?php endif; ?>
                                        class="btn btn-store-outline border-dark d-block m-0 w-100 mb-3 mb-sm-0 <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>">
                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/google.svg')); ?>"
                                            alt="goole" class="social-login">
                                        <span
                                            class="text-dark color-changer px-1"><?php echo e(trans('labels.sign_in')); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@helper::checkaddons('google_login')): ?>
                        <?php if(@$setting->google_mode == 1): ?>
                            <div class="d-sm-flex justify-content-between my-3">
                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($storeinfo->slug . '/login/google-user')); ?>" <?php endif; ?>
                                    class="btn btn-store-outline border-dark d-block m-0 w-100 mb-3 mb-sm-0 <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>">
                                    <img src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/google.svg')); ?>"
                                        alt="goole" class="social-login">
                                    <span class="text-dark color-changer px-1"><?php echo e(trans('labels.sign_in')); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(@helper::checkaddons('subscription')): ?>
                    <?php if(@helper::checkaddons('facebook_login')): ?>
                        <?php
                            $checkplan = App\Models\Transaction::where('vendor_id', @$storeinfo->id)
                                ->orderByDesc('id')
                                ->first();
                            $user = App\Models\User::where('id', @$storeinfo->id)->first();
                            if (@$user->allow_without_subscription == 1) {
                                $facebook_login = 1;
                            } else {
                                $facebook_login = @$checkplan->facebook_login;
                            }
                        ?>
                        <?php if($facebook_login == 1): ?>
                            <?php if(@$setting->facebook_mode == 1): ?>
                                <div class="d-sm-flex justify-content-between my-3">
                                    <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($storeinfo->slug . '/login/facebook-user')); ?>" <?php endif; ?>
                                        class="btn btn-store-outline border-dark d-block m-0 w-100">
                                        <img src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/facebook.svg')); ?>"
                                            alt="goole" class="social-login">
                                        <span
                                            class="text-dark color-changer px-1"><?php echo e(trans('labels.sign_in')); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@helper::checkaddons('facebook_login')): ?>
                        <?php if(@$setting->facebook_mode == 1): ?>
                            <div class="d-sm-flex justify-content-between my-3">
                                <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> href="<?php echo e(URL::to($storeinfo->slug . '/login/facebook-user')); ?>" <?php endif; ?>
                                    class="btn btn-store-outline border-dark d-block m-0 w-100">
                                    <img src="<?php echo e(url(env('ASSETPATHURL') . 'front/images/facebook.svg')); ?>"
                                        alt="goole" class="social-login">
                                    <span class="text-dark color-changer px-1"><?php echo e(trans('labels.sign_in')); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

            <!-------------------------- register -------------------------->
            <div class="register input-14 d-none" id="register_form">
                <form action="<?php echo e(URL::to($storeinfo->slug . '/register_customer')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold"><?php echo e(trans('labels.name')); ?></label>
                        <input type="text" class="form-control rounded-2 p-3" id="name" name="name"
                            placeholder="<?php echo e(trans('labels.name')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailid" class="form-label fw-semibold"><?php echo e(trans('labels.email')); ?></label>
                        <input type="email" class="form-control rounded-2 p-3" id="emailid" name="email"
                            placeholder="<?php echo e(trans('labels.email')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label fw-semibold"><?php echo e(trans('labels.mobile')); ?></label>
                        <input type="number" class="form-control rounded-2 p-3" id="mobile" name="mobile"
                            placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold"><?php echo e(trans('labels.password')); ?></label>
                        <input type="password" class="form-control rounded-2 p-3" id="password" name="password"
                            placeholder="<?php echo e(trans('labels.password')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword"
                            class="form-label fw-semibold"><?php echo e(trans('labels.confirm_password')); ?></label>
                        <input type="password" class="form-control rounded-2 p-3" id="confirmpassword"
                            name="confirmpassword" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" required>
                    </div>

                    <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="mb-3 d-flex align-items-center">
                        <input type="checkbox" class="form-check-input p-0" id="exampleCheck2" required checked>
                        <label class="form-check-label fw-normal mx-2"
                            for="exampleCheck2"><?php echo e(trans('labels.i_accept_the')); ?> <a
                                href="<?php echo e(URL::to($storeinfo->slug . '/terms_condition')); ?>"
                                class="fw-semibold text-secondary"><?php echo e(trans('labels.terms_condition')); ?></a></label>
                    </div>
                    <button type="submit" id="btnsignup"
                        class="btn btn-store d-block w-100 p-3"><?php echo e(trans('labels.signup')); ?></button>
                    <p class="text-center color-changer mb25 mt10"><?php echo e(trans('labels.already_account')); ?> <a
                            href="javascript:void(0)"
                            class="fw-semibold login_btn text-secondary"><?php echo e(trans('labels.sign_in')); ?></a></p>
                </form>
            </div>

            <!-------------------------- forgot password -------------------------->
            <div class="forgotpassword input-14 d-none" id="forgot_password_form">
                <form action="<?php echo e(URL::to($storeinfo->slug . '/send_password')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="forgetemailid"
                            class="form-label fw-semibold"><?php echo e(trans('labels.email')); ?></label>
                        <input type="email" class="form-control rounded-2 p-3" id="forgetemailid" name="email"
                            placeholder="<?php echo e(trans('labels.email')); ?>" required>
                    </div>
                    <button type="submit" id="btnsubmit"
                        class="btn btn-store d-block w-100 p-3"><?php echo e(trans('labels.submit')); ?></button>
                    <p class="text-center mb25 color-changer mt10"><?php echo e(trans('labels.dont_have_account')); ?> <a
                            href="javascript:void(0)"
                            class="fw-semibold create_account_btn text-secondary"><?php echo e(trans('labels.signup')); ?></a>
                    </p>
                </form>
            </div>

        </div>
    </div>


    <!--------------- rating sidebar --------------->
    <?php if(@helper::checkaddons('product_reviews')): ?>
        <div class="" id="viewreviewsbody"></div>
    <?php endif; ?>


    <main id="main-content">

        <!-- navbar -->
        <?php if(helper::appdata(@$storeinfo->id)->template != 11): ?>
            <div class="d-none d-lg-block">
                <nav class="top-header border-bottom">
                    <div class="container">
                        <div class="d-flex align-items-center mobile-header">
                            <div class="col-md-6 p-0 ">
                                <div class="header-contact">
                                    <a href="tel:<?php echo e(helper::appdata(@$storeinfo->id)->contact); ?>" target="_blank"
                                        class="color-changer"><i class="fa-light fa-phone-flip"></i><span
                                            class="mx-2"><?php echo e(helper::appdata(@$storeinfo->id)->contact); ?></span></a>

                                    <a href="mailto:<?php echo e(helper::appdata(@$storeinfo->id)->email); ?>" target="_blank"
                                        class="color-changer"><i class="fa-light fa-envelope"></i><span
                                            class="mx-2"><?php echo e(helper::appdata(@$storeinfo->id)->email); ?></span></a>
                                </div>
                            </div>
                            <div class="col-md-6 p-0 ">
                                <div class="header-social">
                                    <div class="social-media d-none d-lg-block">
                                        <ul class="d-flex gap-2 m-0 p-0">
                                            <?php $__currentLoopData = @helper::getsociallinks(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e($links->link); ?>" target="_blank"
                                                        class="social-rounded fb p-0"><?php echo $links->icon; ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        <?php endif; ?>

        <!-- navbar -->

        <?php
            $current_url = Request()->url();
            $home_url = url('/' . $storeinfo->slug);
        ?>
        <!-- mine header -->

        <div
            class="navbar main-header main-sticky-top p-0 <?php echo e(helper::appdata(@$storeinfo->id)->template == 10 ? 'header-10-bg top-0' : ''); ?>">
            <div class="container">

                <div class="col-xxl-4 col-xl-5 col-lg-5 d-none d-xl-block main-menu">
                    <ul class="d-flex gap-4 p-0 m-0">
                        <li>
                            <a class="<?php echo e(request()->is($storeinfo->slug) ? 'menu-active' : ''); ?>"
                                href="<?php echo e(URL::to($storeinfo->slug)); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
                            <li><a class="<?php echo e(request()->is($storeinfo->slug . '/find-order') ? 'menu-active' : ''); ?>"
                                    href="<?php echo e(URL::to($storeinfo->slug . '/find-order')); ?>"><?php echo e(trans('labels.track_order')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('blog')): ?>
                            <?php if(helper::getblogs(@$storeinfo->id)->count() > 0): ?>
                                <li><a class="<?php echo e(request()->is($storeinfo->slug . '/blogs') ? 'menu-active' : ''); ?>"
                                        href="<?php echo e(URL::to($storeinfo->slug . '/blogs')); ?>"><?php echo e(trans('labels.blogs')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <li><a class="<?php echo e(request()->is($storeinfo->slug . '/contact') ? 'menu-active' : ''); ?>"
                                href="<?php echo e(URL::to($storeinfo->slug . '/contact')); ?>"><?php echo e(trans('labels.contact_us')); ?></a>
                        </li>
                        <?php if(helper::getfaqs(@$storeinfo->id)->count() > 0): ?>
                            <li><a class="<?php echo e(request()->is($storeinfo->slug . '/faqs') ? 'menu-active' : ''); ?>"
                                    href="<?php echo e(URL::to($storeinfo->slug . '/faqs')); ?>"><?php echo e(trans('labels.faqs')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3">
                        <!-- mobile sidebar trigger -->
                        <?php if(@helper::checkaddons('customer_login')): ?>
                            <?php if(helper::appdata(@$storeinfo->id)->checkout_login_required == 1): ?>
                                <li class="d-block d-xl-none">
                                    <a type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-sidebar"
                                        aria-controls="offcanvasExample"
                                        class="d-flex justify-content-center align-items-center">
                                        <i class="fa-light fa-bars fs-4 color-changer text-dark"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let logo = "";


                    if (localStorage.getItem('theme') === 'dark') {
                        logo = "<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->darklogo)); ?>";
                    } else {
                        logo = "<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->logo)); ?>";
                    }

                    // Set logo image src
                    document.getElementById('logoimage2').src = logo;
                });
            </script>

            <a href="<?php echo e(URL::to($storeinfo->slug)); ?>">
                <img id="logoimage2" src="" alt="logo" class="object-fit-cover my-2 logo-h-55-px">
            </a>

                       

                    </div>
                </div>

                
                <div class="col-auto d-lg-none">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <?php $__currentLoopData = @helper::getsociallinks(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($links->link); ?>" target="_blank" 
                               style="
                                   width: 24px;
                                   height: 24px;
                                   border-radius: 50%;
                                   display: flex;
                                   align-items: center;
                                   justify-content: center;
                                   background: var(--bs-primary);
                                   color: #fff;
                                   font-size: 11px;
                                   text-decoration: none;
                                   transition: all 0.3s ease;
                               "
                               onmouseover="this.style.transform='scale(1.1)';this.style.opacity='0.9'"
                               onmouseout="this.style.transform='scale(1)';this.style.opacity='1'">
                                <?php echo $links->icon; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- mobile lag button -->
                <div class="col-xxl-4 col-xl-5">

                    <!-- right side option -->
                    <?php
                        $languages = explode('|', helper::appdata(@$storeinfo->id)->languages);
                        $currencies = explode('|', helper::appdata(@$storeinfo->id)->currencies);
                    ?>

                    <ul class="d-flex align-items-center justify-content-end gap-lg-4 gap-3 m-0 p-0">
                        <?php if(@helper::checkaddons('language')): ?>
                            <?php if(count($languages) > 1): ?>
                                <li>
                                    <div class="dropdown language-dropdown lag-btn">
                                        <a class="dropdown-toggle open-btn bg-transparent p-0 border-0 m-0"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-light fa-globe fs-5 color-changer"></i>
                                        </a>
                                        <ul
                                            class="dropdown-menu p-0 bg-body-secondary border-0 shadow mt-2 <?php echo e(session()->get('direction') == 2 ? 'min-dropdown-rtl' : 'min-dropdown-ltr'); ?>">
                                            <?php $__currentLoopData = helper::available_language(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languagelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(in_array($languagelist->code, explode('|', helper::appdata(@$storeinfo->id)->languages))): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center p-2 gap-2"
                                                            href="<?php echo e(URL::to('/lang/change?lang=' . $languagelist->code)); ?>">
                                                            <img src="<?php echo e(helper::image_path($languagelist->image)); ?>"
                                                                alt="" class="img-fluid lag-img">
                                                            <span class="fw-normal">
                                                                <?php echo e($languagelist->name); ?>

                                                            </span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li>
                            <div class="dropdown language-dropdown lag-btn">
                                <a role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="dropdown-toggle open-btn bg-transparent p-0 border-0 m-0">
                                    <i class="fa-regular fa-circle-half-stroke fs-5 color-changer"></i>
                                </a>
                                <ul
                                    class="dropdown-menu p-0 bg-body-secondary border-0 shadow mt-2 <?php echo e(session()->get('direction') == 2 ? 'min-dropdown-rtl' : 'min-dropdown-ltr'); ?>">
                                    <li>
                                        <a class="dropdown-item d-flex cursor-pointer align-items-center p-2 gap-2"
                                            onclick="setLightMode()">
                                            <i class="fa-light fa-lightbulb fs-6"></i>
                                            <span>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex cursor-pointer align-items-center p-2 gap-2"
                                            onclick="setDarkMode()">
                                            <i class="fa-solid fa-moon fs-6"></i>
                                            <span>Dark</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php if(@helper::checkaddons('currency_settigns')): ?>
                            <?php if(count($currencies) > 1): ?>
                                <li>
                                    <div class="dropdown language-dropdown lag-btn">
                                        <a class="dropdown-toggle open-btn bg-transparent p-0 border-0 m-0"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="fs-5 color-changer">
                                                <?php echo e(session()->get('currency')); ?>

                                            </span>
                                        </a>

                                        <ul
                                            class="dropdown-menu p-0 bg-body-secondary border-0 shadow mt-2 <?php echo e(session()->get('direction') == 2 ? 'min-dropdown-rtl' : 'min-dropdown-ltr'); ?>">
                                            <?php $__currentLoopData = helper::available_currency(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currencylist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(in_array($currencylist->code, explode('|', helper::appdata(@$storeinfo->id)->currencies))): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center p-2 gap-2"
                                                            href="<?php echo e(URL::to('/currency/change?currency=' . $currencylist['code'])); ?>">
                                                            <p class="fs-7">
                                                                <?php echo e($currencylist['currency'] . '  ' . $currencylist['name']); ?>

                                                            </p>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="d-none d-lg-block">
                            <a href="<?php echo e(URL::to($storeinfo->slug . '/search')); ?>">
                                <i class="fa-light fa-magnifying-glass fs-5 color-changer"></i></a>
                        </li>

                        <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
                            <li class="shopping-cart d-none d-lg-block">

                                <a href="<?php echo e(URL::to($storeinfo->slug . '/cart/')); ?>">
                                    <i class="fa-light fa-bag-shopping fs-5 color-changer"></i></a>
                                <div class="cart-count <?php echo e(session()->get('cart') > 0 ? '' : 'd-none'); ?> <?php echo e(session()->get('direction') == 2 ? 'left_10px' : ''); ?>"
                                    id="cartcnt"><?php echo e(session()->get('cart')); ?></div>
                            </li>
                        <?php endif; ?>

                        <!-- loginpage trigar -->
                        <?php if(@helper::checkaddons('customer_login')): ?>
                            <?php if(helper::appdata(@$storeinfo->id)->checkout_login_required == 1): ?>
                                <li class="d-lg-block d-none">
                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/profile')); ?>">
                                            <i class="fa-light fa-user fs-5"></i>
                                        </a>
                                    <?php else: ?>
                                        <a type="button" data-bs-toggle="offcanvas" data-bs-target="#loginpage"
                                            id="btnlogin" aria-controls="loginpage">
                                            <i class="fa-light fa-user fs-5"></i>
                                        </a>
                                    <?php endif; ?>
                                </li>
                                <!-- loginpage trigar -->
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- mine header -->

        <!----------------------- mobile menu footer ----------------------->
        <div class="mobile-menu-footer d-none">
            <ul class="p-0 m-0">
                <li class="<?php echo e(request()->is($storeinfo->slug) ? 'mobile-active' : ''); ?>">
                    <a href="<?php echo e(URL::to($storeinfo->slug)); ?>">
                        <i class="fa-light fa-house"></i>
                        <span><?php echo e(trans('labels.home')); ?></span>
                    </a>
                </li>
                <li class="<?php echo e(request()->is($storeinfo->slug . '/search') ? 'mobile-active' : ''); ?>">
                    <a href="<?php echo e(URL::to($storeinfo->slug . '/search')); ?>">
                        <i class="fa-light fa-magnifying-glass"></i>
                        <span><?php echo e(trans('labels.search')); ?></span>
                    </a>
                </li>
                <li class="<?php echo e(request()->is($storeinfo->slug . '/category') ? 'mobile-active' : ''); ?>">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#catModal">
                        <i class="fa-light fa-box-archive"></i>
                        <span><?php echo e(trans('labels.category')); ?></span>
                    </a>
                </li>
                <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
                    <li class="<?php echo e(request()->is($storeinfo->slug . '/cart') ? 'mobile-active' : ''); ?>">
                        <a href="<?php echo e(URL::to($storeinfo->slug . '/cart/')); ?>">

                            <i class="fa-light fa-bag-shopping position-relative">
                                <?php if(session()->get('cart') > 0): ?>
                                    <div class="mobile-cart-count" id="cartcnt"><?php echo e(session()->get('cart')); ?></div>
                                <?php endif; ?>
                            </i>
                            <span><?php echo e(trans('labels.cart')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if(@helper::checkaddons('customer_login')): ?>
                    <?php if(helper::appdata(@$storeinfo->id)->checkout_login_required == 1): ?>
                        <?php if(helper::appdata(@$storeinfo->id)->online_order == 1): ?>
                            <li class="<?php echo e(request()->is($storeinfo->slug . '/profile') ? 'mobile-active' : ''); ?>">
                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                    <a href="<?php echo e(URL::to($storeinfo->slug . '/profile')); ?>">
                                        <i class="fa-light fa-user"></i>
                                        <span><?php echo e(trans('labels.account')); ?></span></a>
                                <?php else: ?>
                                    <a data-bs-toggle="offcanvas" data-bs-target="#loginpage">
                                        <i class="fa-light fa-user"></i>
                                        <span><?php echo e(trans('labels.account')); ?></span>
                                    </a>
                                <?php endif; ?>

                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="">
                        <a data-bs-toggle="offcanvas" data-bs-target="#mobile-sidebar"
                            aria-controls="offcanvasExample">
                            <i class="fa-light fa-ellipsis-vertical"></i>
                            <span><?php echo e(trans('labels.more')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>


        <div id="success-msg" class="alert alert-dismissible mt-3" style="display: none;">
            <span id="msg"></span>
        </div>
        <div id="error-msg" class="alert alert-dismissible mt-3" style="display: none;">
            <span id="ermsg"></span>
        </div>
        <style>
            :root {
                /* Color */
                --primary-color: #000;
                --primary-bg-color: #f4f4f8;
                /* --body-color: #f7f7f7; */
                --active-tab: #3ba2a484;

                /* Hover Color */
                --bs-primary: <?php echo e(helper::appdata(@$storeinfo->id)->primary_color); ?>;
                --primary-bg-color-hover: #000;
                --bs-secondary: <?php echo e(helper::appdata(@$storeinfo->id)->secondary_color); ?>;

                --active-menu: <?php echo e(helper::appdata(@$storeinfo->id)->primary_color); ?>30;
                --in-stock: #28a745;
                --out-stock: #D41A1A;
                --bs-primary-srg: color-mix(in srgb, var(--bs-primary), transparent 90%);
                --bs-secondary-srg: color-mix(in srgb, var(--bs-secondary), transparent 90%);

            }
        </style>
        <?php if(!request()->is($storeinfo->slug . '/detail-*')): ?>
            <?php echo $__env->make('front.theme.timer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </main>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/theme/header.blade.php ENDPATH**/ ?>