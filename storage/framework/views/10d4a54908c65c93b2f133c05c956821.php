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
                        href="<?php echo e(URL::to('admin/currencys')); ?>" class="color-changer"><?php echo e(trans('labels.currency')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/currencys/currency_store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <input type="hidden" name="code" id="code">
                                <label class="form-label"><?php echo e(trans('labels.code')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="currency" id="currency"
                                    value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(trans('labels.currency')); ?>" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.currency_symbol')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="currency_symbol"
                                    value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(trans('labels.currency_symbol')); ?>"
                                    required>

                            </div>

                            <div class="form-group text-<?php echo e(session()->get('direction') == '2' ? 'start' : 'end'); ?> m-0">
                                <a href="<?php echo e(URL::to('admin/currencys')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency-settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
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
        $(document).ready(function() {
            "user strict";
            $('#code').val($('#currency').val());
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/currency_settings/currencys/add.blade.php ENDPATH**/ ?>