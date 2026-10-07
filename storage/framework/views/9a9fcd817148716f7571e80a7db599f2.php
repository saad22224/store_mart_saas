<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/currency-settings')); ?>"
                        class="color-changer"><?php echo e(trans('labels.currency-settings')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <?php
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
        ?>
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/currency-settings/update-' . $editcurrency->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.currency')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" name="currency" required>
                                    <option value=""><?php echo e(trans('labels.select_currency_symbol')); ?>

                                    </option>
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency->currency_symbol); ?>"
                                            <?php echo e($currency->currency_symbol == $editcurrency->currency ? 'selected' : ''); ?>>
                                            <?php echo e($currency->currency_symbol); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.exchange_rate')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="exchange_rate"
                                    value="<?php echo e($editcurrency->exchange_rate); ?>"
                                    placeholder="<?php echo e(trans('labels.exchange_rate')); ?>" required>

                            </div>
                            <div class="form-group col-sm-3">
                                <p class="form-label"><?php echo e(trans('labels.currency_position')); ?>

                                </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_position" id="radio" value="1"
                                        <?php echo e($editcurrency->currency_position == '1' ? 'checked' : ''); ?> />
                                    <label for="radio" class="form-check-label"><?php echo e(trans('labels.left')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_position" id="radio1" value="2"
                                        <?php echo e($editcurrency->currency_position == '2' ? 'checked' : ''); ?> />
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
                                        <?php echo e($editcurrency->currency_space == '1' ? 'checked' : ''); ?> />
                                    <label for="currency_space" class="form-check-label"><?php echo e(trans('labels.yes')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="currency_space" id="currency_space1" value="2"
                                        <?php echo e($editcurrency->currency_space == '2' ? 'checked' : ''); ?> />
                                    <label for="currency_space1" class="form-check-label"><?php echo e(trans('labels.no')); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form-label"><?php echo e(trans('labels.currency_formate')); ?><span class="text-danger">
                                        * </span></label>
                                <input type="text" class="form-control" name="currency_formate"
                                    value="<?php echo e($editcurrency->currency_formate); ?>"
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
                                        name="decimal_separator" id="dot" value="1"
                                        <?php echo e($editcurrency->decimal_separator == '1' ? 'checked' : ''); ?> />
                                    <label for="dot" class="form-check-label"><?php echo e(trans('labels.dot')); ?>

                                        (.)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-secondary" type="radio"
                                        name="decimal_separator" id="comma" value="2"
                                        <?php echo e($editcurrency->decimal_separator == '2' ? 'checked' : ''); ?> />
                                    <label for="comma" class="form-check-label"><?php echo e(trans('labels.comma')); ?>

                                        (,)</label>
                                </div>
                            </div>
                            <div class="text-<?php echo e(session()->get('direction') == '2' ? 'start' : 'end'); ?>">
                                <a href="<?php echo e(URL::to('admin/currency-settings')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                    class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\currency_settings\edit.blade.php ENDPATH**/ ?>