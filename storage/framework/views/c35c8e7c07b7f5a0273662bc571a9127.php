<?php $__env->startSection('content'); ?>
    <style>
        /* ===== Multi-Step Registration Styles ===== */
        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }
        .register-hero {
            position: relative;
            overflow: hidden;
        }
        .register-hero img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }
        .register-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99,102,241,0.6) 0%, rgba(168,85,247,0.4) 100%);
        }
        .register-form-side {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--reg-bg, #f8f9fc);
            position: relative;
            overflow-y: auto;
        }
        .register-card {
            width: 100%;
            max-width: 520px;
        }

        /* Progress Steps */
        .step-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 2rem;
            position: relative;
        }
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .step-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #e2e8f0;
            color: #94a3b8;
            border: 3px solid #e2e8f0;
        }
        .step-circle.active {
            background: linear-gradient(135deg, var(--bs-primary, #6366f1), var(--bs-secondary, #8b5cf6));
            color: #fff;
            border-color: var(--bs-primary, #6366f1);
            box-shadow: 0 4px 15px rgba(99,102,241,0.4);
            transform: scale(1.1);
        }
        .step-circle.completed {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border-color: #10b981;
            box-shadow: 0 4px 15px rgba(16,185,129,0.4);
        }
        .step-label {
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
            color: #94a3b8;
            transition: color 0.3s;
            white-space: nowrap;
        }
        .step-label.active { color: var(--bs-primary, #6366f1); }
        .step-label.completed { color: #10b981; }

        .step-connector {
            width: 100px;
            height: 3px;
            background: #e2e8f0;
            margin: 0 0.5rem;
            margin-bottom: 1.5rem;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
        }
        .step-connector .fill {
            position: absolute;
            top: 0; left: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #10b981, var(--bs-primary, #6366f1));
            border-radius: 2px;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .step-connector.filled .fill { width: 100%; }

        /* Form Steps */
        .form-step {
            display: none;
            animation: stepFadeIn 0.4s ease;
        }
        .form-step.active { display: block; }
        @keyframes stepFadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Styling */
        .reg-form-group {
            margin-bottom: 1.25rem;
        }
        .reg-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .reg-form-group .form-control,
        .reg-form-group .form-select {
            padding: 0.7rem 1rem;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 0.9rem;
            transition: all 0.3s;
            background: #fff;
        }
        .reg-form-group .form-control:focus,
        .reg-form-group .form-select:focus {
            border-color: var(--bs-primary, #6366f1);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
        }
        .password-wrapper {
            position: relative;
        }
        .password-wrapper .toggle-pass {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 14px;
            cursor: pointer;
            color: #94a3b8;
            z-index: 5;
        }
        html[dir="rtl"] .password-wrapper .toggle-pass {
            right: auto;
            left: 14px;
        }

        /* Buttons */
        .btn-step {
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s;
            border: none;
        }
        .btn-next {
            background: linear-gradient(135deg, var(--bs-primary, #6366f1), var(--bs-secondary, #8b5cf6));
            color: #fff;
        }
        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.4);
            color: #fff;
        }
        .btn-prev {
            background: #f1f5f9;
            color: #475569;
        }
        .btn-prev:hover {
            background: #e2e8f0;
            color: #1e293b;
        }
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16,185,129,0.4);
            color: #fff;
        }
        .btn-login-link {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #64748b;
            border-radius: 12px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login-link:hover {
            border-color: var(--bs-primary, #6366f1);
            color: var(--bs-primary, #6366f1);
        }

        /* Title */
        .reg-title {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--bs-primary, #6366f1), var(--bs-secondary, #8b5cf6));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .reg-subtitle { color: #64748b; font-size: 0.9rem; }

        /* Dark mode */
        .dark .register-form-side { --reg-bg: #0f172a; }
        .dark .reg-form-group label { color: #cbd5e1; }
        .dark .reg-form-group .form-control,
        .dark .reg-form-group .form-select {
            background: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }
        .dark .step-circle { background: #1e293b; border-color: #334155; color: #64748b; }
        .dark .step-connector { background: #334155; }
        .dark .btn-prev { background: #1e293b; color: #e2e8f0; }
        .dark .btn-login-link { border-color: #334155; color: #94a3b8; }
        .dark .reg-subtitle { color: #94a3b8; }

        @media (max-width: 767px) {
            .register-form-side { padding: 1.5rem 1rem; }
            .step-connector { width: 50px; }
            .reg-title { font-size: 1.4rem; }
        }
    </style>

    <section>
        <div class="row g-0 register-wrapper">
            
            <div class="col-xl-7 col-lg-6 col-md-6 d-md-block d-none register-hero">
                <img src="<?php echo e(helper::image_path(helper::appdata('')->admin_auth_pages_bg_image)); ?>" alt="">
            </div>

            
            <div class="col-xl-5 col-lg-6 col-md-6 register-form-side">
                <div class="register-card">
                    
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="reg-title mb-1"><?php echo e(trans('labels.register')); ?></h2>
                            <p class="reg-subtitle mb-0"><?php echo e(trans('labels.create_sub_title')); ?></p>
                        </div>
                        <?php if(helper::available_language('')->count() > 1): ?>
                            <?php if(@helper::checkaddons('language')): ?>
                                <div class="lag-btn dropdown border-0 shadow-none login-lang">
                                    <button class="border-0 bg-transparent language-dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo e(helper::image_path(session()->get('flag'))); ?>" alt=""
                                            class="lag-img rounded-circle w-25">
                                    </button>
                                    <ul class="dropdown-menu rounded-1 mt-1 p-0 bg-body-secondary shadow border-0 rounded-3 overflow-hidden">
                                        <?php $__currentLoopData = helper::listoflanguage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languagelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a class="dropdown-item text-dark d-flex align-items-center px-2 gap-2 py-2"
                                                    href="<?php echo e(URL::to('/lang/change?lang=' . $languagelist->code)); ?>">
                                                    <img src="<?php echo e(helper::image_path($languagelist->image)); ?>" alt="" class="img-fluid lag-img w-25">
                                                    <?php echo e($languagelist->name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    
                    <div class="step-progress">
                        <div class="step-indicator">
                            <div class="step-circle active" id="stepCircle0">1</div>
                            <span class="step-label active" id="stepLabel0">الواتساب</span>
                        </div>
                        <div class="step-connector" id="stepConnector0">
                            <div class="fill"></div>
                        </div>
                        <div class="step-indicator">
                            <div class="step-circle" id="stepCircle1">2</div>
                            <span class="step-label" id="stepLabel1"><?php echo e(trans('labels.basic_info') == 'labels.basic_info' ? 'البيانات الأساسية' : trans('labels.basic_info')); ?></span>
                        </div>
                        <div class="step-connector" id="stepConnector1">
                            <div class="fill"></div>
                        </div>
                        <div class="step-indicator">
                            <div class="step-circle" id="stepCircle2">3</div>
                            <span class="step-label" id="stepLabel2"><?php echo e(trans('labels.store_info') == 'labels.store_info' ? 'بيانات المتجر' : trans('labels.store_info')); ?></span>
                        </div>
                    </div>

                    
                    <form id="registerForm" method="POST" action="<?php echo e(URL::to('admin/register_vendor')); ?>">
                        <?php echo csrf_field(); ?>

                        
                        <div class="form-step active" id="step0">
                            <div class="row">
                                <div class="col-12 reg-form-group">
                                    <label for="mobile">رقم الواتساب<span class="text-danger">*</span></label>
                                    <div class="input-group" dir="ltr">
                                        <select class="form-select" id="country_code" style="max-width: 120px; border-radius: 12px 0 0 12px;">
                                            <option value="+963" selected>🇸🇾 +963</option>
                                            <option value="+966">🇸🇦 +966</option>
                                            <option value="+971">🇦🇪 +971</option>
                                            <option value="+965">🇰🇼 +965</option>
                                            <option value="+974">🇶🇦 +974</option>
                                            <option value="+973">🇧🇭 +973</option>
                                            <option value="+968">🇴🇲 +968</option>
                                            <option value="+20">🇪🇬 +20</option>
                                            <option value="+962">🇯🇴 +962</option>
                                            <option value="+961">🇱🇧 +961</option>
                                        </select>
                                        <input type="text" class="form-control mobile-number" name="mobile_input" value="<?php echo e(old('mobile')); ?>" id="mobile_input"
                                            placeholder="<?php echo e(trans('labels.mobile')); ?>" required style="border-radius: 0 12px 12px 0;">
                                    </div>
                                    <input type="hidden" name="mobile" id="mobile_hidden">
                                </div>
                                <div class="col-12 reg-form-group d-none" id="otp_section">
                                    <label for="otp">رمز التحقق (OTP)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="otp" id="otp" placeholder="أدخل رمز التحقق المرسل للواتساب">
                                </div>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="<?php echo e(URL::to('/admin')); ?>" class="btn btn-login-link flex-fill text-center"><?php echo e(trans('labels.login')); ?></a>
                                <button type="button" class="btn btn-step btn-next flex-fill" id="btn_send_otp" onclick="sendOtp()">
                                    إرسال الرمز <i class="fa-solid fa-paper-plane ms-1"></i>
                                </button>
                                <button type="button" class="btn btn-step btn-submit flex-fill d-none" id="btn_verify_otp" onclick="verifyOtp()">
                                    تحقق <i class="fa-solid fa-check ms-1"></i>
                                </button>
                            </div>
                        </div>

                        
                        <div class="form-step" id="step1">
                            <div class="row">
                                <div class="col-12 reg-form-group">
                                    <label for="name"><?php echo e(trans('labels.name') == 'Name' ? 'Store Name' : 'إسم المتجر'); ?><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" id="name"
                                        placeholder="<?php echo e(trans('labels.name') == 'Name' ? 'Store Name' : 'إسم المتجر'); ?>" required>
                                </div>
                                <div class="col-12 reg-form-group">
                                    <label for="email"><?php echo e(trans('labels.email')); ?><span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" id="email"
                                        placeholder="<?php echo e(trans('labels.email')); ?>" required>
                                </div>
                                <div class="col-12 reg-form-group">
                                    <label for="password"><?php echo e(trans('labels.password')); ?><span class="text-danger">*</span></label>
                                    <div class="password-wrapper">
                                        <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" id="password"
                                            placeholder="<?php echo e(trans('labels.password')); ?>" required>
                                        <span class="toggle-pass"><i class="fa-light fa-eye-slash" id="eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <button type="button" class="btn btn-step btn-prev flex-fill" onclick="prevStep()">
                                    <i class="fa-solid fa-arrow-<?php echo e(session()->get('direction') == 2 ? 'right' : 'left'); ?> me-1"></i> <?php echo e(trans('labels.previous') == 'labels.previous' ? 'السابق' : trans('labels.previous')); ?>

                                </button>
                                <button type="button" class="btn btn-step btn-next flex-fill" onclick="nextStep()">
                                    <?php echo e(trans('labels.next') == 'labels.next' ? 'التالي' : trans('labels.next')); ?> <i class="fa-solid fa-arrow-<?php echo e(session()->get('direction') == 2 ? 'left' : 'right'); ?> ms-1"></i>
                                </button>
                            </div>
                        </div>

                        
                        <div class="form-step" id="step2">
                            <div class="row">
                                <div class="col-md-6 reg-form-group">
                                    <label for="country"><?php echo e(trans('labels.country')); ?><span class="text-danger">*</span></label>
                                    <select name="country" class="form-select" id="country" required>
                                        <option value=""><?php echo e(trans('labels.select')); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6 reg-form-group">
                                    <label for="city"><?php echo e(trans('labels.city')); ?><span class="text-danger">*</span></label>
                                    <select name="city" class="form-select" id="city" required>
                                        <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    </select>
                                </div>

                                <?php if(@helper::checkaddons('digital_product')): ?>
                                    <div class="col-md-6 reg-form-group">
                                        <label for="store"><?php echo e(trans('labels.store_categories')); ?><span class="text-danger">*</span></label>
                                        <select name="store" class="form-select" id="store" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 reg-form-group">
                                        <label for="product_type"><?php echo e(trans('labels.product_type')); ?><span class="text-danger">*</span></label>
                                        <select name="product_type" class="form-select" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                            <option value="1" <?php echo e(old('store') == 1 ? 'selected' : ''); ?>><?php echo e(trans('labels.physical')); ?></option>
                                            <option value="2" <?php echo e(old('store') == 2 ? 'selected' : ''); ?>><?php echo e(trans('labels.digital')); ?></option>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <div class="col-12 reg-form-group">
                                        <label for="store"><?php echo e(trans('labels.store_categories')); ?><span class="text-danger">*</span></label>
                                        <select name="store" class="form-select" id="store" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>

                                <?php if(@helper::checkaddons('unique_slug')): ?>
                                    <div class="col-12 reg-form-group">
                                        <label for="slug"><?php echo e(trans('labels.personlized_link')); ?><span class="text-danger">*</span></label>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                        <div class="input-group">
                                            <span class="input-group-text col-5 overflow-x-auto <?php echo e(session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : 'rounded-end-0'); ?>" style="border-radius:12px 0 0 12px;"><?php echo e(URL::to('/')); ?>/</span>
                                            <input type="text" class="form-control <?php echo e(session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : 'rounded-start-0'); ?>" id="slug" name="slug" value="<?php echo e(old('slug')); ?>" required style="border-radius:0 12px 12px 0;">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-12 reg-form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="check_terms" id="check_terms" checked required>
                                        <label class="form-check-label" for="check_terms">
                                            <?php echo e(trans('labels.i_accept_the')); ?>

                                            <a href="<?php echo e(URL::to('/termscondition')); ?>" target="_blank" class="fw-bold" style="color:var(--bs-secondary)"><?php echo e(trans('labels.terms')); ?></a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="d-flex gap-2 mt-2">
                                <button type="button" class="btn btn-step btn-prev flex-fill" onclick="prevStep()">
                                    <i class="fa-solid fa-arrow-<?php echo e(session()->get('direction') == 2 ? 'right' : 'left'); ?> me-1"></i> <?php echo e(trans('labels.previous') == 'labels.previous' ? 'السابق' : trans('labels.previous')); ?>

                                </button>
                                <button class="btn btn-step btn-submit flex-fill"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>>
                                    <i class="fa-solid fa-check me-1"></i> <?php echo e(trans('labels.register') == 'labels.register' ? 'إنشاء حساب' : trans('labels.register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php if(env('Environment') == 'sendbox'): ?>
        <button class="btn btn-primary theme-label text-white" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="fa-solid fa-list text-white px-2"></i>
            Themes</button>

        <div class="offcanvas <?php echo e(session()->get('direction') == 2 ? 'offcanvas-start' : 'offcanvas-end '); ?>"
            tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header justify-content-between border-bottom">
                <h5 id="offcanvasRightLabel" class="color-changer">Themes</h5>
                <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="offcanvas"
                    aria-label="Close">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div class="row px-3">
                    <?php for($i = 1; $i <= 10; $i++): ?>
                        <a href="https://store-mart.paponapps.co.in/theme-<?php echo e($i); ?>" target="_blank"
                            class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                            <img src="<?php echo e(helper::image_path('theme-' . $i . '.png')); ?>" class="card-img-top them-name-images">
                            <div class="card-body">
                                <h5 class="card-title text-center color-changer">Theme - <?php echo e($i); ?></h5>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        <?php if(count($errors) > 0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error("<?php echo e($error); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
    <script>
        let currentStep = 0;
        let verifiedMobile = "";

        function sendOtp() {
            const countryCode = $('#country_code').val();
            let mobileInput = $('#mobile_input').val();

            if (!mobileInput.trim()) { toastr.error("رقم الواتساب مطلوب"); $('#mobile_input').focus(); return; }

            // remove leading zero if exists
            if (mobileInput.startsWith('0')) {
                mobileInput = mobileInput.substring(1);
            }

            const fullMobile = countryCode + mobileInput;
            $('#mobile_hidden').val(fullMobile);

            let btn = $('#btn_send_otp');
            let originalContent = btn.html();
            btn.html('<i class="fa-solid fa-spinner fa-spin ms-1"></i> جاري الإرسال...');
            btn.prop('disabled', true);

            // AJAX call to send OTP
            $.ajax({
                url: "<?php echo e(URL::to('admin/whatsapp-otp/send')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    mobile: fullMobile
                },
                success: function(response) {
                    btn.html(originalContent);
                    btn.prop('disabled', false);
                    
                    if(response.success) {
                        toastr.success(response.message);
                        $('#otp_section').removeClass('d-none');
                        $('#btn_send_otp').addClass('d-none');
                        $('#btn_verify_otp').removeClass('d-none');
                        $('#mobile_input').attr('readonly', true);
                        $('#country_code').attr('readonly', true).css('pointer-events', 'none');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    btn.html(originalContent);
                    btn.prop('disabled', false);
                    toastr.error("حدث خطأ أثناء الإرسال. تأكد من الرقم والمحاولة مرة أخرى.");
                }
            });
        }

        function verifyOtp() {
            const otp = $('#otp').val();
            const fullMobile = $('#mobile_hidden').val();

            if (!otp.trim()) { toastr.error("رمز التحقق مطلوب"); $('#otp').focus(); return; }

            let btn = $('#btn_verify_otp');
            let originalContent = btn.html();
            btn.html('<i class="fa-solid fa-spinner fa-spin ms-1"></i> جاري التحقق...');
            btn.prop('disabled', true);

            // AJAX call to verify OTP
            $.ajax({
                url: "<?php echo e(URL::to('admin/whatsapp-otp/verify')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    mobile: fullMobile,
                    otp: otp
                },
                success: function(response) {
                    btn.html(originalContent);
                    btn.prop('disabled', false);

                    if(response.success) {
                        toastr.success(response.message);
                        verifiedMobile = fullMobile;
                        currentStep = 1;
                        updateSteps();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    btn.html(originalContent);
                    btn.prop('disabled', false);
                    toastr.error("حدث خطأ في التحقق.");
                }
            });
        }

        function nextStep() {
            if (currentStep === 1) {
                // Validate step 1 fields
                const name = document.getElementById('name');
                const email = document.getElementById('email');
                const password = document.getElementById('password');

                if (!name.value.trim()) { toastr.error("<?php echo e(trans('labels.name')); ?> <?php echo e(trans('messages.required') ?? 'مطلوب'); ?>"); name.focus(); return; }
                if (!email.value.trim() || !email.checkValidity()) { toastr.error("<?php echo e(trans('labels.email')); ?> <?php echo e(trans('messages.required') ?? 'مطلوب'); ?>"); email.focus(); return; }
                if (!password.value.trim()) { toastr.error("<?php echo e(trans('labels.password')); ?> <?php echo e(trans('messages.required') ?? 'مطلوب'); ?>"); password.focus(); return; }

                currentStep = 2;
                updateSteps();
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                updateSteps();
            }
        }

        function updateSteps() {
            document.getElementById('step0').classList.remove('active');
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step' + currentStep).classList.add('active');

            const c0 = document.getElementById('stepCircle0');
            const c1 = document.getElementById('stepCircle1');
            const c2 = document.getElementById('stepCircle2');
            
            const l0 = document.getElementById('stepLabel0');
            const l1 = document.getElementById('stepLabel1');
            const l2 = document.getElementById('stepLabel2');
            
            const conn0 = document.getElementById('stepConnector0');
            const conn1 = document.getElementById('stepConnector1');

            // Reset all
            c0.className = 'step-circle'; c1.className = 'step-circle'; c2.className = 'step-circle';
            l0.className = 'step-label'; l1.className = 'step-label'; l2.className = 'step-label';
            conn0.classList.remove('filled'); conn1.classList.remove('filled');
            c0.innerHTML = '1'; c1.innerHTML = '2'; c2.innerHTML = '3';

            if (currentStep === 0) {
                c0.className = 'step-circle active';
                l0.className = 'step-label active';
            } else if (currentStep === 1) {
                c0.className = 'step-circle completed';
                c1.className = 'step-circle active';
                l0.className = 'step-label completed';
                l1.className = 'step-label active';
                conn0.classList.add('filled');
                c0.innerHTML = '<i class="fa-solid fa-check"></i>';
            } else if (currentStep === 2) {
                c0.className = 'step-circle completed';
                c1.className = 'step-circle completed';
                c2.className = 'step-circle active';
                
                l0.className = 'step-label completed';
                l1.className = 'step-label completed';
                l2.className = 'step-label active';
                
                conn0.classList.add('filled');
                conn1.classList.add('filled');
                
                c0.innerHTML = '<i class="fa-solid fa-check"></i>';
                c1.innerHTML = '<i class="fa-solid fa-check"></i>';
            }
        }

        // Password toggle
        $(function() {
            $('#eye').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('labels.select')); ?>";
        var cityid = "0";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/auth/register.blade.php ENDPATH**/ ?>