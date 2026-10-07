<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------ breadcrumb ------>
<section class="breadcrumb-sec bg-change-mode">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> active"
                    aria-current="page"><?php echo e(trans('labels.orders')); ?></li>

            </ol>

        </nav>

    </div>

</section>

<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="user-bg-color mb-5">
            <div class="container">
                <div class="row">
                    <?php echo $__env->make('front.theme.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-xl-9 col-lg-8 col-xxl-9 col-12">
                        <div class="border rounded table-box">
                            <div class="card">
                                <div class="settings-box-header border-bottom px-4 py-3">
                                    <h5 class="mb-0 color-changer"><i class="fa-regular fa-user"></i>
                                        <span class="px-2"><?php echo e(trans('labels.orders')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class='d-flex align-items-center pb-2 table-top-box border-bottom mb-3'>
                                        <?php if(helper::appdata($storeinfo->id)->product_type == 1): ?>
                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/orders?type=processing')); ?>"
                                                class="w-100">
                                                <button type='button'
                                                    class="btn-outline-warning border border-warning rounded warning-icon-box px-3 py-3 w-100 bg-light <?php echo e(app('request')->input('type') == 'processing' ? 'preparing-box-active' : 'bg-transparent'); ?> processing-box">
                                                    <span class='warning-icon d-flex align-items-center'>
                                                        <i
                                                            class="fa-regular fa-hourglass d-flex justify-content-center align-items-center color-changer"></i>
                                                        <div class='px-3'>
                                                            <p
                                                                class='text-start-pro color-changer m-0 p-0 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>'>
                                                                <?php echo e($totalprocessing); ?></p>
                                                            <p class='m-0 p-0 color-changer'><?php echo e(trans('labels.preparing')); ?></p>
                                                        </div>
                                                    </span>
                                                </button>
                                            </a>


                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/orders?type=completed')); ?>"
                                                class="w-100 mx-3 delivered-box">
                                                <button type='button'
                                                    class="btn-outline-success border border-success rounded warning-icon-box px-3 py-3 w-100 bg-light <?php echo e(app('request')->input('type') == 'completed' ? 'completed-box-active' : 'bg-transparent'); ?> processing-box">
                                                    <span class='success-icon d-flex align-items-center'>
                                                        <i
                                                            class='fa-regular color-changer fa-circle-check d-flex justify-content-center align-items-center'>
                                                        </i>
                                                        <div class='px-3'>
                                                            <p
                                                                class='text-start-pro color-changer m-0 p-0  <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>'>
                                                                <?php echo e($totalcompleted); ?></p>
                                                            <p class='m-0 p-0 color-changer'><?php echo e(trans('labels.delivered')); ?></p>
                                                        </div>
                                                    </span>
                                                </button>
                                            </a>

                                            <a href="<?php echo e(URL::to($storeinfo->slug . '/orders?type=cancelled')); ?>"
                                                class="w-100 rejected-box">
                                                <button type='button'
                                                    class="btn-outline-danger border border-danger rounded px-3 py-3 w-100 bg-light <?php echo e(app('request')->input('type') == 'cancelled' ? 'rejected-box-active' : 'bg-transparent'); ?>">
                                                    <span class='danger-icon d-flex align-items-center'>
                                                        <i
                                                            class='fa-solid fa-xmark d-flex color-changer justify-content-center align-items-center'></i>
                                                        <div class='px-3'>
                                                            <p
                                                                class='text-start-pro color-changer m-0 p-0 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>'>
                                                                <?php echo e($totalrejected); ?></p>
                                                            <p class='m-0 p-0 color-changer'><?php echo e(trans('labels.cancelled')); ?></p>
                                                        </div>
                                                    </span>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                    </div>



                                    <!-- new order list -->
                                    <div class="row">
                                        <?php if($getorders->count() > 0): ?>
                                            <?php $__currentLoopData = $getorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <a
                                                        href="<?php echo e(URL::to(@$storeinfo->slug . '/find-order?order=' . $orderdata->order_number)); ?>" class="text-muted">
                                                        <div class="card border rounded-2">
                                                            <div class="card-body">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between pb-2">
                                                                    <p
                                                                        class="m-0 fw-semibold color-changer text-uppercase order-number">
                                                                        <?php echo e(trans('labels.id')); ?> :
                                                                        <span class="color-changer"><?php echo e($orderdata->order_number); ?></span>
                                                                    </p>
                                                                    <span
                                                                        class="m-0 text-muted order-date"><?php echo e(helper::date_format($orderdata->created_at, $storeinfo->id)); ?></span>
                                                                </div>

                                                                <p class="text-muted order-payment">
                                                                    <?php echo e(trans('labels.payment_type')); ?> :
                                                                    <span class="text-muted">
                                                                        <?php if($orderdata->payment_type == 6): ?>
                                                                            <?php echo e(@helper::getpayment($orderdata->payment_type, $orderdata->vendor_id)->payment_name); ?>

                                                                            : <small><a
                                                                                    href="<?php echo e(helper::image_path($orderdata->screenshot)); ?>"
                                                                                    target="_blank"
                                                                                    class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                                                                        <?php elseif($orderdata->payment_type == 1): ?>
                                                                            <?php echo e(@helper::getpayment($orderdata->payment_type, $orderdata->vendor_id)->payment_name); ?>

                                                                        <?php elseif(in_array($orderdata->payment_type, [2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15])): ?>
                                                                            <?php echo e(@helper::getpayment($orderdata->payment_type, $orderdata->vendor_id)->payment_name); ?>

                                                                            : <?php echo e($orderdata->payment_id); ?>

                                                                        <?php endif; ?>
                                                                    </span>
                                                                </p>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">

                                                                    <p class="m-0 fw-semibold color-changer">
                                                                        <?php echo e(helper::currency_formate($orderdata->grand_total, $orderdata->vendor_id)); ?>

                                                                    </p>

                                                                    <span class="m-0">
                                                                        <?php if($orderdata->status_type == '1'): ?>
                                                                            <span class="badge text-bg-warning p-2"> <i
                                                                                    class="fa-regular fa-bell"></i>
                                                                                <?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name); ?></span>
                                                                        <?php elseif($orderdata->status_type == '2'): ?>
                                                                            <span class="badge text-bg-info p-2"> <i
                                                                                    class="fa-regular fa-tasks"></i>
                                                                                <?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name); ?></span>
                                                                        <?php elseif($orderdata->status_type == '4'): ?>
                                                                            <span class="badge text-bg-danger p-2"> <i
                                                                                    class="fa-regular fa-close"></i>
                                                                                <?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name); ?></span>
                                                                        <?php elseif($orderdata->status_type == '3'): ?>
                                                                            <span class="badge text-bg-success"> <i
                                                                                    class="fa-regular fa-check"></i>
                                                                                <?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name); ?></span>
                                                                        <?php else: ?>
                                                                            --
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                        <?php $i = 1; ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\orders.blade.php ENDPATH**/ ?>