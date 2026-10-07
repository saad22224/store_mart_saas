<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-primary fs-4"><?php echo e(trans('labels.purchase_plan')); ?></h5>
    </div>
    <div class="row g-3">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-dark"><?php echo e($plan->name); ?></h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-1 text-dark"><?php echo e(helper::currency_formate($plan->price, '')); ?>

                            <span class="fs-7 text-muted">/
                                <?php if($plan->plan_type == 1): ?>
                                    <?php if($plan->duration == 1): ?>
                                        <?php echo e(trans('labels.one_month')); ?>

                                    <?php elseif($plan->duration == 2): ?>
                                        <?php echo e(trans('labels.three_month')); ?>

                                    <?php elseif($plan->duration == 3): ?>
                                        <?php echo e(trans('labels.six_month')); ?>

                                    <?php elseif($plan->duration == 4): ?>
                                        <?php echo e(trans('labels.one_year')); ?>

                                    <?php elseif($plan->duration == 5): ?>
                                        <?php echo e(trans('labels.lifetime')); ?>

                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($plan->plan_type == 2): ?>
                                    <?php echo e($plan->days); ?>

                                    <?php echo e($plan->days > 1 ? trans('labels.days') : trans('labels.day')); ?>

                                <?php endif; ?>
                            </span>
                        </h5>
                        <?php if($plan->tax != null && $plan->tax != ''): ?>
                            <small class="text-danger"><?php echo e(trans('labels.exclusive_taxes')); ?></small><br>
                        <?php else: ?>
                            <small class="text-success"><?php echo e(trans('labels.inclusive_taxes')); ?></small> <br>
                        <?php endif; ?>
                        <small class="text-muted text-center"><?php echo e($plan->description); ?></small>
                    </div>
                    <ul class="pb-5">
                        <?php $features = ($plan->features == null ? null : explode('|', $plan->features));?>
                        <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                <?php echo e($plan->order_limit == -1 ? trans('labels.unlimited') : $plan->order_limit); ?>

                                <?php echo e($plan->order_limit > 1 || $plan->order_limit == -1 ? trans('labels.products') : trans('labels.product')); ?>

                            </span>
                        </li>
                        <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                <?php echo e($plan->appointment_limit == -1 ? trans('labels.unlimited') : $plan->appointment_limit); ?>

                                <?php echo e($plan->appointment_limit > 1 || $plan->appointment_limit == -1 ? trans('labels.orders') : trans('labels.order')); ?>

                            </span>
                        </li>
                        <?php
                            $themes = [];
                            if ($plan->themes_id != '' && $plan->themes_id != null) {
                                $themes = explode('|', $plan->themes_id);
                        } ?>
                        <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2"><?php echo e(count($themes)); ?>

                                <?php echo e(count($themes) > 1 ? trans('labels.themes') : trans('labels.theme')); ?>

                                <?php if(Auth::user()->type == 2 || Auth::user()->type == 4): ?>
                                    <a onclick="themeinfo('<?php echo e($plan->id); ?>','<?php echo e($plan->themes_id); ?>','<?php echo e($plan->name); ?>')"
                                        tooltip="<?php echo e(trans('labels.info')); ?>" class="cursor-pointer"> <i
                                            class="fa-regular fa-circle-info"></i> </a>
                                <?php endif; ?>
                            </span>
                        </li>
                        <?php if(@helper::checkaddons('coupon')): ?>
                            <?php if($plan->coupons == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.coupons')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('custom_domain')): ?>
                            <?php if($plan->custom_domain == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.custome_domain')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('blog')): ?>
                            <?php if($plan->blogs == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.blogs')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('google_login')): ?>
                            <?php if($plan->google_login == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.google_login')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('facebook_login')): ?>
                            <?php if($plan->facebook_login == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.facebook_login')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('notification')): ?>
                            <?php if($plan->sound_notification == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.sound_notification')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('whatsapp_message')): ?>
                            <?php if($plan->whatsapp_message == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.whatsapp_message')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('telegram_message')): ?>
                            <?php if($plan->telegram_message == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.telegram_message')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('vendor_app')): ?>
                            <?php if($plan->vendor_app == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.vendor_app_available')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('user_app')): ?>
                            <?php if($plan->customer_app == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.customer_app')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('pos')): ?>
                            <?php if($plan->pos == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.pos')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('pwa')): ?>
                            <?php if($plan->pwa == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.pwa')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('employee')): ?>
                            <?php if($plan->role_management == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.role_management')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(@helper::checkaddons('pixel')): ?>
                            <?php if($plan->pixel == 1): ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"><?php echo e(trans('labels.pixel')); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($features != null): ?>
                            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2 d-flex fs-7"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"> <?php echo e($feature); ?> </span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 mb-3 payments">
            <?php if(@helper::checkaddons('coupon')): ?>
                <div class="card border-0 box-shadow">
                    <div class="card-header p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 text-dark"><?php echo e(trans('labels.apply_coupon')); ?></h5>
                            <p class="text-secondary cursor-pointer <?php echo e(session()->has('discount_data') ? 'd-none' : ''); ?>"
                                data-bs-toggle="modal" data-bs-target="#couponmodal">
                                <?php echo e(trans('labels.select_promocode')); ?></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            $count = App\Models\Coupons::where('vendor_id', 1)->count();
                            $coupons = App\Models\Coupons::where('vendor_id', 1)->orderBy('reorder_id')->get();
                        ?>
                        <?php if(session()->has('discount_data')): ?>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="promocode" name="promocode"
                                    value="<?php echo e(session()->get('discount_data')['offer_code']); ?>" readonly
                                    placeholder="<?php echo e(trans('labels.enter_coupon_code')); ?>">
                                <button type="button" onclick="removecoupon()"
                                    class="btn btn-secondary px-sm-4"><?php echo e(trans('labels.remove')); ?></button>
                            </div>
                        <?php else: ?>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="promocode" name="promocode" readonly
                                    placeholder="<?php echo e(trans('labels.enter_coupon_code')); ?>">
                                <button type="button" onclick="applyCopon()"
                                    class="btn btn-secondary px-sm-4"><?php echo e(trans('labels.apply')); ?></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card border-0 box-shadow mt-3">
                <div class="card-header p-3">
                    <h5 class="card-title m-0 text-dark"><?php echo e(trans('labels.payment_details')); ?></h5>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <p class="fs-15 fw-500"><?php echo e(trans('labels.sub_total')); ?></p>
                            <p class="fs-15 fw-500"><?php echo e(helper::currency_formate($plan->price, '')); ?></p>
                        </li>
                        <?php if(session()->has('discount_data')): ?>
                            <?php
                                $discount = session()->get('discount_data')['offer_amount'];
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <p class="fs-15 fw-500"><?php echo e(trans('labels.discount')); ?> <span
                                        class="text-dark">(<?php echo e(session()->get('discount_data')['offer_code']); ?>)</span>
                                </p>
                                <p class="fs-15 fw-500">
                                    -<?php echo e(helper::currency_formate(session()->get('discount_data')['offer_amount'], '')); ?>

                                </p>
                            </li>
                        <?php else: ?>
                            <?php
                                $discount = 0;
                            ?>
                        <?php endif; ?>

                        <?php
                            $taxlist = helper::gettax($plan->tax);
                            $newtax = [];
                            $totaltax = 0;
                        ?>
                        <?php if($plan->tax != null && $plan->tax != ''): ?>
                            <?php $__currentLoopData = $taxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <p class="fs-15 fw-500">
                                        <?php echo e(@$tax->name); ?>

                                    </p>
                                    <p class="fs-15 fw-500">
                                        <?php echo e(@$tax->type == 1 ? helper::currency_formate(@$tax->tax, '') : helper::currency_formate($plan->price * (@$tax->tax / 100), '')); ?>

                                    </p>
                                    <?php
                                        if (@$tax->type == 1) {
                                            $newtax[] = @$tax->tax;
                                        } else {
                                            $newtax[] = $plan->price * (@$tax->tax / 100);
                                        }
                                    ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php $__currentLoopData = $newtax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totaltax += (float) $item;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <?php
                                $grand_total = $plan->price - $discount + $totaltax;
                            ?>
                            <p class="fs-16 fw-600 text-primary"><?php echo e(trans('labels.grand_total')); ?></p>
                            <input type="hidden" name="grand_total" id="grand_total" value="<?php echo e($grand_total); ?>">
                            <p class="fw-600 fs-16 text-primary"><?php echo e(helper::currency_formate($grand_total, '')); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card border-0 box-shadow mt-3">
                <div class="card-header p-3">
                    <h5 class="card-title mb-0 text-dark"><?php echo e(trans('labels.payment_methods')); ?></h5>
                </div>
                <div class="card-body">

                    <div class="row g-3">
                        <?php $__currentLoopData = $paymentmethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $payment_type = $pmdata->payment_type;
                            ?>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" id="<?php echo e($payment_type); ?>"
                                            value="<?php echo e($pmdata->public_key); ?>"
                                            data-transaction-type="<?php echo e($pmdata->payment_type); ?>"
                                            data-currency="<?php echo e($pmdata->currency); ?>"
                                            <?php if($payment_type == '6'): ?> data-bank-name="<?php echo e($pmdata->bank_name); ?>"  data-account-holder-name="<?php echo e($pmdata->account_holder_name); ?>"  data-account-number="<?php echo e($pmdata->account_number); ?>" data-bank-ifsc-code="<?php echo e($pmdata->bank_ifsc_code); ?>" <?php endif; ?>
                                            name="paymentmode">
                                        <?php if($payment_type == '6'): ?>
                                            <input type="hidden" value="<?php echo e($pmdata->payment_description); ?>"
                                                id="bank_payment">
                                        <?php endif; ?>
                                    </div>
                                    <label for="<?php echo e($payment_type); ?>"
                                        class="d-flex align-items-center form-control cursor-pointer fs-15">
                                        <img src="<?php echo e(helper::image_path($pmdata->image)); ?>" class="mx-2 hw-20"
                                            alt="" srcset="">
                                        <?php echo e($pmdata->payment_name); ?>

                                    </label>
                                </div>
                                <?php if($payment_type == '3'): ?>
                                    <input type="hidden" name="stripe_public_key" id="stripe_public_key"
                                        value="<?php echo e($pmdata->public_key); ?>">
                                    <div class="stripe-form d-none">
                                        <div id="card-element"></div>
                                    </div>
                                    <div class="text-danger stripe_error"></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-end mt-2">
                        <a href="<?php echo e(URL::to('/admin/plan')); ?>"
                            class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                        <?php if($paymentmethod->count() > 0): ?>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="button" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(env('Environment') == 'sendbox' ? '' : 'buy_now'); ?> ">
                                <?php echo e(trans('labels.checkout')); ?>

                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="price" id="price" value="<?php echo e($plan->price); ?>">
    <input type="hidden" name="plan_id" id="plan_id" value="<?php echo e($plan->id); ?>">
    <input type="hidden" name="user_name" id="user_name" value="<?php echo e(Auth::user()->name); ?>">
    <input type="hidden" name="user_email" id="user_email" value="<?php echo e(Auth::user()->email); ?>">
    <input type="hidden" name="user_mobile" id="user_mobile" value="<?php echo e(Auth::user()->mobile); ?>">
    <input type="hidden" name="payment_error" id="payment_error" value="<?php echo e(trans('messages.select_atleast_one')); ?>">
    <form action="<?php echo e(url('admin/plan/buyplan/paypalrequest')); ?>" method="post" class="d-none">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="return" value="2">
        <input type="submit" class="callpaypal" name="submit">
    </form>
    <!-- Modal -->
    <div class="modal fade" id="modalbankdetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalbankdetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="modalbankdetailsLabel"><?php echo e(trans('labels.banktransfer')); ?></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('admin/plan/buyplan')); ?>" method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_type" id="modal_payment_type" class="form-control"
                            value="">
                        <input type="hidden" name="plan_id" id="modal_plan_id" class="form-control" value="">
                        <input type="hidden" name="amount" id="modal_amount" class="form-control" value="">
                        <p><?php echo e(trans('labels.payment_description')); ?></p>
                        <hr>
                        <p class="payment_description" id="payment_description"></p>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="screenshot"> <?php echo e(trans('labels.screenshot')); ?> </label>
                            <div class="controls">
                                <input type="file" name="screenshot" id="screenshot"
                                    class="form-control  <?php $__errorArgs = ['screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4"
                            data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                            class="btn btn-primary"> <?php echo e(trans('labels.save')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="couponmodal" tabindex="-1" aria-labelledby="couponmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded overflow-hidden">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-primary" id="couponmodalLabel"><?php echo e(trans('labels.coupons_offers')); ?></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="available-cuppon <?php echo e(session()->get('direction') == '2' ? 'text-right' : ''); ?>">
                        <p class="available-title text-dark fw-500" id="exampleModalLabel">
                            <?php echo e(trans('labels.available_coupons')); ?>

                        </p>
                    </div>
                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card my-3 border-0 bg-white box-shadow">
                            <div
                                class="card-body p-0 <?php echo e(session()->get('direction') == '2' ? 'pe-3' : 'ps-3'); ?> overflow-hidden ">
                                <div class="coupon bg-white rounded d-flex justify-content-between align-items-center">
                                    <div
                                        class="<?php echo e(session()->get('direction') == '2' ? 'right-side' : 'left-side'); ?> py-3 d-flex w-100 justify-content-start align-items-center">
                                        <div>
                                            <h6 class="fw-600 text-dark"><?php echo e($coupon->offer_name); ?></h6>
                                            <p class="dark_color mb-0 fw-500 fs-15 dark_color mt-1">
                                                Coupon :
                                                <span
                                                    class="fw-normal text-decoration-underline text-uppercase text-primary"><?php echo e($coupon->offer_code); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="right-side <?php echo e(session()->get('direction') == '2' ? 'border-0' : 'border-0'); ?>">
                                        <div class="info m-3 d-flex align-items-center">
                                            <span
                                                class="<?php echo e(session()->get('direction') == '2' ? 'coupn-circle-up-right' : 'coupn-circle-up-left'); ?>"></span>
                                            <div class="w-100 d-flex justify-content-center">
                                                <button class="btn btn-success px-sm-4"
                                                    onclick="copy('<?php echo e($coupon->offer_code); ?>')"><?php echo e(trans('labels.copy')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        var SITEURL = "<?php echo e(URL::to('')); ?>";
        var planlisturl = "<?php echo e(URL::to('admin/plan')); ?>";
        var buyurl = "<?php echo e(URL::to('admin/plan/buyplan')); ?>";
        var plan_name = "<?php echo e($plan->name); ?>";
        var plan_description = "<?php echo e($plan->description); ?>";
        var title = "<?php echo e(Str::limit(helper::appdata('')->website_title, 50)); ?>";
        var description = "Plan Subscription";
        var applycouponurl = "<?php echo e(URL::to('/admin/applycoupon')); ?>";
        var removecouponurl = "<?php echo e(URL::to('/admin/removecoupon')); ?>";
        var offer_code = "<?php echo e(session()->has('discount_data') ? session()->get('discount_data')['offer_code'] : 0); ?>";
        var discount = "<?php echo e(session()->has('discount_data') ? session()->get('discount_data')['offer_amount'] : 0); ?>";
        var sub_total = "<?php echo e($plan->price); ?>";
        var checkout = "<?php echo e(trans('labels.checkout')); ?>";
    </script>
    <script>
        function themeinfo(id, theme_id, plan_name) {
            let string = theme_id;
            let arr = string.split('|');
            $('#themeinfoLabel').text(plan_name);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "<?php echo e(URL::to('admin/themeimages')); ?>",
                method: 'GET',
                data: {
                    theme_id: arr
                },
                dataType: 'json',
                success: function(data) {
                    $('#theme_modalbody').html(data.output);
                    $('#themeinfo').modal('show');
                }
            })
        }
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/plan_payment.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\plan\plan_payment.blade.php ENDPATH**/ ?>