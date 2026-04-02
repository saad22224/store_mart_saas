<div class="modal-body p-3 pro-modal">
    <?php if($item_check != null): ?>
        <div class="row gx-3">
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <?php if(!request()->is('admin/pos/item-details')): ?>
                <div class="col-lg-5">
                    <div id="carouseltest" class="carousel slide pb-3">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $getitem['multi_image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?> "
                                    name="image<?php echo e($key); ?>">
                                    <img class="img-fluid w-100" src="<?php echo e(helper::image_path($image->image)); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($getitem['multi_image']) > 1): ?>
                                <button class='carousel-control-prev' type='button' data-bs-target='#carouseltest'
                                    data-bs-slide='prev'>
                                    <span
                                        class='carousel-control-prev-icon d-flex justify-content-center align-items-center'
                                        aria-hidden='true'> <i class='fa-solid fa-arrow-left-long text-white'></i>
                                    </span>
                                </button>
                                <button class='carousel-control-next' type='button' data-bs-target='#carouseltest'
                                    data-bs-slide='next'>
                                    <span
                                        class='carousel-control-next-icon d-flex justify-content-center align-items-center'
                                        aria-hidden='true'> <i
                                            class='fa-solid fa-arrow-right-long text-white'></i></span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-lg-7' : 'col-lg-12'); ?>">
                <?php
                    if (
                        !request()->is('admin/pos/item-details') &&
                        $getitem->top_deals == 1 &&
                        helper::top_deals($storeinfo->id) != null
                    ) {
                        if (@helper::top_deals($storeinfo->id)->offer_type == 1) {
                            if ($getitem['variation']->count() > 0) {
                                if (
                                    $getitem['variation'][0]->price > @helper::top_deals($storeinfo->id)->offer_amount
                                ) {
                                    $price =
                                        $getitem['variation'][0]->price -
                                        @helper::top_deals($storeinfo->id)->offer_amount;
                                } else {
                                    $price = $getitem['variation'][0]->price;
                                }
                            } else {
                                if ($getitem->item_price > @helper::top_deals($storeinfo->id)->offer_amount) {
                                    $price = $getitem->item_price - @helper::top_deals($storeinfo->id)->offer_amount;
                                } else {
                                    $price = $getitem->item_price;
                                }
                            }
                        } else {
                            if ($getitem['variation']->count() > 0) {
                                $price =
                                    $getitem['variation'][0]->price -
                                    $getitem['variation'][0]->price *
                                        (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                            } else {
                                $price =
                                    $getitem->item_price -
                                    $getitem->item_price * (@helper::top_deals($storeinfo->id)->offer_amount / 100);
                            }
                        }
                        if ($getitem['variation']->count() > 0) {
                            $original_price = $getitem['variation'][0]->price;
                        } else {
                            $original_price = $getitem->item_price;
                        }
                        $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                    } else {
                        $price = $getitem->item_price;
                        $original_price = $getitem->original_price;
                        if ($getitem['variation']->count() > 0) {
                            $price = $getitem['variation'][0]->price;
                            $original_price = $getitem['variation'][0]->original_price;
                        } else {
                            $price = $getitem->item_price;
                            $original_price = $getitem->item_original_price;
                        }
                        $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                    }
                ?>
                <div class="card-body repsonsive-cart-modal p-0 text-left">
                    <?php if($off > 0): ?>
                        <span class="badge text-bg-primary fs-7 mb-2" id="modal_offer"><?php echo e($off); ?>%
                            <?php echo e(trans('labels.off')); ?></span>
                    <?php endif; ?>

                    <p class="pro-title color-changer fs-4 fw-600 mb-sm-2 mb-2"><?php echo e($getitem->item_name); ?></p>
                    <!-- category name and rating star -->
                    <div class="d-flex align-items-center justify-content-between">
                        <p id="modal_laodertext" class="d-none laodertext"></p>
                        <div class="d-flex align-items-center modal-price modal-product-detail-price">

                            <?php if($getitem->is_available != 2 || $getitem->is_deleted == 1): ?>
                                <p class="pro-text pricing" id="modal_detail_item_price">
                                    <?php echo e(helper::currency_formate($price, $storeinfo->id)); ?>

                                </p>
                                <?php if($original_price > $price): ?>
                                    <p class="card-text pro-org-value text-muted pricing"
                                        id="modal_detail_original_price">
                                        <?php echo e(helper::currency_formate($original_price, $storeinfo->id)); ?>

                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($getitem->has_variants == 2): ?>
                                <?php if($getitem->is_available == 2 || $getitem->is_deleted == 1): ?>
                                    <h3 class="text-danger"><?php echo e(trans('labels.not_available')); ?></h3>
                                <?php endif; ?>
                            <?php else: ?>
                                <h3 class="text-danger" id="modal_detail_not_available_text"></h3>
                            <?php endif; ?>

                        </div>

                        <!-- rating star -->
                        <?php if(!request()->is('admin/pos/item-details')): ?>
                            <?php if(@helper::checkaddons('product_reviews')): ?>
                                <?php if(helper::appdata($storeinfo->id)->product_ratting_switch == 1): ?>
                                    <ul class="d-flex bg-gray bg-changer px-2 py-1 rounded-2 align-items-center p-0 m-0 cursor-pointer"
                                        tooltip="View"
                                        onclick="rattingmodal('<?php echo e($getitem->id); ?>','<?php echo e($getitem->vendor_id); ?>','<?php echo e($getitem->item_name); ?>')">
                                        <li class="d-flex align-items-center gap-1">
                                            <i class="fa-solid fa-star text-warning fs-7"></i>
                                            <div id="ratting-div" class="fs-7 fw-semibold">
                                                <p class="px-1 color-changer avg-ratting">
                                                    <?php echo e(number_format($getitem->ratings_average, 1)); ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if($getitem->is_available != 2 || $getitem->is_deleted == 1): ?>
                        <p id="modal_tax" class="responcive-tax text-left mb-1">
                            <span class="text-muted fs-7">
                                <?php if($getitem->tax != null && $getitem->tax != ''): ?>
                                    <span class="text-danger fs-7"> <?php echo e(trans('labels.exclusive_taxes')); ?></span>
                                <?php else: ?>
                                    <span class="text-success fs-7"> <?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                <?php endif; ?>
                            </span>
                        </p>
                    <?php endif; ?>
                    <?php if(!request()->is('admin/pos/item-details')): ?>
                        <?php if(@Helper::checkaddons('fake_view')): ?>
                            <?php if(Helper::appdata($storeinfo->id)->product_fake_view == 1): ?>
                                <?php

                                    $var = ['{eye}', '{count}'];
                                    $newvar = [
                                        "<i class='fa-solid fa-eye'></i>",
                                        rand(
                                            Helper::appdata($storeinfo->id)->min_view_count,
                                            Helper::appdata($storeinfo->id)->max_view_count,
                                        ),
                                    ];

                                    $fake_view = str_replace(
                                        $var,
                                        $newvar,
                                        Helper::appdata($storeinfo->id)->fake_view_message,
                                    );
                                ?>
                                <div class="border-bottom pb-2">
                                    <div class="d-flex gap-1 align-items-center blink_me mb-1">
                                        <p class="fw-600 text-success m-0"><?php echo $fake_view; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <input type="hidden" name="price" id="price" value="<?php echo e($getitem->price); ?>">

                    <div class="border-bottom pb-3 <?php echo e($getitem->sku != null || $getitem->stock_management == 1 || $getitem->attchment_url != null || $getitem->attchment_name != null ? 'd-block' : 'd-none'); ?>"
                        id="sku_stock">
                        <div class="meta-content bg-gray bg-changer p-3 mt-3 rounded-2">
                            <?php if($getitem->sku != '' && $getitem->sku != null): ?>
                                <div class="sku-wrapper product_meta ">
                                    <span class="fs-7" id="sku_lable">
                                        <span class="fw-semibold color-changer"><?php echo e(trans('labels.sku')); ?></span>
                                        <span class="text-muted fs-7" id="sku_value">: <?php echo e($getitem->sku); ?></span>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if($getitem->has_variants == 2 && $getitem->stock_management == 1): ?>
                                <div class="sku-wrapper product_meta" id="modal_stock">
                                    <span class="fs-7"><span
                                            class="fw-semibold color-changer"><?php echo e(trans('labels.stock')); ?>:</span>
                                    </span>
                                    <?php if($getitem->qty > 0): ?>
                                        <span class="text-success fs-7"><?php echo e($getitem->qty); ?>

                                            <?php echo e(trans('labels.in_stock')); ?></span>
                                    <?php else: ?>
                                        <span class="text-danger fs-7"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php elseif($getitem->has_variants == 1): ?>
                                <div class="sku-wrapper product_meta" id="modal_stock">
                                    <span class="fs-7">
                                        <span class="fw-semibold color-changer"><?php echo e(trans('labels.stock')); ?>:</span>
                                    </span>
                                    <span class="fs-7" id="modal_detail_out_of_stock"></span>
                                </div>
                            <?php endif; ?>

                            <?php if($getitem->attchment_url != '' && $getitem->attchment_url != null): ?>
                                <div>
                                    <?php if($getitem->attchment_name != '' && $getitem->attchment_name != null): ?>
                                        <a href="<?php echo e($getitem->attchment_url); ?>" target="_blank">
                                            <p class="fs-7 d-flex align-items-center gap-2">
                                                <i class="fa-light fa-file fs-6"></i>
                                                <?php echo e($getitem->attchment_name); ?>

                                            </p>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e($getitem->attchment_url); ?>" target="_blank">
                                            <p class="fs-7 d-flex align-items-center gap-2">
                                                <i class="fa-light fa-file fs-6"></i>
                                                <?php echo e(trans('labels.click_here')); ?>

                                            </p>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($getitem->has_variants == 1): ?>
                        <div class="product-variations-wrapper">
                            <div class="size-variation modal_size_variation" id="modal_variation">

                                <?php for($i = 0; $i < count($getitem->variants_json); $i++): ?>
                                    <label class="fw-semibold form-label mt-3"
                                        for=""><?php echo e($getitem->variants_json[$i]['variant_name']); ?></label><br>
                                    <div class="d-flex flex-wrap gap-2 border-bottom pb-3">
                                        <?php for($t = 0; $t < count($getitem->variants_json[$i]['variant_options']); $t++): ?>
                                            <label
                                                class="checkbox-inline check<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?> <?php echo e($t == 0 ? 'active' : ''); ?>"
                                                id="check_<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                                for="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
                                                <input type="checkbox" class="" name="skills"
                                                    <?php echo e($t == 0 ? 'checked' : ''); ?>

                                                    value="<?php echo e($getitem->variants_json[$i]['variant_options'][$t]); ?>"
                                                    id="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
                                                <?php echo e($getitem->variants_json[$i]['variant_options'][$t]); ?>

                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(count($getitem['extras']) > 0): ?>
                        <div class="woo_pr_color flex_inline_center my-3 border-bottom pb-3">
                            <div class="woo_colors_list text-left">
                                <span id="extras">
                                    <h5 class="extra-title fw-semibold color-changer mb-2">
                                        <?php echo e(trans('labels.extras')); ?></h5>
                                    <ul class="list-unstyled extra-food m-0">
                                        <div id="pricelist">
                                            <?php $__currentLoopData = $getitem['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="mb-2">
                                                    <input type="checkbox" name="addons[]"
                                                        extras_name="<?php echo e($extras->name); ?>" class="Checkbox"
                                                        value="<?php echo e($extras->id); ?>" price="<?php echo e($extras->price); ?>">
                                                    <p class="color-changer"><?php echo e($extras->name); ?> :
                                                        <?php echo e(helper::currency_formate($extras->price, $getitem->vendor_id)); ?>

                                                    </p>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </ul>
                                </span>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($getitem->is_available != 2 || $getitem->is_deleted == 1): ?>
                        <div class="row border-bottom g-2 pb-3" id="modal_detail_plus_minus">
                            <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                <div
                                    class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-xxl-3 col-lg-6 col-md-3 col-6' : 'col-4'); ?>">
                                    <div
                                        class="input-group qty-input2 col-md-auto col-12 responsive-margin m-0 rounded-2 h-100">
                                        <button class="btn p-0 change-qty-2 h-100" id="minus" data-type="minus"
                                            data-item_id="<?php echo e($getitem->id); ?>"
                                            onclick="changeqty($(this).attr('data-item_id'),'minus')"
                                            value="minus value"><i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" class="bg-transparent color-changer text-center item_qty_<?php echo e($getitem->id); ?>"
                                            name="number" value="1" readonly="">
                                        <button class="btn p-0 change-qty-2 h-100" id="plus"
                                            data-item_id="<?php echo e($getitem->id); ?>"
                                            onclick="changeqty($(this).attr('data-item_id'),'plus')" data-type="plus"
                                            value="plus value"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!request()->is('admin/pos/item-details')): ?>
                                <?php if(@helper::checkaddons('subscription')): ?>
                                    <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                        <?php
                                            $checkplan = App\Models\Transaction::where('vendor_id', $storeinfo->id)
                                                ->orderByDesc('id')
                                                ->first();
                                            $user = App\Models\User::where('id', $storeinfo->id)->first();
                                            if (@$user->allow_without_subscription == 1) {
                                                $whatsapp_message = 1;
                                            } else {
                                                $whatsapp_message = @$checkplan->whatsapp_message;
                                            }
                                        ?>
                                        <?php if(
                                            $whatsapp_message == 1 &&
                                                @whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_number != '' &&
                                                @whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_number != null): ?>
                                            <div class="col-xxl-3 col-lg-6 col-md-3 col-6">
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo e(@whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_number); ?>&text=<?php echo e($getitem->item_name); ?>"
                                                    class="btn btn-enquir m-0 add-btn px-0 w-100 h-100" id="enquiries"
                                                    target="_blank">
                                                    <i
                                                        class="fa-brands fa-whatsapp fs-5 <?php echo e(session()->get('direction') == 2 ? 'glyphicon' : ''); ?>"></i>
                                                    <span class="px-1"><?php echo e(trans('labels.enquiries')); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                        <div class="col-xxl-3 col-lg-6 col-md-3 col-6">
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo e(@whatsapp_helper::whatsapp_message_config($storeinfo->id)->whatsapp_number); ?>&text=<?php echo e($getitem->item_name); ?>"
                                                class="btn btn-enquir m-0 add-btn px-0 w-100 h-100" id="enquiries"
                                                target="_blank">
                                                <i
                                                    class="fa-brands fa-whatsapp fs-5 <?php echo e(session()->get('direction') == 2 ? 'glyphicon' : ''); ?>"></i>
                                                <span class="px-1"><?php echo e(trans('labels.enquiries')); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(helper::appdata($storeinfo->id)->online_order == 1): ?>
                                <div
                                    class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-xxl-3 col-lg-6 col-md-3 col-6' : 'col-8'); ?>">
                                    <button
                                        class="btn btn-store m-0 modal_add_btn addtocart w-100 px-0 <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                        <?php if(!request()->is('admin/pos/item-details')): ?> onclick="AddtoCart('0')" <?php else: ?> onclick="posaddtocart()" <?php endif; ?>>
                                        <span class="px-1"><?php echo e(trans('labels.add_to_cart')); ?></span>
                                    </button>
                                </div>
                                <?php if(!request()->is('admin/pos/item-details')): ?>
                                    <div class="col-xxl-3 col-lg-6 col-md-3 col-6">
                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                            <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                                <button
                                                    class="btn btn-store-outline m-0 modal_add_btn buynow w-100 px-0 <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                                    <?php if(helper::appdata($storeinfo->id)->is_checkout_login_required == 1): ?> onclick="login()" <?php else: ?> onclick="AddtoCart('1')" <?php endif; ?>>
                                                    <span class="px-1"><?php echo e(trans('labels.buy_now')); ?></span>
                                                </button>
                                            <?php else: ?>
                                                <button
                                                    class="btn btn-store-outline m-0 modal_add_btn buynow w-100 px-0 <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                                    onclick="AddtoCart('1')">
                                                    <span class="px-1"><?php echo e(trans('labels.buy_now')); ?></span>
                                                </button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button
                                                class="btn btn-store-outline m-0 modal_add_btn buynow w-100 px-0 <?php echo e($getitem->has_variants == 2 && $getitem->stock_management == 1 && $getitem->qty == 0 ? 'disabled' : ''); ?>"
                                                onclick="AddtoCart('1')">
                                                <span class="px-1"><?php echo e(trans('labels.buy_now')); ?></span>
                                            </button>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!request()->is('admin/pos/item-details')): ?>
                        <div
                            class="d-flex flex-wrap gap-sm-2 gap-3 justify-content-between align-items-center w-100 mt-3">
                            <?php if(@helper::checkaddons('customer_login')): ?>
                                <?php if(helper::appdata($storeinfo->id)->checkout_login_required == 1): ?>
                                    <p class="fs-7 d-flex align-items-center m-0">
                                        <a onclick="managefavorite('<?php echo e($getitem->id); ?>',<?php echo e($storeinfo->id); ?>,'<?php echo e(URL::to(@$storeinfo->slug . '/managefavorite')); ?>')"
                                            class="btn-sm btn-Wishlist cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
                                            <span class=" btn-sm btn-Wishlist mx-2">
                                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                    <?php

                                                        $favorite = helper::ceckfavorite(
                                                            $getitem->id,
                                                            $storeinfo->id,
                                                            Auth::user()->id,
                                                        );

                                                    ?>
                                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                        <i class="fa-solid fa-heart"></i>
                                                    <?php else: ?>
                                                        <i class="fa-regular fa-heart"></i>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <i class="fa-regular fa-heart"></i>
                                                <?php endif; ?>
                                            </span>
                                        </a>
                                        <span class="color-changer mx-2"><?php echo e(trans('labels.add_to_wishlist')); ?></span>
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="d-flex align-items-center justify-content-center gap-2">

                                <?php if($getitem->video_url != '' && $getitem->video_url != null): ?>
                                    <a href="<?php echo e($getitem->video_url); ?>" tooltip="Video"
                                        class=" rounded-circle prod-social m-0" id="btn-video" target="_blank">
                                        <i class="fa-regular fa-video fs-7"></i></a>
                                <?php endif; ?>

                                <?php if(helper::appdata($storeinfo->id)->google_review != '' && helper::appdata($storeinfo->id)->google_review != null): ?>
                                    <a href="<?php echo e(helper::appdata($storeinfo->id)->google_review); ?>" target="_blank"
                                        tooltip="Review" class=" rounded-circle prod-social m-0"><i
                                            class="fa-regular fa-star fs-7"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <input type="hidden" name="vendor" id="modal_overview_vendor"
                        value="<?php echo e($getitem->vendor_id); ?>">
                    <input type="hidden" name="item_id" id="modal_overview_item_id" value="<?php echo e($getitem->id); ?>">
                    <input type="hidden" name="item_name" id="modal_overview_item_name"
                        value="<?php echo e($getitem->item_name); ?>">
                    <input type="hidden" name="item_image" id="modal_overview_item_image"
                        value="<?php echo e(@$getitem['product_image']->image); ?>">
                    <input type="hidden" name="item_min_order" id="modal_item_min_order"
                        value="<?php echo e($getitem->min_order); ?>">
                    <input type="hidden" name="item_max_order" id="modal_item_max_order"
                        value="<?php echo e($getitem->max_order); ?>">
                    <input type="hidden" name="item_price" id="modal_overview_item_price"
                        value="<?php echo e($price); ?>">
                    <input type="hidden" name="item_original_price" id="modal_overview_item_original_price"
                        value ="<?php echo e($original_price); ?>">
                    <input type="hidden" name="tax" id="modal_tax_val" value="<?php echo e($getitem->tax); ?>">
                    <input type="hidden" name="variants_name" id="modal_variants_name">
                    <input type="hidden" name="stock_management" id="modal_stock_management"
                        value="<?php echo e($getitem->stock_management); ?>">
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php echo $__env->make('front.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function($) {
        var selected = [];
        $('.modal_size_variation input:checked').each(function() {
            $("#modal_variation [id='" + 'check_' + this.id + "']").addClass('active');
            selected.push($(this).attr('value'));
        });
        set_variant_price(selected);
    });
    $('#modal_variation input:checkbox').click(function() {
        var selected = [];
        var divselected = [];
        const myArray = this.id.split("-");
        var id = this.id;
        $('#modal_variation .check' + myArray[0] + ' input:checked').each(function() {
            divselected.push($(this).attr('value'));
        });
        if (divselected.length == 0) {
            $(this).prop('checked', true);
        }
        $('#modal_variation .check' + myArray[0] + ' input:checkbox').not(this).prop('checked', false);
        $('#modal_variation .check' + myArray[0]).removeClass('active');
        $("#modal_variation [id='" + 'check_' + this.id + "']").addClass('active');
        $('.modal_size_variation input:checked').each(function() {
            $('.modal-product-detail-price').addClass('d-none');
            $('#modal_laodertext').removeClass('d-none');
            $('#modal_laodertext').html(
                '<span class="loader"></span>'
            );
            selected.push($(this).attr('value'));
        });
        set_variant_price(selected);
    });

    function set_variant_price(variants) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo e(!request()->is('admin/pos/item-details') ? URL::to('get-products-variant-quantity') : URL::to('admin/pos/get-products-variant-quantity')); ?>",
            data: {
                name: variants,
                item_id: $('#modal_overview_item_id').val(),
                vendor_id: <?php echo e($storeinfo->id); ?>,
            },
            success: function(data) {
                if (data.status == 1) {
                    setTimeout(function() {
                        $('#modal_laodertext').html('');
                    }, 4000);
                    var off = ((1 - (data.price / data.original_price)) * 100).toFixed(1);
                    $('#modal_laodertext').addClass('d-none');
                    $('.modal-product-detail-price').removeClass('d-none');
                    $('#modal_variants_name').val(variants);

                    $('#modal_detail_item_price').text(currency_formate(parseFloat(data.price)));
                    $('#modal_overview_item_price').val(data.price);
                    $('#modal_offer').removeClass('d-none');
                    if (parseFloat(data.original_price) > parseFloat(data.price)) {
                        $('#modal_detail_original_price').text(currency_formate(parseFloat(data
                            .original_price)));
                        $('#modal_offer').removeClass('d-none');
                        $('#modal_offer').text($.number(off, 1) + '% <?php echo e(trans('labels.off')); ?>');
                    } else {
                        $('#modal_detail_original_price').text('');
                        $('#modal_offer').addClass('d-none');
                        $('#modal_offer').text('');
                    }
                    $('#modal_overview_item_original_price').val(data.original_price);
                    $('#modal_stock_management').val(data.stock_management);
                    $('#modal_item_min_order').val(data.min_order);
                    $('#modal_item_max_order').val(data.max_order);
                    if (data.is_available == 2) {
                        $('#modal_offer').addClass('d-none');
                        $('#modal_detail_not_available_text').html('<?php echo e(trans('labels.not_available')); ?>');
                        $('.modal_add_btn').attr('disabled', true);
                        $('.modal_add_btn').addClass('d-none');
                        $('#modal_detail_item_price').addClass('d-none');
                        $('#modal_detail_original_price').addClass('d-none');
                        $('#modal_detail_plus_minus').addClass('d-none');
                        $('#modal_tax').addClass('d-none');
                        $('#modal_stock').addClass('d-none');
                    } else {
                        $('#modal_detail_not_available_text').html('');
                        $('#modal_offer').removeClass('d-none');
                        $('.modal_add_btn').attr('disabled', false);
                        $('.modal_add_btn').removeClass('d-none');
                        $('#modal_detail_item_price').removeClass('d-none');
                        $('#modal_detail_original_price').removeClass('d-none');
                        $('#modal_detail_plus_minus').removeClass('d-none');
                        $('#modal_tax').removeClass('d-none');
                        $('#modal_stock').addClass('d-none');
                        if (data.stock_management == 1) {
                            $('#modal_stock').removeClass('d-none');
                            $('#modal_detail_out_of_stock').removeClass('d-none');
                            if (data.quantity > 0) {
                                $('.modal_add_btn').attr('disabled', false);
                                $('#modal_detail_out_of_stock').removeClass('text-danger');
                                $('#modal_detail_out_of_stock').addClass('text-success');
                                $('#modal_detail_out_of_stock').html('(' + data.quantity +
                                    ' <?php echo e(trans('labels.in_stock')); ?>)');
                            } else {
                                $('.modal_add_btn').attr('disabled', true);
                                $('#modal_detail_out_of_stock').removeClass('text-dark');
                                $('#modal_detail_out_of_stock').addClass('text-danger');
                                $('#modal_detail_out_of_stock').html(
                                    '(<?php echo e(trans('labels.out_of_stock')); ?>)');
                            }
                        } else {
                            $('#modal_detail_out_of_stock').addClass('d-none');
                        }

                    }
                }

            }
        });

    }
</script>
<?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/front/productdetail.blade.php ENDPATH**/ ?>