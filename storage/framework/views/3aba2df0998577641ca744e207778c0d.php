
<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/whoweare')); ?>" class="color-changer"><?php echo e(trans('labels.who_we_are')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/whoweare/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.title')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>"
                                    placeholder="<?php echo e(trans('labels.title')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.description')); ?><span class="text-danger"> *
                                    </span></label>
                                <textarea name="description" class="form-control" rows="5" placeholder="<?php echo e(trans('labels.description')); ?>"
                                    required><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>
                        <div class="mt-3 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/whoweare')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_who_we_are', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/who_we_are/add.blade.php ENDPATH**/ ?>