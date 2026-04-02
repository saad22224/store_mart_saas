<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<div class="offcanvas offcanvas-end " id="cart-offCanvas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <button type="button" class="closing-button-1 d-none d-md-block" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fa-regular fa-xmark fs-4"></i>
    </button>
    <div class="offcanvas-header py-3 gap-1 px-2 gx-3 align-items-center">
        <select id="customer" class="form-select fs-7" aria-label="Default select example">
            <option value="0">Walk In Customers</option>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(@$customer->id); ?>"><?php echo e(@$customer->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="button" class="closing-button-2 border rounded bg-transparent d-block d-md-none"
            data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-regular fa-xmark color-changer"></i>
        </button>
    </div>
    <div class="offcanvas-body p-0">
        <table class="table mb-0 table-hover" id="myTable">
            <thead>
                <tr class="border-top">
                    <th scope="col"></th>
                    <th scope="col" class="product-text-size fw-500 ps-0"><?php echo e(trans('labels.items')); ?></th>
                    <th scope="col" class="product-text-size fw-500 text-center"> <?php echo e(trans('labels.qty')); ?></th>
                    <th scope="col" class="product-text-size fw-500"><?php echo e(trans('labels.price')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                ?>
                <?php $__currentLoopData = $cartitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="align-middle">
                        <td class="pe-sm-2 py-3 md-2 pe-0">
                            <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="deletedata('<?php echo e(URL::to('admin/pos/cartview/delete-' . $item->id)); ?>')" <?php endif; ?>
                                tooltip="<?php echo e(trans('labels.delete')); ?>" class="btn btn-danger hov btn-sm"> <i
                                    class="fa-regular fa-trash"></i>
                            </a>
                        </td>
                        <td class="ps-1 ps-sm-0 py-3">
                            <div class="text-dark">
                                <h6 class="line-1 m-0 product-text-size fw-600 color-changer"><?php echo e($item->item_name); ?></h6>
                                <p class="m-0 line-1 product-text-size text-muted"><?php echo e($item->variants_name); ?><?php if($item->variants_price != 0): ?>
                                        (<?php echo e(helper::currency_formate($item->variants_price, $vendor_id)); ?>)
                                    <?php endif; ?>
                                </p>
                                <?php
                                    $extras_name = explode('|', $item->extras_name);
                                    $extras_price = explode('|', $item->extras_price);
                                    $total_extras_price = array_sum(array_map('floatval', $extras_price));
                                ?>
                                <?php $__currentLoopData = $extras_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="m-0 line-1 product-text-size text-muted">
                                        <?php echo e($name); ?>

                                        <?php if(isset($extras_price[$index]) && $extras_price[$index] != ''): ?>
                                            (<?php echo e(helper::currency_formate($extras_price[$index], $vendor_id)); ?>)
                                        <?php endif; ?>
                                    </p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="price-range pb-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:void(0);" class="circle"
                                        onclick="qtyupdate('<?php echo e($item->id); ?>','minus','<?php echo e(URL::to('admin/pos/cart/qtyupdate')); ?>','<?php echo e($item->item_id); ?>','<?php echo e($item->variants_id); ?>','<?php echo e($item->qty); ?>')">
                                        <i class="fa-light fa-minus"></i></a>
                                    <input type="text" class="color-changer fs-7" value="<?php echo e($item->qty); ?>" readonly>
                                    <a href="javascript:void(0);" class="circle"
                                        onclick="qtyupdate('<?php echo e($item->id); ?>','plus','<?php echo e(URL::to('admin/pos/cart/qtyupdate')); ?>','<?php echo e($item->item_id); ?>','<?php echo e($item->variants_id); ?>','<?php echo e($item->qty); ?>')">
                                        <i class="fa-light fa-plus"></i></a>
                                </div>
                            </div>
                        </td>
                        <?php
                            $variants_price = floatval($item->variants_price);
                            $extras_price = floatval($total_extras_price);
                            $itemtotal = ($variants_price + $extras_price) * $item->qty;
                            $total += $itemtotal;
                            $discount = floatval(session()->get('discount', 0));
                            $sub_total = $total - $discount;
                        ?>
                        <td class="py-3">
                            <p class="fw-500 text-dark color-changer m-0 line-1 product-text-size itemtotal">
                                <?php echo e(helper::currency_formate($itemtotal, $vendor_id)); ?></p>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
    <div class="offcanvas-footer p-3">
        <form class="footer-form m-0">
            <div class="col-12 d-flex gap-1 fs-7">
                <div class="input-group gap-0 fs-8">
                    <?php if(session()->get('discount') > 0): ?>
                        <input type="text" id="discount-input" class="form-control fs-7" placeholder="Add Discount"
                            aria-label="Add Discount" aria-describedby="button-addon2"
                            value="<?php echo e(session()->get('discount')); ?>" disabled>
                        <button class="btn btn-primary fw-500 border-0 text-light fs-7 rounded-end d-none"
                            type="button" id="apply-discount"> <?php echo e(trans('labels.apply')); ?> </button>
                        <button class="btn bg-danger fw-500 border-0 text-light fs-7 rounded-end " type="button"
                            id="remove-discount"> <?php echo e(trans('labels.remove')); ?> </button>
                    <?php else: ?>
                        <input type="text" id="discount-input" class="form-control fs-7" placeholder="Add Discount"
                            aria-label="Add Discount" aria-describedby="button-addon2">
                        <button class="btn btn-primary fw-500 border-0 text-light fs-7 rounded-end " type="button"
                            id="apply-discount"> <?php echo e(trans('labels.apply')); ?> </button>
                        <button class="btn bg-danger fw-500 border-0 text-light fs-7 rounded-end d-none" type="button"
                            id="remove-discount"> <?php echo e(trans('labels.remove')); ?> </button>
                    <?php endif; ?>


                </div>
            </div>

        </form>
        <div class="col-12 py-2">
            <?php
                $taxtotal = 0;
                foreach ($taxArr['tax'] as $index => $name) {
                    $taxtotal += $taxArr['rate'][$index];
                }

                $grandTotal = $taxtotal + $total - session()->get('discount');
            ?>

            <div class="d-flex justify-content-between my-1 py-1">
                <span class="fw-600 color-changer fs-7"> <?php echo e(trans('labels.sub_total')); ?> </span>
                <span
                    class="fw-semibold text-dark color-changer fs-7 sub_total d-none"><?php echo e(helper::currency_formate(@$sub_total, $vendor_id)); ?></span>
                <span
                    class="fw-semibold text-dark color-changer fs-7 sub_total1"><?php echo e(helper::currency_formate($total, $vendor_id)); ?></span>
            </div>

            <div class="text-muted fw-500">
                <?php $__currentLoopData = $taxArr['tax']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between my-1">
                        <span class="text-sm tax_name color-changer"><?php echo e($name); ?></span>
                        <span
                            class="text-sm tax-rate color-changer"><?php echo e(helper::currency_formate($taxArr['rate'][$index], $vendor_id)); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between my-1">
                    <span class="text-sm color-changer"> <?php echo e(trans('labels.discount')); ?> </span>
                    <span class="text-sm discount color-changer"
                        id="discount_amount">-<?php echo e(helper::currency_formate(session()->get('discount'), $vendor_id)); ?></span>
                </div>
            </div>

            <div class="d-flex justify-content-between fs-7 underline-2 py-1">
                <span class="fw-semibold text-dark color-changer"><?php echo e(trans('labels.total')); ?> </span>
                <span
                    class="fw-semibold text-dark color-changer grand_total"><?php echo e(helper::currency_formate($grandTotal, $vendor_id)); ?></span>
            </div>
        </div>
        <div class="col-12">
            <div class="row gx-3 align-items-center justify-content-between mt-1">
                <div class="col-6">
                    <button id="deleteAllBtn"
                        class="total-pay Empty-cart fs-7 rounded fw-500 bg-danger text-light border-0"
                        onclick="RemoveCart('')"><?php echo e(trans('labels.empty_carts')); ?></button>
                </div>
                <div class="col-6">
                    <button id="order" type="button" onclick="OrderNow('<?php echo e(URL::to('admin/pos/ordernow')); ?>')"
                        class="orderbtn total-pay btn btn-primary fs-7 rounded fw-500 text-light border-0">
                        <?php echo e(trans('labels.order_now')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/pos_cartview.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/pos.js')); ?>" type="text/javascript"></script>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/pos/cartview.blade.php ENDPATH**/ ?>