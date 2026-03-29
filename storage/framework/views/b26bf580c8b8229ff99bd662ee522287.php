<div class="modal fade age_modal" id="age_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="age_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                
                <h5 class="modal-title fw-600 color-changer d-flex align-items-center gap-2" id="age_modalLabel"><span
                        class="number-verification"><?php echo e(@helper::getagedetails($storeinfo->id)->min_age); ?>+</span>
                    <?php echo e(trans('labels.age_verification')); ?></h5>
                <button type="button" class="bg-transparent border-0 m-0" onclick="ageverificationclose()">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
                
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <div class="alert alert-danger p-2 fs-7" style="display: none;" id="age-alert" role="alert">
                        <?php echo e(trans('labels.age_alert')); ?>

                    </div>
                    <p class="mt-2 fs-15 color-changer"><?php echo e(trans('labels.age_verification_text')); ?></p>
                </div>

                <input type="hidden" id="popup_type" value="<?php echo e(@helper::getagedetails($storeinfo->id)->popup_type); ?>">
                <input type="hidden" id="min_age" value="<?php echo e(@helper::getagedetails($storeinfo->id)->min_age); ?>">
                <div class="row g-3">
                    <?php if(@helper::getagedetails($storeinfo->id)->popup_type == 2): ?>
                        <div class="form-group col-sm-4">
                            <input type="number" inputmode="numeric" name="dd" id="dd" placeholder="DD"
                                class="form-control p-2 fs-7" value="">
                            <span class="text-danger" id="dd-required"
                                style="display: none;"><?php echo e(trans('labels.required')); ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="number" inputmode="numeric" name="mm" id="mm" placeholder="MM"
                                class="form-control p-2 fs-7" value="">
                            <span class="text-danger" id="mm-required"
                                style="display: none;"><?php echo e(trans('labels.required')); ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="number" inputmode="numeric" name="yyyy" id="yyyy" placeholder="YYYY"
                                class="form-control p-2 fs-7" value="">
                            <span class="text-danger" id="yyyy-required"
                                style="display: none;"><?php echo e(trans('labels.required')); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if(@helper::getagedetails($storeinfo->id)->popup_type == 3): ?>
                        <div class="col-md-12">
                            <input type="number" inputmode="numeric" name="age" id="age"
                                class="form-control p-2 fs-7" value=""
                                placeholder="<?php echo e(trans('labels.enter_age')); ?>">
                            <span class="text-danger" id="age-required"
                                style="display: none;"><?php echo e(trans('labels.required')); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer p-3">
                <div class="col-12 m-0">
                    <div class="row g-3">
                        <div class="col-6">
                            <button type="button" onclick="ageverificationcancel()"
                                class="btn btn-age-outline m-0 w-100 px-0"><?php echo e(trans('labels.cancel')); ?></button>
                        </div>
                        <div class="col-6">
                            <button type="button" onclick="ageverification()" class="btn btn-age m-0 w-100 px-0">
                                <?php if(@helper::getagedetails($storeinfo->id)->popup_type == 1): ?>
                                    <?php echo e(trans('labels.yes_i_am')); ?>

                                    <?php echo e(@helper::getagedetails($storeinfo->id)->min_age); ?>

                                <?php else: ?>
                                    <?php echo e(trans('labels.yes')); ?>

                                <?php endif; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/front/age_modal.blade.php ENDPATH**/ ?>