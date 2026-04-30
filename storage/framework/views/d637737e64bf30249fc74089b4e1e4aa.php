<section class="product-service mb-5 mb-lg-0">
    <div class="py-4 bg-light bg-changer">
        <div class="container">
            <div class="d-lg-block d-none">
                <div class="row align-items-center justify-content-center">
                    <?php $__currentLoopData = helper::footer_features(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12 d-flex p-3 justify-content-center">
                            <div class="fs-4 free-icon icon-color">
                                <?php echo $feature->icon; ?>

                            </div>
                            <div class="free-content px-3 col-10">
                                <h6 class="fw-500 color-changer m-0"><?php echo e($feature->title); ?></h6>
                                <p class="fs-7 text-muted fw-normal line-2"><?php echo e($feature->description); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="footer-fiechar-slider owl-carousel owl-theme d-lg-none">
                <?php $__currentLoopData = helper::footer_features(@$storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="col d-flex p-3 justify-content-center">
                            <div class="fs-4 free-icon icon-color">
                                <?php echo $feature->icon; ?>

                            </div>
                            <div class="free-content px-3 col-10">
                                <h6 class="fw-500 color-changer m-0"><?php echo e($feature->title); ?></h6>
                                <p class="fs-7 text-muted fw-normal line-2"><?php echo e($feature->description); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<footer class="footer-sec2 bg-light bg-changer py-5 border-top shadow-sm">
    <div class="container">
        <style>
            .footer-input::placeholder { color: inherit !important; opacity: 0.6; }
            .hover-opacity-100:hover { opacity: 1 !important; }
        </style>
        <div class="row align-items-start justify-content-between">
            
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                <h5 class="text-dark color-changer mb-4 fw-bold"><?php echo e(trans('labels.pages') == 'labels.pages' ? 'الصفحات' : trans('labels.pages')); ?></h5>
                <ul class="footer-menu d-flex flex-column m-0 p-0 gap-2" style="list-style: none;">
                    <li><a href="<?php echo e(URL::to($storeinfo->slug . '/contact')); ?>"
                            class="text-dark color-changer text-decoration-none fw-semibold opacity-75 hover-opacity-100 transition"><?php echo e(trans('labels.contact_us')); ?></a>
                    </li>
                    <li><a href="<?php echo e(URL::to($storeinfo->slug . '/privacypolicy')); ?>"
                            class="text-dark color-changer text-decoration-none fw-semibold opacity-75 hover-opacity-100 transition"><?php echo e(trans('labels.privacy_policy')); ?></a>
                    </li>
                    <li><a href="<?php echo e(URL::to($storeinfo->slug . '/refund_policy')); ?>"
                            class="text-dark color-changer text-decoration-none fw-semibold opacity-75 hover-opacity-100 transition"><?php echo e(trans('labels.refund_policy')); ?> - <?php echo e(trans('labels.terms_condition')); ?></a>
                    </li>
                    <li><a href="<?php echo e(URL::to($storeinfo->slug . '/aboutus')); ?>"
                            class="text-dark color-changer text-decoration-none fw-semibold opacity-75 hover-opacity-100 transition"><?php echo e(trans('labels.about_us')); ?></a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-5 col-md-12 text-center mb-4 mb-lg-0">
                <h5 class="text-dark color-changer mb-4 fw-bold"><?php echo e(trans('labels.contact_info') == 'labels.contact_info' ? 'معلومات الاتصال' : trans('labels.contact_info')); ?></h5>
                <ul class="m-0 p-0 d-inline-block text-start" style="list-style: none;">
                    <li class="d-flex align-items-center mb-3 gap-3">
                        <div style="width: 30px; text-align: center;">
                            <i class="fa-regular fa-envelope text-dark color-changer fs-5"></i>
                        </div>
                        <a href="mailto:<?php echo e($storeinfo->email); ?>" class="text-dark color-changer text-decoration-none opacity-75 hover-opacity-100 transition" dir="ltr">
                            <?php echo e($storeinfo->email); ?>

                        </a>
                    </li>
                    <li class="d-flex align-items-center mb-3 gap-3">
                        <div style="width: 30px; text-align: center;">
                            <i class="fa-solid fa-phone text-dark color-changer fs-5"></i>
                        </div>
                        <a href="tel:<?php echo e($storeinfo->mobile); ?>" class="text-dark color-changer text-decoration-none opacity-75 hover-opacity-100 transition" dir="ltr">
                            <?php echo e($storeinfo->mobile); ?>

                        </a>
                    </li>
                    <?php
                        $city = \App\Models\City::find(@$storeinfo->city_id);
                        $country = \App\Models\Country::find(@$storeinfo->country_id);
                        $location = [];
                        if($city) $location[] = $city->city;
                        if($country) $location[] = $country->name;
                        $location_text = implode(', ', $location);
                    //    dd( $city->city . " " . $country->name) 
                    ?>
                    <?php if(!empty($location_text)): ?>
                    <li class="d-flex align-items-center mb-3 gap-3">
                        <div style="width: 30px; text-align: center;">
                            <i class="fa-solid fa-location-dot text-dark color-changer fs-5"></i>
                        </div>
                        <span class="text-dark color-changer opacity-75 text-nowrap">
                            <?php echo e($location_text); ?>

                        </span>
                    </li>
                    <?php else: ?>
                    <li class="d-flex align-items-center mb-3 gap-3">
                        <div style="width: 30px; text-align: center;">
                            <i class="fa-solid fa-location-dot text-dark color-changer fs-5"></i>
                        </div>
                        <a href="https://www.google.com/maps/place/<?php echo e(helper::appdata($storeinfo->id)->address); ?>" target="_blank" class="text-dark color-changer text-decoration-none opacity-75 hover-opacity-100 transition text-nowrap">
                            <?php echo e(empty(helper::appdata($storeinfo->id)->address) ? '-' : helper::appdata($storeinfo->id)->address); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-start' : 'text-lg-end'); ?> mt-4 mt-lg-0">
                <h5 class="text-dark color-changer mb-4 fw-bold"><?php echo e(trans('labels.newslatter') == 'labels.newslatter' ? 'ليصلك جديدنا' : trans('labels.newslatter')); ?></h5>
                <form action="<?php echo e(URL::to(@$storeinfo->slug . '/subscribe')); ?>" method="post" class="d-flex justify-content-center <?php echo e(session()->get('direction') == 2 ? 'justify-content-lg-start' : 'justify-content-lg-end'); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group" style="max-width: 300px; border-radius: 5px; overflow: hidden; border: 1px solid rgba(0,0,0,0.1);">
                        <input type="email" class="form-control text-dark color-changer bg-transparent footer-input" name="subscribe_email" placeholder="<?php echo e(trans('labels.email')); ?>" required style="box-shadow: none;">
                        <button type="submit" class="btn btn-store fw-bold px-4" style="border-radius: 0;"><?php echo e(trans('labels.subscribe') == 'labels.subscribe' ? 'اشترك' : trans('labels.subscribe')); ?></button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</footer>

<!-- copy-right-sec -->
<div class="copy-right-sec bg-light bg-changer py-3 border-top">
    <div class="container">
        <div class="d-md-flex justify-content-center align-items-center">
            <p class="mb-md-0 text-dark color-changer opacity-75"><?php echo e(helper::appdata($storeinfo->id)->copyright); ?></p>
        </div>
    </div>
</div>
</main>


<!-- Product View -->
<div class="modal fade" id="viewproduct-over" tabindex="-1" aria-labelledby="add-payment" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="viewproduct_body">

        </div>
    </div>
</div>

<!-- MODAL-INFORMATION -->
<div class="modal fade" id="infomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title color-changer" id="exampleModalLabel">
                    <?php echo e(trans('labels.working_hours')); ?>

                </h5>
                <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="business-sec">
                    <div class="working-hours">
                        <ul class="list-group border-0 bg-none p-0">
                            <?php if(is_array(@helper::timings($storeinfo->id)) || is_object(@helper::timings($storeinfo->id))): ?>
                                <?php $__currentLoopData = @helper::timings($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item bg-transparent d-flex border-0 default-color">
                                        <p class="fw-semibold col-6 color-changer">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span class="px-2"><?php echo e(trans('labels.' . strtolower($time->day))); ?></span>
                                        </p>
                                        <div class="col-6 d-flex justify-content-center">
                                            <p class="text-center color-changer">
                                                <?php if($time->is_always_close == 1): ?>
                                                    <span class="text-danger"><?php echo e(trans('labels.closed')); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="color-changer"><?php echo e($time->open_time . ' ' . trans('labels.to') . ' ' . $time->close_time); ?></span>
                                                <?php endif; ?>

                                            </p>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="my-3 d-lg-none">
                        <h5 class="color-changer">
                            <?php echo e(trans('labels.social_links')); ?>

                        </h5>
                        <div class="social-media">
                            <ul class="d-flex gap-2 m-0 p-0 flex-wrap">
                                <?php $__currentLoopData = @helper::getsociallinks($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($links->link); ?>" target="_blank"
                                            class="social-rounded fb p-0"><?php echo $links->icon; ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                    <div class="my-3 d-lg-none">
                        <h5 class="color-changer">
                            <?php echo e(trans('labels.payment_methods')); ?>

                        </h5>
                        <?php
                            $payment = helper::getallpayment($storeinfo->id);
                        ?>

                        <ul class="footer_acceped_card d-flex flex-wrap gap-3 p-0 m-0">
                            <?php $__currentLoopData = helper::getallpayment($storeinfo->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo e(helper::image_path($item->image)); ?>" class="w-20px">
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL_SELECTED_ADDONS--START -->
<div class="modal fade" id="modal_selected_addons" tabindex="-1" aria-labelledby="selected_addons_Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title color-changer fs-5" id="selected_addons_Label"></h5>
                <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <div class="modal-body p-0 extra-variation-modal">
                <ul
                    class="list-group list-group-flush p-0 <?php echo e(session()->get('direction') == 2 ? 'text-right' : 'text-left'); ?>">
                </ul>

                <!-- Variants -->
                <div class="p-12px">
                    <div id="item-variations" class="mt-2">

                    </div>
                    <!-- Extras -->
                    <div id="item-extras" class="mt-3">
                        <h5 class="fw-normal color-changer m-0 d-none" id="extras_title"><?php echo e(trans('labels.extras')); ?>

                        </h5>
                        <ul class="m-0 ps-2">
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- MODAL_SELECTED_ADDONS--END -->

<input type="hidden" name="currency" id="currency" value="<?php echo e(helper::appdata($storeinfo->id)->currency); ?>">

<!-- Modal NewsModal -->
<div class="modal" id="NewsModal" tabindex="-1" aria-labelledby="NewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 overflow-hidden">
            <div class="modal-body p-0 position-relative">
                <button type="button"
                    class="bg-transparent border-0 m-0 subsciption_button <?php echo e(session()->get('direction') == '2' ? 'rtl' : ''); ?>"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
                <div class="row g-0 p-lg-3 align-items-center justify-content-between">
                    <div class="col-6 d-none d-lg-block">
                        <img src="<?php echo e(helper::image_path(helper::appdata(@$storeinfo->id)->subscribe_image)); ?>"
                            alt="" class="w-100 object-fit-cover newslatter-img">
                    </div>
                    <div class="col-lg-6 col-12">

                        <div class="py-5 px-sm-5 px-4">
                            <span class="fs-7 fs-500 color-changer"><?php echo e(trans('labels.newslatter')); ?></span>
                            <h2 class="subscribe-title color-changer"><?php echo e(trans('labels.subscribe_now')); ?>

                            </h2>
                            <p class="text-dark color-changer fw-500 fs-7 mb-3">
                                <?php echo e(trans('labels.newslatter_subtitle')); ?>

                            </p>
                            <form action="<?php echo e(URL::to(@$storeinfo->slug . '/subscribe')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <label
                                    class="text-black form-label fs-7 mb-1"><?php echo e(trans('labels.email_address')); ?></label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control border text-dark fw-500 bg-light"
                                        name="subscribe_email" placeholder="<?php echo e(trans('labels.email')); ?>"
                                        required="">
                                </div>
                                <button type="submit" class="btn btn-store w-100 py-2"
                                    id="basic-addon2"><?php echo e(trans('labels.subscribe')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Type Model Start -->
<div class="modal fade" id="loginmodel" tabindex="-1" aria-labelledby="loginmodelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-2">
            <div class="modal-body">
                <div class="row justify-content-between">
                    <div class="col-md-12 col-lg-7">
                        <h3 class="promocodemodellable-titel m-0 color-changer text-start" id="promocodemodellable">
                            <?php echo e(trans('labels.proceed_as_guest_or_login')); ?></h3>
                        <p class="mb-3 promocodemodellable-subtitel color-changer">
                            <?php echo e(trans('labels.dont_have_account_guest')); ?></p>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-3">
                        <a onclick="login()"
                            class="btn btn-store-outline mb-3"><?php echo e(trans('labels.login_with_your_account')); ?></a>
                        <a onclick="productcheckout()"
                            class="btn btn-store"><?php echo e(trans('labels.continue_as_guest')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- User Type Model End -->

<?php if(@helper::checkaddons('sales_notification')): ?>
    <?php echo $__env->make('front.sales_notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<!------ whatsapp_icon ------>
<?php if(@helper::checkaddons('subscription')): ?>
    <?php if(@helper::checkaddons('whatsapp_message')): ?>
        <?php
            $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)->orderByDesc('id')->first();
            $user = App\Models\User::where('id', $storeinfo->id)->first();
            if (@$user->allow_without_subscription == 1) {
                $whatsapp_message = 1;
            } else {
                $whatsapp_message = @$checkplan->whatsapp_message;
            }

        ?>
        <?php if($whatsapp_message == 1 && @whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_chat_on_off == 1): ?>
            <?php echo $__env->make('front.whatsapp_chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(@helper::checkaddons('whatsapp_message')): ?>
        <?php if(@whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_chat_on_off == 1): ?>
            <?php echo $__env->make('front.whatsapp_chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if(@helper::checkaddons('tawk_addons')): ?>
    <?php if(helper::appdata($storeinfo->id)->tawk_on_off == 1): ?>
        <?php echo @helper::appdata($storeinfo->id)->tawk_widget_id; ?>

    <?php endif; ?>
<?php endif; ?>

<?php if(@helper::checkaddons('wizz_chat')): ?>
    <?php if(helper::appdata($storeinfo->id)->wizz_chat_on_off == 1): ?>
        <!-- Wizz Chat -->
        <?php echo helper::appdata($storeinfo->id)->wizz_chat_settings; ?>

    <?php endif; ?>
<?php endif; ?>



<!-- Quick call -->
<?php if(@helper::checkaddons('quick_call')): ?>
    <?php if(@helper::appdata($storeinfo->id)->quick_call == 1): ?>
        <div
            class="<?php echo e(helper::appdata($storeinfo->id)->quick_call_mobile_view_on_off == 1 ? 'd-block' : 'd-lg-block d-none'); ?>">
            <?php echo $__env->make('front.quick_call', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- jquery -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js')); ?>"></script>
<!-- bootstrap js -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/bootstrap.bundle.js')); ?>"></script>
<!-- owl.carousel js -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/owl.carousel.min.js')); ?>"></script>
<!-- owl.swiper js -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/swiper-bundle.min.js')); ?>"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/smoothproducts.js')); ?>"></script>
<!-- slick slider js -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/slick.min.js')); ?>"></script>
<!-- lazyload js -->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/lazyload.js')); ?>"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/jquery.number.min.js')); ?>"></script>
<?php if(@helper::checkaddons('age_verification')): ?>
    <?php if(@helper::getagedetails($storeinfo->id)->age_verification_on_off == 1): ?>
        <script src="<?php echo e(url('resources/js/age.js')); ?>"></script>
    <?php endif; ?>
<?php endif; ?>
<!-- fontawesome js-->
<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
<!-- custom js -->
<script>
    // top deals parameter
    var start_date = "<?php echo e(@helper::top_deals($storeinfo->id)->start_date); ?>";
    var start_time = "<?php echo e(@helper::top_deals($storeinfo->id)->start_time); ?>";
    var end_date = "<?php echo e(@helper::top_deals($storeinfo->id)->end_date); ?>";
    var end_time = "<?php echo e(@helper::top_deals($storeinfo->id)->end_time); ?>";
    var topdeals = "<?php echo e(!empty(helper::topdalsitemlist($storeinfo->id)) ? 1 : 0); ?>";
    var time_zone = "<?php echo e(helper::appdata($storeinfo->id)->timezone); ?>";
    var current_date = "<?php echo e(\Carbon\Carbon::now()->toDateString()); ?>";
    var deal_type = "<?php echo e(@helper::top_deals($storeinfo->id)->deal_type); ?>";
    // top deals parametervvv

    var are_you_sure = "<?php echo e(trans('messages.are_you_sure')); ?>";
    var yes = "<?php echo e(trans('messages.yes')); ?>";
    var no = "<?php echo e(trans('messages.no')); ?>";
    var wrong = "<?php echo e(trans('messages.wrong')); ?>";
    var formate = "<?php echo e(helper::appdata($storeinfo->id)->currency_formate); ?>";
    var login_title = "<?php echo e(trans('labels.login')); ?>";
    var register_title = "<?php echo e(trans('labels.register')); ?>";
    var forgot_password_title = "<?php echo e(trans('labels.forgot_password')); ?>";
    var current_url = "<?php echo e(Request()->url()); ?>";
    var home_url = "<?php echo e(url('/' . $storeinfo->slug)); ?>";
    var is_logedin = "<?php echo e(@Auth::user()->type == 3 ? 1 : 2); ?>";
    var loginurl = "<?php echo e(URL::to($storeinfo->slug . '/login')); ?>";
    var out_of_stock = "<?php echo e(trans('labels.out_of_stock')); ?>";
    var rtl = "<?php echo e(session()->get('direction')); ?>";
</script>
<script>
    var darklogo = "<?php echo e(helper::image_path(helper::appdata($storeinfo->id)->darklogo)); ?>";
    var lightlogo = "<?php echo e(helper::image_path(helper::appdata($storeinfo->id)->logo)); ?>";
</script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/custom.js')); ?>"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/top_deals.js')); ?>"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/sweetalert/sweetalert2.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>


<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'front/js/wallet.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<!-- loaded js -->

<script>
    // Product Preview
    $('.sp-wrap').smoothproducts();

    function rattingmodal(id, vendor_id, item_name) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "<?php echo e(URL::to($storeinfo->slug . '/rattingmodal')); ?>",
            type: "post",
            dataType: "json",
            data: {
                item_id: id,
                vendor_id: vendor_id
            },
            success: function(response) {
                if (response.status == 1) {
                    $('#viewreviewsbody').html(response.output);
                    $('#viewproduct-over').modal('hide');
                    $('#ratingsidebar').offcanvas('show');
                } else {
                    toastr.error(wrong);
                }
            },
            error: function() {
                toastr.error(wrong);
            }
        });
    }

    function formatDate(value) {
        let date = new Date(value);
        const day = date.toLocaleString('default', {
            day: '2-digit'
        });
        const month = date.toLocaleString('default', {
            month: 'short'
        });
        const year = date.toLocaleString('default', {
            year: 'numeric'
        });
        return day + ' ' + month + ' ' + year;
    }

    function postreview(itemid, item_name) {
        $('#item_id').val(itemid);
        $('#ratingsaddLabel').html(item_name);
        $('#ratingsidebar').offcanvas('hide');
        $('#ratingsadd').modal('show');
    }
</script>

<?php if(@helper::checkaddons('customer_login')): ?>
    <input type="hidden" name="login_required" id="login_required"
        value="<?php echo e(@helper::appdata($storeinfo->id)->checkout_login_required); ?>">
    <input type="hidden" name="checklogin" id="checklogin" value="<?php echo e(@Auth::user() && Auth::user()->type == 3); ?>">
    <input type="hidden" name="customer_login" id="customer_login"
        value="<?php echo e(@helper::checkaddons('customer_login')); ?>">
<?php endif; ?>

<input type="hidden" name="request_url" id="request_url"
    value="<?php echo e(@request()->segments()[1] ? @request()->segments()[1] : @request()->segments()[0]); ?>">


<script type="text/javascript">
    $(document).ready(function() {
        $('#orders').DataTable();
    });

    //sidebar For Craete Account Form Show
    $('.create_account_btn').on("click", function() {
        $('#register_form').removeClass('d-none');
        $('#login_form').addClass('d-none');
        $('#forgot_password_form').addClass('d-none');
        $('#auth_form_title').html(register_title);
    });

    //sidebar For Login Form Show 
    $('.login_btn').on("click", function() {
        $('#register_form').addClass('d-none');
        $('#login_form').removeClass('d-none');
        $('#forgot_password_form').addClass('d-none');
        $('#auth_form_title').html(login_title);
    });

    //sidebar For Forgot Password Form Show
    $('.forgot_password_btn').on("click", function() {
        $('#register_form').addClass('d-none');
        $('#login_form').addClass('d-none');
        $('#forgot_password_form').removeClass('d-none');
        $('#auth_form_title').html(forgot_password_title);
    });

    const myOffcanvas = document.getElementById('loginpage');
    myOffcanvas.addEventListener('hidden.bs.offcanvas', () => {
        $('.login_btn').click();
    });

    // Close mobile sidebar when store information modal opens
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const infomodal = document.getElementById('infomodal');
    if (infomodal) {
        infomodal.addEventListener('show.bs.modal', () => {
            const bsOffcanvas = bootstrap.Offcanvas.getInstance(mobileSidebar);
            if (bsOffcanvas) {
                bsOffcanvas.hide();
            }
        });
    }

    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-right",
    }
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(session('success')); ?>");
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>
    var ratting = "<?php echo e(number_format(0, 1)); ?>";
    if ("<?php echo e(helper::appdata($storeinfo->id)->product_ratting_switch == 1); ?>") {
        reviewshow = 1;
    }
    var whatsappnumber = "<?php echo e(helper::appdata($storeinfo->id)->whatsapp_number); ?>";

    function currency_formate(price, currency_type = null) {
        if (currency_type == 'USD') {
            return '$' + $.number(price, 2);
        }
        if (currency_type == 'Lira') {
            var locale = "<?php echo e(\App::getLocale()); ?>";
            var currency_text = locale === 'en' ? " L.S" : " ل.س";
            return $.number(price, 0) + currency_text;
        }

        var formate = <?php echo e(@helper::currencyinfo($storeinfo->id)->decimal_digit ?? 2); ?>;
        var exchange_rate = <?php echo e(@helper::currencyinfo($storeinfo->id)->exchange_rate ?? 1); ?>;
        var price = parseFloat(price) * parseFloat(exchange_rate);

        var locale = "<?php echo e(\App::getLocale()); ?>";
        var currency = locale === 'ar' ? "ل.س" : "<?php echo e(@helper::currencyinfo($storeinfo->id)->currency); ?>";
        var position = "<?php echo e(@helper::currencyinfo($storeinfo->id)->currency_position); ?>";
        var space = "<?php echo e(@helper::currencyinfo($storeinfo->id)->currency_space); ?>";
        var decimal_sep = "<?php echo e(@helper::currencyinfo($storeinfo->id)->decimal_separator); ?>";

        var oldprice = decimal_sep == 1 ? $.number(price, formate) : $.number(price, formate, ',', '.');
        var newprice = '';

        if (position == "1") {
            newprice = space == "1" ? currency + ' ' + oldprice : currency + oldprice;
        } else {
            newprice = space == "1" ? oldprice + ' ' + currency : oldprice + currency;
        }

        return newprice;
    }

    function GetProductOverview(slug, id) {
        if (id != null && id != "") {
            $('#' + id).prop("disabled", true);
            $('#' + id).html(
                '<span class="loader"></span>');
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo e(URL::to('product-details/details')); ?>",
            data: {
                slug: slug,
                vendor: "<?php echo e($storeinfo->slug); ?>",
            },
            method: 'POST', //Post method,
            dataType: 'json',
            success: function(response) {
                if (id != null && id != "") {
                    $('#' + id).prop("disabled", false);
                    if (id.includes('icon')) {
                        if ("<?php echo e(helper::appdata($storeinfo->id)->online_order); ?>" == 1) {
                            $('#' + id).html('<i class="fa-regular fa-cart-shopping"></i>');
                        } else {
                            $('#' + id).html('<i class="fa-regular fa-eye"></i>');
                        }
                    } else {
                        if ("<?php echo e(helper::appdata($storeinfo->id)->online_order); ?>" == 1) {
                            $('#' + id).html("<?php echo e(trans('labels.add_to_cart')); ?>");
                        } else {
                            $('#' + id).html("<?php echo e(trans('labels.view')); ?>");
                        }
                    }
                }
                $('#viewproduct_body').html(response.output);
                $('#viewproduct-over').modal('show');

            },
            error: function(error) {
                $('#' + id).prop("disabled", false);
                if (id.includes('icon')) {
                    if ("<?php echo e(helper::appdata($storeinfo->id)->online_order); ?>" == 1) {
                        $('#' + id).html('<i class="fa-regular fa-cart-shopping"></i>');
                    } else {
                        $('#' + id).html('<i class="fa-regular fa-eye"></i>');
                    }
                } else {
                    if ("<?php echo e(helper::appdata($storeinfo->id)->online_order); ?>" == 1) {
                        $('#' + id).html("<?php echo e(trans('labels.add_to_cart')); ?>");
                    } else {
                        $('#' + id).html("<?php echo e(trans('labels.view')); ?>");
                    }
                }
                toastr.error("<?php echo e(trans('messages.wrong')); ?>");
            }
        })
    }

    function AddtoCart(buynow) {

        // add spinner to button for some time
        if (buynow == 0) {
            $('.addtocart').prop("disabled", true);
            $('.addtocart').html('<span class="loader"></span>');

        } else {
            $('.buynow').prop("disabled", true);
            $('.buynow').html('<span class="loader text-white"></span>');

        }
        if ($('#viewproduct-over').is(':visible')) {
            var vendor = $('#modal_overview_vendor').val();
            var item_id = $('#modal_overview_item_id').val();
            var item_name = $('#modal_overview_item_name').val();
            var item_image = $('#modal_overview_item_image').val();
            var item_price = $('#modal_overview_item_price').val();
            var item_qty = $('#modal_detail_plus_minus .item_qty_' + item_id).val();
            var item_original_price = $('#modal_overview_item_original_price').val();
            var tax = $('#modal_tax_val').val();
            var variants_name = $('#modal_variants_name').val();
            var min_order = $('#modal_item_min_order').val();
            var max_order = $('#modal_item_max_order').val();
            var stock_management = $('#modal_stock_management').val();
        } else {
            var vendor = $('#overview_vendor').val();
            var item_id = $('#overview_item_id').val();
            var item_name = $('#overview_item_name').val();
            var item_image = $('#overview_item_image').val();
            var item_price = $('#overview_item_price').val();
            var item_qty = $('#detail_plus_minus .item_qty_' + item_id).val();
            var item_original_price = $('#overview_item_original_price').val();
            var tax = $('#tax_val').val();
            var variants_name = $('#variants_name').val();
            var min_order = $('#item_min_order').val();
            var max_order = $('#item_max_order').val();
            var stock_management = $('#stock_management').val();

        }
        var extras_id = ($('.Checkbox:checked').map(function() {
            return this.value;
        }).get().join('| '));
        var extras_name = ($('.Checkbox:checked').map(function() {
            return $(this).attr('extras_name');
        }).get().join('| '));
        var extras_price = ($('.Checkbox:checked').map(function() {
            return $(this).attr('price');
        }).get().join('| '));

        var login_required = $('#login_required').val();
        var checklogin = $('#checklogin').val();
        var customer_login = "";
        if ($('#customer_login').val() != null) {
            var customer_login = JSON.parse($('#customer_login').val());
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo e(URL::to('/add-to-cart')); ?>",
            data: {
                vendor_id: vendor,
                item_id: item_id,
                item_name: item_name,
                item_image: item_image,
                item_price: item_price,
                item_original_price: item_original_price,
                tax: tax,
                variants_name: variants_name,
                extras_id: extras_id,
                extras_name: extras_name,
                extras_price: extras_price,
                qty: item_qty,
                min_order: min_order,
                max_order: max_order,
                stock_management: stock_management,
                buynow: buynow,
            },
            method: 'POST', //Post method,
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    if (buynow == 0) {
                        if ($('#viewproduct-over').is(':visible')) {
                            if ("<?php echo e(helper::appdata(@$storeinfo->id)->template); ?>" == 2) {
                                location.reload();
                            } else {
                                $('#viewproduct-over').modal('hide');
                                $('#cartcnt').text(response.cartcnt);
                                $('#cartcnt').removeClass('d-none');
                                $('.addtocart').html("<?php echo e(trans('labels.add_to_cart')); ?>");
                                $('.addtocart').prop("disabled", false);
                            }
                        } else {
                            location.reload();
                        }
                        toastr.success("<?php echo e(trans('messages.success')); ?>");
                    } else {
                        if (customer_login != "" && customer_login.activated == 1) {
                            if (checklogin) {
                                location.href = "<?php echo e(URL::to($storeinfo->slug . '/checkout?buy_now=')); ?>" +
                                    buynow;
                            } else if (login_required == 1) {
                                if ($('#viewproduct-over').is(':visible')) {
                                    $('#viewproduct-over').modal('hide');
                                }
                                $('.buynow').html("<?php echo e(trans('labels.buy_now')); ?>");
                                $('.buynow').prop("disabled", false);
                                $('#loginmodel').modal('show');
                            } else {
                                location.href = "<?php echo e(URL::to($storeinfo->slug . '/checkout?buy_now=')); ?>" +
                                    buynow;
                            }
                        } else {
                            location.href = "<?php echo e(URL::to($storeinfo->slug . '/checkout?buy_now=')); ?>" +
                                buynow;
                        }
                    }
                } else {
                    $('.addtocart').html("<?php echo e(trans('labels.add_to_cart')); ?>");
                    $('.addtocart').prop("disabled", false);
                    $('.buynow').html("<?php echo e(trans('labels.buy_now')); ?>");
                    $('.buynow').prop("disabled", false);
                    toastr.error(response.message);
                }
            },
            error: function() {
                $('.addtocart').html("<?php echo e(trans('labels.add_to_cart')); ?>");
                $('.addtocart').prop("disabled", false);
                $('.buynow').html("<?php echo e(trans('labels.buy_now')); ?>");
                $('.buynow').prop("disabled", false);
                toastr.error(wrong);
            }
        })
    };

    function addonaddtocart(buynow, cart_type) {
        if ($('#viewproduct-over').is(':visible')) {
            var vendor = $('#modal_overview_vendor').val();
            var item_id = $('#modal_overview_item_id').val();
            var item_name = $('#modal_overview_item_name').val();
            var item_image = $('#modal_overview_item_image').val();
            var item_price = $('#modal_overview_item_price').val();
            var item_qty = $('#modal_detail_plus_minus .item_qty_' + item_id).val();
            var item_original_price = $('#modal_overview_item_original_price').val();
            var tax = $('#modal_tax_val').val();
            var variants_name = $('#modal_variants_name').val();
            var min_order = $('#modal_item_min_order').val();
            var max_order = $('#modal_item_max_order').val();
            var stock_management = $('#modal_stock_management').val();
        } else {
            var vendor = $('#overview_vendor').val();
            var item_id = $('#overview_item_id').val();
            var item_name = $('#overview_item_name').val();
            var item_image = $('#overview_item_image').val();
            var item_price = $('#overview_item_price').val();
            var item_qty = $('#detail_plus_minus .item_qty_' + item_id).val();
            var item_original_price = $('#overview_item_original_price').val();
            var tax = $('#tax_val').val();
            var variants_name = $('#variants_name').val();
            var min_order = $('#item_min_order').val();
            var max_order = $('#item_max_order').val();
            var stock_management = $('#stock_management').val();

        }
        var extras_id = ($('.Checkbox:checked').map(function() {
            return this.value;
        }).get().join('| '));
        var extras_name = ($('.Checkbox:checked').map(function() {
            return $(this).attr('extras_name');
        }).get().join('| '));
        var extras_price = ($('.Checkbox:checked').map(function() {
            return $(this).attr('price');
        }).get().join('| '));

        var login_required = $('#login_required').val();
        var checklogin = $('#checklogin').val();
        var customer_login = "";
        if ($('#customer_login').val() != null) {
            var customer_login = JSON.parse($('#customer_login').val());
        }

        if (cart_type == 'addon_add_cart') {
            var frequently_bought_items = $(".frequently_bought_items_chk_" + item_id + ":checked").map(
                function() {
                    return $(this).attr("frequently_bought_items-id");
                }).get().join("|");
        } else {
            var frequently_bought_items = "";
        }
        $('#addon_cart_btn').prop("disabled", true);
        $('#addon_cart_btn').html(
            '<span class="loader"></span>');
        setTimeout(function() {
            $('#addon_cart_btn').html('Add To Cart');
        }, 3000);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "<?php echo e(URL::to('/add-to-cart')); ?>",
            data: {
                vendor_id: vendor,
                item_id: item_id,
                item_name: item_name,
                item_image: item_image,
                item_price: item_price,
                item_original_price: item_original_price,
                tax: tax,
                variants_name: variants_name,
                extras_id: extras_id,
                extras_name: extras_name,
                extras_price: extras_price,
                qty: item_qty,
                min_order: min_order,
                max_order: max_order,
                stock_management: stock_management,
                buynow: buynow,
                frequently_bought_items: frequently_bought_items,
            },
            method: "POST",
            dataType: "json",
            success: function(response) {
                if (response.status == 1) {
                    toastr.success("<?php echo e(trans('messages.success')); ?>");
                    location.reload();

                    $(".cart-count").html(response.total_cart_count);
                    $('#viewproduct-over').modal('hide');
                } else {
                    $('#addon_cart_btn').prop("disabled", false);
                    $('#addon_cart_btn').html('Add To Cart');
                    toastr.error(response.message);
                    $('#viewproduct-over').modal('hide');
                }
            },
            error: function() {
                $('#addon_cart_btn').prop("disabled", false);
                $('#addon_cart_btn').html('Add To Cart');
                toastr.error(wrong);
                $('#viewproduct-over').modal('hide');
                return false;
            }
        });
    }


    function productcheckout() {
        var request_url = $('#request_url').val();
        if (request_url == 'cart') {
            location.href = "<?php echo e(URL::to($storeinfo->slug . '/checkout?buy_now=0')); ?>";
        } else {
            location.href = "<?php echo e(URL::to($storeinfo->slug . '/checkout?buy_now=1')); ?>";
        }
    }

    $('body').on('change', 'input[type="checkbox"]', function(e) {
        var total = parseFloat($("#price").val());
        if ($(this).is(':checked')) {
            total += parseFloat($(this).attr('price')) || 0;
        } else {
            total -= parseFloat($(this).attr('price')) || 0;
        }
        $('h3.pricing').text(currency_formate(parseFloat(total)));
        $('#price').val(total);
    })
    $('body').on('change', 'input[type="radio"]', function(e) {
        $('h3.pricing').text(currency_formate(parseFloat($(this).attr('price'))));
        $('#price').val(parseFloat($(this).attr('price')));
        $('input[type=checkbox]').prop('checked', false);
    })

    // $(".catinfo").on("click", function() {
    //     "use strict";
    //     $("#settingmenuContent").find(".card").attr("style", "");
    //     if (
    //         $(this).attr("data-tab") == "basicinfo" ||
    //         $(this).attr("data-tab") == "theme_settings"
    //     ) {
    //         $("html, body").animate({
    //                 scrollTop: 0
    //             },
    //             "1000"
    //         );
    //     } else {
    //         if (!$(this).is(":last-child")) {
    //             $("#" + $(this).attr("data-tab"))
    //                 .find(".card")
    //                 .attr("style", "margin-top: 80px;");
    //         }
    //     }
    //     $(".list-options").find(".active").removeClass("active");
    //     $(this).addClass("active");
    // });


    $('.cat-check').on('click', function() {
        $("#settingmenuContent").find(".catinfo").attr("style", "");
        if ($(this).attr('data-cat-type') == '0') {
            $('html, body, section').find(".product-list-sec").animate({
                scrollTop: 0
            }, '1000');
        } else {
            if (!$(this).is(":last-child")) {
                // $("#" + $(this).attr("data-tab")).attr("style", "margin-top: 80px;");
                $("#" + $(this).attr("data-tab")).find("#settingmenuContent").animate({
                    scrollTop: 100
                });
            }
        }
        $('.cat-aside-wrap').find('.active').removeClass('active');
        $(this).addClass('active');
    });

    function RemoveCart(cart_id, vendor_id) {
        "use strict";
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-1',
                cancelButton: 'btn btn-danger bg-danger mx-1'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            icon: 'warning',
            title: "<?php echo e(trans('messages.are_you_sure')); ?>",
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: "<?php echo e(trans('messages.yes')); ?>",
            cancelButtonText: "<?php echo e(trans('messages.no')); ?>",
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "<?php echo e(URL::to('/cart/deletecartitem')); ?>",
                        data: {
                            cart_id: cart_id,
                            vendor_id: vendor_id,
                        },
                        method: 'POST',
                        success: function(response) {
                            if (response.status == 1) {
                                $('.shopping-cart #cartcnt').text(response.cartcnt);
                                location.reload();
                            } else {
                                swal("Cancelled", "<?php echo e(trans('messages.wrong')); ?> :(",
                                    "error");
                            }
                        },
                        error: function(e) {
                            swal("Cancelled", "<?php echo e(trans('messages.wrong')); ?> :(",
                                "error");
                        }
                    });
                });
            },
        }).then((result) => {
            if (!result.isConfirmed) {
                result.dismiss === Swal.DismissReason.cancel
            }
        })
    }

    function qtyupdate(cart_id, item_id, variants_id, price, type) {

        var qtys = parseInt($("#number_" + cart_id).val());
        var item_id = item_id;
        var cart_id = cart_id;
        var variants_id = variants_id;
        if (type == "decreaseValue") {
            qty = qtys - 1;
        } else {
            qty = qtys + 1;
        }

        if (qty >= "1") {
            $('.change-qty').prop('disabled', true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(URL::to('/cart/qtyupdate')); ?>",
                data: {
                    cart_id: cart_id,
                    item_id: item_id,
                    type: type,
                    qty: qty,
                    variants_id: variants_id,
                    price: price * qty
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 1) {
                        location.reload();
                    } else {
                        $("#number_" + cart_id).val(response.qty);
                        toastr.error(response.message);
                        $('.change-qty').prop('disabled', false);
                    }
                },
                error: function() {
                    toastr.error(wrong);
                    $('.change-qty').prop('disabled', false);
                }
            });
        }

    }

    function changeqty(item_id, type) {
        var qtys = parseInt($('.item_qty_' + item_id).val());
        if (type == "minus") {
            qty = qtys - 1;
        } else {
            qty = qtys + 1;
        }
        if (qty >= "1") {
            if ($('#viewproduct-over').is(':visible')) {
                var variants_name = $('#modal_variants_name').val();
                var stock_management = $('#modal_stock_management').val();
                $('.change-qty-2').prop('disabled', true);
            } else {
                var variants_name = $('#variants_name').val();
                var stock_management = $('#stock_management').val();
                $('.change-qty-1').prop('disabled', true);
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(URL::to('/changeqty')); ?>",
                data: {
                    item_id: item_id,
                    type: type,
                    qty: qty,
                    vendor_id: "<?php echo e($storeinfo->id); ?>",
                    variants_name: variants_name,
                    stock_management: stock_management,
                },
                method: 'POST',
                success: function(response) {
                    if (response.status == 1) {
                        $('.change-qty-1').prop('disabled', false);
                        $('.change-qty-2').prop('disabled', false);
                        $('.item_qty_' + item_id).val(response.qty);
                    } else {
                        $('.change-qty-1').prop('disabled', false);
                        $('.change-qty-2').prop('disabled', false);
                        $('.item_qty_' + item_id).val(response.qty);
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    $('.change-qty-1').prop('disabled', false);
                    $('.change-qty-2').prop('disabled', false);
                }
            });
        }

    }

    function showaddons(id, item_name, attribute, extra_name, extra_price, variation_name, variation_price) {
        $('#selected_addons_Label').html(item_name);
        $('#variation_title').html(attribute);
        var variation_title = "<?php echo e(trans('labels.variants')); ?>";
        var extra_title = "<?php echo e(trans('labels.extras')); ?>";

        var extras = extra_name.split("|");
        var variations = variation_name.split(',');
        var extra_price = extra_price.split('|');
        var html = "";
        if (variations != '') {
            html += '<p class="fw-bolder m-0 color-changer" id="variation_title">' + variation_title +
                '</p><ul class="m-0 ps-2">';
            html += '<li class="px-0 color-changer fs-7">' + variations + ' : <span class="text-muted fs-7">' +
                currency_formate(parseFloat(
                    variation_price)) + '</span></li>'
            html += '</ul>';
        }
        $('#item-variations').html(html);
        var html1 = '';
        if (extras != '') {
            $('#extras_title').removeClass('d-none');
            html1 += '<p class="fw-bolder m-0 color-changer" id="extras_title">' + extra_title +
                '</p><ul class="m-0 ps-2">';
            for (i in extras) {
                html1 += '<li class="px-0 color-changer fs-7">' + extras[i] + ' : <span class="text-muted fs-7">' +
                    currency_formate(parseFloat(
                        extra_price[i])) + '</span></li>'
            }
            html1 += '</ul>';
        }
        $('#item-extras').html(html1);
        $('#modal_selected_addons').modal('show');
    }
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(helper::appdata(1)->tracking_id); ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?php echo e(helper::appdata(1)->tracking_id); ?>');
</script>

<?php if(@helper::checkaddons('subscription')): ?>
    <?php if(@helper::checkaddons('pwa')): ?>
        <?php
            $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)->orderByDesc('id')->first();
            $user = App\Models\User::where('id', $storeinfo->id)->first();
            if ($user->allow_without_subscription == 1) {
                $pwa = 1;
            } else {
                $pwa = @$checkplan->pwa;
            }
        ?>
        <?php if($pwa == 1): ?>
            <script src="<?php echo e(url('storage/app/public/sw.js')); ?>"></script>
            <script>
                if (!navigator.serviceWorker.controller) {
                    navigator.serviceWorker.register("<?php echo e(url('storage/app/public/sw.js')); ?>").then(function(reg) {
                        console.log("Service worker has been registered for scope: " + reg.scope);
                    });
                }
            </script>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(@helper::checkaddons('pwa')): ?>
        <script src="<?php echo e(url('storage/app/public/sw.js')); ?>"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("<?php echo e(url('storage/app/public/sw.js')); ?>").then(function(reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    <?php endif; ?>
<?php endif; ?>

<script>
    var in_stock = "<?php echo e(trans('labels.in_stock')); ?>";
    var out_stock = "<?php echo e(trans('labels.out_of_stock')); ?>";
    var not_available = "<?php echo e(trans('labels.not_available')); ?>";

    function myFunction() {
        "use strict";
        toastr.error("This operation was not performed due to demo mode");
        return false;
    }

    if (window.matchMedia('(display-mode: standalone)').matches) {
        // If the app is installed, hide the install button or popup
        $('.pwa').addClass('d-none');
    } else {
        $('#close-btn').click(function() {
            $('.pwa').addClass('d-none');
        });
        let deferredPrompt = null;
        window.addEventListener('beforeinstallprompt', (e) => {
            $('.mobile_drop_down').show();
            deferredPrompt = e;
        });
        const mobile_install_app = document.getElementById('mobile-install-app');
        if (mobile_install_app != null) {
            mobile_install_app.addEventListener('click', async () => {
                if (deferredPrompt !== null) {
                    deferredPrompt.prompt();
                    const {
                        outcome
                    } = await deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        deferredPrompt = null;
                    }
                }
            });
        }
    }
</script>

<!-- product img change js -->
<script>
    $(document).ready(function($) {
        var selected = [];
        $('.detail_size_variation input:checked').each(function() {
            $("#detail_variation [id='" + 'check_' + this.id + "']").addClass('active');
            selected.push($(this).attr('value'));
        });
        if (selected != "" && selected != null) {
            detail_set_variant_price(selected);
        }
    });
    $('#detail_variation input:checkbox').click(function() {
        var selected = [];
        var divselected = [];
        const myArray = this.id.split("-");

        var id = this.id;
        $('#detail_variation .check' + myArray[0] + ' input:checked').each(function() {
            divselected.push($(this).attr('value'));
        });
        if (divselected.length == 0) {
            $(this).prop('checked', true);
        }


        $('#detail_variation .check' + myArray[0] + ' input:checkbox').not(this).prop('checked', false);
        $('#detail_variation .check' + myArray[0]).removeClass('active');
        $("#detail_variation [id='" + 'check_' + this.id + "']").addClass('active');
        $('.detail_size_variation input:checked').each(function() {
            selected.push($(this).attr('value'));
        });
        if (selected != "" && selected != null) {
            $('.product-detail-price').addClass('d-none');
            $('#laodertext').removeClass('d-none');
            $('#laodertext').html(
                '<span class="loader"></span>'
            );
            detail_set_variant_price(selected);
        }
    });

    function detail_set_variant_price(variants) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo e(URL::to('get-products-variant-quantity')); ?>",
            data: {
                name: variants,
                item_id: $('#overview_item_id').val(),
                vendor_id: "<?php echo e($storeinfo->id); ?>",
            },
            success: function(data) {
                if (data.status == 1) {
                    setTimeout(function() {
                        $('#laodertext').html('');
                    }, 4000);
                    var off = ((1 - (data.price / data.original_price)) * 100).toFixed(1);
                    $('#laodertext').addClass('d-none');
                    $('.product-detail-price').removeClass('d-none');
                    $('#variants_name').val(variants);
                    $('.detail_item_price').text(currency_formate(parseFloat(data.price)));
                    $('#overview_item_price').val(data.price);
                    $('#offer').removeClass('d-none');
                    if (parseFloat(data.original_price) > parseFloat(data.price)) {
                        $('.detail_original_price').text(currency_formate(parseFloat(data.original_price)));
                        $('#offer').text($.number(off, 1) + '% <?php echo e(trans('labels.off')); ?>');
                    } else {
                        $('.detail_original_price').text('');
                        $('#offer').text('');
                    }
                    $('#overview_item_original_price').val(data.original_price);
                    $('#stock_management').val(data.stock_management);
                    $('#item_min_order').val(data.min_order);
                    $('#item_max_order').val(data.max_order);
                    if (data.is_available == 2) {
                        $('#offer').addClass('d-none');
                        $('#detail_not_available_text').html(not_available);
                        $('.add-btn').attr('disabled', true);
                        $('.add-btn').addClass('d-none');
                        $('.detail_item_price').addClass('d-none');
                        $('.detail_original_price').addClass('d-none');
                        $('#sku_stock').addClass('d-none');
                        $('#detail_plus_minus').addClass('d-none');
                        $('#tax').addClass('d-none');
                        $('#stock').addClass('d-none');
                    } else {
                        $('#offer').removeClass('d-none');
                        $('#detail_not_available_text').html('');
                        $('.add-btn').attr('disabled', false);
                        $('.add-btn').removeClass('d-none');
                        $('.detail_item_price').removeClass('d-none');
                        $('.detail_original_price').removeClass('d-none');
                        $('#detail_plus_minus').removeClass('d-none');
                        $('#sku_stock').removeClass('d-none');
                        $('#tax').removeClass('d-none');
                        $('#stock').addClass('d-none');
                        if (data.stock_management == 1) {
                            $('#stock').removeClass('d-none');
                            $('#detail_out_of_stock').removeClass('d-none');
                            if (data.quantity > 0) {
                                $('.add-btn').attr('disabled', false);
                                $('#detail_out_of_stock').removeClass('text-danger');
                                $('#detail_out_of_stock').addClass('text-success');
                                $('#detail_out_of_stock').html(data.quantity + ' ' + in_stock);
                            } else {
                                $('.add-btn').attr('disabled', true);
                                $('#detail_out_of_stock').removeClass('text-dark');
                                $('#detail_out_of_stock').addClass('text-danger');
                                $('#detail_out_of_stock').html(out_stock);
                            }
                        } else {
                            $('#detail_out_of_stock').addClass('d-none');
                        }

                    }
                    add_frequently_product(data.item_id);

                }

            }
        });
    }

    $('#track_here').on('click', function() {
        setTimeout(function() {
            $('#track_here').prop("disabled", true);
            $('#track_here').html(
                '<span class="loader"></span>');
        }, 50);
        setTimeout(function() {
            $('#track_here').html("<?php echo e(trans('labels.track_here')); ?>");
            $('#track_here').prop("disabled", false);
        }, 3000);
    });

    $('#btnsubmit').on('click', function() {
        setTimeout(function() {
            $('#btnsubmit').prop("disabled", true);
            $('#btnsubmit').html(
                '<span class="loader"></span>');
        }, 50);
        setTimeout(function() {
            $('#btnsubmit').html("<?php echo e(trans('labels.submit')); ?>");
            $('#btnsubmit').prop("disabled", false);
        }, 3000);
    });

    $('#btnsubscribe').on('click', function() {
        if ($('#emailsubscribe').val() != "") {
            setTimeout(function() {
                $('#btnsubscribe').prop("disabled", true);
                $('#btnsubscribe').html(
                    '<span class="loader"></span>');
            }, 50);
            setTimeout(function() {
                $('#btnsubscribe').html("<?php echo e(trans('labels.subscribe')); ?>");
                $('#btnsubscribe').prop("disabled", false);
            }, 3000);
        }
    });
    $('#btnsearch').on('click', function() {
        setTimeout(function() {
            $('#btnsearch').prop("disabled", true);
            $('#btnsearch').html(
                '<span class="loader"></span>');
        }, 50);
        setTimeout(function() {
            $('#btnsearch').html("<?php echo e(trans('labels.search')); ?>");
            $('#btnsearch').prop("disabled", false);
        }, 3000);
    });
    $('#btnsignin').on('click', function() {
        setTimeout(function() {
            $('#btnsignin').prop("disabled", true);
            $('#btnsignin').html(
                '<span class="loader"></span>');
        }, 50);
        setTimeout(function() {
            $('#btnsignin').html("<?php echo e(trans('labels.login')); ?>");
            $('#btnsignin').prop("disabled", false);
        }, 3000);
    });
    $('#btnsignup').on('click', function() {
        setTimeout(function() {
            $('#btnsignup').prop("disabled", true);
            $('#btnsignup').html(
                '<span class="loader"></span>');
        }, 50);
        setTimeout(function() {
            $('#btnsignup').html("<?php echo e(trans('labels.sign_in')); ?>");
            $('#btnsignup').prop("disabled", false);
        }, 3000);
    });

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        //>=, not <=
        if (scroll >= 300) {
            //clearHeader, not clearheader - caps H
            $(".main-header").addClass("header-bg-white");
        } else {
            $(".main-header").removeClass("header-bg-white");
        }
    });
</script>

<?php if(@helper::checkaddons('sales_notification')): ?>
    <?php if(helper::appdata($storeinfo->id)->fake_sales_notification == 1): ?>
        <script>
            if ("<?php echo e(@helper::appdata($storeinfo->id)->fake_sales_notification); ?>" == "1") {
                // Select the element with the ID 'sales-booster-popup'
                const popup = document.getElementById('sales-booster-popup');

                if (popup) {
                    // Define a function to add and remove the 'loaded' class
                    let isMouseOver = false;
                    const toggleLoadedClass = () => {
                        // Add the 'loaded' class
                        popup.classList.add('loaded');
                        // Remove the 'loaded' class after 5 seconds, unless the mouse is over the popup
                        setTimeout(() => {
                                if (!isMouseOver) {
                                    popup.classList.remove('loaded');
                                }
                            },
                            "<?php echo e(helper::appdata($storeinfo->id)->notification_display_time); ?>"
                        ); // 4000 milliseconds = 4 seconds for demo purposes
                    };

                    // Function to handle mouseover event
                    const handleMouseOver = () => {
                        isMouseOver = true;
                        // You can perform actions here when mouse is over the popup
                    };

                    // Function to handle mouseout event
                    const handleMouseOut = () => {
                        isMouseOver = false;
                    };

                    // Call the function initially
                    toggleLoadedClass();

                    setInterval(function() {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "<?php echo e(URL::to('get_notification_data')); ?>",

                                type: "post",
                                dataType: "json",
                                data: {
                                    vendor_id: "<?php echo e($storeinfo->id); ?>",
                                },
                                success: function(response) {
                                    toggleLoadedClass();
                                    $('#sales-booster-popup').show();
                                    $('#notification_body').html(response.output);
                                },
                            });
                        },
                        "<?php echo e(helper::appdata($storeinfo->id)->notification_display_time + helper::appdata($storeinfo->id)->next_time_popup); ?>"
                    ); // 8000 milliseconds = 8 seconds

                    // Add mouseover and mouseout event listeners to the popup
                    popup.addEventListener('mouseover', handleMouseOver);
                    popup.addEventListener('mouseout', handleMouseOut);

                    // Select the close button within the popup
                    const closeButton = popup.querySelector('.close'); // Close button selector

                    if (closeButton) {
                        // Add an event listener to the close button
                        closeButton.addEventListener('click', () => {
                            // Remove the 'loaded' class immediately
                            popup.classList.remove('loaded');
                        });
                    }
                }
            }
        </script>
    <?php endif; ?>
<?php endif; ?>

</body>

</html>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/theme/footer.blade.php ENDPATH**/ ?>