<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 color-changer text-dark fs-4"><?php echo e(trans('labels.top_deals')); ?></h5>
    </div>
    <div class="row">
        <div id="top_deals">
            <div class="row my-4">
                <div class="col-12">
                    <div class="col-12">
                        <div class="card border-0 box-shadow">
                            <div class="card-body pb-0">

                                <form action="<?php echo e(URL::to('admin/top_deals/update')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label class="form-label"><?php echo e(trans('labels.deals_type')); ?> <span
                                                    class="text-danger"> * </span></label>

                                            <select name="deal_type" class="form-select" id="deal_type" required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1" <?php echo e(@$topdeals->deal_type == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.one_time')); ?></option>
                                                <option value="2" <?php echo e(@$topdeals->deal_type == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.daily')); ?></option>
                                            </select>

                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label" for=""><?php echo e(trans('labels.top_deals')); ?>

                                            </label>
                                            <input id="top_deals_switch" type="checkbox" class="checkbox-switch"
                                                name="top_deals_switch" value="1"
                                                <?php echo e(@$topdeals->top_deals_switch == 1 ? 'checked' : ''); ?>>
                                            <label for="top_deals_switch" class="switch">
                                                <span
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                        class="switch__circle-inner"></span></span>
                                                <span
                                                    class="switch__left  <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                <span
                                                    class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                            </label>
                                        </div>

                                        <div class="col-sm-6 form-group d-none" id="start_date">
                                            <label class="form-label"><?php echo e(trans('labels.start_date')); ?>

                                                <span class="text-danger"> * </span></label>
                                            <input type="date" class="form-control" id="top_deals_start_date"
                                                name="top_deals_start_date" value="<?php echo e(@$topdeals->start_date); ?>">
                                        </div>
                                        <div class="col-sm-6 form-group d-none" id="end_date">
                                            <label class="form-label"><?php echo e(trans('labels.end_date')); ?>

                                                <span class="text-danger"> * </span></label>
                                            <input type="date" class="form-control" id="top_deals_end_date"
                                                name="top_deals_end_date" value="<?php echo e(@$topdeals->end_date); ?>">
                                        </div>


                                        <div class="col-sm-6 form-group">
                                            <label class="form-label" for="start_time"><?php echo e(trans('labels.start_time')); ?>

                                                <span class="text-danger"> * </span></label>
                                            <input type="time" class="form-control" name="top_deals_start_time"
                                                id="start_time" value="<?php echo e(@$topdeals->start_time); ?>" required>
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label class="form-label" for="end_time"><?php echo e(trans('labels.end_time')); ?>

                                                <span class="text-danger"> * </span></label>
                                            <input type="time" class="form-control" name="top_deals_end_time"
                                                id="end_time" value="<?php echo e(@$topdeals->end_time); ?>" required>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.offer_type')); ?>

                                                <span class="text-danger"> * </span></label>
                                            <select class="form-select" name="offer_type" required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1"
                                                    <?php echo e(@$topdeals->offer_type == '1' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.fixed')); ?>

                                                </option>
                                                <option value="2"
                                                    <?php echo e(@$topdeals->offer_type == '2' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.percentage')); ?>

                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.discount')); ?><span
                                                    class="text-danger"> *
                                                </span></label>
                                            <input type="text" class="form-control numbers_only" name="amount"
                                                value="<?php echo e(@$topdeals->offer_amount); ?>"
                                                placeholder="<?php echo e(trans('labels.discount')); ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.products')); ?></label>
                                            <select class="form-control selectpicker" name="products[]" multiple
                                                data-live-search="true">

                                                <?php if(!empty($getItem)): ?>
                                                    <?php $__currentLoopData = $getItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($products->id); ?>">
                                                            <?php echo e($products->item_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.description')); ?><span
                                                    class="text-danger"> *
                                                </span></label>
                                            <input type="text" class="form-control " name="description"
                                                value="<?php echo e(@$topdeals->description); ?>"
                                                placeholder="<?php echo e(trans('labels.description')); ?>" required>
                                        </div>


                                        <div class="form-group <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                            <button
                                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_top_deals', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="text-capitalize fw-600 text-dark color-changer fs-4"></div>
            <div class="d-flex align-items-center" >
                <!-- Bulk Delete Button -->
                <?php if(@helper::checkaddons('bulk_delete')): ?>
                <button id="bulkDeleteBtn"
                    <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to('admin/top_deals/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex " tooltip="<?php echo e(trans('labels.delete')); ?>" style="margin-right: 20px;">
                    <i class="fa-regular fa-trash"></i>
                </button>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12">

            <div class="card border-0 my-3 box-shadow">

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                            <thead>

                                <tr class=" text-capitalize fs-15 fw-500">
                                    <?php if(@helper::checkaddons('bulk_delete')): ?>
                                        <?php if($productlist->count() > 0): ?>
                                            <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.products')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>

                            </thead>

                            <tbody>

                                <?php $i = 1; ?>

                                <?php $__currentLoopData = @$productlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7  align-middle">
                                        <?php if(@helper::checkaddons('bulk_delete')): ?>
                                            <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="<?php echo e($product->id); ?>"></td>
                                        <?php endif; ?>
                                        <td><?php echo $i++; ?></td>

                                        <td><?php echo e($product->item_name); ?></td>
                                        <td><?php echo e(helper::date_format($product->created_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($product->created_at, $product->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($product->updated_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($product->updated_at, $product->vendor_id)); ?>

                                        </td>

                                        <td>
                                            <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/top_deals/delete-' . $product->id)); ?>')" <?php endif; ?>
                                                class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_top_deals', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                <i class="fa-regular fa-trash"></i></a>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script>
            $('#deal_type').on('change', function() {
                if ($('#deal_type').val() == 1) {
                    $('#start_date').removeClass('d-none');
                    $('#end_date').removeClass('d-none');
                    $('#top_deals_start_date').prop('required', true);
                    $('#top_deals_end_date').prop('required', true);
                } else {
                    $('#start_date').addClass('d-none');
                    $('#end_date').addClass('d-none');
                    $('#top_deals_start_date').prop('required', false);
                    $('#top_deals_end_date').prop('required', false);
                }
            }).change()
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\top_deals\index.blade.php ENDPATH**/ ?>