<!DOCTYPE html>
<html lang="en" dir="{{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}"  class="light">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="{{ helper::appdata('')->meta_title }}" />
    <meta property="og:description" content="{{ helper::appdata('')->meta_description }}" />
    <meta property="og:image" content="{{ helper::image_path(helper::appdata('')->og_image) }}" />

    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.add('light');
        }
    </script>

    <link rel="icon" href="{{ helper::image_path(helper::appdata('')->favicon) }}" type="image" sizes="16x16">
    <title>{{ helper::appdata('')->website_title }}</title>
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap-select.min.css') }}">
    <!--multi-selection css-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/style.css?v='.time()) }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/responsive.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/timepicker/jquery.timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/datatables/buttons.dataTables.min.css') }}">
    <!-- magnific-popup -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/magnific/magnific-popup.min.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap');
        :root {
            /* Color */
            --bs-primary: {{ helper::appdata('')->primary_color }};
            --bs-secondary: {{ helper::appdata('')->secondary_color }};
        }
        body {
            font-family: 'Cairo', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6, .color-changer, .nav-link, .btn {
            font-family: 'Cairo', sans-serif !important;
        }
        i, .fa, .fas, .far, .fal, .fa-solid, .fa-regular, .fa-light, [class^="fa-"]:not(.fa-brands):not(.fab), [class*=" fa-"]:not(.fa-brands):not(.fab) {
            font-family: "Font Awesome 6 Pro", "Font Awesome 6 Free", sans-serif !important;
        }
        .fa-brands, .fab {
            font-family: "Font Awesome 6 Brands" !important;
        }
    </style>
  <meta name="theme-color" content="{{ helper::appdata('')->theme_color ?? '#ffffff' }}">
  <meta name="background-color" content="{{ helper::appdata('')->background_color ?? '#ffffff' }}">
  <link rel="apple-touch-icon" href="{{ helper::image_path(helper::appdata('')->app_logo) }}">
  <link rel="manifest" href='data:application/manifest+json,{"name": "{{ helper::appdata('')->app_name }}","short_name": "{{ helper::appdata('')->app_name }}","icons": [{"src": "{{ helper::image_path(helper::appdata('')->app_logo) }}", "sizes": "512x512", "type": "image/png"}, {"src": "{{ helper::image_path(helper::appdata('')->app_logo) }}", "sizes": "1024x1024", "type": "image/png"}], "start_url": "{{ request()->url() }}","display": "standalone","prefer_related_applications":"false" }'>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YKTXTSENXZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YKTXTSENXZ');
  </script>
</head>

<body>
    @if(Auth::check() && Auth::user()->type == 2 && request()->is('admin/dashboard'))
    <!-- PWA Install Prompt Button -->
    <style>
        .pwa-prompt-container {
            position: fixed; top: 1rem; left: 0; right: 0; margin-left: auto; margin-right: auto;
            z-index: 10000; display: none; align-items: center; justify-content: space-between;
            gap: 0.5rem; background-color: white; padding: 0.75rem 1rem; border-radius: 1rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.2); border: 1px solid #f3f4f6;
            width: 92%; max-width: 24rem;
            opacity: 0; transform: translateY(-150%); transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .pwa-prompt-inner { display: flex; align-items: center; gap: 0.75rem; overflow: hidden; }
        .pwa-prompt-img { width: 2.5rem; height: 2.5rem; border-radius: 0.75rem; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); object-fit: cover; }
        .pwa-prompt-text { flex: 1; min-width: 0; }
        .pwa-prompt-title { font-size: 0.875rem; font-weight: 700; color: #111827; line-height: 1.25; margin: 0; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pwa-prompt-desc { font-size: 0.75rem; color: #6b7280; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pwa-prompt-actions { display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }
        .pwa-prompt-install { background-color: #16a34a; color: white; font-size: 0.75rem; font-weight: 700; padding: 0.5rem 0.75rem; border-radius: 0.75rem; border: none; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); white-space: nowrap; }
        .pwa-prompt-install:hover { background-color: #15803d; }
        .pwa-prompt-close { width: 1.75rem; height: 1.75rem; display: flex; align-items: center; justify-content: center; border-radius: 9999px; background-color: #f9fafb; color: #9ca3af; border: none; cursor: pointer; transition: all 0.2s; }
        .pwa-prompt-close:hover { background-color: #e5e7eb; color: #374151; }
    </style>
    <div id="installBtn" class="pwa-prompt-container">
        <div class="pwa-prompt-inner">
            <div style="flex-shrink: 0;">
                <img src="{{ helper::image_path(helper::appdata('')->app_logo) }}" class="pwa-prompt-img" alt="App Icon">
            </div>
            <div class="pwa-prompt-text">
                <h4 class="pwa-prompt-title">{{ helper::appdata('')->app_name }}</h4>
                <p class="pwa-prompt-desc">تثبيت التطبيق على جهازك</p>
            </div>
        </div>
        <div class="pwa-prompt-actions">
            <button onclick="installApp()" class="pwa-prompt-install">
                تثبيت
            </button>
            <button onclick="hideInstallBtn()" class="pwa-prompt-close">
                <i class="fas fa-times" style="font-size: 0.75rem;"></i>
            </button>
        </div>
    </div>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("{{ url('storage/app/public/sw.js') }}").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            }).catch(function(err) {
                console.log("Service worker registration failed: ", err);
            });
        }
        
        let deferredPrompt;
        const isIos = () => {
            const userAgent = window.navigator.userAgent.toLowerCase();
            return /iphone|ipad|ipod/.test(userAgent);
        };
        const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

        if (isIos() && !isInStandaloneMode()) {
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.display = 'flex';
                setTimeout(() => {
                    installBtn.style.transform = 'translateY(0)';
                    installBtn.style.opacity = '1';
                }, 50);
                setTimeout(() => {
                    hideInstallBtn();
                }, 10000);
            }
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.display = 'flex';
                setTimeout(() => {
                    installBtn.style.transform = 'translateY(0)';
                    installBtn.style.opacity = '1';
                }, 50);
                setTimeout(() => {
                    hideInstallBtn();
                }, 10000);
            }
        });
        async function installApp() {
            if (isIos()) {
                alert("لتثبيت التطبيق على جهاز iOS، اضغط على زر المشاركة (Share) في المتصفح ثم اختر 'إضافة إلى الشاشة الرئيسية' (Add to Home Screen).");
                hideInstallBtn();
                return;
            }
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            deferredPrompt = null;
            hideInstallBtn();
        }
        function hideInstallBtn() {
            const installBtn = document.getElementById('installBtn');
            if (installBtn) {
                installBtn.style.transform = 'translateY(-150%)';
                installBtn.style.opacity = '0';
                setTimeout(() => {
                    installBtn.style.display = 'none';
                }, 600);
            }
        }
    </script>
    @endif
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp
    <main>
        <div class="wrapper">
            @include('admin.layout.header')
            <div class="content-wrapper">
                @include('admin.layout.sidebar')
                <div class="{{ session()->get('direction') == 2 ? 'main-content-rtl' : 'main-content' }}">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="row">
                                @if (env('Environment') == 'sendbox')
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <p>According to Envato's license policy, an extended license is required for
                                            SaaS usage. <a class="btn btn-primary px-sm-4 btn-sm ms-2 active"
                                                href="https://1.envato.market/Yg7YmB" target="_blank">Buy Now
                                            </a></p>
                                    </div>
                                @endif
                                <div class="col-12 ml-sm-auto">
                                    @if (env('Environment') == 'live')
                                        @if (request()->is('admin/custom_domain'))
                                            <div class="alert alert-warning" role="alert">
                                                {{ trans('messages.custom_domain_message') }}
                                            </div>
                                        @endif
                                        @if (request()->is('admin/apps'))
                                            <div class="alert alert-warning" role="alert">
                                                {{ trans('messages.addon_message') }}
                                            </div>
                                        @endif
                                    @endif
                                    @if (Auth::user()->type == 2)
                                        <?php
                                        $checkplan = helper::checkplan(Auth::user()->id, '');
                                        $plan = json_decode(json_encode($checkplan));
                                        ?>
                                        @if (@$plan->original->status == '2' && @$plan->original->showclick != 2)
                                            <div class="alert alert-warning" role="alert">
                                                {{ @$plan->original->message }}{{ empty($plan->original->expdate) ? '' : ':' . $plan->original->expdate }}
                                                @if (@$plan->original->showclick == 1)
                                                    <u><a
                                                            href="{{ URL::to('/admin/plan') }}">{{ trans('labels.click_here') }}</a></u>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!--Modal: order-modal-->
                            <div class="modal fade" id="order-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-notify modal-info" role="document">
                                    <div class="modal-content text-center">
                                        <div class="modal-header d-flex justify-content-center">
                                            <p class="heading color-changer">{{ trans('messages.be_up_to_date') }}</p>
                                        </div>
                                        <div class="modal-body color-changer"><i
                                                class="fa fa-bell fa-4x animated rotateIn mb-4"></i>
                                            <p>{{ trans('messages.new_order_arrive') }}</p>
                                        </div>
                                        <div class="modal-footer flex-center">
                                            <a role="button" class="btn btn-secondary waves-effect"
                                                onClick="window.location.reload();"
                                                data-bs-dismiss="modal">{{ trans('labels.okay') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

            <!----- theme sidebar ----->
            <div class="offcanvas {{ session()->get('direction') == 2 ? 'offcanvas-start' : 'offcanvas-end ' }}"
                data-bs-scroll="true" tabindex="-1" id="themelabel" aria-labelledby="offcanvasWithBothOptionsLabel">

                <div class="offcanvas-header justify-content-between">
                    <h5 class="offcanvas-title color-changer" id="offcanvasWithBothOptionsLabel">All theme</h5>
                    <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="offcanvas"
                        aria-label="Close">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>

                <div class="offcanvas-body">
                    <p class="color-changer">Try scrolling the rest of the page to see this option in action.</p>
                </div>

            </div>

            <footer class="py-3 text-center bg-white fixed-bottom border-top">
                <span>{{ helper::appdata('')->copyright }}</span>
            </footer>
        </div>

        <!--theme image Modal -->
        <div class="modal fade" id="themeinfo" tabindex="-1" aria-labelledby="themeinfoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title text-dark color-changer" id="themeinfoLabel"></h5>
                        <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                            <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="theme_modalbody">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap-select.min.js') }}"></script><!-- Bootstrap multi-select JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/sweetalert/sweetalert2.min.js') }}"></script><!-- Sweetalert JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/chartjs/chart_3.9.1.min.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jquery.dataTables.min.js') }}"></script><!-- Datatables JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.bootstrap5.min.js') }}"></script><!-- Datatables Bootstrap5 JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.buttons.min.js') }}"></script><!-- Datatables Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jszip.min.js') }}"></script><!-- Datatables Excel Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/pdfmake.min.js') }}"></script><!-- Datatables Make PDF Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/vfs_fonts.js') }}"></script><!-- Datatables Export PDF Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/buttons.html5.min.js') }}"></script><!-- Datatables Buttons HTML5 JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/magnific/magnific-popup.min.js') }}"></script><!-- magnific-popup js -->

    <script>
        var are_you_sure = "{{ trans('messages.are_you_sure') }}";
        var yes = "{{ trans('messages.yes') }}";
        var no = "{{ trans('messages.no') }}";
        var cancel = "{{ trans('labels.cancel') }}";
        let wrong = "{{ trans('messages.wrong') }}";
        let env = "{{ env('Environment') }}";
        var time_format = "{{ helper::appdata($vendor_id)->time_format }}";
        // pdf and excel file name table wise
        var filename = "";
        var title = "";
        if ("{{ Auth::user()->type == 2 }}" && "{{ request()->is('admin/dashboard') }}") {
            filename = "trans('labels.processing_orders')";
            title = "trans('labels.processing_orders')";
        }
        if ("{{ Auth::user()->type == 1 }}" && "{{ request()->is('admin/dashboard') }}") {
            filename = "trans('labels.today_transaction')";
            title = "trans('labels.today_transaction')";
        }
        if ("{{ request()->is('admin/orders*') }}" || "{{ request()->is('admin/report') }}") {
            filename = "{{ trans('labels.orders') }}";
            title = "{{ trans('labels.orders') }}";
        }
        if ("{{ request()->is('admin/customers*') }}") {
            filename = "{{ trans('labels.customers') }}";
            title = "{{ trans('labels.customers') }}";
        }
        if ("{{ request()->is('admin/users*') }}") {
            filename = "{{ trans('labels.users') }}";
            title = "{{ trans('labels.users') }}";
        }
        if ("{{ request()->is('admin/countries*') }}") {
            filename = "{{ trans('labels.cities') }}";
            title = "{{ trans('labels.cities') }}";
        }
        if ("{{ request()->is('admin/cities*') }}") {
            filename = "{{ trans('labels.areas') }}";
            title = "{{ trans('labels.areas') }}";
        }
        if ("{{ request()->is('admin/how_it_works*') }}") {
            filename = "{{ trans('labels.how_it_works') }}";
            title = "{{ trans('labels.how_it_works') }}";
        }
        if ("{{ request()->is('admin/themes*') }}") {
            filename = "{{ trans('labels.theme_images') }}";
            title = "{{ trans('labels.theme_images') }}";
        }
        if ("{{ request()->is('admin/features*') }}") {
            filename = "{{ trans('labels.features') }}";
            title = "{{ trans('labels.features') }}";
        }
        if ("{{ request()->is('admin/promotionalbanners*') }}") {
            filename = "{{ trans('labels.promotional_banners') }}";
            title = "{{ trans('labels.promotional_banners') }}";
        }
        if ("{{ request()->is('admin/transaction') }}") {
            filename = "{{ trans('labels.transactions') }}";
            title = "{{ trans('labels.transactions') }}";
        }
        if ("{{ request()->is('admin/shipping-area') }}") {
            filename = "{{ trans('labels.shipping_area') }}";
            title = "{{ trans('labels.shipping_area') }}";
        }
        if ("{{ request()->is('admin/blogs') }}") {
            filename = "{{ trans('labels.blogs') }}";
            title = "{{ trans('labels.blogs') }}";
        }
        if ("{{ request()->is('admin/testimonials') }}") {
            filename = "{{ trans('labels.testimonials') }}";
            title = "{{ trans('labels.testimonials') }}";
        }
        if ("{{ request()->is('admin/faqs') }}") {
            filename = "{{ trans('labels.faqs') }}";
            title = "{{ trans('labels.faqs') }}";
        }
        if ("{{ request()->is('admin/categories') }}") {
            filename = "{{ trans('labels.categories') }}";
            title = "{{ trans('labels.categories') }}";
        }
        if ("{{ request()->is('admin/products') }}") {
            filename = "{{ trans('labels.products') }}";
            title = "{{ trans('labels.products') }}";
        }
        if ("{{ request()->is('admin/sliders') }}") {
            filename = "{{ trans('labels.sliders') }}";
            title = "{{ trans('labels.sliders') }}";
        }
        if ("{{ request()->is('admin/banner') }}") {
            filename = "{{ trans('labels.banners') }}";
            title = "{{ trans('labels.banners') }}";
        }
        if ("{{ request()->is('admin/coupons') }}") {
            filename = "{{ trans('labels.coupons') }}";
            title = "{{ trans('labels.coupons') }}";
        }
        if ("{{ request()->is('admin/roles') }}") {
            filename = "{{ trans('labels.roles') }}";
            title = "{{ trans('labels.roles') }}";
        }
        if ("{{ request()->is('admin/employees') }}") {
            filename = "{{ trans('labels.employees') }}";
            title = "{{ trans('labels.employees') }}";
        }
        if ("{{ request()->is('admin/subscribers') }}") {
            filename = "{{ trans('labels.subscribers') }}";
            title = "{{ trans('labels.subscribers') }}";
        }
        if ("{{ request()->is('admin/inquiries') }}") {
            filename = "{{ trans('labels.inquiries') }}";
            title = "{{ trans('labels.inquiries') }}";
        }
        if ("{{ request()->is('admin/language-settings') }}") {
            filename = "{{ trans('labels.language-settings') }}";
            title = "{{ trans('labels.language-settings') }}";
        }
        if ("{{ request()->is('admin/store_categories') }}") {
            filename = "{{ trans('labels.store_categories') }}";
            title = "{{ trans('labels.store_categories') }}";
        }

        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif

        @if (Auth::user()->type == 2)
            // New Notification
            var noticount = 0;
            var notificationurl = "{{ URL::to('/admin/getorder') }}";
            var vendoraudio =
                "{{ url(env('ASSETPATHURL') . 'admin-assets/notification/' . helper::appdata(Auth::user()->id)->notification_sound) }}";
        @endif
    </script>
    @if (@helper::checkaddons('notification'))
        @if (Auth::user()->type == 2)
            <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/sound.js') }}"></script>
        @endif
    @endif
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/common.js') }}"></script><!-- Common JS -->
    @yield('scripts')
</body>

</html>
