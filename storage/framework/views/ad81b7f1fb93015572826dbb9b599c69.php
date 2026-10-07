<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new') ?? 'إضافة ثيم جديد'); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark">
                    <a href="<?php echo e(URL::to('admin/themes')); ?>" class="color-changer"><?php echo e(trans('labels.themes') ?? 'الثيمات'); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow rounded-4">
                <div class="card-body p-4">
                    <form action="<?php echo e(URL::to('/admin/themes/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label class="form-label fw-bold"><?php echo e(trans('labels.name')); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="أدخل اسم الثيم" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fw-bold"><?php echo e(trans('labels.image')); ?> <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label fw-bold"><?php echo e(trans('labels.link') ?? 'رابط معاينة الثيم'); ?></label>
                                <input type="url" class="form-control" name="link" value="<?php echo e(old('link')); ?>" placeholder="https://example.com/demo-theme">
                                <small class="text-muted fs-8">أدخل رابط العرض المباشر (Demo Preview Link) ليتمكن التاجر من رؤية الثيم وتجربته قبل الطلب.</small>
                            </div>
                        </div>
                        <div class="mt-4 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/themes')); ?>" class="btn btn-outline-secondary px-sm-4 me-2"><?php echo e(trans('labels.cancel')); ?></a>
                            <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?> class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\theme\add.blade.php ENDPATH**/ ?>