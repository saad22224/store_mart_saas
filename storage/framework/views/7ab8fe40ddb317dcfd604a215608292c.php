<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>


<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.invoice')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <?php if(Auth::user()->type == 1): ?>
                    <li class="breadcrumb-item text-dark">
                        <a href="<?php echo e(URL::to('admin/customers/orders-' . $getorderdata->user_id)); ?>"
                            class="color-changer"><?php echo e(trans('labels.orders')); ?></a>
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item text-dark">
                        <a href="<?php echo e(URL::to('admin/orders')); ?>" class="color-changer"><?php echo e(trans('labels.orders')); ?></a>
                    </li>
                <?php endif; ?>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.invoice')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <?php if($getorderdata->status_type == 3 || $getorderdata->status_type == 4): ?>
            <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
                <div class="col-md-12 my-2 d-flex justify-content-end">
                    <?php if($getorderdata->status_type == '1'): ?>
                        <span class="px-sm-4 btn btn-warning">
                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name); ?>

                        </span>
                    <?php elseif($getorderdata->status_type == '2'): ?>
                        <span class="px-sm-4 btn btn-info">
                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name); ?>

                        </span>
                    <?php elseif($getorderdata->status_type == '3'): ?>
                        <span class="px-sm-4 btn btn-success">
                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name); ?>

                        </span>
                    <?php elseif($getorderdata->status_type == '4'): ?>
                        <span class="px-sm-4 btn btn-danger">
                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name); ?>

                        </span>
                    <?php else: ?>
                        --
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="col-md-12 my-2 d-flex justify-content-end">
                    <?php if($orderdata->status_type == '3'): ?>
                        <span class="px-sm-4 btn btn-success"><?php echo e(trans('labels.completed')); ?></span>
                    <?php elseif($orderdata->status_type == '4'): ?>
                        <span class="px-sm-4 btn btn-danger"><?php echo e(trans('labels.cancelled')); ?></span>
                    <?php else: ?>
                        --
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="col-md-12 my-2 d-flex justify-content-end">
                <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
                    <?php if($getorderdata->status_type != 3 || $getorderdata->status_type != 4): ?>
                        <div class="lag-btn dropdown">
                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle py-2 px-sm-4"
                                data-bs-toggle="dropdown"><?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $vendor_id)->name); ?></button>
                            <div
                                class="dropdown-menu rounded mt-1 p-0 bg-body-secondary shadow border-0 overflow-hidden <?php echo e(Auth::user()->type == 1 ? 'disabled' : ''); ?>">
                                <?php $__currentLoopData = helper::customstauts($getorderdata->vendor_id, $getorderdata->order_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="dropdown-item w-auto cursor-pointer p-2 <?php if($getorderdata->status == $status->id): ?> fw-600 <?php endif; ?>"
                                        onclick="statusupdate('<?php echo e(URL::to('admin/orders/update-' . $getorderdata->id . '-' . $status->id . '-' . $status->type)); ?>')"><?php echo e($status->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-between g-3">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card border-0 mb-3 h-100 d-flex box-shadow">
                        <div
                            class="card-header border-bottom d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark color-changer"><i class="fa-solid fa-clipboard fs-5"></i>
                                <?php echo e(trans('labels.order_details')); ?></h6>
                        </div>
                        <div class="card-body">

                            <div class="basic-list-group">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        <p class="color-changer"><?php echo e(trans('labels.order_number')); ?></p>
                                        <p class="text-dark color-changer fw-600"><?php echo e($getorderdata->order_number); ?></p>
                                    </li>
                                    <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                        <p class="color-changer"><?php echo e(trans('labels.order_date')); ?></p>
                                        <p class="text-muted">
                                            <?php echo e(helper::date_format($getorderdata->created_at, $vendor_id)); ?></p>
                                    </li>
                                    <?php if(helper::appdata($vendor_id)->ordertype_date_time == 1): ?>
                                        <?php if($getorderdata->order_from != 'pos' && $getorderdata->order_type != 3): ?>
                                            <?php if($getorderdata->delivery_date != '' && $getorderdata->delivery_date != null): ?>
                                                <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                    <p class="color-changer">
                                                        <?php echo e($getorderdata->order_type == 1 ? trans('labels.delivery_date') : trans('labels.pickup_date')); ?>

                                                    </p>
                                                    <p class="text-muted">
                                                        <?php echo e(helper::date_format($getorderdata->delivery_date, $vendor_id)); ?>

                                                    </p>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($getorderdata->delivery_time != '' && $getorderdata->delivery_time != null): ?>
                                                <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                    <p class="color-changer">
                                                        <?php echo e($getorderdata->order_type == 1 ? trans('labels.delivery_time') : trans('labels.pickup_time')); ?>

                                                    </p>
                                                    <p class="text-muted"><?php echo e($getorderdata->delivery_time); ?></p>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    
                                    <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                        <p class="color-changer"><?php echo e(trans('labels.payment_type')); ?></p>
                                        <span class="text-muted">
                                            <?php if($getorderdata->payment_type == 0): ?>
                                                <?php echo e(trans('labels.online')); ?>

                                            <?php elseif($getorderdata->payment_type == 6): ?>
                                                <?php echo e(@helper::getpayment($getorderdata->payment_type, $getorderdata->vendor_id)->payment_name); ?>

                                                : <small><a href="<?php echo e(helper::image_path($getorderdata->screenshot)); ?>"
                                                        target="_blank"
                                                        class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                                            <?php else: ?>
                                                <?php echo e(@helper::getpayment($getorderdata->payment_type, $getorderdata->vendor_id)->payment_name); ?>

                                            <?php endif; ?>
                                        </span>
                                    </li>
                                    <?php if(@helper::checkaddons('vendor_tip')): ?>
                                        <?php if(@helper::otherappdata($getorderdata->vendor_id)->tips_settings == 1): ?>
                                            <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                <p class="color-changer"><?php echo e(trans('labels.tips_pro')); ?></p>
                                                <p class="text-muted">
                                                    <?php echo e(helper::currency_formate($getorderdata->tips, $getorderdata->vendor_id)); ?>

                                                </p>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array($getorderdata->payment_type, [2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15])): ?>
                                        <li class="list-group-item px-0 fs-7 fw-500">
                                            <p class="color-changer"><?php echo e(trans('labels.payment_id')); ?></p>
                                            <p class="text-muted">
                                                <?php echo e($getorderdata->payment_id); ?>

                                            </p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($getorderdata->order_notes != ''): ?>
                                        <li class="list-group-item px-0 fs-7 fw-500">
                                            <p class="color-changer"><?php echo e(trans('labels.notes')); ?></p>
                                            <p class="text-muted">
                                                <?php echo e($getorderdata->order_notes); ?>

                                            </p>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card border-0 mb-3 h-100 d-flex box-shadow">
                        <div
                            class="card-header border-bottom d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark color-changer"><i class="fa-solid fa-user fs-5"></i>
                                <?php echo e(trans('labels.customer')); ?></h6>
                            <p class="text-muted cursor-pointer "
                                onclick="editcustomerdata('<?php echo e($getorderdata->order_number); ?>','<?php echo e($getorderdata->customer_name); ?>','<?php echo e($getorderdata->mobile); ?>','<?php echo e($getorderdata->customer_email); ?>','<?php echo e(str_replace(',', '|', $getorderdata->address)); ?>','<?php echo e(str_replace(',', '|', $getorderdata->building)); ?>','<?php echo e(str_replace(',', '|', $getorderdata->landmark)); ?>','<?php echo e($getorderdata->pincode); ?>','customer_info')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        <ul class="list-group list-group-flush">

                                            <li
                                                class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                <p class="color-changer">الاسم الكامل</p>
                                                <p class="text-muted"> <?php echo e($getorderdata->customer_name); ?></p>
                                            </li>

                                            <?php if($getorderdata->mobile != null): ?>
                                                <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                    <p class="color-changer"><?php echo e(trans('labels.mobile')); ?></p>
                                                    <p class="text-muted"><?php echo e($getorderdata->mobile); ?></p>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card border-0 mb-3 h-100 d-flex box-shadow">

                        <div
                            class="card-header border-bottom d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark color-changer"><i class="fa-solid fa-file-invoice fs-5"></i>
                                <?php if($getorderdata->order_type == 3 or $getorderdata->order_type == 4 or $getorderdata->order_type == 5): ?>
                                    <?php echo e(trans('labels.info')); ?>

                                <?php else: ?>
                                    <?php echo e(trans('labels.bill_to')); ?>

                                <?php endif; ?>
                            </h6>
                            <?php if($getorderdata->order_type == 1): ?>
                                <p class="text-muted cursor-pointer"
                                    onclick="editcustomerdata('<?php echo e($getorderdata->order_number); ?>','<?php echo e($getorderdata->customer_name); ?>','<?php echo e($getorderdata->mobile); ?>','<?php echo e($getorderdata->customer_email); ?>','<?php echo e(str_replace(',', '|', $getorderdata->address)); ?>','<?php echo e(str_replace(',', '|', $getorderdata->building)); ?>','<?php echo e(str_replace(',', '|', $getorderdata->landmark)); ?>','<?php echo e($getorderdata->pincode); ?>','delivery_info')">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <?php if($getorderdata->order_type == 1): ?>
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <?php if($getorderdata->order_from == 'pos'): ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p class="color-changer"><?php echo e(trans('labels.pos')); ?></p>
                                                            <p class="text-muted"> <?php echo e(trans('labels.dine_in')); ?></p>
                                                        </li>
                                                    <?php else: ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p class="color-changer"><?php echo e(trans('labels.address')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->address); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                            <p class="color-changer"><?php echo e(trans('labels.building')); ?></p>
                                                            <p class="text-muted"><?php echo e($getorderdata->building); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                            <p class="color-changer"><?php echo e(trans('labels.landmark')); ?></p>
                                                            <p class="text-muted"><?php echo e($getorderdata->landmark); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between">
                                                            <p class="color-changer"><?php echo e(trans('labels.pincode')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->pincode); ?>.</p>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php elseif($getorderdata->order_type == 2): ?>
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <?php if($getorderdata->order_from == 'pos'): ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p class="color-changer"><?php echo e(trans('labels.order_type')); ?></p>
                                                            <p class="text-muted"> <?php echo e(trans('labels.takeaway')); ?></p>
                                                        </li>
                                                    <?php else: ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p class="color-changer"><?php echo e(trans('labels.order_type')); ?></p>
                                                            <p class="text-muted"> <?php echo e(trans('labels.pickup')); ?></p>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php elseif($getorderdata->order_type == 3): ?>
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p class="color-changer"><?php echo e(trans('labels.table')); ?></p>
                                                        <p class="text-muted">
                                                            (<?php echo e($getorderdata->dinein_tablename != '' ? $getorderdata->dinein_tablename : '-'); ?>)
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php elseif($getorderdata->order_type == 4): ?>
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p class="color-changer"><?php echo e(trans('labels.pos')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php elseif($getorderdata->order_type == 5): ?>
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p class="color-changer"><?php echo e(trans('labels.digital')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card border-0 mb-3 h-100 d-flex box-shadow">
                        <div
                            class="card-header border-bottom d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark color-changer"><i class="fa-solid fa-clipboard fs-5"></i>
                                <?php echo e(trans('labels.notes')); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        <?php if($getorderdata->vendor_note != ''): ?>
                                            <div class="alert alert-info" role="alert">
                                                <?php echo e($getorderdata->vendor_note); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <form action="<?php echo e(URL::to('admin/orders/vendor_note')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group col-md-12">
                                    <label for="note" class="form-label"> <?php echo e(trans('labels.note')); ?> </label>
                                    <div class="controls">
                                        <input type="hidden" name="order_id" class="form-control"
                                            value="<?php echo e($getorderdata->order_number); ?>">
                                        <input type="text" name="vendor_note" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <button
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                                        class="btn btn-primary"> <?php echo e(trans('labels.update')); ?> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 mt-3 box-shadow">
                <div
                    class="card-header border-bottom d-flex align-items-center justify-content-between bg-transparent text-dark py-3">
                    <h6 class="px-2 fw-500 color-changer text-dark">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <?php echo e(trans('labels.orders')); ?>

                    </h6>
                    <a href="<?php echo e(URL::to('admin/orders/print/' . $getorderdata->order_number)); ?>" target="_blank"
                        class="btn btn-secondary px-sm-4 <?php echo e(Auth::user()->type == 1 ? 'disabled' : ''); ?> <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_orders', Auth::user()->role_id, $vendor_id, 'manage') == 1 ? '' : 'd-none') : ''); ?>">
                        <?php echo e(trans('labels.print')); ?>

                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td><?php echo e(trans('labels.products')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.unit_cost')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.qty')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.sub_total')); ?></td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="align-middle fs-7 fw-500">
                                        <td><?php echo e($orders->item_name); ?>

                                            <?php if($orders->variants_id != ''): ?>
                                                - <small><?php echo e($orders->variants_name); ?>

                                                    (<?php echo e(helper::currency_formate($orders->variants_price, $getorderdata->vendor_id)); ?>)
                                                </small>
                                            <?php endif; ?>
                                            <?php if($orders->extras_id != ''): ?>
                                                <?php
                                                    $extras_id = explode('|', $orders->extras_id);
                                                    $extras_name = explode('|', $orders->extras_name);
                                                    $extras_price = explode('|', $orders->extras_price);
                                                    $extras_total_price = 0;
                                                ?>
                                                <br>
                                                <?php $__currentLoopData = $extras_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <small>
                                                        <b class="text-muted"><?php echo e($extras_name[$key]); ?></b> :
                                                        <?php echo e(helper::currency_formate($extras_price[$key], $getorderdata->vendor_id)); ?><br>
                                                    </small>
                                                    <?php
                                                        $extras_total_price += $extras_price[$key];
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php
                                                    $extras_total_price = 0;
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e(helper::currency_formate((float) $orders->variants_price + (float) $extras_total_price, $getorderdata->vendor_id)); ?>

                                        </td>
                                        <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e($orders->qty); ?></td>
                                        <?php
                                            $total =
                                                ((float) $orders->variants_price + (float) $extras_total_price) *
                                                (float) $orders->qty;
                                        ?>
                                        <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e(helper::currency_formate($total, $getorderdata->vendor_id)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-15 fw-500 p-2"
                                        colspan="3">
                                        <?php echo e(trans('labels.sub_total')); ?>

                                    </td>
                                    <td
                                        class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-500 p-2">
                                        <?php echo e(helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id)); ?>

                                    </td>
                                </tr>
                                <?php if($getorderdata->discount_amount > 0): ?>
                                    <tr>
                                        <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-15 fw-500 p-2"
                                            colspan="3">
                                            <?php echo e(trans('labels.discount')); ?><?php echo e($getorderdata->couponcode != '' ? '(' . $getorderdata->couponcode . ')' : ''); ?>

                                        </td>
                                        <td
                                            class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-500 p-2">
                                            -<?php echo e(helper::currency_formate($getorderdata->discount_amount, $getorderdata->vendor_id)); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php
                                    $tax = explode('|', $getorderdata->tax);
                                    $tax_name = explode('|', $getorderdata->tax_name);
                                ?>
                                <?php if($getorderdata->tax != null && $getorderdata->tax != ''): ?>
                                    <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-15 fw-500 p-2"
                                                colspan="3">
                                                <?php echo e($tax_name[$key]); ?>

                                            </td>
                                            <td
                                                class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-500 p-2">
                                                <?php echo e(helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id)); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($getorderdata->order_type == 1): ?>
                                    <tr>
                                        <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-15 fw-500 p-2"
                                            colspan="3">
                                            <?php echo e(trans('labels.delivery')); ?>

                                            <?php if($getorderdata->delivery_area != ''): ?>
                                                (<?php echo e($getorderdata->delivery_area); ?>)
                                            <?php endif; ?>
                                        </td>
                                        <td
                                            class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-500 p-2">
                                            <?php if($getorderdata->delivery_charge > 0): ?>
                                                <?php echo e(helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id)); ?>

                                            <?php else: ?>
                                                <?php echo e(trans('labels.free')); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-600 p-2 text-success"
                                        colspan="3">
                                        <?php echo e(trans('labels.total')); ?> <?php echo e(trans('labels.amount')); ?>

                                    </td>
                                    <td
                                        class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?> fs-16 fw-600 p-2 text-success">
                                        <?php echo e(helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id)); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customerinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title color-changer" id="modalbankdetailsLabel"><?php echo e(trans('labels.edit')); ?></h5>
                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('admin/orders/customerinfo')); ?>" method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="order_id" id="modal_order_id" class="form-control" value="">
                        <input type="hidden" name="edit_type" id="edit_type" class="form-control" value="">
                        <div id="customer_info">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_name"> الاسم الكامل
                                </label>
                                <div class="controls">
                                    <input type="text" name="customer_name" id="customer_name" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_mobile"> <?php echo e(trans('labels.mobile')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="customer_mobile" id="customer_mobile"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="display:none;">
                                <label class="form-label" for="customer_email"> <?php echo e(trans('labels.email')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="customer_email" id="customer_email" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="delivery_info">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_address"> <?php echo e(trans('labels.address')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="customer_address" id="customer_address"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_building"> <?php echo e(trans('labels.building')); ?>

                                </label>
                                <div class="controls">
                                    <input type="text" name="customer_building" id="customer_building"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_landmark"> <?php echo e(trans('labels.landmark')); ?>

                                </label>
                                <div class="controls">
                                    <input type="text" name="customer_landmark" id="customer_landmark"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label" for="customer_pincode"> <?php echo e(trans('labels.pincode')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="customer_pincode" id="customer_pincode"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4"
                            data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4"> <?php echo e(trans('labels.save')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/orders/invoice.blade.php ENDPATH**/ ?>