<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.custom_domains')); ?></h5>
        <div class="col-sm-auto col-12 mt-2 mt-sm-0">
            <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                <a href="<?php echo e(URL::to('admin/custom_domain/add')); ?>"
                    class="btn btn-secondary px-sm-4 w-100 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.request_custom_domain')); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                <?php echo $__env->make('admin.customdomain.setting_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                <?php echo $__env->make('admin.customdomain.partials.guide', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <div class="card border-0 mb-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                            <?php echo $__env->make('admin.customdomain.customdomain_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1)): ?>
                            <?php echo $__env->make('admin.customdomain.listcustomdomain_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                    <?php if(Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1)): ?>
                        <?php if(!empty($setting->cname_title) || !empty($setting->cname_text)): ?>
                            <div class="card mt-4 border">
                                <div class="card-header border-bottom color-changer">
                                    <?php echo e($setting->cname_title ?: trans('labels.read_before_sending_custom_domain_request')); ?>

                                </div>
                                <div class="card-body color-changer fs-7">
                                    <div class="card-text"><?php echo $setting->cname_text; ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        if (document.getElementById('cname_text')) {
            CKEDITOR.replace('cname_text');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/customdomain/customdomain.blade.php ENDPATH**/ ?>