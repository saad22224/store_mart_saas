<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/features')); ?>" class="color-changer"><?php echo e(trans('labels.features')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/features/update-' . $editfeature->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.title')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="title" value="<?php echo e($editfeature->title); ?>"
                                    placeholder="<?php echo e(trans('labels.title')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.description')); ?><span class="text-danger"> *
                                    </span></label>
                                <textarea class="form-control" name="description" placeholder="<?php echo e(trans('labels.description')); ?>" rows="5"
                                    required><?php echo e($editfeature->description); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image">

                                <img src="<?php echo e(helper::image_path($editfeature->image)); ?>"
                                    class="img-fluid rounded hw-50 bg-white p-1 mt-1 object" alt="">
                            </div>
                        </div>
                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/features')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_features', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\features\edit.blade.php ENDPATH**/ ?>