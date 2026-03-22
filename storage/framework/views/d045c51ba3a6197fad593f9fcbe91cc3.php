<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.refund_policy')); ?></h5>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <div id="privacy-policy-three" class="privacy-policy">

                        <form action="<?php echo e(URL::to('admin/refund_policy/update')); ?>" method="post">

                            <?php echo csrf_field(); ?>

                            <textarea class="form-control" id="ckeditor" name="refund_policy" required><?php echo e(@$policy->refund_policy); ?></textarea>
                            <div class="form-group m-0 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">

                                <button
                                    class="btn btn-primary px-sm-4 mt-3 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cms_pages', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>

    <script type="text/javascript">
        CKEDITOR.replace('ckeditor');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/envato_storemart/Storemart_V4.4/Storemart_Addon/resources/views/admin/otherpages/refundpolicy.blade.php ENDPATH**/ ?>