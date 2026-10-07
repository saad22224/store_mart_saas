<?php $__env->startSection('content'); ?>
<?php
    if (Auth::user()->type == 4) {
    $vendor_id = Auth::user()->vendor_id;
    } else {
    $vendor_id = Auth::user()->id;
    }
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/testimonials')); ?>" class="color-changer"><?php echo e(trans('labels.testimonials')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/testimonials/update-' . $edittestimonial->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo e($edittestimonial->name); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>
                               
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.position')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="position"
                                    value="<?php echo e($edittestimonial->position); ?>" placeholder="<?php echo e(trans('labels.position')); ?>"
                                    required>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.ratting')); ?><span class="text-danger"> *
                                    </span></label>
                                <select name="rating" class="form-select">
                                    <option value="1" <?php echo e($edittestimonial->star == 1 ? 'selected' : ''); ?>>1</option>
                                    <option value="2" <?php echo e($edittestimonial->star == 2 ? 'selected' : ''); ?>>2</option>
                                    <option value="3" <?php echo e($edittestimonial->star == 3 ? 'selected' : ''); ?>>3</option>
                                    <option value="4" <?php echo e($edittestimonial->star == 4 ? 'selected' : ''); ?>>4</option>
                                    <option value="5" <?php echo e($edittestimonial->star == 5 ? 'selected' : ''); ?>>5</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?><span class="text-danger">
                                        * </span></label>
                                <input type="file" class="form-control" name="image"
                                    placeholder="<?php echo e(trans('labels.image')); ?>">
                                <img src="<?php echo e(helper::image_path($edittestimonial->image)); ?>"
                                    class="img-fluid rounded hw-50 mt-1 object" alt="">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.description')); ?><span class="text-danger"> *
                                    </span></label>
                                <textarea class="form-control" name="description" placeholder="<?php echo e(trans('labels.description')); ?>" rows="5"
                                    required><?php echo e($edittestimonial->description); ?></textarea>
                               
                            </div>

                        </div>
                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/testimonials')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_testimonials', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\included\testimonial\edit.blade.php ENDPATH**/ ?>