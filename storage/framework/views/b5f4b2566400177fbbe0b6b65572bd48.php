<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.payment_settings')); ?></h5>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="accordion accordion-flush sort_menu" id="accordionExample"
                        data-url="<?php echo e(url('admin/payment/reorder_payment')); ?>">
                        <?php
                            $i = 1;
                        ?>

                        <?php $__currentLoopData = $getpayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pmdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Check if the current $pmdata is a system addon and activated
                                if ($pmdata->payment_type == '1' || $pmdata->payment_type == '16') {
                                    $systemAddonActivated = true;
                                } else {
                                    $systemAddonActivated = false;
                                }
                                $addon = App\Models\SystemAddons::where(
                                    'unique_identifier',
                                    $pmdata->unique_identifier,
                                )->first();
                                if ($addon != null && $addon->activated == 1) {
                                    $systemAddonActivated = true;
                                }
                                $transaction_type = strtolower($pmdata->payment_type);
                            ?>
                            <?php if($systemAddonActivated): ?>
                                <form action="<?php echo e(URL::to('admin/payment/update')); ?>" method="POST" class="payments"
                                    data-id="<?php echo e($pmdata->id); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="payment_id" value="<?php echo e($pmdata->payment_type); ?>">
                                    <input type="hidden" name="payment_name" value="<?php echo e($transaction_type); ?>">
                                    <div class="payment-accordian card rounded box-shadow border mb-3 handle">
                                        <h2 class="card-header d-flex align-items-center rounded border-0 justify-content-between"
                                            id="heading<?php echo e($transaction_type); ?>">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?php echo e(helper::image_path($pmdata->image)); ?>" alt=""
                                                    class="img-fluid rounded" height="30" width="30">
                                                <b><?php echo e($pmdata->payment_name); ?></b>
                                                <?php if(in_array($transaction_type, ['2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'])): ?>
                                                    <?php if(env('Environment') == 'sendbox'): ?>
                                                        <span
                                                            class="badge badge bg-danger"><?php echo e(trans('labels.addon')); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <a class="cursor-pointer" tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right"></i></a>
                                        </h2>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label">
                                                        <?php echo e(trans('labels.payment_name')); ?>

                                                        <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="<?php echo e(trans('labels.payment_name')); ?>"
                                                        value="<?php echo e($pmdata->payment_name); ?>" required>
                                                </div>
                                                <?php if($transaction_type == '6'): ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image" class="form-label">
                                                                <?php echo e(trans('labels.image')); ?> </label>
                                                            <input type="file" class="form-control" name="image">

                                                            <img src="<?php echo e(helper::image_path($pmdata->image)); ?>"
                                                                alt="" class="img-fluid rounded hw-50 mt-1 object">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                <?php echo e(trans('labels.payment_description')); ?>

                                                                <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="ckeditor" name="payment_description"><?php echo e($pmdata->payment_description); ?></textarea>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(in_array($transaction_type, ['2', '3', '4', '5', '7', '8', '9', '10', '11', '12', '13', '14', '15'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="form-label"><?php echo e(trans('labels.environment')); ?></p>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="environment[<?php echo e($transaction_type); ?>]"
                                                                id="<?php echo e($transaction_type); ?>_<?php echo e($key); ?>_environment"
                                                                value="1"
                                                                <?php echo e($pmdata->environment == 1 ? 'checked' : ''); ?>>
                                                            <label class="form-check-label"
                                                                for="<?php echo e($transaction_type); ?>_<?php echo e($key); ?>_environment">
                                                                <?php echo e(trans('labels.sandbox')); ?> </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="environment[<?php echo e($transaction_type); ?>]"
                                                                id="<?php echo e($transaction_type); ?>_<?php echo e($i); ?>_environment"
                                                                value="2"
                                                                <?php echo e($pmdata->environment == 2 ? 'checked' : ''); ?>>
                                                            <label class="form-check-label"
                                                                for="<?php echo e($transaction_type); ?>_<?php echo e($i); ?>_environment">
                                                                <?php echo e(trans('labels.production')); ?> </label>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-md-6 <?php echo e($transaction_type == '7' ? 'd-none' : ''); ?>  <?php echo e($transaction_type == '9' ? 'd-none' : ''); ?> <?php echo e($transaction_type == '14' ? 'd-none' : ''); ?>">
                                                        <div class="form-group">
                                                            <label for="<?php echo e($transaction_type); ?>_publickey"
                                                                class="form-label">
                                                                <?php if($transaction_type == '11'): ?>
                                                                    <?php echo e(trans('labels.merchant_id')); ?>

                                                                <?php elseif($transaction_type == '12'): ?>
                                                                    <?php echo e(trans('labels.profile_key')); ?>

                                                                <?php else: ?>
                                                                    <?php echo e(trans('labels.public_key')); ?>

                                                                <?php endif; ?>
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="<?php echo e($transaction_type); ?>_publickey"
                                                                class="form-control"
                                                                name="public_key[<?php echo e($transaction_type); ?>]"
                                                                placeholder="<?php if($transaction_type == '11'): ?> <?php echo e(trans('labels.merchant_id')); ?> <?php else: ?> <?php echo e(trans('labels.secret_key')); ?> <?php endif; ?>"
                                                                <?php if(env('Environment') == 'sendbox'): ?> value="*********" <?php else: ?> value="<?php echo e($pmdata->public_key); ?>" <?php endif; ?>
                                                                <?php echo e($transaction_type == '9' || $transaction_type == '14' ? '' : 'required'); ?>>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class=" <?php echo e($transaction_type == '7' ? 'col-md-12' : 'col-md-6'); ?> <?php echo e($transaction_type == '9' ? 'col-md-12' : 'col-md-6'); ?>">
                                                        <div class="form-group">
                                                            <label for="<?php echo e($transaction_type); ?>_secretkey"
                                                                class="form-label">
                                                                <?php if($transaction_type == '11'): ?>
                                                                    <?php echo e(trans('labels.salt_key')); ?>

                                                                <?php else: ?>
                                                                    <?php echo e(trans('labels.secret_key')); ?>

                                                                <?php endif; ?> <span class="text-danger">
                                                                    *</span>
                                                            </label>
                                                            <input type="text" id="<?php echo e($transaction_type); ?>_secretkey"
                                                                class="form-control"
                                                                name="secret_key[<?php echo e($transaction_type); ?>]"
                                                                placeholder="<?php if($transaction_type == '11'): ?> <?php echo e(trans('labels.salt_key')); ?>

                                                            <?php else: ?>
                                                                <?php echo e(trans('labels.secret_key')); ?> <?php endif; ?>"
                                                                <?php if(env('Environment') == 'sendbox'): ?> value="*********" <?php else: ?> value="<?php echo e($pmdata->secret_key); ?>" <?php endif; ?>
                                                                required>
                                                        </div>
                                                    </div>
                                                    <?php if($transaction_type == '4'): ?>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="encryption_key"
                                                                    class="form-label"><?php echo e(trans('labels.encryption_key')); ?>

                                                                    <span class="text-danger"> *</span>
                                                                </label>
                                                                <input type="text" id="encryptionkey"
                                                                    class="form-control" name="encryption_key"
                                                                    placeholder="<?php echo e(trans('labels.encryption_key')); ?>"
                                                                    <?php if(env('Environment') == 'sendbox'): ?> value="*********" <?php else: ?> value="<?php echo e($pmdata->encryption_key); ?>" <?php endif; ?>
                                                                    required>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($transaction_type == '12'): ?>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="base_url_by_region" class="form-label">
                                                                    <?php echo e(trans('labels.base_url_by_region')); ?>

                                                                    <span class="text-danger"> *</span>
                                                                </label>
                                                                <input type="text" id="base_url_by_region"
                                                                    class="form-control" name="base_url_by_region"
                                                                    placeholder="<?php echo e(trans('labels.base_url_by_region')); ?>"
                                                                    value="<?php echo e($pmdata->base_url_by_region); ?>"
                                                                    <?php echo e($transaction_type == 'paytab' ? 'required' : ''); ?>>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($transaction_type != '6'): ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="image" class="form-label">
                                                                    <?php echo e(trans('labels.image')); ?> </label>
                                                                <input type="file" class="form-control"
                                                                    name="image">

                                                                <img src="<?php echo e(helper::image_path($pmdata->image)); ?>"
                                                                    alt=""
                                                                    class="img-fluid rounded hw-50 mt-1 object">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="<?php echo e($transaction_type); ?>currency"
                                                                class="form-label">
                                                                <?php echo e(trans('labels.currency')); ?>

                                                                <span class="text-danger"> *</span>
                                                            </label>
                                                            <input type="text" id="<?php echo e($transaction_type); ?>currency"
                                                                class="form-control"
                                                                name="currency[<?php echo e($transaction_type); ?>]"
                                                                placeholder="<?php echo e(trans('labels.currency')); ?>"
                                                                value="<?php echo e($pmdata->currency); ?>" required>
                                                        </div>
                                                    </div>
                                                <?php elseif($transaction_type == 1): ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image" class="form-label">
                                                                <?php echo e(trans('labels.image')); ?> </label>
                                                            <input type="file" class="form-control" name="image">

                                                            <img src="<?php echo e(helper::image_path($pmdata->image)); ?>"
                                                                alt=""
                                                                class="img-fluid rounded hw-50 mt-1 object">
                                                        </div>
                                                    </div>
                                                <?php elseif($transaction_type == 16): ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image" class="form-label">
                                                                <?php echo e(trans('labels.image')); ?> </label>
                                                            <input type="file" class="form-control" name="image">

                                                            <img src="<?php echo e(helper::image_path($pmdata->image)); ?>"
                                                                alt=""
                                                                class="img-fluid rounded hw-50 mt-1 object">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <input id="checkbox-switch-<?php echo e($transaction_type); ?>"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="is_available[<?php echo e($transaction_type); ?>]" value="1"
                                                            <?php echo e($pmdata->is_available == 1 ? 'checked' : ''); ?>>
                                                        <label for="checkbox-switch-<?php echo e($transaction_type); ?>"
                                                            class="switch">
                                                            <span
                                                                class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                                    class="switch__circle-inner"></span></span>
                                                            <span
                                                                class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                            <span
                                                                class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                                        </label>
                                                    </div>
                                                    <button
                                                        class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_payment_methods', Auth::user()->role_id, $vendor_id, 'add') == 1 || helper::check_access('role_payment_methods', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        <?php if(count($errors) > 0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error("<?php echo e($error); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        $(document).ready(function() {
            $('.sort_menu').sortable({
                handle: '.handle',
                cursor: 'move',
                placeholder: 'highlight',
                axis: "y",
                header: "> div > h2",
                update: function(e, ui) {
                    var sortData = $('.sort_menu').sortable('toArray', {
                        attribute: 'data-id'
                    })
                    updateToDatabase(sortData.join('|'))
                }
            })

            function updateToDatabase(idString) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    dataType: "json",
                    url: $('#accordionExample').attr('data-url'),
                    data: {
                        ids: idString,
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.success(wrong);
                        }
                    }
                });
            }

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/payment.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/payment/payment.blade.php ENDPATH**/ ?>