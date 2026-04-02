<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/language-settings')); ?>" class="color-changer"><?php echo e(trans('labels.languages')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/language-settings/update-' . $getlanguage->id)); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-3 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="layout" class="col-form-label"><?php echo e(trans('labels.layout')); ?> <span
                                            class="text-danger"> *
                                        </span></label>
                                    <select name="layout" class="form-control layout-dropdown" id="layout" required>
                                        <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                        <option value="1"<?php echo e($getlanguage->layout == '1' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.ltr')); ?></option>
                                        <option value="2"<?php echo e($getlanguage->layout == '2' ? 'selected' : ''); ?>>
                                            <?php echo e(trans('labels.rtl')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="layout" class="col-form-label"><?php echo e(trans('labels.image')); ?></label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="<?php echo e(helper::image_path($getlanguage->image)); ?>"
                                        class="img-fluid rounded hw-50 mt-1 object" alt="">
                                </div>

                            </div>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/language-settings')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_language_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/included/language/edit.blade.php ENDPATH**/ ?>