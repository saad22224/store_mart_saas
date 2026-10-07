<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------ breadcrumb ------>
<section class="breadcrumb-sec bg-change-mode">

    <div class="container">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>

                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> text-dark active"
                    aria-current="page"><?php echo e(trans('labels.wallet')); ?>

                </li>

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
                        <div class="card-v p-0 border rounded user-form">
                            <div class="settings-box">
                                <div class="settings-box-header flex-wrap border-bottom px-4 py-3">
                                    <div class="mb-0 d-flex color-changer align-items-center gap-3">
                                        <i class="fa-light fa-wallet fs-4"></i>
                                        <div>
                                            <span class="fs-5 fw-500">
                                                <?php echo e(trans('labels.wallet_balance')); ?>

                                            </span>
                                            <p class="text-success fs-6 fw-600">
                                                <?php echo e(helper::currency_formate(Auth::user()->wallet, $storeinfo->id)); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto col-12">
                                        <a href="<?php echo e(URL::to($storeinfo->slug . '/wallet/addmoney')); ?>"
                                            class="w-100 border-0 btn btn-store m-0 mt-2 mt-sm-0 align-items-center fs-15 fw-500 justify-content-center p-2 px-3 d-flex gap-2">
                                            <i class="fa-regular fa-plus"></i>
                                            <?php echo e(trans('labels.add_money')); ?>

                                        </a>
                                    </div>
                                </div>
                                <div class="settings-box-body p-3 dashboard-section">
                                    <?php if($gettransactions->count() > 0): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped align-middle table-hover">
                                                <thead class="table-light">
                                                    <tr class="fs-7 fw-600">
                                                        <th scope="col"><?php echo e(trans('labels.date')); ?></th>
                                                        <th scope="col"> <?php echo e(trans('labels.amount')); ?> </th>
                                                        <th scope="col"><?php echo e(trans('labels.remark')); ?></th>
                                                        <th scope="col"><?php echo e(trans('labels.status')); ?></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $__currentLoopData = $gettransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="fs-7">
                                                            <td><?php echo e(helper::date_format($row->created_at, $storeinfo->id)); ?><br>
                                                                <?php echo e(helper::time_format($row->created_at, $storeinfo->id)); ?>

                                                            </td>
                                                            <td>
                                                                <?php if($row->tips > 0): ?>
                                                                    (<?php echo e(helper::currency_formate($row->amount, $storeinfo->id)); ?>

                                                                    +
                                                                    <?php echo e(trans('labels.tips') . ' : ' . helper::currency_formate($row->tips, $storeinfo->id)); ?>)
                                                                <?php else: ?>
                                                                    <?php echo e(helper::currency_formate($row->amount, $storeinfo->id)); ?>

                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($row->transaction_type == 2): ?>
                                                                    <?php echo e(trans('labels.order_placed')); ?>

                                                                    <span><?php echo e($row->order_number); ?> </span>
                                                                <?php elseif($row->transaction_type == 3): ?>
                                                                    <?php echo e(trans('labels.order_cancel')); ?>

                                                                    <span><?php echo e($row->order_number); ?> </span>
                                                                <?php else: ?>
                                                                    <?php echo e(trans('labels.wallet_recharge')); ?>

                                                                    <span><?php echo e(@helper::getpayment($row->payment_type, $storeinfo->id)->payment_name); ?></span>
                                                                    <span><?php echo e($row->payment_id); ?> </span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($row->transaction_type == 2): ?>
                                                                    <div
                                                                        class="badge bg-debit custom-badge bg-cancelled rounded-0">
                                                                        <span> <?php echo e(trans('labels.debit')); ?></span>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div
                                                                        class="badge bg-debit custom-badge rounded-0 bg-completed">
                                                                        <span> <?php echo e(trans('labels.credit')); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-center">
                                                <?php echo e($gettransactions->links()); ?>

                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\matjarhub\resources\views\front\wallet.blade.php ENDPATH**/ ?>