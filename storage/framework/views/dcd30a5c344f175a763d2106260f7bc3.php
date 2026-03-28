<html>

<head>
    <title><?php echo e(helper::appdata($getorderdata->vendor_id)->web_title); ?></title>
</head>
<style type="text/css">
    body {
        font-family: 'DejaVu Sans', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .w-33 {
        width: 33.33%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0"><?php echo e(trans('labels.invoice')); ?></h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.invoice_id')); ?> - <span
                    class="gray-color">#<?php echo e($getorderdata->id); ?></span></p>
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.order_id')); ?> -
                <span class="gray-color">#<?php echo e($getorderdata->order_number); ?></span>
            </p>
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.order_date')); ?> -
                <span
                    class="gray-color"><?php echo e(helper::date_format($getorderdata->created_at, $getorderdata->vendor_id)); ?></span>
            </p>
            <?php if(helper::appdata($getorderdata->vendor_id)->ordertype_date_time == 1): ?>
                <?php if($getorderdata->order_from != 'pos' && $getorderdata->order_type != 3): ?>
                    <?php if($getorderdata->delivery_date != '' && $getorderdata->delivery_date != null): ?>
                        <p class="m-0 pt-5 text-bold w-100">
                            <?php echo e($getorderdata->order_type == 1 ? trans('labels.delivery_date') : trans('labels.pickup_date')); ?>

                            -
                            <span
                                class="gray-color"><?php echo e(helper::date_format($getorderdata->delivery_date, $getorderdata->vendor_id)); ?></span>
                        </p>
                    <?php endif; ?>
                    <?php if($getorderdata->delivery_time != '' && $getorderdata->delivery_time != null): ?>
                        <p class="m-0 pt-5 text-bold w-100">
                            <?php echo e($getorderdata->order_type == 1 ? trans('labels.delivery_time') : trans('labels.pickup_time')); ?>

                            -
                            <span class="gray-color"><?php echo e($getorderdata->delivery_time); ?></span>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th colspan="2" class="w-50"><?php echo e(trans('labels.customer_info')); ?></th>
            </tr>
            <tr>
                <td>
                    <div class="box-text">
                        <p><i class="fa-regular fa-user"></i> <?php echo e($getorderdata->customer_name); ?></p>
                        <p><i class="fa-regular fa-phone"></i> <?php echo e($getorderdata->mobile); ?> </p>
                        <p><i class="fa-regular fa-envelope"></i> <?php echo e($getorderdata->customer_email); ?></p>
                    </div>
                </td>
                <?php if($getorderdata->order_type == 1): ?>
                    <td>
                        <div class="box-text">
                            <p><?php echo e($getorderdata->address); ?>,</p>
                            <p><?php echo e($getorderdata->building); ?>,</p>
                            <p><?php echo e($getorderdata->landmark); ?></p>
                            <p><?php echo e($getorderdata->pincode); ?>.</p>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-33"><?php echo e(trans('labels.payment_options')); ?></th>
                <th class="w-33"><?php echo e(trans('labels.shipping_method')); ?></th>
                <?php if(@helper::checkaddons('vendor_tip')): ?>
                    <?php if(@helper::otherappdata($getorderdata->vendor_id)->tips_settings == 1): ?>
                        <th class="w-33"><?php echo e(trans('labels.tips')); ?></th>
                    <?php endif; ?>
                <?php endif; ?>
            </tr>
            <tr>
                <td>
                    <?php if($getorderdata->payment_type == 0): ?>
                        <?php echo e(trans('labels.online')); ?>

                    <?php elseif($getorderdata->payment_type == 6): ?>
                        <?php echo e(@helper::getpayment($getorderdata->payment_type, $getorderdata->vendor_id)->payment_name); ?>

                        : <small>
                            <a href="<?php echo e(helper::image_path($transaction->screenshot)); ?>" target="_blank"
                                class="text-danger"><?php echo e(trans('labels.click_here')); ?></a>
                        </small>
                    <?php else: ?>
                        <?php echo e(@helper::getpayment($getorderdata->payment_type, $getorderdata->vendor_id)->payment_name); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <?php if($getorderdata->order_type == 1): ?>
                        <?php echo e(trans('labels.delivery')); ?>

                    <?php elseif($getorderdata->order_type == 2): ?>
                        <?php echo e(trans('labels.pickup')); ?>

                    <?php elseif($getorderdata->order_type == 3): ?>
                        <?php echo e(trans('labels.table')); ?>

                    <?php elseif($getorderdata->order_type == 4): ?>
                        <?php echo e(trans('labels.pos')); ?>

                    <?php endif; ?>
                </td>
                <?php if(@helper::checkaddons('vendor_tip')): ?>
                    <?php if(@helper::otherappdata($getorderdata->vendor_id)->tips_settings == 1): ?>
                        <td>
                            <?php echo e(helper::currency_formate($getorderdata->tips, $getorderdata->vendor_id)); ?>

                        </td>
                    <?php endif; ?>
                <?php endif; ?>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50"><?php echo e(trans('labels.product_name')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.unit_cost')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.qty')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.sub_total')); ?></th>
            </tr>
            <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr align="center">
                    <td><?php echo e($orders->item_name); ?>

                        <?php if($orders->variants_id != ''): ?>
                            - <small><?php echo e($orders->variants_name); ?>

                                (<?php echo e(helper::currency_formate($orders->variants_price, $getorderdata->vendor_id)); ?>)</small>
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
                    <?php
                        $price = (float) $extras_total_price + (float) $orders->variants_price;
                        $total = (float) $price * (float) $orders->qty;
                    ?>
                    <td> <?php echo e(helper::currency_formate($price, $getorderdata->vendor_id)); ?>

                    </td>
                    <td><?php echo e($orders->qty); ?></td>
                    <td> <?php echo e(helper::currency_formate($total, $getorderdata->vendor_id)); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="4">
                    <div class="total-part">
                        <?php
                            $tax = explode('|', $getorderdata->tax);
                            $tax_name = explode('|', $getorderdata->tax_name);
                        ?>
                        <div class="total-left w-85 float-left" align="left">
                            <p><?php echo e(trans('labels.sub_total')); ?></p>
                            <?php if($getorderdata->discount_amount > 0): ?>
                                <p><?php echo e(trans('labels.discount')); ?><?php echo e($getorderdata->couponcode != '' ? '(' . $getorderdata->couponcode . ')' : ''); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($getorderdata->tax != null && $getorderdata->tax != ''): ?>
                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($tax_name[$key]); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if($getorderdata->order_type == 1): ?>
                                <p><?php echo e(trans('labels.delivery')); ?>

                                    <?php if($getorderdata->delivery_area != ''): ?>
                                        (<?php echo e($getorderdata->delivery_area); ?>)
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            <p><strong><?php echo e(trans('labels.grand_total')); ?></strong></p>
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">
                            <p><?php echo e(helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id)); ?></p>
                            <?php if($getorderdata->discount_amount > 0): ?>
                                <p><?php echo e(helper::currency_formate($getorderdata->discount_amount, $getorderdata->vendor_id)); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($getorderdata->tax != null && $getorderdata->tax != ''): ?>
                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e(helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id)); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </p>
                            <?php if($getorderdata->order_type == 1): ?>
                                <p>
                                    <?php if($getorderdata->delivery_charge > 0): ?>
                                        <?php echo e(helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id)); ?>

                                    <?php else: ?>
                                        <?php echo e(trans('labels.free')); ?>

                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            <p> <strong><?php echo e(helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id)); ?></strong>
                            </p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/orders/invoicepdf.blade.php ENDPATH**/ ?>