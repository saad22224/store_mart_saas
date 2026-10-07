<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header p-3 bg-white">
                    <h6 class="text-dark fs-600"><?php echo e(trans('labels.step_1')); ?> :</h6>
                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex text-dark flex-column gap-2 fw-500">
                        <li class="d-flex gap-1">
                            <b>1.</b> <?php echo e(trans('labels.vendor_import_download_file')); ?>

                        </li>
                        <li class="d-flex gap-1"><b>2.</b>
                            <?php echo e(trans('labels.vendor_import_download_example_file_to_understand')); ?></li>
                        <li class="d-flex gap-1"><b>3.</b> <?php echo e(trans('labels.vendor_import_upload_submit')); ?></li>
                    </ul>
                </div>
            </div>
            <a href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/sample_demo.xlsx')); ?>"
                class="btn btn-primary px-sm-4 fs-15 fw-500 mb-3"><?php echo e(trans('labels.download_CSV')); ?></a>
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header p-3 bg-white">
                    <h6 class="text-dark fs-600"><?php echo e(trans('labels.step_2')); ?> :</h6>
                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex text-dark flex-column gap-2 fw-500">
                        <li class="d-flex gap-1"><b>1.</b> <?php echo e(trans('labels.vendor_import_download_file')); ?></li>
                        <li class="d-flex gap-1"><b>2.</b>
                            <?php echo e(trans('labels.vendor_import_download_example_file_to_understand')); ?></li>
                        <li class="d-flex gap-1"><b>3.</b> <?php echo e(trans('labels.vendor_import_upload_submit')); ?></li>
                    </ul>
                </div>
            </div>
            <a href="<?php echo e(URL::to('admin/users/generate_city_pdf')); ?>"
                class="btn btn-primary px-sm-4 fs-15 fw-500 mb-3"><?php echo e(trans('labels.download_city')); ?></a>
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/users/import_vendor')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-12 form-group">
                            <label class="form-label"><?php echo e(trans('labels.vendor_upload')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="file" class="form-control" name="importfile" id="importfile" multiple=""
                                required>
                        </div>
                        <button
                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4 fs-15 fw-500 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.import')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\import_vendor\import.blade.php ENDPATH**/ ?>