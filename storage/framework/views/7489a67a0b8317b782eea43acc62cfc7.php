<div id="shopify_settings">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-capitalize fw-600 text-dark">
                        <?php echo e(trans('labels.shopify_settings')); ?>

                    </h5>
                </div>
                <div class="card-body">
                    
                    <form action="<?php echo e(URL::to('admin/settings/shopify_settings')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="shopify_store_url"
                                    class="form-label"><?php echo e(trans('labels.shopify_store_url')); ?> </label>
                                <input type="text" class="form-control" name="shopify_store_url"
                                    placeholder="<?php echo e(trans('labels.shopify_store_url')); ?>"
                                    value="<?php echo e(@$settingdata->shopify_store_url); ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shopify_access_token"
                                    class="form-label"><?php echo e(trans('labels.shopify_access_token')); ?> </label>
                                <input type="text" class="form-control" name="shopify_access_token"
                                    placeholder="<?php echo e(trans('labels.shopify_access_token')); ?>"
                                    value="<?php echo e(@$settingdata->shopify_access_token); ?>" required>
                            </div>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/shopify/shopify_setting.blade.php ENDPATH**/ ?>