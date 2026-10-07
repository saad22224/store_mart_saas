<?php $__env->startSection('content'); ?>

    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>

    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 color-changer text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/custom_status')); ?>" class="color-changer"><?php echo e(trans('labels.custom_status')); ?></a></li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>

            </ol>

        </nav>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="<?php echo e(URL::to('admin/custom_status/save')); ?>" method="POST" enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.status')); ?> <?php echo e(trans('labels.type')); ?><span
                                        class="text-danger"> * </span></label>
                                <select name="status_type" class="form-select" required>
                                    <option value="0"><?php echo e(trans('labels.select')); ?></option>
                                    <option value="2"><?php echo e(trans('labels.process')); ?></option>
                                </select>

                              
                            </div>
                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.order_type')); ?><span class="text-danger"> *
                                    </span></label>

                                <select name="order_type" class="form-select" required>

                                    <option value="0"><?php echo e(trans('labels.select')); ?></option>

                                    <option value="1"><?php echo e(trans('labels.delivery')); ?></option>

                                    <option value="2"><?php echo e(trans('labels.pickup')); ?></option>

                                    <option value="3"><?php echo e(trans('labels.table')); ?></option>

                                    <?php if(@helper::checkaddons('subscription')): ?>
                                        <?php if(@helper::checkaddons('pos')): ?>
                                            <?php
                                                $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                    ->orderByDesc('id')
                                                    ->first();
                                                if (helper::getslug($vendor_id)->allow_without_subscription == 1) {
                                                    $pos = 1;
                                                } else {
                                                    $pos = @$checkplan->pos;
                                                }
                                            ?>
                                            <?php if($pos == 1): ?>
                                                <option value="4">
                                                    <?php echo e(trans('labels.pos')); ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(@helper::checkaddons('pos')): ?>
                                            <option value="4">
                                                <?php echo e(trans('labels.pos')); ?></option>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </select>

                             

                            </div>

                            <div class="form-group col-md-12">

                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                    </span></label>

                                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>

                               

                            </div>

                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">

                                <a href="<?php echo e(URL::to('admin/custom_status')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\custom_status\add.blade.php ENDPATH**/ ?>