<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold color-changer text-dark m-0 d-flex align-items-center gap-2">
                <i class="fa-solid fa-palette text-success"></i> الثيمات
            </h4>
            <p class="text-muted fs-7 m-0 mt-1">
                <?php echo e(Auth::user()->type == 1 ? 'إدارة الثيمات المعروضة للتجار وإضافة صور وروابط المعاينة' : 'اختر الثيم المناسب لمتجرك واطلب تفعيله مباشرة'); ?>

            </p>
        </div>

        <?php if(Auth::user()->type == 1): ?>
            <div class="d-flex align-items-center" style="gap: 10px;">
                <a href="<?php echo e(URL::to('admin/vendor_themes/add')); ?>" class="btn btn-primary px-sm-4 d-flex align-items-center gap-2 rounded-pill shadow-sm">
                    <i class="fa-regular fa-plus"></i> إضافة ثيم جديد
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if(Auth::user()->type == 1): ?>
        
        <div class="row">
            <div class="col-12">
                <div class="card border-0 mb-3 box-shadow rounded-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                                <thead>
                                    <tr class="text-capitalize fw-500 fs-15">
                                        <td>#</td>
                                        <td><?php echo e(trans('labels.image')); ?></td>
                                        <td><?php echo e(trans('labels.name')); ?></td>
                                        <td>رابط المعاينة (Preview Link)</td>
                                        <td><?php echo e(trans('labels.created_date')); ?></td>
                                        <td><?php echo e(trans('labels.action')); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 align-middle">
                                            <td><?php echo e($i++); ?></td>
                                            <td>
                                                <img src="<?php echo e(helper::image_path($theme->image)); ?>" class="img-fluid rounded-3 hw-60 object-fit-cover shadow-sm" alt="<?php echo e($theme->name); ?>">
                                            </td>
                                            <td class="fw-bold fs-6"><?php echo e($theme->name); ?></td>
                                            <td>
                                                <?php if(!empty($theme->preview_link) && $theme->preview_link != '#'): ?>
                                                    <a href="<?php echo e($theme->preview_link); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fs-8">
                                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> معاينة المباشرة
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted fs-8">غير محدد</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e(helper::date_format($theme->created_at, $vendor_id)); ?><br>
                                                <?php echo e(helper::time_format($theme->created_at, $vendor_id)); ?>

                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="<?php echo e(URL::to('/admin/vendor_themes/edit-' . $theme->id)); ?>" class="btn btn-info hov btn-sm text-white" tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/vendor_themes/delete-' . $theme->id)); ?>')" <?php endif; ?>
                                                        class="btn btn-danger hov btn-sm">
                                                        <i class="fa-regular fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        
        <div class="row g-4 mb-5">
            <?php $__empty_1 = true; $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $previewUrl = !empty($theme->preview_link) ? $theme->preview_link : '#';
                    $waText = urlencode('مرحباً، أريد طلب تفعيل ثيم: (' . $theme->name . ') لمتجري.');
                    $waPhone = !empty($adminWhatsapp) ? preg_replace('/[^0-9]/', '', $adminWhatsapp) : '';
                    $waLink = !empty($waPhone) ? "https://api.whatsapp.com/send?phone={$waPhone}&text={$waText}" : "https://api.whatsapp.com/send?text={$waText}";
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="card h-100 bg-white border shadow-sm rounded-4 overflow-hidden easy-theme-card">
                        <!-- Theme Image Area -->
                        <div class="easy-theme-img-wrap position-relative p-3 bg-light text-center">
                            <img src="<?php echo e(helper::image_path($theme->image)); ?>" class="img-fluid rounded-4 shadow-sm easy-theme-img" alt="<?php echo e($theme->name); ?>">
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                            <div>
                                <!-- Theme Title -->
                                <h4 class="fw-bold text-dark mb-2"><?php echo e($theme->name); ?></h4>
                                
                                <!-- Category Pill -->
                                <div class="d-flex justify-content-center mb-4">
                                    <span class="easy-category-pill">تصميم متجر متعدد الفئات</span>
                                </div>
                            </div>

                            <!-- Bottom Action Row (3 items match screenshot) -->
                            <div class="d-flex align-items-center justify-content-between gap-2 mt-2 pt-2 border-top">
                                <!-- Badge Tag -->
                                <span class="easy-badge-pill">مجاني</span>

                                <!-- Preview Button -->
                                <?php if($previewUrl != '#'): ?>
                                    <a href="<?php echo e($previewUrl); ?>" target="_blank" class="easy-btn-preview text-decoration-none">
                                        <i class="fa-regular fa-eye me-1"></i> معاينة
                                    </a>
                                <?php else: ?>
                                    <button class="easy-btn-preview" disabled>
                                        <i class="fa-regular fa-eye me-1"></i> معاينة
                                    </button>
                                <?php endif; ?>

                                <!-- WhatsApp Request Button -->
                                <a href="<?php echo e($waLink); ?>" target="_blank" class="easy-btn-whatsapp text-decoration-none">
                                    <i class="fa-brands fa-whatsapp fs-6 me-1"></i> طلب الثيم
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <div class="card border-0 shadow-sm p-5 rounded-4">
                        <i class="fa-solid fa-palette fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted fw-bold">لا توجد ثيمات متاحة حالياً</h5>
                        <p class="text-muted fs-7 mb-0">سيتم إضافة ثيمات جديدة قريباً من قبل الإدارة.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <style>
            /* Easy Orders exact UI card styling */
            .easy-theme-card {
                border: 1px solid #e5e7eb !important;
                transition: all 0.3s ease;
            }

            .easy-theme-card:hover {
                box-shadow: 0 12px 30px rgba(0,0,0,0.08) !important;
                transform: translateY(-4px);
            }

            .easy-theme-img-wrap {
                background: #f9fafb;
                border-bottom: 1px solid #f3f4f6;
            }

            .easy-theme-img {
                max-height: 320px;
                width: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }

            .easy-theme-card:hover .easy-theme-img {
                transform: scale(1.02);
            }

            .easy-category-pill {
                background: #f3f4f6;
                color: #4b5563;
                border: 1px solid #e5e7eb;
                padding: 6px 18px;
                border-radius: 30px;
                font-size: 13px;
                font-weight: 600;
                display: inline-block;
            }

            .easy-badge-pill {
                background: #dcfce7;
                color: #16a34a;
                font-weight: 700;
                font-size: 14px;
                padding: 8px 18px;
                border-radius: 12px;
                display: inline-block;
            }

            .easy-btn-preview {
                background: #ffffff;
                color: #374151;
                border: 1px solid #d1d5db;
                font-weight: 600;
                font-size: 14px;
                padding: 8px 16px;
                border-radius: 12px;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .easy-btn-preview:hover {
                background: #f3f4f6;
                color: #111827;
                border-color: #9ca3af;
            }

            .easy-btn-whatsapp {
                background: #10b981;
                color: #ffffff;
                font-weight: 700;
                font-size: 14px;
                padding: 8px 18px;
                border-radius: 12px;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            }

            .easy-btn-whatsapp:hover {
                background: #059669;
                color: #ffffff;
                box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
                transform: translateY(-1px);
            }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\vendor_themes\index.blade.php ENDPATH**/ ?>