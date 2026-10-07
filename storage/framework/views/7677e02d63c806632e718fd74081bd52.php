<?php
     if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/custom_domain')); ?>" class="color-changer"><?php echo e(trans('labels.custom_domains')); ?></a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="alert alert-warning">
                        <small>You already have a custom domain
                            (<a target="_blank" href="//<?php echo e(helper::appdata($vendor_id)->custom_domain); ?>"><?php echo e(empty(helper::appdata($vendor_id)->custom_domain) ? '-' : helper::appdata($vendor_id)->custom_domain); ?></a>)
                            connected with your website. <br>
                            if you request another domain now &amp; if it gets connected with our server, then
                            your current domain
                            (<a target="_blank" href="//<?php echo e(helper::appdata($vendor_id)->custom_domain); ?>"><?php echo e(empty(helper::appdata($vendor_id)->custom_domain) ? '-' : helper::appdata($vendor_id)->custom_domain); ?></a>)
                            will be removed.</small>
                    </div>
                    <form class="col-md-12 my-2" action="<?php echo e(URL::to('admin/custom_domain/save')); ?>">
                        <div class="my-2">
                            <label for="custom_domain"> <?php echo e(trans('labels.custom_domains')); ?></label>
                            <input type="text" name="custom_domain" class="form-control" placeholder="<?php echo e(trans('labels.custom_domains')); ?>" required>
                          
                        </div>
                        <p class="mb-0 color-changer"><i class="fas fa-exclamation-circle"></i> Do not use
                            <strong class="text-danger">http://</strong> or <strong class="text-danger">https://</strong>
                        </p>
                        <p class="mb-0 mb-2 color-changer"><i class="fas fa-exclamation-circle"></i>
                            The valid format will be exactly like this one - <strong class="text-danger">domain.tld,
                                www.domain.tld</strong> or <strong class="text-danger">subdomain.domain.tld,
                                www.subdomain.domain.tld</strong>
                        </p>
                        <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/custom_domain')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button <?php if(env('Environment')=='sendbox' ): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?> class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 || helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\customdomain\add.blade.php ENDPATH**/ ?>