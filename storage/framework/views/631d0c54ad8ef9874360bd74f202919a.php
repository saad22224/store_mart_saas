<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    if (request()->is('admin/sliders*')) {
        $section = 0;
        $title = trans('labels.sliders');
        $url = 'sliders';
    } elseif (request()->is('admin/bannersection-1*')) {
        $section = 1;
        $title = trans('labels.section-1');
        $url = 'bannersection-1';
    } elseif (request()->is('admin/bannersection-2*')) {
        $section = 2;
        $title = trans('labels.section-2');
        $url = 'bannersection-2';
    }
?>


<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e($title); ?></h5>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <!-- Bulk Delete Button -->
            <?php if(@helper::checkaddons('bulk_delete')): ?>
            <button id="bulkDeleteBtn"
                <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deleteSelected('<?php echo e(URL::to(request()->url() . '/bulk_delete')); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm d-none d-flex" tooltip="<?php echo e(trans('labels.delete')); ?>">
                <i class="fa-regular fa-trash"></i>
            </button>
            <?php endif; ?>
            <?php if(
                (Auth::user()->type == 4 && helper::check_access('role_banner', Auth::user()->role_id, $vendor_id, 'add') == 1) ||
                    helper::check_access('role_sliders', Auth::user()->role_id, $vendor_id, 'add') == 1): ?>
                <a href="<?php echo e(URL::to(request()->url() . '/add')); ?>" class="btn btn-secondary px-sm-4 d-flex">
                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                </a>
            <?php endif; ?>
            <?php if(Auth::user()->type == 1 || Auth::user()->type == 2): ?>
                <a href="<?php echo e(URL::to(request()->url() . '/add')); ?>" class="btn btn-secondary px-sm-4 d-flex">
                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php echo $__env->make('admin.banner.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/banner/banner.blade.php ENDPATH**/ ?>