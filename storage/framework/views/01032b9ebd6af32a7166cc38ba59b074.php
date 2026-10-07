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

                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/custom_status')); ?>" class="color-changer"><?php echo e(trans('labels.custom_status')); ?></a></li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>

            </ol>

        </nav>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="<?php echo e(URL::to('admin/custom_status/update-' . $editstatus->id)); ?>" method="POST"
                        enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.status')); ?> <?php echo e(trans('labels.type')); ?><span
                                        class="text-danger"> * </span></label>
                                <input type="hidden" value="<?php echo e($editstatus->type); ?>" name="type" id="type">
                                <select name="status_type" id="status_type" class="form-select" required  <?php echo e($editstatus->type == 1 || $editstatus->type == 3 || $editstatus->type == 4 ? 'disabled' : ''); ?>>
                                <option value="0"><?php echo e(trans('labels.select')); ?></option>
                                    <option value="1" class="<?php echo e($editstatus->type == 1 || $editstatus->type == 3 || $editstatus->type == 4 ? '' : 'd-none'); ?>" <?php echo e($editstatus->type == 1 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.default')); ?></option>

                                    <option value="2"  <?php echo e($editstatus->type == 2 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.process')); ?></option>
                                        
                                    <option value="3" class="<?php echo e($editstatus->type == 1 || $editstatus->type == 3 || $editstatus->type == 4 ? '' : 'd-none'); ?>" <?php echo e($editstatus->type == 3 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.complete')); ?></option>
                                    <option value="4" class="<?php echo e($editstatus->type == 1 || $editstatus->type == 3 || $editstatus->type == 4 ? '' : 'd-none'); ?>" <?php echo e($editstatus->type == 4 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.cancel')); ?></option>
                                </select>

                               

                            </div>
                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.order_type')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="hidden" value="<?php echo e($editstatus->order_type); ?>" name="order" id="order">
                                <select name="order_type" class="form-select" required  <?php echo e($editstatus->type == 1 || $editstatus->type == 3 || $editstatus->type == 4 ? 'disabled' : ''); ?>>

                                    <option value="0"><?php echo e(trans('labels.select')); ?></option>

                                    <option value="1" <?php echo e($editstatus->order_type == 1 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.delivery')); ?></option>

                                    <option value="2" <?php echo e($editstatus->order_type == 2 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.pickup')); ?></option>

                                    <option value="3" <?php echo e($editstatus->order_type == 3 ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.table')); ?></option>
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
                                                <option value="4"
                                                    <?php echo e($editstatus->order_type == 4 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.pos')); ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(@helper::checkaddons('pos')): ?>
                                            <option value="4" <?php echo e($editstatus->order_type == 4 ? 'selected' : ''); ?>>
                                                <?php echo e(trans('labels.pos')); ?></option>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </select>


                            </div>
                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                    </span></label>

                                <input type="text" class="form-control" name="name" value="<?php echo e($editstatus->name); ?>"
                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>

                                

                            </div>

                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">

                                <a href="<?php echo e(URL::to('admin/custom_status')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_status', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $('#status_type').on('change',function(){
            $('#type').val($("#status_type :selected").val());
        })
        $('#order_type').on('change',function(){
            $('#order').val($("#order_type :selected").val());
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\custom_status\edit.blade.php ENDPATH**/ ?>