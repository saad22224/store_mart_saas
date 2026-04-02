<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    if (request()->is('admin/sliders*')) {
        $section = 0;
        $title = trans('labels.sliders');
        $url = URL::to('admin/sliders');
    } elseif (request()->is('admin/bannersection-1*')) {
        $section = 1;
        $title = trans('labels.section-1');
        $url = URL::to('admin/bannersection-1');
    } elseif (request()->is('admin/bannersection-2*')) {
        $section = 2;
        $title = trans('labels.section-2');
        $url = URL::to('admin/bannersection-2');
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e($url); ?>" class="color-changer"><?php echo e($title); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e($url . '/store'); ?>" method="POST" enctype="multipart/form-data" class="m-0">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" name="section" value="<?php echo e($section); ?>">
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.type')); ?></label>
                                <select class="form-select type" name="banner_info" required>
                                    <option value="0"><?php echo e(trans('labels.select')); ?> </option>
                                    <option value="1" <?php echo e(old('banner_info') == '1' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.category')); ?></option>
                                    <option value="2" <?php echo e(old('banner_info') == '2' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.product')); ?></option>
                                </select>

                            </div>

                            <div class="col-sm-6 form-group 1 gravity">
                                <label class="form-label"><?php echo e(trans('labels.category')); ?><span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="category" id="category" required>
                                    <option value="" selected><?php echo e(trans('labels.select')); ?> </option>
                                    <?php $__currentLoopData = $getcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(old('category') == $item->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>

                            <div class="col-sm-6 form-group 2 gravity">
                                <label class="form-label"><?php echo e(trans('labels.product')); ?><span class="text-danger"> *
                                    </span></label>
                                <select class="form-select" name="product" id="product" required>
                                    <option value="" selected><?php echo e(trans('labels.select')); ?> </option>
                                    <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(old('product') == $item->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->item_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?> <span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e(URL::to($url)); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_banner', Auth::user()->role_id, $vendor_id, 'add') == 1 || helper::check_access('role_sliders', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button"
                                    onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
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
        $('.type').on('change', function() {
            "use strict";
            var optionValue = $(this).find("option:selected").attr("value");

            if (optionValue) {
                $(".gravity").not("." + optionValue).hide();
                $(".gravity").not("." + optionValue).find('select').prop('required', false);
                $("." + optionValue).show();
                $("." + optionValue).find('select').prop('required', true);

            } else {
                $(".gravity").hide();
                $(".gravity").find('select').prop('required', false);
                $('#link_text').prop('required', false);
            }
            if (optionValue != 0) {
                $('#link_text').prop('required', true);
                $('.link_text').removeClass('d-none');

            } else {
                $('#link_text').prop('required', false);
                $('.link_text').addClass('d-none');
            }
        }).change();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/banner/add.blade.php ENDPATH**/ ?>