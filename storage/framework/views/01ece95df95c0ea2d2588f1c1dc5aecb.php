<?php $__env->startSection('content'); ?>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a
                        href="<?php echo e(URL::to('admin/currency-settings')); ?>" class="color-changer"><?php echo e(trans('labels.currency-settings')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/currency-settings/store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="hidden" name="name" id="currency_name">
                                <label for="code" class="col-form-label"><?php echo e(trans('labels.code')); ?> <span
                                        class="text-danger"> *
                                    </span></label>
                                <select name="code" class="form-select code-dropdown" id="code" required>
                                    <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $currencys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($currency->code); ?>"<?php echo e(old('code') == $currency->code ? 'selected' : ''); ?>

                                            data-currency-name="<?php echo e($currency->currency); ?>"><?php echo e($currency->currency); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span> <br>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="currency_symbol" class="col-form-label"><?php echo e(trans('labels.currency_symbol')); ?>

                                    <span class="text-danger"> *
                                    </span></label>
                                <select name="currency_symbol" class="form-select currency_symbol-dropdown"
                                    id="currency_symbol" required>
                                    <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $currencys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value=" <?php echo e($currency->currency_symbol); ?>"<?php echo e(old('currency_symbol') == $currency->currency_symbol ? 'selected' : ''); ?>>
                                            <?php echo e($currency->currency_symbol); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.exchange_rate')); ?><span class="text-danger">
                                        *
                                    </span></label>
                                <input type="text" class="form-control" name="exchange_rate" value="<?php echo e(old('name')); ?>"
                                    placeholder="<?php echo e(trans('labels.exchange_rate')); ?>" required>

                            </div>
                            <div class="form-group col-sm-3">
                                <p class="form-label"><?php echo e(trans('labels.currency_position')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_position" id="radio" value="1" checked
                                        <?php echo e(@$getcurrency->currency_space == '1' ? 'checked' : ''); ?> />
                                    <label for="radio" class="form-check-label"><?php echo e(trans('labels.left')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_position" id="radio1" value="2"
                                        <?php echo e(@$getcurrency->currency_space == '2' ? 'checked' : ''); ?> />
                                    <label for="radio1" class="form-check-label"><?php echo e(trans('labels.right')); ?></label>
                                </div>

                            </div>
                            <div class="col-md-3 form-group">
                                <p class="form-label">
                                    <?php echo e(trans('labels.currency_space')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_space" id="currency_space" value="1"
                                        <?php echo e(@$getcurrency->currency_space == '1' ? 'checked' : ''); ?> />
                                    <label for="currency_space" class="form-check-label"><?php echo e(trans('labels.yes')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_space" id="currency_space1" value="2" checked
                                        <?php echo e(@$getcurrency->currency_space == '2' ? 'checked' : ''); ?> />
                                    <label for="currency_space1" class="form-check-label"><?php echo e(trans('labels.no')); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.currency_formate')); ?><span class="text-danger">
                                        * </span></label>
                                <input type="text" class="form-control" name="currency_formate" value=""
                                    placeholder="<?php echo e(trans('labels.currency_formate')); ?>" required>
                                <?php $__errorArgs = ['currency_formate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.decimal_separator')); ?></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="decimal_separator" id="dot" value="1" checked
                                        <?php echo e(@$getcurrency->decimal_separator == '1' ? 'checked' : ''); ?> />
                                    <label for="dot" class="form-check-label"><?php echo e(trans('labels.dot')); ?>

                                        (.)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="decimal_separator" id="comma" value="2"
                                        <?php echo e(@$getcurrency->decimal_separator == '2' ? 'checked' : ''); ?> />
                                    <label for="comma" class="form-check-label"><?php echo e(trans('labels.comma')); ?>

                                        (,)</label>
                                </div>
                            </div>
                            <div class="form-group text-<?php echo e(session()->get('direction') == '2' ? 'start' : 'end'); ?> m-0">
                                <a href="<?php echo e(URL::to('admin/currency-settings')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_currency-settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            "user strict";
            $(".code-dropdown").change(function() {
                $('#currency_name').val($(this).find(':selected').attr('data-currency-name'));
            }).change();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/currency_settings/add.blade.php ENDPATH**/ ?>