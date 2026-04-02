<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="breadcrumb-sec bg-change-mode">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark"><a class="text-dark color-changer"
                        href="<?php echo e(URL::to($storeinfo->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                </li>
                <li class="text-muted breadcrumb-item <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> text-dark active"
                    aria-current="page"><?php echo e(trans('labels.order_details')); ?></li>
            </ol>
        </nav>
    </div>
</section>
<?php if(Auth::user() && Auth::user()->type == 3 && request()->has('order')): ?>
<?php else: ?>
    <section class="order_detail py-3">
        <div class="container">
            <div class="row align-items-center justify-content-between mb-5">
                <div class="col-lg-6">
                    <img src="<?php echo e(helper::image_path(helper::appdata($storeinfo->id)->order_detail_image)); ?>"
                        class="w-100 mb-5 mb-lg-0" alt="tracking">
                </div>
                <div class="col-lg-6 col-xl-5">
                    <h2 class="track-title color-changer text-truncate"><?php echo e(trans('labels.track_orders')); ?></h2>
                    <p class="text-muted mb-4 line-3 fs-7"><?php echo e(trans('labels.track_order_message')); ?></p>
                    <form action="<?php echo e(URL::to(@$storeinfo->slug . '/find-order')); ?>" method="get">
                        <label class="form-label label14"><?php echo e(trans('labels.order_id')); ?></label>
                        <div class="input-group mb-4">
                            <input type="text" class="form-control rounded-2 p-3" name="order"
                                value="<?php echo e($order_number); ?>" placeholder="<?php echo e(trans('labels.find_order_placeholder')); ?>"
                                required>
                        </div>
                        <button class="btn btn-store w-100" type="submit"
                            id="track_here"><?php echo e(trans('labels.track_here')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(!empty($getorderdata)): ?>
    <section class="order_details">
        <div class="container">
            <?php if(Auth::user() && Auth::user()->type == 3): ?>
            <?php else: ?>
                <h2 class="text-center mb-4 text-dark fw-bold color-changer"><?php echo e(trans('labels.order_details')); ?></h2>
            <?php endif; ?>
            <!-- Your Order details -->
            <div class="card rounded-2 bg-light mb-3">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-9 col-lg-8 col-xl-6">
                            <div class="d-md-flex justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center justify-contente-between py-2">
                                        <span class="text-dark color-changer fw-bold"><?php echo e(trans('labels.order_id')); ?> :&nbsp;</span>
                                        <div class="fw-bold text-secondary">#<?php echo e($order_number); ?></div>
                                    </div>

                                    <?php if(helper::appdata($getorderdata->vendor_id)->product_type == 1 &&
                                            helper::appdata($getorderdata->vendor_id)->ordertype_date_time == 1): ?>
                                        <?php if($getorderdata->delivery_date): ?>
                                            <div class="d-flex align-items-center text-muted justify-contente-between py-2">
                                                <span class="text-dark color-changer fw-bold">
                                                    <?php echo e(trans('labels.order_date')); ?>

                                                    :&nbsp;
                                                </span><?php echo e(helper::date_format($getorderdata->delivery_date, $storeinfo->id)); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php elseif(helper::appdata($getorderdata->vendor_id)->product_type == 2): ?>
                                        <div class="d-flex align-items-center text-muted justify-contente-between py-2">
                                            <span class="text-dark color-changer fw-bold"><?php echo e(trans('labels.order_date')); ?>

                                                :&nbsp;</span><?php echo e(helper::date_format($getorderdata->created_at, $storeinfo->id)); ?>

                                            
                                        </div>
                                    <?php endif; ?>
                                    <?php if(helper::appdata($getorderdata->vendor_id)->product_type == 1): ?>
                                        <div class="d-flex align-items-center text-muted justify-contente-between py-2">
                                            <span class="text-dark color-changer fw-bold"><?php echo e(trans('labels.order')); ?>

                                                <?php echo e(trans('labels.status')); ?>

                                                :&nbsp;</span>
                                            <?php if($getorderdata->status_type == 1): ?>
                                                <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                            <?php elseif($getorderdata->status_type == 2): ?>
                                                <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                            <?php elseif($getorderdata->status_type == 4): ?>
                                                <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                            <?php elseif($getorderdata->status_type == 3): ?>
                                                <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="px-sm-2">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 bg-transparent">
                                            <span class="text-dark color-changer fw-bold"><?php echo e(trans('labels.order_type')); ?>

                                                :&nbsp;</span>
                                            <span class="text-muted">
                                                <?php if($getorderdata->order_type == 1): ?>
                                                    <?php echo e(trans('labels.delivery')); ?>

                                                <?php elseif($getorderdata->order_type == 2): ?>
                                                    <?php echo e(trans('labels.pickup')); ?>

                                                <?php elseif($getorderdata->order_type == 3): ?>
                                                    <?php echo e(trans('labels.table')); ?>

                                                    (<?php echo e($getorderdata->dinein_tablename != '' ? $getorderdata->dinein_tablename : '-'); ?>)
                                                <?php elseif($getorderdata->order_type == 4): ?>
                                                    <?php echo e(trans('labels.pos')); ?>

                                                <?php elseif($getorderdata->order_type == 5): ?>
                                                    <?php echo e(trans('labels.digital')); ?>

                                                <?php endif; ?>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 bg-transparent">
                                            <span class="text-dark color-changer fw-bold"><?php echo e(trans('labels.payment_type')); ?>

                                                :&nbsp;</span>
                                            <span class="text-muted">
                                                <?php echo e(@helper::getpayment($getorderdata->payment_type, $storeinfo->id)->payment_name); ?>

                                            </span>
                                        </li>
                                    </ul>
                                    <?php if(@helper::checkaddons('vendor_tip')): ?>
                                        <?php if(@helper::otherappdata($storeinfo->id)->tips_settings == 1): ?>
                                            <div class="d-flex align-items-center justify-contente-between py-2">
                                                <span class="text-dark color-changer fw-bold">
                                                    <?php echo e(trans('labels.tips_pro')); ?> :&nbsp;
                                                </span>
                                                <span class="text-muted">
                                                    <?php echo e(helper::currency_formate($getorderdata->tips, $storeinfo->id)); ?>

                                                </span>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(
                            ($getorderdata->status_type == 1 && helper::appdata($storeinfo->id)->product_type == 1) ||
                                (helper::appdata($storeinfo->id)->product_type == 2 && $getorderdata->payment_status == 1)): ?>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-2">
                                <a class="btn btn-store fw-500  <?php echo e(session()->get('direction') == 2 ? 'float-start' : 'float-end'); ?>"
                                    href="<?php echo e(URL::to(@$storeinfo->slug . '/cancel-order/' . $order_number)); ?>"
                                    onclick="#"><?php echo e(trans('labels.cancel_order')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between g-4">
                <!-- Delivery Info -->
                <div
                    class="<?php echo e(helper::appdata($storeinfo->id)->product_type == 1 && $getorderdata->order_type == 1 ? 'col-md-6 d-block' : 'd-none'); ?> col-12">
                    <div class="order-add h-100 rounded-2 bg-light card">
                        <h5 class="customer-title border-bottom pb-2">
                            <span class="custom-icon color-changer d-flex m-0">
                                <i class="fa-light fa-truck-ramp-box"></i>
                                <span class="px-2 checkoutform-title m-0"><?php echo e(trans('labels.delivery_info')); ?></span>
                            </span>
                        </h5>
                        <span class="color-changer"><?php echo e(trans('labels.address')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->address); ?></p>
                        <span class="color-changer"><?php echo e(trans('labels.building')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->building); ?></p>
                        <span class="color-changer"><?php echo e(trans('labels.landmark')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->landmark); ?></p>
                        <span class="color-changer"><?php echo e(trans('labels.pincode')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->pincode); ?></p>
                    </div>
                </div>
                <!-- Customer Info -->
                <div
                    class="<?php echo e(helper::appdata($storeinfo->id)->product_type == 1 && $getorderdata->order_type == 1 ? 'col-md-6' : 'col-md-12'); ?> col-12">
                    <div class="order-add h-100 rounded-2 bg-light card">
                        <h5 class="customer-title border-bottom pb-2">
                            <span class="custom-icon color-changer d-flex m-0">
                                <i class="fa-light fa-user "></i>
                                <span class="px-2 checkoutform-title m-0"><?php echo e(trans('labels.customer_info')); ?></span>
                            </span>
                        </h5>
                        <span class="color-changer"><?php echo e(trans('labels.name')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->customer_name); ?></p>
                        <span class="color-changer"><?php echo e(trans('labels.email')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->customer_email); ?></p>
                        <span class="color-changer"><?php echo e(trans('labels.mobile')); ?></span>
                        <p class="border-bottom color-changer"><?php echo e($getorderdata->mobile); ?></p>
                    </div>
                </div>
            </div>
            <?php if($getorderdata->vendor_note != null && $getorderdata->vendor_note != ''): ?>
                <div class="card rounded-0 mt-4 card-shadow bg-light">
                    <div class="card-body">
                        <h5 class="customer-title color-changer border-bottom pb-2 mb-4">
                            <i class="fa-light fa-comment-dots"></i>
                            <span class="px-2 checkoutform-title"><?php echo e(trans('labels.vendor_note')); ?></span>
                        </h5>
                        <p class="line-2 text-capitalize text-muted"><?php echo e($getorderdata->vendor_note); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row my-4">
                <div class="col-md-12 col-lg-7 col-xl-8 mb-4 mb-lg-0">
                    <!-- order Summary -->
                    <div class="card bg-light rounded-2">
                        <div class="card-body">
                            <h5 class="payment-title border-bottom pb-2 m-0">
                                <span class="custom-icon color-changer">
                                    <i class="fa-light fa-box-archive"></i>
                                    <span class="px-2 checkoutform-title"><?php echo e(trans('labels.order_summary')); ?></span>
                                </span>
                            </h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-capitalize fw-semibold">
                                            <td><?php echo e(trans('labels.image')); ?></td>
                                            <td><?php echo e(trans('labels.product')); ?></td>
                                            <td><?php echo e(trans('labels.unit_cost')); ?></td>
                                            <td><?php echo e(trans('labels.qty')); ?></td>
                                            <td><?php echo e(trans('labels.sub_total')); ?></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $getorderitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="align-middle">
                                                <td><img src="<?php echo e(helper::image_path($product->item_image)); ?>"
                                                        class="object-fit-cover rounded hw-70-px"> </td>
                                                <?php if($product->extras_id != ''): ?>
                                                    <?php
                                                        $extras_id = explode('|', $product->extras_id);
                                                        $extras_name = explode('|', $product->extras_name);
                                                        $extras_price = explode('|', $product->extras_price);
                                                        $extras_total_price = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $extras_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $extras_total_price += $extras_price[$key];
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php
                                                        $extras_total_price = 0;
                                                    ?>
                                                <?php endif; ?>

                                                <td class="mw-400">
                                                    <p class="line-2 mb-1"><?php echo e($product->item_name); ?></p>
                                                    <?php if($product->variants_id != '' || $product->extras_id != ''): ?>
                                                        <span class="text-muted fs-7 cursor-pointer"
                                                            onclick='showaddons("<?php echo e($product->id); ?>","<?php echo e($product->item_name); ?>","<?php echo e($product->attribute); ?>","<?php echo e($product->extras_name); ?>","<?php echo e($product->extras_price); ?>","<?php echo e($product->variants_name); ?>","<?php echo e($product->variants_price); ?>")'>
                                                            <?php echo e(trans('labels.customize')); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php
                                                    $price =
                                                        (float) $extras_total_price + (float) $product->variants_price;
                                                    $total = (float) $price * (float) $product->qty;
                                                ?>
                                                <td>
                                                    <?php echo e(helper::currency_formate($price, $storeinfo->id)); ?>

                                                </td>
                                                <td><?php echo e($product->qty); ?></td>
                                                <td>
                                                    <?php echo e(helper::currency_formate($total, $storeinfo->id)); ?>

                                                </td>
                                                <?php if(@helper::checkaddons('digital_product')): ?>
                                                    <td>
                                                        <?php
                                                            $items = helper::getmin_maxorder(
                                                                $product->item_id,
                                                                $storeinfo->id,
                                                            );
                                                        ?>
                                                        <?php if(helper::appdata($getorderdata->vendor_id)->product_type == 2 && $getorderdata->payment_status == 2): ?>
                                                            <?php if($items->download_file != '' && $items->download_file != null): ?>
                                                                <a href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $items->download_file)); ?>"
                                                                    tooltip="<?php echo e(trans('labels.download')); ?>"
                                                                    target="_blank">
                                                                    <i class="fa-solid fa-download"></i></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-12">
                    <!-- Product order nots -->
                    <?php if($getorderdata->order_notes != null && $getorderdata->order_notes != ''): ?>
                        <div class="card rounded-0 mb-4 card-shadow">
                            <div class="card-body">
                                <h5 class="customer-title color-changer border-bottom pb-2 mb-4">
                                    <i class="fa-light fa-comment-dots"></i>
                                    <span class="px-2 checkoutform-title"><?php echo e(trans('labels.notes')); ?></span>
                                </h5>
                                <p class="line-2 text-capitalize text-muted"><?php echo e($getorderdata->order_notes); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- payment summary -->
                    <div class="card bg-light rounded-2">
                        <div class="card-body">
                            <h5 class="payment-title border-bottom pb-2 mb-4">
                                <span class="custom-icon color-changer">
                                    <i class="fa-light fa-file-invoice"></i>
                                    <span class="px-2 checkoutform-title"><?php echo e(trans('labels.payment_summary')); ?></span>
                                </span>
                            </h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between border-0 bg-transparent color-changer sub-total">
                                    <h6 class="m-0 fw-semibold"><?php echo e(trans('labels.sub_total')); ?></h6>
                                    <span class="color-changer"><?php echo e(helper::currency_formate($getorderdata->sub_total, $storeinfo->id)); ?></span>
                                </li>
                                <?php if($getorderdata->discount_amount > 0): ?>
                                    <li
                                        class="list-group-item d-flex justify-content-between border-0 bg-transparent color-changer sub-total">
                                        <h6 class="m-0 fw-semibold"><?php echo e(trans('labels.discount')); ?></h6>
                                        <span class="color-changer">-<?php echo e(helper::currency_formate($getorderdata->discount_amount, $storeinfo->id)); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php
                                    $tax = explode('|', $getorderdata->tax);
                                    $tax_name = explode('|', $getorderdata->tax_name);
                                ?>
                                <?php if($getorderdata->tax != null && $getorderdata->tax != ''): ?>
                                    <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li
                                            class="list-group-item d-flex justify-content-between border-0 bg-transparent color-changer sub-total">
                                            <h6 class="m-0 fw-semibold"><?php echo e($tax_name[$key]); ?></h6>
                                            <span class="color-changer"><?php echo e(helper::currency_formate(@(float) $tax[$key], $storeinfo->id)); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($getorderdata->order_type == 1): ?>
                                    <li
                                        class="list-group-item d-flex justify-content-between border-0 bg-transparent color-changer sub-total">
                                        <h6 class="m-0 fw-semibold"><?php echo e(trans('labels.delivery')); ?>

                                            <?php if($getorderdata->delivery_area != ''): ?>
                                                (<?php echo e($getorderdata->delivery_area); ?>)
                                            <?php endif; ?>
                                        </h6>
                                        <span class="color-changer">
                                            <?php if($getorderdata->delivery_charge > 0): ?>
                                                <?php echo e(helper::currency_formate($getorderdata->delivery_charge, $storeinfo->id)); ?>

                                            <?php else: ?>
                                                <?php echo e(trans('labels.free')); ?>

                                            <?php endif; ?>
                                        </span>
                                    </li>
                                <?php endif; ?>

                                <li
                                    class="list-group-item d-flex justify-content-between border-0 border-top border-1 border-dark text-dark bg-transparent sub-total mt-2">
                                    <h6 class="m-0 fw-bolder text-success"><?php echo e(trans('labels.total_amount')); ?></h6>
                                    <span class="text-success"><strong><?php echo e(helper::currency_formate($getorderdata->grand_total, $storeinfo->id)); ?></strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/front/order_find.blade.php ENDPATH**/ ?>