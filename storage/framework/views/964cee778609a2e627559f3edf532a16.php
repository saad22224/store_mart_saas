<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $user = App\Models\User::where('id', $vendor_id)->first();
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/roles')); ?>"
                        class="color-changer"><?php echo e(trans('labels.roles')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <?php $modules = explode('|',$data->module); ?>
                    <form action="<?php echo e(URL::to('admin/roles/update-' . $data->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for=""><?php echo e(trans('labels.role')); ?> <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="<?php echo e(trans('labels.role')); ?>" value="<?php echo e($data->role); ?>">
                                </div>
                            </div>
                            <h5 class="mb-3 fw-bold color-changer" for=""><?php echo e(trans('labels.system_modules')); ?> <span
                                    class="text-danger">*</span> </h5>
                            <div class="row bg-light rolmangement_dark py-3">
                                <div class="col-sm-4 col-6 cursor-pointer d-block">
                                    <input class="form-check-input" type="checkbox" value="" name="checkall"
                                        id="checkall">
                                    <label
                                        class="form-check-label text-dark fw-600 <?php echo e(session()->get('direction') == 2 ? 'ms-5' : 'me-5'); ?>"
                                        for="checkall">
                                        <?php echo e(trans('labels.modules')); ?>

                                    </label>

                                </div>
                                <div class="col-sm-8 col-6 d-block">
                                    <label
                                        class="form-check-label text-dark fw-600 <?php echo e(session()->get('direction') == 2 ? 'ms-5' : 'me-5'); ?>">
                                        <?php echo e(trans('labels.permissions')); ?>

                                    </label>

                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-4" id="checkboxes">
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="dashboard"
                                            id="role_dashboard">
                                        <label class="cursor-pointer form-label fs-13" for="role_dashboard">
                                            <?php echo e(trans('labels.dashboard')); ?>

                                        </label>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="addons_manager" id="role_addons_manager">
                                            <label class="cursor-pointer form-label fs-13" for="role_addons_manager">
                                                <?php echo e(trans('labels.addons_manager')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value="" name="vendors"
                                                id="role_vendors">
                                            <label class="cursor-pointer form-label fs-13" for="role_vendors">
                                                <?php echo e(trans('labels.users')); ?>

                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('pos')): ?>
                                                <?php
                                                    if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                                        $checkplan = App\Models\Transaction::where(
                                                            'vendor_id',
                                                            $vendor_id,
                                                        )
                                                            ->orderByDesc('id')
                                                            ->first();
                                                    }
                                                    if ($user->allow_without_subscription == 1) {
                                                        $pos = 1;
                                                    } else {
                                                        $pos = @$checkplan->pos;
                                                    }
                                                ?>
                                                <?php if($pos == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="POS (Point Of Sale)" id="role_pos">
                                                        <label class="cursor-pointer form-label fs-13" for="role_pos">
                                                            <?php echo e(trans('labels.pos')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('pos')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="POS (Point Of Sale)" id="role_pos">
                                                    <label class="cursor-pointer form-label fs-13" for="role_pos">
                                                        <?php echo e(trans('labels.pos')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value="" name="orders"
                                                id="role_orders">
                                            <label class="cursor-pointer form-label fs-13" for="role_orders">
                                                <?php echo e(trans('labels.orders')); ?>

                                            </label>
                                        </div>

                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value="" name="report"
                                                id="role_report">
                                            <label class="cursor-pointer form-label fs-13" for="role_report">
                                                <?php echo e(trans('labels.report')); ?>

                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Customers" id="role_customers">
                                            <label class="cursor-pointer form-label fs-13" for="role_customers">
                                                <?php echo e(trans('labels.customers')); ?>

                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Categories" id="role_categories">
                                            <label class="cursor-pointer form-label fs-13" for="role_categories">
                                                <?php echo e(trans('labels.categories')); ?>

                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Tax"
                                            id="role_tax">
                                        <label class="cursor-pointer form-label fs-13" for="role_tax">
                                            <?php echo e(trans('labels.tax')); ?>

                                        </label>
                                    </div>

                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Global Extras" id="role_global_extras">
                                            <label class="cursor-pointer form-label fs-13" for="role_global_extras">
                                                <?php echo e(trans('labels.global_extras')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Products" id="role_products">
                                            <label class="cursor-pointer form-label fs-13" for="role_products">
                                                <?php echo e(trans('labels.products')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('product_import')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="import_product" id="role_import_product">
                                                <label class="cursor-pointer form-label fs-13" for="role_import_product">
                                                    <?php echo e(trans('labels.product_upload')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="shipping_management" id="role_shipping_management">
                                            <label class="cursor-pointer form-label fs-13" for="role_shipping_management">
                                                <?php echo e(trans('labels.shipping_management')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('question_answer')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="product_question_answer" id="role_product_question_answer">
                                                <label class="cursor-pointer form-label fs-13"
                                                    for="role_product_question_answer">
                                                    <?php echo e(trans('labels.product_question_answer')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('shopify')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Shopify" id="role_shopify">
                                                <label class="cursor-pointer form-label fs-13" for="role_shopify">
                                                    <?php echo e(trans('labels.shopify')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Sliders" id="role_sliders">
                                            <label class="cursor-pointer form-label fs-13" for="role_sliders">
                                                <?php echo e(trans('labels.sliders')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Banner" id="role_banner">
                                            <label class="cursor-pointer form-label fs-13" for="role_banner">
                                                <?php echo e(trans('labels.banner')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('coupon')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $coupons = 1;
                                                    } else {
                                                        $coupons = @$checkplan->coupons;
                                                    }
                                                ?>
                                                <?php if($coupons == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="Coupons" id="role_coupons">
                                                        <label class="cursor-pointer form-label fs-13" for="role_coupons">
                                                            <?php echo e(trans('labels.coupons')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('coupon')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Coupons" id="role_coupons">
                                                    <label class="cursor-pointer form-label fs-13" for="role_coupons">
                                                        <?php echo e(trans('labels.coupons')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('top_deals')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="top_deals" id="role_top_deals">
                                                <label class="cursor-pointer form-label fs-13" for="role_top_deals">
                                                    <?php echo e(trans('labels.top_deals')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('firebase_notification')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="firebase_notification" id="role_firebase_notification">
                                                <label class="cursor-pointer form-label fs-13"
                                                    for="role_firebase_notification">
                                                    <?php echo e(trans('labels.firebase_notification')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('subscription')): ?>
                                        <?php if($user->allow_without_subscription != 1): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Subscription Plans" id="role_pricing_plans">
                                                <label class="cursor-pointer form-label fs-13" for="role_pricing_plans">
                                                    <?php echo e(trans('labels.pricing_plans')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Transactions" id="role_transaction">
                                            <label class="cursor-pointer form-label fs-13" for="role_transaction">
                                                <?php echo e(trans('labels.transaction')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Payment Methods" id="role_payment_methods">
                                            <label class="cursor-pointer form-label fs-13" for="role_payment_methods">
                                                <?php echo e(trans('labels.payment_methods')); ?>

                                            </label>
                                        </div>
                                    <?php else: ?>
                                        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Payment Methods" id="role_payment_methods">
                                                <label class="cursor-pointer form-label fs-13" for="role_payment_methods">
                                                    <?php echo e(trans('labels.payment_methods')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="cities" id="role_cities">
                                            <label class="cursor-pointer form-label fs-13" for="role_cities">
                                                <?php echo e(trans('labels.cities')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="areas" id="role_areas">
                                            <label class="cursor-pointer form-label fs-13" for="role_areas">
                                                <?php echo e(trans('labels.areas')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="store_categories" id="role_store_categories">
                                            <label class="cursor-pointer form-label fs-13" for="role_store_categories">
                                                <?php echo e(trans('labels.store_categories')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('custom_domain')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Custom Domains" id="role_custom_domains">
                                                <label class="cursor-pointer form-label fs-13" for="role_custom_domains">
                                                    <?php echo e(trans('labels.custom_domains')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Working Hours" id="role_working_hours">
                                            <label class="cursor-pointer form-label fs-13" for="role_working_hours">
                                                <?php echo e(trans('labels.working_hours')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Table" id="role_table">
                                            <label class="cursor-pointer form-label fs-13" for="role_table">
                                                <?php echo e(trans('labels.table')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('custom_status')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Custom Status" id="role_custom_status">
                                                <label class="cursor-pointer form-label fs-13" for="role_custom_status">
                                                    <?php echo e(trans('labels.custom_status')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('custom_domain')): ?>
                                                <?php
                                                    if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                                        $checkplan = App\Models\Transaction::where(
                                                            'vendor_id',
                                                            $vendor_id,
                                                        )
                                                            ->orderByDesc('id')
                                                            ->first();
                                                    }
                                                    if ($user->allow_without_subscription == 1) {
                                                        $custom_domain = 1;
                                                    } else {
                                                        $custom_domain = @$checkplan->custom_domain;
                                                    }
                                                ?>
                                                <?php if(@$custom_domain == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="Custom Domains" id="role_custom_domains">
                                                        <label class="cursor-pointer form-label fs-13"
                                                            for="role_custom_domains">
                                                            <?php echo e(trans('labels.custom_domains')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('custom_domain')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Custom Domains" id="role_custom_domains">
                                                    <label class="cursor-pointer form-label fs-13"
                                                        for="role_custom_domains">
                                                        <?php echo e(trans('labels.custom_domains')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Basic Settings" id="role_basic_settings">
                                        <label class="cursor-pointer form-label fs-13" for="role_basic_settings">
                                            <?php echo e(trans('labels.basic_settings')); ?>

                                        </label>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="how_it_works" id="role_how_it_works">
                                            <label class="cursor-pointer form-label fs-13" for="role_how_it_works">
                                                <?php echo e(trans('labels.how_it_works')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="theme_images" id="role_theme_images">
                                            <label class="cursor-pointer form-label fs-13" for="role_theme_images">
                                                <?php echo e(trans('labels.theme_images')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="features" id="role_features">
                                            <label class="cursor-pointer form-label fs-13" for="role_features">
                                                <?php echo e(trans('labels.features')); ?>

                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="promotional_banners" id="role_promotional_banners">
                                            <label class="cursor-pointer form-label fs-13" for="role_promotional_banners">
                                                <?php echo e(trans('labels.promotional_banners')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('blog')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Blogs" id="role_blogs">
                                                <label class="cursor-pointer form-label fs-13" for="role_blogs">
                                                    <?php echo e(trans('labels.blogs')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Basic Settings" id="role_who_we_are">
                                            <label class="cursor-pointer form-label fs-13" for="role_who_we_are">
                                                <?php echo e(trans('labels.who_we_are')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('blog')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $blogs = 1;
                                                    } else {
                                                        $blogs = @$checkplan->blogs;
                                                    }
                                                ?>
                                                <?php if($blogs == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="Blogs" id="role_blogs">
                                                        <label class="cursor-pointer form-label fs-13" for="role_blogs">
                                                            <?php echo e(trans('labels.blogs')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('blog')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Blogs" id="role_blogs">
                                                    <label class="cursor-pointer form-label fs-13" for="role_blogs">
                                                        <?php echo e(trans('labels.blogs')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Testimonials" id="role_testimonials">
                                        <label class="cursor-pointer form-label fs-13" for="role_testimonials">
                                            <?php echo e(trans('labels.testimonials')); ?>

                                        </label>
                                    </div>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Faqs"
                                            id="role_faqs">
                                        <label class="cursor-pointer form-label fs-13" for="role_faqs">
                                            <?php echo e(trans('labels.faqs')); ?>

                                        </label>
                                    </div>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Cms Pages"
                                            id="role_cms_pages">
                                        <label class="cursor-pointer form-label fs-13" for="role_cms_pages">
                                            <?php echo e(trans('labels.cms_pages')); ?>

                                        </label>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <?php if(@helper::checkaddons('coupon')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Coupons" id="role_coupons">
                                                <label class="cursor-pointer form-label fs-13" for="role_coupons">
                                                    <?php echo e(trans('labels.coupons')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('employee')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Roles" id="role_roles">
                                                <label class="cursor-pointer form-label fs-13" for="role_roles">
                                                    <?php echo e(trans('labels.roles')); ?>

                                                </label>
                                            </div>

                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Employees" id="role_employees">
                                                <label class="cursor-pointer form-label fs-13" for="role_employees">
                                                    <?php echo e(trans('labels.employees')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('employee')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $role_management = 1;
                                                    } else {
                                                        $role_management = @$checkplan->role_management;
                                                    }
                                                ?>
                                                <?php if($role_management == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="Roles" id="role_roles">
                                                        <label class="cursor-pointer form-label fs-13" for="role_roles">
                                                            <?php echo e(trans('labels.roles')); ?>

                                                        </label>
                                                    </div>

                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="Employees" id="role_employees">
                                                        <label class="cursor-pointer form-label fs-13"
                                                            for="role_employees">
                                                            <?php echo e(trans('labels.employees')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('employee')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Roles" id="role_roles">
                                                    <label class="cursor-pointer form-label fs-13" for="role_roles">
                                                        <?php echo e(trans('labels.roles')); ?>

                                                    </label>
                                                </div>

                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Employees" id="role_employees">
                                                    <label class="cursor-pointer form-label fs-13" for="role_employees">
                                                        <?php echo e(trans('labels.employees')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Subscribers" id="role_subscribers">
                                        <label class="cursor-pointer form-label fs-13" for="role_subscribers">
                                            <?php echo e(trans('labels.subscribers')); ?>

                                        </label>
                                    </div>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Inquiries"
                                            id="role_inquiries">
                                        <label class="cursor-pointer form-label fs-13" for="role_inquiries">
                                            <?php echo e(trans('labels.inquiries')); ?>

                                        </label>
                                    </div>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('product_inquiry')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="product_inquiry" id="role_product_inquiry">
                                                <label class="cursor-pointer form-label fs-13" for="role_product_inquiry">
                                                    <?php echo e(trans('labels.product_inquiry')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>

                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Share" id="role_share">
                                            <label class="cursor-pointer form-label fs-13" for="role_share">
                                                <?php echo e(trans('labels.share')); ?>

                                            </label>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $whatsapp_message = 1;
                                                    } else {
                                                        $whatsapp_message = @$checkplan->whatsapp_message;
                                                    }
                                                ?>
                                                <?php if($whatsapp_message == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="whatsapp_settings" id="role_whatsapp_settings">
                                                        <label class="cursor-pointer form-label fs-13"
                                                            for="role_whatsapp_settings">
                                                            <?php echo e(trans('labels.whatsapp_settings')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="whatsapp_settings" id="role_whatsapp_settings">
                                                    <label class="cursor-pointer form-label fs-13"
                                                        for="role_whatsapp_settings">
                                                        <?php echo e(trans('labels.whatsapp_settings')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('telegram_message')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $telegram_message = 1;
                                                    } else {
                                                        $telegram_message = @$checkplan->telegram_message;
                                                    }
                                                ?>
                                                <?php if($telegram_message == 1): ?>
                                                    <div class="cursor-pointer d-block mb-3">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="telegram_settings" id="role_telegram_settings">
                                                        <label class="cursor-pointer form-label fs-13"
                                                            for="role_telegram_settings">
                                                            <?php echo e(trans('labels.telegram_settings')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('telegram_message')): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="telegram_settings" id="role_telegram_settings">
                                                    <label class="cursor-pointer form-label fs-13"
                                                        for="role_telegram_settings">
                                                        <?php echo e(trans('labels.telegram_settings')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('language')): ?>
                                            <?php if(helper::listoflanguage()->count() > 1): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Language Settings" id="role_language_settings">
                                                    <label class="cursor-pointer form-label fs-13"
                                                        for="role_language_settings">
                                                        <?php echo e(trans('labels.language-settings')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('currency_settigns')): ?>
                                            <?php if(helper::available_currency()->count() > 1): ?>
                                                <div class="cursor-pointer d-block mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="Currency Settings" id="role_currency_settings">
                                                    <label class="cursor-pointer form-label fs-13"
                                                        for="role_currency_settings">
                                                        <?php echo e(trans('labels.currency-settings')); ?>

                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <?php if(@helper::checkaddons('language')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Language Settings" id="role_language_settings">
                                                <label class="cursor-pointer form-label fs-13"
                                                    for="role_language_settings">
                                                    <?php echo e(trans('labels.language-settings')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('currency_settigns')): ?>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Currency Settings" id="role_currency_settings">
                                                <label class="cursor-pointer form-label fs-13"
                                                    for="role_currency_settings">
                                                    <?php echo e(trans('labels.currency-settings')); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Settings"
                                            id="role_settings">
                                        <label class="cursor-pointer form-label fs-13" for="role_settings">
                                            <?php echo e(trans('labels.settings')); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-8" id="permissioncheckbox">
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_dashboard"
                                                    name="modules[role_dashboard]"
                                                    <?php echo e(helper::check_access('role_dashboard', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_dashboard]">
                                                <label class="form-label fs-13" for="manage[role_dashboard]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_addons_manager" name="modules[role_addons_manager]"
                                                        <?php echo e(helper::check_access('role_addons_manager', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_addons_manager]">
                                                    <label class="form-label fs-13" for="manage[role_addons_manager]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_vendors"
                                                        name="modules[role_vendors]"
                                                        <?php echo e(helper::check_access('role_vendors', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_vendors]">
                                                    <label class="form-label fs-13" for="manage[role_vendors]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_vendors"
                                                        name="add[role_vendors]"
                                                        <?php echo e(helper::check_access('role_vendors', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_vendors]">
                                                    <label class="form-label fs-13" for="add[role_vendors]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_vendors"
                                                        name="edit[role_vendors]"
                                                        <?php echo e(helper::check_access('role_vendors', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_vendors]">
                                                    <label class="form-label fs-13" for="edit[role_vendors]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_vendors"
                                                        name="delete[role_vendors]"
                                                        <?php echo e(helper::check_access('role_vendors', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_vendors]">
                                                    <label class="form-label fs-13" for="delete[role_vendors]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('pos')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $pos = 1;
                                                    } else {
                                                        $pos = @$checkplan->pos;
                                                    }
                                                ?>
                                                <?php if($pos == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_pos" name="modules[role_pos]"
                                                                    <?php echo e(helper::check_access('role_pos', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_pos]">
                                                                <label class="form-label fs-13" for="manage[role_pos]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_pos" name="add[role_pos]"
                                                                    <?php echo e(helper::check_access('role_pos', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_pos]">
                                                                <label class="form-label fs-13" for="add[role_pos]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('pos')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_pos" name="modules[role_pos]"
                                                                <?php echo e(helper::check_access('role_pos', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_pos]">
                                                            <label class="form-label fs-13" for="manage[role_pos]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_pos" name="add[role_pos]"
                                                                <?php echo e(helper::check_access('role_pos', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_pos]">
                                                            <label class="form-label fs-13" for="add[role_pos]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_orders"
                                                        name="modules[role_orders]"
                                                        <?php echo e(helper::check_access('role_orders', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_orders]">
                                                    <label class="form-label fs-13" for="manage[role_orders]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_report"
                                                        name="modules[role_report]"
                                                        <?php echo e(helper::check_access('role_report', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_report]">
                                                    <label class="form-label fs-13" for="manage[role_report]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_customers" name="modules[role_customers]"
                                                        <?php echo e(helper::check_access('role_customers', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_customers]">
                                                    <label class="form-label fs-13" for="manage[role_customers]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_customers" name="add[role_customers]"
                                                            <?php echo e(helper::check_access('role_customers', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_customers]">
                                                        <label class="form-label fs-13" for="add[role_customers]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_customers" name="edit[role_customers]"
                                                            <?php echo e(helper::check_access('role_customers', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_customers]">
                                                        <label class="form-label fs-13" for="edit[role_customers]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_customers" name="delete[role_customers]"
                                                            <?php echo e(helper::check_access('role_customers', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_customers]">
                                                        <label class="form-label fs-13" for="delete[role_customers]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_categories" name="modules[role_categories]"
                                                        <?php echo e(helper::check_access('role_categories', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_categories]">
                                                    <label class="form-label fs-13" for="manage[role_categories]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_categories" name="add[role_categories]"
                                                        <?php echo e(helper::check_access('role_categories', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_categories]">
                                                    <label class="form-label fs-13" for="add[role_categories]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_categories" name="edit[role_categories]"
                                                        <?php echo e(helper::check_access('role_categories', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_categories]">
                                                    <label class="form-label fs-13" for="edit[role_categories]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_categories" name="delete[role_categories]"
                                                        <?php echo e(helper::check_access('role_categories', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_categories]">
                                                    <label class="form-label fs-13" for="delete[role_categories]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_tax"
                                                    name="modules[role_tax]"
                                                    <?php echo e(helper::check_access('role_tax', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_tax]">
                                                <label class="form-label fs-13" for="manage[role_tax]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_tax"
                                                    name="add[role_tax]"
                                                    <?php echo e(helper::check_access('role_tax', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                    id="add[role_tax]">
                                                <label class="form-label fs-13" for="add[role_tax]">
                                                    <?php echo e(trans('labels.add')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_tax"
                                                    name="edit[role_tax]"
                                                    <?php echo e(helper::check_access('role_tax', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_tax]">
                                                <label class="form-label fs-13" for="edit[role_tax]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_tax"
                                                    name="delete[role_tax]"
                                                    <?php echo e(helper::check_access('role_tax', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                    id="delete[role_tax]">
                                                <label class="form-label fs-13" for="delete[role_tax]">
                                                    <?php echo e(trans('labels.delete')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_global_extras" name="modules[role_global_extras]"
                                                        <?php echo e(helper::check_access('role_global_extras', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_global_extras]">
                                                    <label class="form-label fs-13" for="manage[role_global_extras]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_global_extras" name="add[role_global_extras]"
                                                        <?php echo e(helper::check_access('role_global_extras', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_global_extras]">
                                                    <label class="form-label fs-13" for="add[role_global_extras]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_global_extras" name="edit[role_global_extras]"
                                                        <?php echo e(helper::check_access('role_global_extras', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_global_extras]">
                                                    <label class="form-label fs-13" for="edit[role_global_extras]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_global_extras" name="delete[role_global_extras]"
                                                        <?php echo e(helper::check_access('role_global_extras', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_global_extras]">
                                                    <label class="form-label fs-13" for="delete[role_global_extras]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_products"
                                                        name="modules[role_products]"
                                                        <?php echo e(helper::check_access('role_products', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_products]">
                                                    <label class="form-label fs-13" for="manage[role_products]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_products"
                                                        name="add[role_products]"
                                                        <?php echo e(helper::check_access('role_products', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_products]">
                                                    <label class="form-label fs-13" for="add[role_products]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_products"
                                                        name="edit[role_products]"
                                                        <?php echo e(helper::check_access('role_products', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_products]">
                                                    <label class="form-label fs-13" for="edit[role_products]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_products"
                                                        name="delete[role_products]"
                                                        <?php echo e(helper::check_access('role_products', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_products]">
                                                    <label class="form-label fs-13" for="delete[role_products]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('product_import')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_import_product"
                                                            name="modules[role_import_product]"
                                                            <?php echo e(helper::check_access('role_import_product', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_import_product]">
                                                        <label class="form-label fs-13" for="manage[role_import_product]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_import_product" name="add[role_import_product]"
                                                            <?php echo e(helper::check_access('role_import_product', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_import_product]">
                                                        <label class="form-label fs-13" for="add[role_import_product]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_shipping_management"
                                                        name="modules[role_shipping_management]"
                                                        <?php echo e(helper::check_access('role_shipping_management', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_shipping_management]">
                                                    <label class="form-label fs-13"
                                                        for="manage[role_shipping_management]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <?php if(@helper::checkaddons('shipping_area')): ?>
                                                    <?php if(helper::appdata($vendor_id)->shipping_area == 1): ?>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_shipping_management"
                                                                name="add[role_shipping_management]"
                                                                <?php echo e(helper::check_access('role_shipping_management', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_shipping_management]">
                                                            <label class="form-label fs-13"
                                                                for="add[role_shipping_management]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_shipping_management"
                                                        name="edit[role_shipping_management]"
                                                        <?php echo e(helper::check_access('role_shipping_management', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_shipping_management]">
                                                    <label class="form-label fs-13" for="edit[role_shipping_management]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <?php if(@helper::checkaddons('shipping_area')): ?>
                                                    <?php if(helper::appdata($vendor_id)->shipping_area == 1): ?>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_shipping_management"
                                                                name="delete[role_shipping_management]"
                                                                <?php echo e(helper::check_access('role_shipping_management', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_shipping_management]">
                                                            <label class="form-label fs-13"
                                                                for="delete[role_shipping_management]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_product_question_answer"
                                                        name="modules[role_product_question_answer]"
                                                        <?php echo e(helper::check_access('role_product_question_answer', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_product_question_answer]">
                                                    <label class="form-label fs-13"
                                                        for="manage[role_product_question_answer]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>

                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_product_question_answer"
                                                        name="edit[role_product_question_answer]"
                                                        <?php echo e(helper::check_access('role_product_question_answer', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_product_question_answer]">
                                                    <label class="form-label fs-13"
                                                        for="edit[role_product_question_answer]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <?php if(@helper::checkaddons('shipping_area')): ?>
                                                    <?php if(helper::appdata($vendor_id)->shipping_area == 1): ?>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_product_question_answer"
                                                                name="delete[role_product_question_answer]"
                                                                <?php echo e(helper::check_access('role_product_question_answer', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_product_question_answer]">
                                                            <label class="form-label fs-13"
                                                                for="delete[role_product_question_answer]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('shopify')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_shopify" name="modules[role_shopify]"
                                                            <?php echo e(helper::check_access('role_shopify', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_shopify]">
                                                        <label class="form-label fs-13" for="manage[role_shopify]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_shopify" name="add[role_shopify]"
                                                            <?php echo e(helper::check_access('role_shopify', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_shopify]">
                                                        <label class="form-label fs-13" for="add[role_shopify]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_sliders"
                                                        name="modules[role_sliders]"
                                                        <?php echo e(helper::check_access('role_sliders', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_sliders]">
                                                    <label class="form-label fs-13" for="manage[role_sliders]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_sliders"
                                                        name="add[role_sliders]"
                                                        <?php echo e(helper::check_access('role_sliders', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_sliders]">
                                                    <label class="form-label fs-13" for="add[role_sliders]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_sliders"
                                                        name="edit[role_sliders]"
                                                        <?php echo e(helper::check_access('role_sliders', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_sliders]">
                                                    <label class="form-label fs-13" for="edit[role_sliders]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_sliders"
                                                        name="delete[role_sliders]"
                                                        <?php echo e(helper::check_access('role_sliders', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_sliders]">
                                                    <label class="form-label fs-13" for="delete[role_sliders]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_banner"
                                                        name="modules[role_banner]"
                                                        <?php echo e(helper::check_access('role_banner', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_banner]">
                                                    <label class="form-label fs-13" for="manage[role_banner]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_banner" name="add[role_banner]"
                                                        <?php echo e(helper::check_access('role_banner', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_banner]">
                                                    <label class="form-label fs-13" for="add[role_banner]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_banner" name="edit[role_banner]"
                                                        <?php echo e(helper::check_access('role_banner', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_banner]">
                                                    <label class="form-label fs-13" for="edit[role_banner]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_banner" name="delete[role_banner]"
                                                        <?php echo e(helper::check_access('role_banner', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_banner]">
                                                    <label class="form-label fs-13" for="delete[role_banner]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('coupon')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $coupons = 1;
                                                    } else {
                                                        $coupons = @$checkplan->coupons;
                                                    }
                                                ?>
                                                <?php if($coupons == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_coupons" name="modules[role_coupons]"
                                                                    <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_coupons]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_coupons]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_coupons" name="add[role_coupons]"
                                                                    <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_coupons]">
                                                                <label class="form-label fs-13" for="add[role_coupons]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_coupons" name="edit[role_coupons]"
                                                                    <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_coupons]">
                                                                <label class="form-label fs-13"
                                                                    for="edit[role_coupons]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_coupons" name="delete[role_coupons]"
                                                                    <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                    id="delete[role_coupons]">
                                                                <label class="form-label fs-13"
                                                                    for="delete[role_coupons]">
                                                                    <?php echo e(trans('labels.delete')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('coupon')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_coupons" name="modules[role_coupons]"
                                                                <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_coupons]">
                                                            <label class="form-label fs-13" for="manage[role_coupons]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_coupons" name="add[role_coupons]"
                                                                <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_coupons]">
                                                            <label class="form-label fs-13" for="add[role_coupons]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_coupons" name="edit[role_coupons]"
                                                                <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_coupons]">
                                                            <label class="form-label fs-13" for="edit[role_coupons]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_coupons" name="delete[role_coupons]"
                                                                <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_coupons]">
                                                            <label class="form-label fs-13" for="delete[role_coupons]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('top_deals')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_top_deals" name="modules[role_top_deals]"
                                                            <?php echo e(helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_top_deals]">
                                                        <label class="form-label fs-13" for="manage[role_top_deals]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_top_deals" name="add[role_top_deals]"
                                                            <?php echo e(helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_top_deals]">
                                                        <label class="form-label fs-13" for="add[role_top_deals]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_top_deals" name="delete[role_top_deals]"
                                                            <?php echo e(helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_top_deals]">
                                                        <label class="form-label fs-13" for="delete[role_top_deals]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('firebase_notification')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_firebase_notification"
                                                            name="modules[role_firebase_notification]"
                                                            <?php echo e(helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_firebase_notification]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_firebase_notification]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_firebase_notification"
                                                            name="add[role_firebase_notification]"
                                                            <?php echo e(helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_firebase_notification]">
                                                        <label class="form-label fs-13"
                                                            for="add[role_firebase_notification]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_firebase_notification"
                                                            name="edit[role_firebase_notification]"
                                                            <?php echo e(helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_firebase_notification]">
                                                        <label class="form-label fs-13"
                                                            for="edit[role_firebase_notification]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_firebase_notification"
                                                            name="delete[role_firebase_notification]"
                                                            <?php echo e(helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_firebase_notification]">
                                                        <label class="form-label fs-13"
                                                            for="delete[role_firebase_notification]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(@helper::checkaddons('subscription')): ?>
                                        <?php if($user->allow_without_subscription != 1): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_pricing_plans"
                                                            name="modules[role_pricing_plans]"
                                                            <?php echo e(helper::check_access('role_pricing_plans', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_pricing_plans]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_pricing_plans]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_pricing_plans"
                                                                name="add[role_pricing_plans]"
                                                                <?php echo e(helper::check_access('role_pricing_plans', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_pricing_plans]">
                                                            <label class="form-label fs-13"
                                                                for="add[role_pricing_plans]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_pricing_plans"
                                                                name="edit[role_pricing_plans]"
                                                                <?php echo e(helper::check_access('role_pricing_plans', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_pricing_plans]">
                                                            <label class="form-label fs-13"
                                                                for="edit[role_pricing_plans]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_pricing_plans"
                                                                name="delete[role_pricing_plans]"
                                                                <?php echo e(helper::check_access('role_pricing_plans', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_pricing_plans]">
                                                            <label class="form-label fs-13"
                                                                for="delete[role_pricing_plans]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_transaction" name="modules[role_transaction]"
                                                        <?php echo e(helper::check_access('role_transaction', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_transaction]">
                                                    <label class="form-label fs-13" for="manage[role_transaction]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_payment_methods"
                                                        name="modules[role_payment_methods]"
                                                        <?php echo e(helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_payment_methods]">
                                                    <label class="form-label fs-13" for="manage[role_payment_methods]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_payment_methods" name="add[role_payment_methods]"
                                                        <?php echo e(helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_payment_methods]">
                                                    <label class="form-label fs-13" for="add[role_payment_methods]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_payment_methods"
                                                            name="modules[role_payment_methods]"
                                                            <?php echo e(helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_payment_methods]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_payment_methods]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_payment_methods"
                                                            name="add[role_payment_methods]"
                                                            <?php echo e(helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_payment_methods]">
                                                        <label class="form-label fs-13" for="add[role_payment_methods]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_cities" name="modules[role_cities]"
                                                        <?php echo e(helper::check_access('role_cities', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_cities]">
                                                    <label class="form-label fs-13" for="manage[role_cities]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_cities" name="add[role_cities]"
                                                        <?php echo e(helper::check_access('role_cities', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_cities]">
                                                    <label class="form-label fs-13" for="add[role_cities]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_cities" name="edit[role_cities]"
                                                        <?php echo e(helper::check_access('role_cities', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_cities]">
                                                    <label class="form-label fs-13" for="edit[role_cities]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_cities" name="delete[role_cities]"
                                                        <?php echo e(helper::check_access('role_cities', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_cities]">
                                                    <label class="form-label fs-13" for="delete[role_cities]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_areas"
                                                        name="modules[role_areas]"
                                                        <?php echo e(helper::check_access('role_areas', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_areas]">
                                                    <label class="form-label fs-13" for="manage[role_areas]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_areas"
                                                        name="add[role_areas]"
                                                        <?php echo e(helper::check_access('role_areas', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_areas]">
                                                    <label class="form-label fs-13" for="add[role_areas]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_areas"
                                                        name="edit[role_areas]"
                                                        <?php echo e(helper::check_access('role_areas', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_areas]">
                                                    <label class="form-label fs-13" for="edit[role_areas]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_areas"
                                                        name="delete[role_areas]"
                                                        <?php echo e(helper::check_access('role_areas', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_areas]">
                                                    <label class="form-label fs-13" for="delete[role_areas]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_store_categories"
                                                        name="modules[role_store_categories]"
                                                        <?php echo e(helper::check_access('role_store_categories', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_store_categories]">
                                                    <label class="form-label fs-13" for="manage[role_store_categories]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_store_categories" name="add[role_store_categories]"
                                                        <?php echo e(helper::check_access('role_store_categories', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_store_categories]">
                                                    <label class="form-label fs-13" for="add[role_store_categories]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_store_categories" name="edit[role_store_categories]"
                                                        <?php echo e(helper::check_access('role_store_categories', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_store_categories]">
                                                    <label class="form-label fs-13" for="edit[role_store_categories]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_store_categories"
                                                        name="delete[role_store_categories]"
                                                        <?php echo e(helper::check_access('role_store_categories', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_store_categories]">
                                                    <label class="form-label fs-13" for="delete[role_store_categories]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('custom_domain')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_domains"
                                                            name="modules[role_custom_domains]"
                                                            <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_custom_domains]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_custom_domains]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_domains" name="edit[role_custom_domains]"
                                                            <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_custom_domains]">
                                                        <label class="form-label fs-13" for="edit[role_custom_domains]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_working_hours" name="modules[role_working_hours]"
                                                        <?php echo e(helper::check_access('role_working_hours', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_working_hours]">
                                                    <label class="form-label fs-13" for="manage[role_working_hours]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_working_hours" name="edit[role_working_hours]"
                                                        <?php echo e(helper::check_access('role_working_hours', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_working_hours]">
                                                    <label class="form-label fs-13" for="edit[role_working_hours]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_table"
                                                        name="modules[role_table]"
                                                        <?php echo e(helper::check_access('role_table', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_table]">
                                                    <label class="form-label fs-13" for="manage[role_table]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_table"
                                                        name="add[role_table]"
                                                        <?php echo e(helper::check_access('role_table', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_table]">
                                                    <label class="form-label fs-13" for="add[role_table]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_table"
                                                        name="edit[role_table]"
                                                        <?php echo e(helper::check_access('role_table', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_table]">
                                                    <label class="form-label fs-13" for="edit[role_table]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_table"
                                                        name="delete[role_table]"
                                                        <?php echo e(helper::check_access('role_table', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_table]">
                                                    <label class="form-label fs-13" for="delete[role_table]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('custom_status')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_status"
                                                            name="modules[role_custom_status]"
                                                            <?php echo e(helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_custom_status]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_custom_status]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_status" name="add[role_custom_status]"
                                                            <?php echo e(helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_custom_status]">
                                                        <label class="form-label fs-13" for="add[role_custom_status]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_status" name="edit[role_custom_status]"
                                                            <?php echo e(helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_custom_status]">
                                                        <label class="form-label fs-13" for="edit[role_custom_status]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_status" name="delete[role_custom_status]"
                                                            <?php echo e(helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_custom_status]">
                                                        <label class="form-label fs-13"
                                                            for="delete[role_custom_status]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('custom_domain')): ?>
                                                <?php
                                                    if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                                        $checkplan = App\Models\Transaction::where(
                                                            'vendor_id',
                                                            $vendor_id,
                                                        )
                                                            ->orderByDesc('id')
                                                            ->first();
                                                    }
                                                    if ($user->allow_without_subscription == 1) {
                                                        $custom_domain = 1;
                                                    } else {
                                                        $custom_domain = @$checkplan->custom_domain;
                                                    }
                                                ?>
                                                <?php if($custom_domain == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_custom_domains"
                                                                    name="modules[role_custom_domains]"
                                                                    <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_custom_domains]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_custom_domains]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_custom_domains"
                                                                    name="add[role_custom_domains]"
                                                                    <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_custom_domains]">
                                                                <label class="form-label fs-13"
                                                                    for="add[role_custom_domains]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('custom_domain')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_custom_domains"
                                                                name="modules[role_custom_domains]"
                                                                <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_custom_domains]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_custom_domains]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_custom_domains"
                                                                name="add[role_custom_domains]"
                                                                <?php echo e(helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_custom_domains]">
                                                            <label class="form-label fs-13"
                                                                for="add[role_custom_domains]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_basic_settings" name="modules[role_basic_settings]"
                                                    <?php echo e(helper::check_access('role_basic_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_basic_settings]">
                                                <label class="form-label fs-13" for="manage[role_basic_settings]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_basic_settings" name="edit[role_basic_settings]"
                                                    <?php echo e(helper::check_access('role_basic_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_basic_settings]">
                                                <label class="form-label fs-13" for="edit[role_basic_settings]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_how_it_works" name="modules[role_how_it_works]"
                                                        <?php echo e(helper::check_access('role_how_it_works', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_how_it_works]">
                                                    <label class="form-label fs-13" for="manage[role_how_it_works]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_how_it_works" name="add[role_how_it_works]"
                                                        <?php echo e(helper::check_access('role_how_it_works', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_how_it_works]">
                                                    <label class="form-label fs-13" for="add[role_how_it_works]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_how_it_works" name="edit[role_how_it_works]"
                                                        <?php echo e(helper::check_access('role_how_it_works', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_how_it_works]">
                                                    <label class="form-label fs-13" for="edit[role_how_it_works]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_how_it_works" name="delete[role_how_it_works]"
                                                        <?php echo e(helper::check_access('role_how_it_works', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_how_it_works]">
                                                    <label class="form-label fs-13" for="delete[role_how_it_works]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_theme_images" name="modules[role_theme_images]"
                                                        <?php echo e(helper::check_access('role_theme_images', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_theme_images]">
                                                    <label class="form-label fs-13" for="manage[role_theme_images]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_theme_images" name="add[role_theme_images]"
                                                        <?php echo e(helper::check_access('role_theme_images', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_theme_images]">
                                                    <label class="form-label fs-13" for="add[role_theme_images]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_theme_images" name="edit[role_theme_images]"
                                                        <?php echo e(helper::check_access('role_theme_images', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_theme_images]">
                                                    <label class="form-label fs-13" for="edit[role_theme_images]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_theme_images" name="delete[role_theme_images]"
                                                        <?php echo e(helper::check_access('role_theme_images', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_theme_images]">
                                                    <label class="form-label fs-13" for="delete[role_theme_images]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_features" name="modules[role_features]"
                                                        <?php echo e(helper::check_access('role_features', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_features]">
                                                    <label class="form-label fs-13" for="manage[role_features]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_features" name="add[role_features]"
                                                        <?php echo e(helper::check_access('role_features', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_features]">
                                                    <label class="form-label fs-13" for="add[role_features]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_features" name="edit[role_features]"
                                                        <?php echo e(helper::check_access('role_features', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_features]">
                                                    <label class="form-label fs-13" for="edit[role_features]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_features" name="delete[role_features]"
                                                        <?php echo e(helper::check_access('role_features', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_features]">
                                                    <label class="form-label fs-13" for="delete[role_features]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_promotional_banners"
                                                        name="modules[role_promotional_banners]"
                                                        <?php echo e(helper::check_access('role_promotional_banners', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_promotional_banners]">
                                                    <label class="form-label fs-13"
                                                        for="manage[role_promotional_banners]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_promotional_banners"
                                                        name="add[role_promotional_banners]"
                                                        <?php echo e(helper::check_access('role_promotional_banners', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_promotional_banners]">
                                                    <label class="form-label fs-13" for="add[role_promotional_banners]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_promotional_banners"
                                                        name="edit[role_promotional_banners]"
                                                        <?php echo e(helper::check_access('role_promotional_banners', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_promotional_banners]">
                                                    <label class="form-label fs-13"
                                                        for="edit[role_promotional_banners]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_promotional_banners"
                                                        name="delete[role_promotional_banners]"
                                                        <?php echo e(helper::check_access('role_promotional_banners', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_promotional_banners]">
                                                    <label class="form-label fs-13"
                                                        for="delete[role_promotional_banners]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('blog')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="modules[role_blogs]"
                                                            <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_blogs]">
                                                        <label class="form-label fs-13" for="manage[role_blogs]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="add[role_blogs]"
                                                            <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_blogs]">
                                                        <label class="form-label fs-13" for="add[role_blogs]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="edit[role_blogs]"
                                                            <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_blogs]">
                                                        <label class="form-label fs-13" for="edit[role_blogs]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="delete[role_blogs]"
                                                            <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_blogs]">
                                                        <label class="form-label fs-13" for="delete[role_blogs]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_who_we_are" name="modules[role_who_we_are]"
                                                        <?php echo e(helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_who_we_are]">
                                                    <label class="form-label fs-13" for="manage[role_who_we_are]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_who_we_are" name="add[role_who_we_are]"
                                                        <?php echo e(helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                        id="add[role_who_we_are]">
                                                    <label class="form-label fs-13" for="add[role_who_we_are]">
                                                        <?php echo e(trans('labels.add')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_who_we_are" name="edit[role_who_we_are]"
                                                        <?php echo e(helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                        id="edit[role_who_we_are]">
                                                    <label class="form-label fs-13" for="edit[role_who_we_are]">
                                                        <?php echo e(trans('labels.edit')); ?>

                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_who_we_are" name="delete[role_who_we_are]"
                                                        <?php echo e(helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                        id="delete[role_who_we_are]">
                                                    <label class="form-label fs-13" for="delete[role_who_we_are]">
                                                        <?php echo e(trans('labels.delete')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('blog')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $blogs = 1;
                                                    } else {
                                                        $blogs = @$checkplan->blogs;
                                                    }
                                                ?>
                                                <?php if($blogs == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_blogs" name="modules[role_blogs]"
                                                                    <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_blogs]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_blogs]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_blogs" name="add[role_blogs]"
                                                                    <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_blogs]">
                                                                <label class="form-label fs-13" for="add[role_blogs]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_blogs" name="edit[role_blogs]"
                                                                    <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_blogs]">
                                                                <label class="form-label fs-13" for="edit[role_blogs]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_blogs" name="delete[role_blogs]"
                                                                    <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                    id="delete[role_blogs]">
                                                                <label class="form-label fs-13"
                                                                    for="delete[role_blogs]">
                                                                    <?php echo e(trans('labels.delete')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('blog')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_blogs" name="modules[role_blogs]"
                                                                <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_blogs]">
                                                            <label class="form-label fs-13" for="manage[role_blogs]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_blogs" name="add[role_blogs]"
                                                                <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_blogs]">
                                                            <label class="form-label fs-13" for="add[role_blogs]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_blogs" name="edit[role_blogs]"
                                                                <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_blogs]">
                                                            <label class="form-label fs-13" for="edit[role_blogs]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_blogs" name="delete[role_blogs]"
                                                                <?php echo e(helper::check_access('role_blogs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_blogs]">
                                                            <label class="form-label fs-13" for="delete[role_blogs]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_testimonials" name="modules[role_testimonials]"
                                                    <?php echo e(helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_testimonials]">
                                                <label class="form-label fs-13" for="manage[role_testimonials]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_testimonials" name="add[role_testimonials]"
                                                    <?php echo e(helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                    id="add[role_testimonials]">
                                                <label class="form-label fs-13" for="add[role_testimonials]">
                                                    <?php echo e(trans('labels.add')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_testimonials" name="edit[role_testimonials]"
                                                    <?php echo e(helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_testimonials]">
                                                <label class="form-label fs-13" for="edit[role_testimonials]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_testimonials" name="delete[role_testimonials]"
                                                    <?php echo e(helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                    id="delete[role_testimonials]">
                                                <label class="form-label fs-13" for="delete[role_testimonials]">
                                                    <?php echo e(trans('labels.delete')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_faqs"
                                                    name="modules[role_faqs]"
                                                    <?php echo e(helper::check_access('role_faqs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_faqs]">
                                                <label class="form-label fs-13" for="manage[role_faqs]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_faqs"
                                                    name="add[role_faqs]"
                                                    <?php echo e(helper::check_access('role_faqs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                    id="add[role_faqs]">
                                                <label class="form-label fs-13" for="add[role_faqs]">
                                                    <?php echo e(trans('labels.add')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_faqs"
                                                    name="edit[role_faqs]"
                                                    <?php echo e(helper::check_access('role_faqs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_faqs]">
                                                <label class="form-label fs-13" for="edit[role_faqs]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_faqs"
                                                    name="delete[role_faqs]"
                                                    <?php echo e(helper::check_access('role_faqs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                    id="delete[role_faqs]">
                                                <label class="form-label fs-13" for="delete[role_faqs]">
                                                    <?php echo e(trans('labels.delete')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="role_cms_pages"
                                                    name="modules[role_cms_pages]"
                                                    <?php echo e(helper::check_access('role_cms_pages', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_cms_pages]">
                                                <label class="form-label fs-13" for="manage[role_cms_pages]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_cms_pages"
                                                    name="edit[role_cms_pages]"
                                                    <?php echo e(helper::check_access('role_cms_pages', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_cms_pages]">
                                                <label class="form-label fs-13" for="edit[role_cms_pages]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <?php if(@helper::checkaddons('coupon')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="modules[role_coupons]"
                                                            <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_coupons]">
                                                        <label class="form-label fs-13" for="manage[role_coupons]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="add[role_coupons]"
                                                            <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_coupons]">
                                                        <label class="form-label fs-13" for="add[role_coupons]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="edit[role_coupons]"
                                                            <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_coupons]">
                                                        <label class="form-label fs-13" for="edit[role_coupons]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="delete[role_coupons]"
                                                            <?php echo e(helper::check_access('role_coupons', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_coupons]">
                                                        <label class="form-label fs-13" for="delete[role_coupons]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('employee')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="modules[role_roles]"
                                                            <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_roles]">
                                                        <label class="form-label fs-13" for="manage[role_roles]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="add[role_roles]"
                                                            <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_roles]">
                                                        <label class="form-label fs-13" for="add[role_roles]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="edit[role_roles]"
                                                            <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_roles]">
                                                        <label class="form-label fs-13" for="edit[role_roles]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="delete[role_roles]"
                                                            <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_roles]">
                                                        <label class="form-label fs-13" for="delete[role_roles]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="modules[role_employees]"
                                                            <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_employees]">
                                                        <label class="form-label fs-13" for="manage[role_employees]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="add[role_employees]"
                                                            <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_employees]">
                                                        <label class="form-label fs-13" for="add[role_employees]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="edit[role_employees]"
                                                            <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_employees]">
                                                        <label class="form-label fs-13" for="edit[role_employees]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="delete[role_employees]"
                                                            <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_employees]">
                                                        <label class="form-label fs-13" for="delete[role_employees]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('employee')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $role_management = 1;
                                                    } else {
                                                        $role_management = @$checkplan->role_management;
                                                    }
                                                ?>
                                                <?php if($role_management == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_roles" name="modules[role_roles]"
                                                                    <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_roles]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_roles]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_roles" name="add[role_roles]"
                                                                    <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_roles]">
                                                                <label class="form-label fs-13" for="add[role_roles]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_roles" name="edit[role_roles]"
                                                                    <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_roles]">
                                                                <label class="form-label fs-13" for="edit[role_roles]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_roles" name="delete[role_roles]"
                                                                    <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                    id="delete[role_roles]">
                                                                <label class="form-label fs-13"
                                                                    for="delete[role_roles]">
                                                                    <?php echo e(trans('labels.delete')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_employees"
                                                                    name="modules[role_employees]"
                                                                    <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_employees]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_employees]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_employees" name="add[role_employees]"
                                                                    <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                    id="add[role_employees]">
                                                                <label class="form-label fs-13"
                                                                    for="add[role_employees]">
                                                                    <?php echo e(trans('labels.add')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_employees" name="edit[role_employees]"
                                                                    <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_employees]">
                                                                <label class="form-label fs-13"
                                                                    for="edit[role_employees]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_employees" name="delete[role_employees]"
                                                                    <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                    id="delete[role_employees]">
                                                                <label class="form-label fs-13"
                                                                    for="delete[role_employees]">
                                                                    <?php echo e(trans('labels.delete')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('employee')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_roles" name="modules[role_roles]"
                                                                <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_roles]">
                                                            <label class="form-label fs-13" for="manage[role_roles]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_roles" name="add[role_roles]"
                                                                <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_roles]">
                                                            <label class="form-label fs-13" for="add[role_roles]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_roles" name="edit[role_roles]"
                                                                <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_roles]">
                                                            <label class="form-label fs-13" for="edit[role_roles]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_roles" name="delete[role_roles]"
                                                                <?php echo e(helper::check_access('role_roles', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_roles]">
                                                            <label class="form-label fs-13" for="delete[role_roles]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_employees" name="modules[role_employees]"
                                                                <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_employees]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_employees]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_employees" name="add[role_employees]"
                                                                <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                                id="add[role_employees]">
                                                            <label class="form-label fs-13" for="add[role_employees]">
                                                                <?php echo e(trans('labels.add')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_employees" name="edit[role_employees]"
                                                                <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_employees]">
                                                            <label class="form-label fs-13" for="edit[role_employees]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_employees" name="delete[role_employees]"
                                                                <?php echo e(helper::check_access('role_employees', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                                id="delete[role_employees]">
                                                            <label class="form-label fs-13"
                                                                for="delete[role_employees]">
                                                                <?php echo e(trans('labels.delete')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_subscribers" name="modules[role_subscribers]"
                                                    <?php echo e(helper::check_access('role_subscribers', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_subscribers]">
                                                <label class="form-label fs-13" for="manage[role_subscribers]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_subscribers" name="delete[role_subscribers]"
                                                    <?php echo e(helper::check_access('role_subscribers', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                    id="delete[role_subscribers]">
                                                <label class="form-label fs-13" for="delete[role_subscribers]">
                                                    <?php echo e(trans('labels.delete')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="role_inquiries"
                                                    name="modules[role_inquiries]"
                                                    <?php echo e(helper::check_access('role_inquiries', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_inquiries]">
                                                <label class="form-label fs-13" for="manage[role_inquiries]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_inquiries"
                                                    name="edit[role_inquiries]"
                                                    <?php echo e(helper::check_access('role_inquiries', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_inquiries]">
                                                <label class="form-label fs-13" for="edit[role_inquiries]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_inquiries"
                                                    name="delete[role_inquiries]"
                                                    <?php echo e(helper::check_access('role_inquiries', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                    id="delete[role_inquiries]">
                                                <label class="form-label fs-13" for="delete[role_inquiries]">
                                                    <?php echo e(trans('labels.delete')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                                        <?php if(@helper::checkaddons('product_inquiry')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_product_inquiry"
                                                            name="modules[role_product_inquiry]"
                                                            <?php echo e(helper::check_access('role_product_inquiry', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_product_inquiry]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_product_inquiry]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_product_inquiry"
                                                            name="edit[role_product_inquiry]"
                                                            <?php echo e(helper::check_access('role_product_inquiry', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_product_inquiry]">
                                                        <label class="form-label fs-13"
                                                            for="edit[role_product_inquiry]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_product_inquiry"
                                                            name="delete[role_product_inquiry]"
                                                            <?php echo e(helper::check_access('role_product_inquiry', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_product_inquiry]">
                                                        <label class="form-label fs-13"
                                                            for="delete[role_product_inquiry]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="d-block mb-3">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_share"
                                                        name="modules[role_share]"
                                                        <?php echo e(helper::check_access('role_share', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                        id="manage[role_share]">
                                                    <label class="form-label fs-13" for="manage[role_share]">
                                                        <?php echo e(trans('labels.view')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $whatsapp_message = 1;
                                                    } else {
                                                        $whatsapp_message = @$checkplan->whatsapp_message;
                                                    }
                                                ?>
                                                <?php if($whatsapp_message == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_whatsapp_settings"
                                                                    name="modules[role_whatsapp_settings]"
                                                                    <?php echo e(helper::check_access('role_whatsapp_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_whatsapp_settings]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_whatsapp_settings]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_whatsapp_settings"
                                                                    name="edit[role_whatsapp_settings]"
                                                                    <?php echo e(helper::check_access('role_whatsapp_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_whatsapp_settings]">
                                                                <label class="form-label fs-13"
                                                                    for="edit[role_whatsapp_settings]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_whatsapp_settings"
                                                                name="modules[role_whatsapp_settings]"
                                                                <?php echo e(helper::check_access('role_whatsapp_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_whatsapp_settings]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_whatsapp_settings]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_whatsapp_settings"
                                                                name="edit[role_whatsapp_settings]"
                                                                <?php echo e(helper::check_access('role_whatsapp_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_whatsapp_settings]">
                                                            <label class="form-label fs-13"
                                                                for="edit[role_whatsapp_settings]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('telegram_message')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $telegram_message = 1;
                                                    } else {
                                                        $telegram_message = @$checkplan->telegram_message;
                                                    }
                                                ?>
                                                <?php if($telegram_message == 1): ?>
                                                    <div class="d-block mb-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_telegram_settings"
                                                                    name="modules[role_telegram_settings]"
                                                                    <?php echo e(helper::check_access('role_telegram_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                    id="manage[role_telegram_settings]">
                                                                <label class="form-label fs-13"
                                                                    for="manage[role_telegram_settings]">
                                                                    <?php echo e(trans('labels.view')); ?>

                                                                </label>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="role_telegram_settings"
                                                                    name="edit[role_telegram_settings]"
                                                                    <?php echo e(helper::check_access('role_telegram_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                    id="edit[role_telegram_settings]">
                                                                <label class="form-label fs-13"
                                                                    for="edit[role_telegram_settings]">
                                                                    <?php echo e(trans('labels.edit')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('telegram_message')): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_telegram_settings"
                                                                name="modules[role_telegram_settings]"
                                                                <?php echo e(helper::check_access('role_telegram_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_telegram_settings]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_telegram_settings]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_telegram_settings"
                                                                name="edit[role_telegram_settings]"
                                                                <?php echo e(helper::check_access('role_telegram_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_telegram_settings]">
                                                            <label class="form-label fs-13"
                                                                for="edit[role_telegram_settings]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('language')): ?>
                                            <?php if(helper::listoflanguage()->count() > 1): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_language_settings"
                                                                name="modules[role_language_settings]"
                                                                <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_language_settings]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_language_settings]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_language_settings"
                                                                name="edit[role_language_settings]"
                                                                <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_language_settings]">
                                                            <label class="form-label fs-13"
                                                                for="edit[role_language_settings]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('currency_settigns')): ?>
                                            <?php if(helper::available_currency()->count() > 1): ?>
                                                <div class="d-block mb-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_currency_settings"
                                                                name="modules[role_currency_settings]"
                                                                <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                                id="manage[role_currency_settings]">
                                                            <label class="form-label fs-13"
                                                                for="manage[role_currency_settings]">
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </label>
                                                        </div>
                                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="role_currency_settings"
                                                                name="edit[role_currency_settings]"
                                                                <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                                id="edit[role_currency_settings]">
                                                            <label class="form-label fs-13"
                                                                for="edit[role_currency_settings]">
                                                                <?php echo e(trans('labels.edit')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                        <?php if(@helper::checkaddons('language')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_language_settings"
                                                            name="modules[role_language_settings]"
                                                            <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_language_settings]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_language_settings]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_language_settings"
                                                            name="add[role_language_settings]"
                                                            <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_language_settings]">
                                                        <label class="form-label fs-13"
                                                            for="add[role_language_settings]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_language_settings"
                                                            name="edit[role_language_settings]"
                                                            <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_language_settings]">
                                                        <label class="form-label fs-13"
                                                            for="edit[role_language_settings]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_language_settings"
                                                            name="delete[role_language_settings]"
                                                            <?php echo e(helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_language_settings]">
                                                        <label class="form-label fs-13"
                                                            for="delete[role_language_settings]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('currency_settigns')): ?>
                                            <div class="d-block mb-3">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_currency_settings"
                                                            name="modules[role_currency_settings]"
                                                            <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                            id="manage[role_currency_settings]">
                                                        <label class="form-label fs-13"
                                                            for="manage[role_currency_settings]">
                                                            <?php echo e(trans('labels.view')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_currency_settings"
                                                            name="add[role_currency_settings]"
                                                            <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : ''); ?>

                                                            id="add[role_currency_settings]">
                                                        <label class="form-label fs-13"
                                                            for="add[role_currency_settings]">
                                                            <?php echo e(trans('labels.add')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_currency_settings"
                                                            name="edit[role_currency_settings]"
                                                            <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                            id="edit[role_currency_settings]">
                                                        <label class="form-label fs-13"
                                                            for="edit[role_currency_settings]">
                                                            <?php echo e(trans('labels.edit')); ?>

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_currency_settings"
                                                            name="delete[role_currency_settings]"
                                                            <?php echo e(helper::check_access('role_currency_settings', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : ''); ?>

                                                            id="delete[role_currency_settings]">
                                                        <label class="form-label fs-13"
                                                            for="delete[role_currency_settings]">
                                                            <?php echo e(trans('labels.delete')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <div class="d-block mb-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="role_settings"
                                                    name="modules[role_settings]"
                                                    <?php echo e(helper::check_access('role_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : ''); ?>

                                                    id="manage[role_settings]">
                                                <label class="form-label fs-13" for="manage[role_settings]">
                                                    <?php echo e(trans('labels.view')); ?>

                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_settings"
                                                    name="edit[role_settings]"
                                                    <?php echo e(helper::check_access('role_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : ''); ?>

                                                    id="edit[role_settings]">
                                                <label class="form-label fs-13" for="edit[role_settings]">
                                                    <?php echo e(trans('labels.edit')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $__errorArgs = ['modules'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <br><span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/roles')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#permissioncheckbox input:checkbox').each(function(e) {
                "use strict";
                var id = $(this).val();
                var manageid = "manage[" + id + "]";
                var addid = "add[" + id + "]";
                var editid = "edit[" + id + "]";
                var deleteid = "delete[" + id + "]";
                if ($("[id='" + manageid + "']").prop('checked') == true ||
                    $("[id='" + addid + "']").prop('checked') == true ||
                    $("[id='" + editid + "']").prop('checked') == true ||
                    $("[id='" + deleteid + "']").prop('checked') == true) {
                    $($('#' + id)).prop('checked', $(this).prop('checked'));
                }
                $('#checkall').prop('checked', $(this).prop('checked'));
            });
        });

        $('#checkall').on('click', function() {
            "use strict";
            var checked = $(this).prop('checked');
            $('input:checkbox').prop('checked', checked);
        }).change();

        $('#checkboxes input:checkbox').on('click', function() {

            var checked = $(this).prop('checked');
            var manageid = "manage[" + this.id + "]";
            var addid = "add[" + this.id + "]";
            var editid = "edit[" + this.id + "]";
            var deleteid = "delete[" + this.id + "]";
            $("[id='" + manageid + "']").prop('checked', checked);
            $("[id='" + addid + "']").prop('checked', checked);
            $("[id='" + editid + "']").prop('checked', checked);
            $("[id='" + deleteid + "']").prop('checked', checked);
        });

        $('#permissioncheckbox input:checkbox').on('click', function() {

            var checked = $(this).prop('checked');
            var value = $(this).val();
            var manageid = "manage[" + $(this).val() + "]";
            var addid = "add[" + $(this).val() + "]";
            var editid = "edit[" + $(this).val() + "]";
            var deleteid = "delete[" + $(this).val() + "]";
            if ($("[id='" + addid + "']").prop('checked') == true || $("[id='" + editid + "']").prop('checked') ==
                true || $("[id='" + deleteid + "']").prop('checked') == true) {
                $("[id='" + manageid + "']").prop('checked', true);
            }

        }).change();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\rolemanager\edit.blade.php ENDPATH**/ ?>