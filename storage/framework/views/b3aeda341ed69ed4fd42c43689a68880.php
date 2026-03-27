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
                    aria-current="page"><?php echo e(trans('labels.cart')); ?>

                </li>
            </ol>
        </nav>
    </div>
</section>
<div class="cart-sec">
    <div class="container">
        <?php if(count($cartdata) > 0): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="yourcart-sec">
                        <?php if(@helper::checkaddons('cart_checkout_countdown')): ?>
                            <?php echo $__env->make('front.cart_checkout_countdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <!-- new product cart list -->
                        <div class="table-responsive">
                            <table class="table cart-table m-md-0">
                                <thead>
                                    <tr class="border-top">
                                        <th><?php echo e(trans('labels.product')); ?></th>
                                        <th><?php echo e(trans('labels.price')); ?></th>
                                        <th><?php echo e(trans('labels.quantity')); ?></th>
                                        <th><?php echo e(trans('labels.total')); ?></th>
                                        <th><?php echo e(trans('labels.remove')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $subtotal = 0;
                                    ?>
                                    <?php $__currentLoopData = $cartdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $subtotal += $cart->item_price * $cart->qty;
                                        ?>
                                        <tr class="align-middle">
                                            <td>
                                                <div class="product-detail align-items-center">
                                                    <div class="pr-img">
                                                        <img src="<?php echo e(helper::image_path($cart->item_image)); ?>"
                                                            alt=""
                                                            class="img-fluid h-100 w-100 object-fit-cover">
                                                    </div>
                                                    <div class="details">
                                                        <div class="d-flex justify-content-between mb-2 mb-sm-0">
                                                            <div class="cart_title">
                                                                <a
                                                                    href="<?php echo e(URL::to($storeinfo->slug . '/detail-' . helper::getmin_maxorder($cart->item_id, $storeinfo->id)->slug)); ?>" class="color-changer text-dark">
                                                                    <h5 class="cart-card-title card-font mb-1 line-2">
                                                                        <?php echo e($cart->item_name); ?>

                                                                    </h5>
                                                                </a>
                                                                <?php if($cart->variants_id != '' || $cart->extras_id != ''): ?>
                                                                    <li class="mb-2">
                                                                        <p>
                                                                            <span type="button" class="text-muted fs-7"
                                                                                onclick='showaddons("<?php echo e($cart->id); ?>","<?php echo e($cart->item_name); ?>","<?php echo e($cart->attribute); ?>","<?php echo e($cart->extras_name); ?>","<?php echo e($cart->extras_price); ?>","<?php echo e($cart->variants_name); ?>","<?php echo e($cart->variants_price); ?>")'>
                                                                                <?php echo e(trans('labels.customize')); ?>

                                                                            </span>
                                                                        </p>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price">
                                                <p class="cart-total-price td_a m-0 text-left">
                                                    <?php echo e(helper::currency_formate($cart->item_price, $storeinfo->id)); ?>

                                                </p>
                                            </td>
                                            <td class="">
                                                <div
                                                    class="input-group qty-input2 qtu-width d-flex justify-content-between rounded-2 py-2 input-postion m-auto">
                                                    <button class="btn btn-sm py-0 change-qty cart-padding"
                                                        data-type="minus" value="minus value"
                                                        onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','decreaseValue')">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input type="text" class="border color-changer text-center bg-transparent"
                                                        id="number_<?php echo e($cart->id); ?>" name="number"
                                                        value="<?php echo e($cart->qty); ?>" min="1" max="10"
                                                        readonly>
                                                    <button class="btn btn-sm py-0 change-qty cart-padding"
                                                        data-type="plus" id="cart-plus"
                                                        onclick="qtyupdate('<?php echo e($cart->id); ?>','<?php echo e($cart->item_id); ?>','<?php echo e($cart->variants_id); ?>','<?php echo e($cart->item_price); ?>','increase')"
                                                        value="plus value"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="cart-total-price m-0 td_a text-left" id="total_price">
                                                    <?php echo e(helper::currency_formate($cart->price, $storeinfo->id)); ?>

                                                </p>
                                            </td>
                                            <td>
                                                <a onclick="RemoveCart('<?php echo e($cart->id); ?>','<?php echo e($storeinfo->id); ?>')"
                                                    tooltip="Remove"
                                                    class="item-delete text-danger py-1 px-2 col-xl-3 col-md-4 col-5 mx-auto cursor-pointer">
                                                    <i class="fa-light fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if(@helper::checkaddons('cart_checkout_progressbar')): ?>
                            <?php echo $__env->make('front.cart_checkout_progressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <!-- new product cart list -->
                        <div class="promo-code bg-changer d-md-flex justify-content-between align-items-center my-3">
                            <div class="cuppon-text text-center">
                                <span class="m-0 card-sub-total-text color-changer"><?php echo e(trans('labels.sub_total')); ?> :
                                    <?php echo e(helper::currency_formate($subtotal, $storeinfo->id)); ?></span>
                            </div>
                            <div class="col-xxl-5 col-lg-6 col-md-8">
                                <div class="row justify-content-between align-items-center mt-2 mt-md-0 g-3">
                                    <!-- Continue Shopping btn -->
                                    <div class="col-sm-6 col-12 mt-3 mt-md-0">
                                        <a href="<?php echo e(URL::to($storeinfo->slug)); ?>"
                                            class="btn btn-store-outline px-0"><?php echo e(trans('labels.continue_shoping')); ?></a>
                                    </div>
                                    <!-- Continue Shopping btn -->
                                    <div class="col-sm-6 col-12 mt-3 mt-md-0">
                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                <button class="btn btn-store w-100 cart_checkout"
                                                    onclick="checkminorderamount('<?php echo e($subtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')"><span><?php echo e(trans('labels.checkout')); ?></span></button>
                                            <?php else: ?>
                                                <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                    <button type="button"
                                                        class="btn btn-store m-0 w-100 px-0 cart_checkout"
                                                        <?php if(helper::appdata($storeinfo->id)->is_checkout_login_required == 1): ?> onclick="login()" <?php else: ?> onclick="checkminorderamount('<?php echo e($subtotal); ?>','')" <?php endif; ?>>
                                                        <?php echo e(trans('labels.checkout')); ?>

                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-store m-0 w-100 px-0 cart_checkout"
                                                        onclick="checkminorderamount('<?php echo e($subtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')"><span><?php echo e(trans('labels.checkout')); ?></span></button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button class="btn btn-store m-0 w-100 px-0 cart_checkout"
                                                onclick="checkminorderamount('<?php echo e($subtotal); ?>','<?php echo e(URL::to(@$storeinfo->slug . '/checkout?buy_now=0')); ?>')"><span><?php echo e(trans('labels.checkout')); ?></span></button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<!-- newsletter -->
<?php echo $__env->make('front.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- newsletter -->

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    var minorderamount = "<?php echo e(helper::appdata($storeinfo->id)->min_order_amount); ?>";
    var qtycheckurl = "<?php echo e(URL::to($storeinfo->slug . '/qtycheckurl')); ?>";

    function checkminorderamount(subtotal, checkouturl) {
        $('.cart_checkout').prop("disabled", true);
        $('.cart_checkout').html('<span class="loader"></span>');
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: qtycheckurl,
            method: "post",
            data: {
                vendor_id: "<?php echo e($storeinfo->id); ?>"
            },
            success: function(data) {
                if (data.status == 1) {
                    if (parseInt(minorderamount) <= parseInt(subtotal)) {
                        if (checkouturl != null && checkouturl != "") {
                            location.href = checkouturl;
                        } else {
                            $('#loginmodel').modal('show');
                            $("#loginmodel").on('hidden.bs.modal', function(e) {
                                $('.cart_checkout').prop("disabled", false);
                                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                            });
                        }
                    } else {
                        $('.cart_checkout').prop("disabled", false);
                        $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                        toastr.error('<?php echo e(trans('messages.min_order_amount_required')); ?>' + minorderamount);
                    }
                } else {
                    $('.cart_checkout').prop("disabled", false);
                    $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                    toastr.error(data.message);
                }
            },
            error: function() {
                $('.cart_checkout').prop("disabled", false);
                $('.cart_checkout').html('<?php echo e(trans('labels.checkout')); ?>');
                toastr.error(wrong);
                return false;
            }
        });
    }
</script>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/cart.blade.php ENDPATH**/ ?>