<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="d-flex justify-content-between mb-3">
        <h5 class="text-capitalize align-items-center text-dark color-changer fs-4">
            <?php echo e(request()->is('admin/report*') ? trans('labels.report') : trans('labels.orders')); ?></h5>
        <?php if(request()->is('admin/report*')): ?>
            <form action="<?php echo e(URL::to('/admin/report')); ?>" class="mb-">
                <div class="input-group col-md-12 ps-0 justify-content-end gap-2">
                    <?php if($getcustomerslist->count() > 0): ?>
                        <div
                            class="input-group-append col-auto px-1 <?php echo e(Auth::user()->type == 4 ? (helper::check_menu(Auth::user()->role_id, 'role_customers') == 1 ? '' : 'd-none') : ''); ?>">
                            <select name="customer_id" class="form-select rounded">
                                <option value=""><?php echo e(trans('labels.select_customer')); ?></option>
                                <?php $__currentLoopData = $getcustomerslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getcustomer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($getcustomer->id); ?>"
                                        <?php echo e($getcustomer->id == @$_GET['customer_id'] ? 'selected' : ''); ?>>
                                        <?php echo e($getcustomer->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="input-group-append col-auto">
                        <input type="date" class="form-control rounded p-2" name="startdate"
                            <?php if(isset($_GET['startdate'])): ?>
                             value="<?php echo e($_GET['startdate']); ?>" <?php endif; ?>
                            required>
                    </div>
                    <div class="input-group-append col-auto">
                        <input type="date" class="form-control rounded p-2" name="enddate"
                            <?php if(isset($_GET['enddate'])): ?>
                             value="<?php echo e($_GET['enddate']); ?>" <?php endif; ?>
                            required>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded fs-15 fw-500"
                            type="submit"><?php echo e(trans('labels.fetch')); ?></button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <?php echo $__env->make('admin.orders.statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title color-changer" id="paymentModalLabel"><?php echo e(trans('labels.record_payment')); ?></h5>
                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                        <i class="fa-regular fa-xmark color-changer fs-4"></i>
                    </button>
                </div>
                <form action=" <?php echo e(URL::to('admin/orders/payment_status-' . '2')); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div>
                            <input type="hidden" id="booking_number" name="booking_number" value="">
                            <div class="form-group">
                                <label for="modal_total_amount" class="form-label">
                                    <?php echo e(trans('labels.total')); ?> <?php echo e(trans('labels.amount')); ?>

                                </label>
                                <input type="text" class="form-control numbers_only" name="modal_total_amount"
                                    id="modal_total_amount" disabled value="">
                            </div>
                            <div class="form-group">
                                <label for="modal_amount" class="form-label">
                                    <?php echo e(trans('labels.cash_received')); ?>

                                </label>
                                <input type="text" class="form-control numbers_only" name="modal_amount"
                                    id="modal_amount" value="" onkeyup="validation($(this).val())">
                            </div>
                            <div class="form-group">
                                <label for="modal_amount" class="form-label">
                                    <?php echo e(trans('labels.change_amount')); ?>

                                </label>
                                <input type="number" class="form-control" name="ramin_amount" id="ramin_amount"
                                    value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary px-sm-4"><?php echo e(trans('labels.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function codpayment(booking_number, grand_total) {
            $('#modal_total_amount').val(grand_total);
            $('#booking_number').val(booking_number);
            $('#paymentModal').modal('show');
        }

        function validation(value) {
            var remaining = $('#modal_total_amount').val() - value;
            $('#ramin_amount').val(remaining.toFixed(2));
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>