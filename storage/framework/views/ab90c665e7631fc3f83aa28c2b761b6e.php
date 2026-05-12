<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>

    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
        <?php if(@helper::otherappdata(1)->notice_on_off == 1): ?>
            <div class="card mb-3 notice_card border-0 box-shadow" style="border-radius:16px">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                        <div class="d-flex justify-content-between col-12 col-sm-auto">
                            <div class="alert-icons rgb-danger-light col-auto">
                                <i class="fa-regular fa-circle-exclamation text-danger"></i>
                            </div>
                            <div class="d-sm-none">
                                <div class="close-button cursor-pointer" id="close-btn3">
                                    <i class="fa-solid fa-xmark text-danger"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="d-flex gap-2 align-items-center mb-2 justify-content-between">
                                <h6 class="line-2 color-changer fs-17">
                                    <?php echo e(@helper::otherappdata(1)->notice_title); ?>

                                </h6>
                                <div class="d-sm-block d-none">
                                    <div class="close-button cursor-pointer" id="close-btn2">
                                        <i class="fa-solid fa-xmark text-danger"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted fs-13 m-0">
                                <?php echo e(@helper::otherappdata(1)->notice_description); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-800 text-dark color-changer mb-1" style="font-size:1.5rem"><?php echo e(trans('labels.dashboard')); ?></h4>
            <p class="text-muted mb-0" style="font-size:.85rem">مرحباً بك في لوحة التحكم</p>
        </div>
        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
            <button class="btn btn-sm px-3 py-2" id="startTourBtn" onclick="startTour()"
                style="background:linear-gradient(135deg,var(--bs-primary),var(--bs-secondary));color:#fff;border-radius:12px;font-weight:700;font-size:.82rem">
                <i class="fa-solid fa-graduation-cap me-1"></i> دليل الاستخدام
            </button>
        <?php endif; ?>
    </div>

    
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $user = App\Models\User::where('id', $vendor_id)->first();
    ?>

    <div class="row g-3 mb-4">
        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
            <div class="col-xl-3 col-md-6" id="tour-stat-1">
                <div class="card dash-stat-card dash-gradient-1">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="dash-stat-label mb-1"><?php echo e(trans('labels.users')); ?></p>
                                <h3 class="dash-stat-value mb-0"><?php echo e($totalvendors); ?></h3>
                            </div>
                            <div class="dash-stat-icon"><i class="fa-regular fa-user"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card dash-stat-card dash-gradient-2">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="dash-stat-label mb-1"><?php echo e(trans('labels.pricing_plans')); ?></p>
                                <h3 class="dash-stat-value mb-0"><?php echo e($totalplans); ?></h3>
                            </div>
                            <div class="dash-stat-icon"><i class="fa-regular fa-medal"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
            <div class="col-xl-3 col-md-6" id="tour-stat-1">
                <div class="card dash-stat-card dash-gradient-1">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="dash-stat-label mb-1"><?php echo e(trans('labels.products')); ?></p>
                                <h3 class="dash-stat-value mb-0"><?php echo e($totalvendors); ?></h3>
                            </div>
                            <div class="dash-stat-icon"><i class="fa-solid fa-list-timeline"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card dash-stat-card dash-gradient-2">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="dash-stat-label mb-1"><?php echo e(trans('labels.current_plan')); ?></p>
                                <h3 class="dash-stat-value mb-0" style="font-size:1.1rem">
                                    <?php if(!empty($currentplanname)): ?>
                                        <?php echo e(@$currentplanname->name); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="dash-stat-icon"><i class="fa-regular fa-medal"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-3 col-md-6" id="tour-stat-orders">
            <div class="card dash-stat-card dash-gradient-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="dash-stat-label mb-1">
                                <?php echo e(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1) ? trans('labels.transaction') : trans('labels.orders')); ?>

                            </p>
                            <h3 class="dash-stat-value mb-0"><?php echo e($totalorders); ?></h3>
                        </div>
                        <div class="dash-stat-icon">
                            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                                <i class="fa-solid fa-ballot-check"></i>
                            <?php else: ?>
                                <i class="fa-regular fa-cart-shopping"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card dash-stat-card dash-gradient-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="dash-stat-label mb-1"><?php echo e(trans('labels.revenue')); ?></p>
                            <h3 class="dash-stat-value mb-0" style="font-size:1.2rem">
                                <?php echo e(helper::currency_formate($totalrevenue, $vendor_id)); ?></h3>
                        </div>
                        <div class="dash-stat-icon"><i class="fa-regular fa-money-bill-1-wave"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
        <?php
            if ($user->custom_domain == null) {
                $url = URL::to('/' . $user->slug);
            } else {
                $url = 'https://' . $user->custom_domain;
            }
        ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card dash-welcome-card">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="<?php echo e(helper::image_path(@Auth::user()->image)); ?>" class="dash-welcome-avatar"
                                    alt="">
                                <div>
                                    <h5 class="dash-welcome-name mb-1"><?php echo e(@Auth::user()->name); ?></h5>
                                    <p class="dash-welcome-desc mb-2"><?php echo e(trans('labels.dashboard_description')); ?></p>
                                    <div class="dropdown" id="tour-quick-add">
                                        <a class="btn btn-sm px-3 py-1 dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown"
                                            style="background:#fff;color:var(--bs-primary);border-radius:8px;font-weight:700;font-size:.85rem;border:none;box-shadow:0 4px 10px rgba(0,0,0,0.1)">
                                            <i class="fa-regular fa-plus me-1"></i> <?php echo e(trans('labels.quick_add')); ?>

                                        </a>
                                        <ul class="dropdown-menu fw-500 fs-7 text-dark"
                                            style="border-radius:12px;overflow:hidden;border:none;box-shadow:0 10px 40px rgba(0,0,0,0.15)">
                                            <li><a class="dropdown-item py-2 <?php echo e(helper::check_menu(@Auth::user()->role_id, 'role_products') == 1 ? 'd-block' : 'd-none'); ?>"
                                                    href="<?php echo e(URL::to('/admin/products')); ?>"><i
                                                        class="fa-solid fa-box me-2 text-muted"></i><?php echo e(trans('labels.products')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item py-2 <?php echo e(helper::check_menu(@Auth::user()->role_id, 'role_categories') == 1 ? 'd-block' : 'd-none'); ?>"
                                                    href="<?php echo e(URL::to('/admin/categories')); ?>"><i
                                                        class="fa-solid fa-layer-group me-2 text-muted"></i><?php echo e(trans('labels.categories')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item py-2 <?php echo e(helper::check_menu(@Auth::user()->role_id, 'role_settings') == 1 ? 'd-block' : 'd-none'); ?>"
                                                    href="<?php echo e(URL::to('/admin/basic_settings')); ?>"><i
                                                        class="fa-solid fa-gear me-2 text-muted"></i><?php echo e(trans('labels.basic_settings')); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="dash-qr">
                                    <img src="https://qrcode.tec-it.com/API/QRCode?data=<?php echo e($url); ?>&choe=UTF-8"
                                        class="object" style="width:90px;height:90px" alt="">
                                </div>
                                <button class="btn btn-sm px-3 py-2" id="copyButton"
                                    style="background:rgba(255,255,255,0.15);color:#fff;border-radius:10px;font-weight:600;font-size:.82rem;backdrop-filter:blur(10px)">
                                    <i class="fa-regular fa-clone me-1"></i> <?php echo e(trans('labels.copy_link')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row g-3 mb-4">
        <div class="col-md-8" id="tour-chart">
            <div class="card dash-chart-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom justify-content-between">
                        <h5 class="dash-chart-title color-changer m-0"><?php echo e(trans('labels.revenue')); ?></h5>
                        <select class="form-select form-select-sm w-auto" id="revenueyear"
                            data-url="<?php echo e(URL::to('/admin/dashboard')); ?>" style="border-radius:10px">
                            <?php if(count($revenue_years) > 0 && !in_array(date('Y'), array_column($revenue_years->toArray(), 'year'))): ?>
                                <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                            <?php endif; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $revenue_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($revenue->year); ?>" <?php echo e(date('Y') == $revenue->year ? 'selected' : ''); ?>>
                                    <?php echo e($revenue->year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <canvas id="revenuechart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card dash-chart-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                        <h5 class="dash-chart-title color-changer m-0">
                            <?php echo e(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1) ? trans('labels.users') : trans('labels.orders')); ?>

                        </h5>
                        <select class="form-select form-select-sm w-auto" id="doughnutyear"
                            data-url="<?php echo e(request()->url()); ?>" style="border-radius:10px">
                            <?php if(count($doughnut_years) > 0 && !in_array(date('Y'), array_column($doughnut_years->toArray(), 'year'))): ?>
                                <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                            <?php endif; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $doughnut_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $useryear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($useryear->year); ?>"
                                    <?php echo e(date('Y') == $useryear->year ? 'selected' : ''); ?>><?php echo e($useryear->year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
        <?php
            $ran = [
                'gradient-1',
                'gradient-2',
                'gradient-3',
                'gradient-4',
                'gradient-5',
                'gradient-6',
                'gradient-7',
                'gradient-8',
                'gradient-9',
            ];
        ?>
        <div class="row g-3 mb-4">
            <div class="col-xl-6" id="tour-products">
                <div class="card dash-table-card h-100">
                    <div class="card-body p-4">
                        <h5 class="dash-chart-title pb-3 color-changer border-bottom"><?php echo e(trans('labels.top_products')); ?>

                        </h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.image')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.item_name')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.category')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.orders')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($topitems) > 0): ?>
                                        <?php $__currentLoopData = @$topitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="fs-7 fw-500 text-dark align-middle">
                                                <td><img src="<?php echo e(Helper::image_path($row['product_image']->image)); ?>"
                                                        class="rounded hw-50 object" alt=""
                                                        style="border-radius:10px !important"></td>
                                                <td><a href="<?php echo e(URL::to('admin/products/edit-' . $row->slug)); ?>"
                                                        class="td_a"><?php echo e($row->item_name); ?></a></td>
                                                <td><?php echo e(@$row['category_info']->name); ?></td>
                                                <td>
                                                    <?php $per = $getorderdetailscount > 0 ? ($row->item_order_counter * 100) / $getorderdetailscount : 0; ?>
                                                    <?php echo e(number_format($per, 2)); ?>%
                                                    <div class="progress h-10-px" style="border-radius:10px">
                                                        <div class="progress-bar <?php echo e($ran[array_rand($ran, 1)]); ?>"
                                                            style="width:<?php echo e($per); ?>%;border-radius:10px"
                                                            role="progressbar"><span
                                                                class="sr-only"><?php echo e($per); ?>%</span></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card dash-table-card h-100">
                    <div class="card-body p-4">
                        <h5 class="dash-chart-title pb-3 color-changer border-bottom"><?php echo e(trans('labels.top_customers')); ?>

                        </h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.image')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.customer_info')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.customer_email')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.orders')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php if(count($topusers) > 0): ?>
                                        <?php $__currentLoopData = @$topusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="fs-7 fw-500 text-dark align-middle">
                                                <td><img src="<?php echo e(Helper::image_path($user->profile_image)); ?>"
                                                        class="rounded hw-50 object" alt=""
                                                        style="border-radius:10px !important"></td>
                                                <td>
                                                    <div class="fs-7 fw-500 td_a">
                                                        <p><?php echo e($user->name); ?></p>
                                                        <p><?php echo e($user->mobile); ?></p>
                                                    </div>
                                                </td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td>
                                                    <?php echo e(number_format($per, 2)); ?>%
                                                    <div class="progress h-10-px" style="border-radius:10px">
                                                        <div class="progress-bar <?php echo e($ran[array_rand($ran, 1)]); ?>"
                                                            style="width:<?php echo e($per); ?>%;border-radius:10px"
                                                            role="progressbar"><span
                                                                class="sr-only"><?php echo e($per); ?>%</span></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row">
        <div class="col-12" id="tour-orders-table">
            <div class="card dash-table-card">
                <div class="card-body p-4">
                    <h5 class="dash-chart-title color-changer pb-3 border-bottom">
                        <?php echo e(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1) ? trans('labels.today_transaction') : trans('labels.processing_orders')); ?>

                    </h5>
                    <div class="table-responsive">
                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                            <?php echo $__env->make('admin.dashboard.admintransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="tourOverlay"
        style="display:none;position:fixed;inset:0;z-index:9998;background:rgba(0,0,0,0.65);transition:opacity .3s"></div>
    <div id="tourTooltip"
        style="display:none;position:fixed;z-index:10001;background:#fff;border-radius:16px;padding:1.25rem 1.5rem;box-shadow:0 20px 60px rgba(0,0,0,0.25);max-width:340px;min-width:280px">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
        <script>
            var copyBtn = document.getElementById('copyButton');
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    var urlToCopy = "<?php echo e(@$url); ?>";
                    var tempInput = document.createElement('input');
                    tempInput.value = urlToCopy;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);
                    toastr.success('تم نسخ الرابط!');
                });
            }
        </script>
    <?php endif; ?>

    
    <script type="text/javascript">
        var doughnut = null;
        var doughnutlabels = <?php echo e(Js::from($doughnutlabels)); ?>;
        var doughnutdata = <?php echo e(Js::from($doughnutdata)); ?>;
    </script>
    <script type="text/javascript">
        var revenuechart = null;
        var labels = <?php echo e(Js::from($revenuelabels)); ?>;
        var revenuedata = <?php echo e(Js::from($revenuedata)); ?>;
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/dashboard.js')); ?>"></script>

    
    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
        <script>
            (function() {
                const steps = [{
                        el: '#tour-stat-1',
                        title: 'إحصائيات المتجر',
                        desc: 'هنا تقدر تشوف إحصائيات متجرك - عدد المنتجات والطلبات والإيرادات.',
                        position: 'bottom'
                    },
                    {
                        el: '#tour-quick-add',
                        title: 'إضافة سريعة',
                        desc: 'من هنا تقدر تضيف منتجات وأقسام وإعدادات بسرعة بدون ما تدور في القوائم.',
                        position: 'bottom'
                    },
                    {
                        el: '#tour-chart',
                        title: 'تقارير الإيرادات',
                        desc: 'رسم بياني يوضح لك إيرادات متجرك على مدار السنة. تقدر تختار سنة مختلفة.',
                        position: 'bottom'
                    },
                    {
                        el: '#tour-orders-table',
                        title: 'الطلبات الجارية',
                        desc: 'جدول بالطلبات اللي محتاجة متابعة. تقدر تغير حالة الطلب من هنا.',
                        position: 'top'
                    },
                    {
                        el: '.sidebar',
                        title: 'القائمة الجانبية',
                        desc: 'من القائمة الجانبية تقدر تتنقل بين كل أقسام لوحة التحكم.',
                        position: 'right'
                    }
                ];
                let idx = 0;
                let prevHighlight = null;

                window.startTour = function() {
                    idx = 0;
                    show();
                };

                function show() {
                    const overlay = document.getElementById('tourOverlay');
                    const tip = document.getElementById('tourTooltip');

                    // Clean previous
                    if (prevHighlight) {
                        prevHighlight.style.position = '';
                        prevHighlight.style.zIndex = '';
                        prevHighlight.style.boxShadow = '';
                        prevHighlight.style.borderRadius = '';
                    }

                    if (idx >= steps.length) {
                        window.endTour();
                        return;
                    }

                    const s = steps[idx];
                    const el = document.querySelector(s.el);
                    if (!el) {
                        idx++;
                        show();
                        return;
                    }

                    overlay.style.display = 'block';

                    // Highlight element
                    el.style.position = 'relative';
                    el.style.zIndex = '9999';
                    el.style.boxShadow = '0 0 0 4px #6366f1, 0 0 30px rgba(99,102,241,0.3)';
                    el.style.borderRadius = '12px';
                    prevHighlight = el;

                    // Scroll
                    if (s.el !== '.sidebar') {
                        el.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    setTimeout(function() {
                        const r = el.getBoundingClientRect();
                        let t, l;

                        if (s.position === 'bottom') {
                            t = r.bottom + 12;
                            l = r.left + r.width / 2 - 160;
                        } else if (s.position === 'top') {
                            t = r.top - 200;
                            l = r.left + r.width / 2 - 160;
                        } else if (s.position === 'right') {
                            t = r.top + r.height / 2 - 80;
                            l = r.right + 12;
                        } else {
                            t = r.top + r.height / 2 - 80;
                            l = r.left - 355;
                        }

                        // Clamp to viewport
                        t = Math.max(10, Math.min(t, window.innerHeight - 220));
                        l = Math.max(10, Math.min(l, window.innerWidth - 360));

                        tip.style.top = t + 'px';
                        tip.style.left = l + 'px';
                        tip.style.display = 'block';
                        tip.style.animation = 'none';
                        tip.offsetHeight; // trigger reflow
                        tip.style.animation = 'tourPop .3s ease';

                        tip.innerHTML =
                            '<div style="font-size:1rem;font-weight:800;color:#1e293b;margin-bottom:.35rem">' + s
                            .title + '</div>' +
                            '<div style="font-size:.82rem;color:#64748b;margin-bottom:1rem;line-height:1.6">' + s
                            .desc + '</div>' +
                            '<div style="display:flex;justify-content:space-between;align-items:center">' +
                            '<span style="font-size:.7rem;color:#94a3b8;font-weight:600">' + (idx + 1) + ' / ' +
                            steps.length + '</span>' +
                            '<div style="display:flex;gap:6px">' +
                            '<button onclick="window.endTour()" style="padding:6px 12px;border-radius:8px;font-size:.78rem;font-weight:600;border:none;background:transparent;color:#94a3b8;cursor:pointer">تخطي</button>' +
                            (idx > 0 ?
                                '<button onclick="window.prevTourStep()" style="padding:6px 12px;border-radius:8px;font-size:.82rem;font-weight:700;border:none;background:#f1f5f9;color:#64748b;cursor:pointer">السابق</button>' :
                                '') +
                            '<button onclick="window.nextTourStep()" style="padding:6px 14px;border-radius:8px;font-size:.82rem;font-weight:700;border:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;cursor:pointer">' +
                            (idx === steps.length - 1 ? 'إنهاء ✓' : 'التالي ←') + '</button>' +
                            '</div>' +
                            '</div>';
                    }, 500);
                }

                window.nextTourStep = function() {
                    idx++;
                    show();
                };
                window.prevTourStep = function() {
                    if (idx > 0) {
                        idx--;
                        show();
                    }
                };
                window.endTour = function() {
                    document.getElementById('tourOverlay').style.display = 'none';
                    document.getElementById('tourTooltip').style.display = 'none';
                    if (prevHighlight) {
                        prevHighlight.style.position = '';
                        prevHighlight.style.zIndex = '';
                        prevHighlight.style.boxShadow = '';
                        prevHighlight.style.borderRadius = '';
                        prevHighlight = null;
                    }
                    // Clear session flag via AJAX
                    fetch("<?php echo e(URL::to('admin/onboarding/clear-session')); ?>", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    });
                };

                document.getElementById('tourOverlay').addEventListener('click', window.endTour);

                // Auto-start for new vendors
                <?php if(session('new_vendor')): ?>
                    setTimeout(window.startTour, 1500);
                <?php endif; ?>
            })();
        </script>

        <style>
            @keyframes tourPop {
                from {
                    opacity: 0;
                    transform: scale(.92)
                }

                to {
                    opacity: 1;
                    transform: scale(1)
                }
            }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>