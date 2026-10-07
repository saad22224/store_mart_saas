<?php
    if(Auth::user()->type == 4)
    {
        $vendor_id = Auth::user()->vendor_id;
    }else{
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="mb-3 d-flex flex-wrap justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.product_upload')); ?> <?php if(env('Environment') == 'sendbox'): ?>
            <span class="badge badge bg-danger float-right mr-1 mb-2"><?php echo e(trans('labels.addon')); ?></span> <?php endif; ?></h5>
        <a href="<?php echo e(URL::to('/admin/media')); ?>" class="btn btn-secondary col-12 mt-2 mt-sm-0 justify-content-center gap-1 col-sm-auto px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_import_product', Auth::user()->role_id,$vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add_media')); ?></a>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header p-3 bg-transparent border-bottom">
                    <h6 class="text-dark color-changer fs-600"><?php echo e(trans('labels.step_1')); ?> :</h6>
                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex text-dark flex-column gap-2 fw-500">
                        <li class="d-flex color-changer gap-1">
                            <b>1.</b> <?php echo e(trans('labels.download_file')); ?>

                        </li>
                        <li class="d-flex gap-1 color-changer"><b>2.</b>  <?php echo e(trans('labels.download_example_file_to_understand')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>3.</b>  <?php echo e(trans('labels.upload_submit')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>4.</b>  <?php echo e(trans('labels.after_uploading_products')); ?></li>
                    </ul>
                </div>
            </div>
            <a href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/Sample.xlsx')); ?>" class="btn btn-primary px-sm-4 fs-15 fw-500 mb-3"><?php echo e(trans('labels.download_CSV')); ?></a>
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header p-3 bg-transparent border-bottom">
                    <h6 class="text-dark color-changer fs-600"><?php echo e(trans('labels.step_2')); ?> :</h6>
                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex text-dark flex-column gap-2 fw-500">
                        <li class="d-flex gap-1 color-changer"><b>1.</b>  <?php echo e(trans('labels.category_numeric')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>2.</b>  <?php echo e(trans('labels.download_pdf')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>3.</b>  <?php echo e(trans('labels.category_step_3')); ?></li>
                    </ul>
                </div>
            </div>
            <a href="<?php echo e(URL::to('/admin/generatepdf')); ?>"  class="btn btn-primary px-sm-4 fs-15 fw-500 mb-3"><?php echo e(trans("labels.download_category")); ?></a>
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header p-3 bg-transparent border-bottom">
                    <h6 class="text-dark color-changer fs-600"><?php echo e(trans('labels.step_3')); ?> :</h6>
                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex text-dark flex-column gap-2 fw-500">
                        <li class="d-flex gap-1 color-changer"><b>1.</b> <?php echo e(trans('labels.tax_numeric')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>2.</b> <?php echo e(trans('labels.download_taxpdf')); ?></li>
                        <li class="d-flex gap-1 color-changer"><b>3.</b> <?php echo e(trans('labels.tax_step_3')); ?></li>
                    </ul>
                </div>
            </div>
            <a href="<?php echo e(URL::to('/admin/generatetaxpdf')); ?>"  class="btn btn-primary px-sm-4 fs-15 fw-500 mb-3"><?php echo e(trans("labels.download_tax")); ?></a>

            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/importproduct')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-12 form-group">
                            <label class="form-label"><?php echo e(trans('labels.product_upload')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="file" class="form-control" name="importfile" id="importfile" multiple="" required>
                        </div>
                        <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?> class="btn btn-primary px-sm-4 fs-15 fw-500 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.import')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\import\import.blade.php ENDPATH**/ ?>