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
            <h4 class="fw-bold color-changer text-dark m-0">
                <i class="fa-solid fa-palette text-primary me-2"></i><?php echo e(trans('labels.themes') ?? 'الثيمات'); ?>

            </h4>
            <p class="text-muted fs-7 m-0">
                <?php echo e(Auth::user()->type == 1 ? 'إدارة ثيمات النظام وروابط المعاينة والصور' : 'استعرض الثيمات المتاحة لمتجرك واطلب تفعيل الثيم المناسب باختيارك'); ?>

            </p>
        </div>

        <?php if(Auth::user()->type == 1): ?>
            <div class="d-flex align-items-center" style="gap: 10px;">
                <?php if(@helper::checkaddons('bulk_delete')): ?>
                    <button id="bulkDeleteBtn"
                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/themes/bulk_delete')); ?>')" <?php endif; ?>
                        class="btn btn-danger hov btn-sm d-none d-flex align-items-center gap-1" tooltip="<?php echo e(trans('labels.delete')); ?>">
                        <i class="fa-regular fa-trash"></i> <?php echo e(trans('labels.delete')); ?>

                    </button>
                <?php endif; ?>

                <a href="<?php echo e(URL::to('admin/themes/add')); ?>" class="btn btn-secondary px-sm-4 d-flex align-items-center gap-1">
                    <i class="fa-regular fa-plus"></i> <?php echo e(trans('labels.add') ?? 'إضافة ثيم جديد'); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if(Auth::user()->type == 1): ?>
        
        <div class="row">
            <div class="col-12">
                <div class="card border-0 mb-3 box-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                                <thead>
                                    <tr class="text-capitalize fw-500 fs-15">
                                        <td></td>
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <?php if($themes->count() > 0): ?>
                                                <td><input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td>#</td>
                                        <td><?php echo e(trans('labels.image')); ?></td>
                                        <td><?php echo e(trans('labels.name')); ?></td>
                                        <td><?php echo e(trans('labels.link') ?? 'رابط المعاينة'); ?></td>
                                        <td><?php echo e(trans('labels.created_date')); ?></td>
                                        <td><?php echo e(trans('labels.action')); ?></td>
                                    </tr>
                                </thead>
                                <tbody id="tabledetails" data-url="<?php echo e(url('admin/themes/reorder_theme')); ?>">
                                    <?php $i = 1; ?>
                                    <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($theme->id); ?>" data-id="<?php echo e($theme->id); ?>">
                                            <td>
                                                <a tooltip="<?php echo e(trans('labels.move')); ?>">
                                                    <i class="fa-light fa-up-down-left-right mx-2"></i>
                                                </a>
                                            </td>
                                            <?php if(@helper::checkaddons('bulk_delete')): ?>
                                                <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($theme->id); ?>"></td>
                                            <?php endif; ?>
                                            <td><?php echo e($i++); ?></td>
                                            <td>
                                                <img src="<?php echo e(helper::image_path($theme->image)); ?>" class="img-fluid rounded hw-50 object-fit-cover" alt="<?php echo e($theme->name); ?>">
                                            </td>
                                            <td class="fw-bold"><?php echo e($theme->name); ?></td>
                                            <td>
                                                <?php $link = $theme->preview_link ?? $theme->link; ?>
                                                <?php if(!empty($link) && $link != '#'): ?>
                                                    <a href="<?php echo e($link); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fs-8">
                                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> <?php echo e(trans('labels.preview') ?? 'معاينة'); ?>

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
                                                    <a href="<?php echo e(URL::to('/admin/themes/edit-' . $theme->id)); ?>" class="btn btn-info hov btn-sm" tooltip="<?php echo e(trans('labels.edit')); ?>">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/themes/delete-' . $theme->id)); ?>')" <?php endif; ?>
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
                    $previewUrl = !empty($theme->preview_link) ? $theme->preview_link : (!empty($theme->link) ? $theme->link : '#');
                    $waText = urlencode('مرحباً، أريد طلب تفعيل ثيم: (' . $theme->name . ') لمتجري.');
                    $waPhone = !empty($adminWhatsapp) ? preg_replace('/[^0-9]/', '', $adminWhatsapp) : '';
                    $waLink = !empty($waPhone) ? "https://api.whatsapp.com/send?phone={$waPhone}&text={$waText}" : "https://api.whatsapp.com/send?text={$waText}";
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden theme-card-vendor hover-lift transition-all">
                        <div class="position-relative overflow-hidden bg-light" style="aspect-ratio: 16/10;">
                            <img src="<?php echo e(helper::image_path($theme->image)); ?>" class="w-100 h-100 object-fit-cover theme-preview-img" alt="<?php echo e($theme->name); ?>">
                            <div class="theme-card-overlay d-flex align-items-center justify-content-center gap-2">
                                <?php if($previewUrl != '#'): ?>
                                    <a href="<?php echo e($previewUrl); ?>" target="_blank" class="btn btn-light rounded-pill px-4 fw-bold text-dark shadow">
                                        <i class="fa-solid fa-eye me-1"></i> <?php echo e(trans('labels.preview') ?? 'معاينة الثيم'); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between bg-white">
                            <div>
                                <h5 class="fw-bold text-dark mb-2"><?php echo e($theme->name); ?></h5>
                                <p class="text-muted fs-7 mb-4">تصميم مميز وعصري يناسب هويتك التجارية ويرفع معدل المبيعات.</p>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-auto">
                                <?php if($previewUrl != '#'): ?>
                                    <a href="<?php echo e($previewUrl); ?>" target="_blank" class="btn btn-outline-secondary rounded-pill flex-fill fw-bold btn-sm py-2">
                                        <i class="fa-solid fa-eye me-1"></i> معاينة
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e($waLink); ?>" target="_blank" class="btn btn-success rounded-pill flex-fill fw-bold btn-sm py-2 d-flex align-items-center justify-content-center gap-1 shadow-sm">
                                    <i class="fa-brands fa-whatsapp fs-5"></i> طلب الثيم عبر واتساب
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <div class="card border-0 shadow-sm p-5 rounded-4">
                        <i class="fa-solid fa-palette fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted fw-bold">لا توجد ثيمات متاحة حالياً</h5>
                        <p class="text-muted fs-7 mb-0">يرجى التواصل مع الإدارة للاستفسار عن الباقات والثيمات المتوفرة.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <style>
            .theme-card-vendor { transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.06) !important; }
            .theme-card-vendor:hover { transform: translateY(-6px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
            .theme-preview-img { transition: transform 0.5s ease; }
            .theme-card-vendor:hover .theme-preview-img { transform: scale(1.05); }
            .theme-card-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.4); opacity: 0; transition: all 0.3s ease; }
            .theme-card-vendor:hover .theme-card-overlay { opacity: 1; }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\theme\index.blade.php ENDPATH**/ ?>