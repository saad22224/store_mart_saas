<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>


<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">

            <?php echo e(trans('labels.coupon_details')); ?>


        </h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/coupons')); ?>" class="color-changer"><?php echo e(trans('labels.coupons')); ?></a>

                </li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.coupon_details')); ?></li>

            </ol>

        </nav>

    </div>
    <div class="row">
        <div class="col-12 mb-lg-0">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                        <thead>

                            <tr class="text-capitalize fw-500 fs-15">

                                <td><?php echo e(trans('labels.srno')); ?></td>

                                <?php if(Auth::user()->type == 1): ?>
                                    <td><?php echo e(trans('labels.transaction_number')); ?></td>
                                <?php else: ?>
                                    <td><?php echo e(trans('labels.order_number')); ?></td>
                                <?php endif; ?>

                                <td><?php echo e(trans('labels.discount_amount')); ?></td>

                                <td><?php echo e(trans('labels.date')); ?></td>



                            </tr>

                        </thead>
                        <tbody>

                            <?php $i = 1; ?>

                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="fs-7">

                                    <td><?php echo $i++; ?></td>

                                    <?php if(Auth::user()->type == 1): ?>
                                        <td><?php echo e($coupon->transaction_number); ?></td>

                                        <td><?php echo e(helper::currency_formate($coupon->offer_amount, $coupon->vendor_id)); ?></td>
                                    <?php else: ?>
                                        <td><?php echo e($coupon->order_number); ?></td>

                                        <td><?php echo e(helper::currency_formate($coupon->discount_amount, $coupon->vendor_id)); ?>

                                        </td>
                                    <?php endif; ?>

                                    <td><?php echo e(helper::date_format($coupon->created_at, $vendor_id)); ?><br>
                                        <?php echo e(helper::time_format($coupon->created_at, $vendor_id)); ?>


                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\included\coupons\coupon_detail.blade.php ENDPATH**/ ?>