<div id="pixel_settings">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-capitalize fw-600 settings-color">
                        <?php echo e(trans('labels.pixel_settings')); ?>

                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/pixcel_settings')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="facebook_pixcel_id" class="form-label"><?php echo e(trans('labels.facebook')); ?>

                                </label>
                                <input type="text" class="form-control" name="facebook_pixcel_id"
                                    placeholder="<?php echo e(trans('labels.facebook_pixcel_id')); ?>"
                                    value="<?php echo e(@$pixelsettings->facebook_pixcel_id); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="twitter_pixcel_id" class="form-label"><?php echo e(trans('labels.twitter')); ?> </label>
                                <input type="text" class="form-control" name="twitter_pixcel_id"
                                    placeholder="<?php echo e(trans('labels.twitter_pixcel_id')); ?>"
                                    value="<?php echo e(@$pixelsettings->twitter_pixcel_id); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="linkedin_pixcel_id" class="form-label"><?php echo e(trans('labels.linkedin')); ?>

                                </label>
                                <input type="text" placeholder="<?php echo e(trans('labels.linkedin_pixcel_id')); ?>"
                                    class="form-control" name="linkedin_pixcel_id"
                                    value="<?php echo e(@$pixelsettings->linkedin_pixcel_id); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="googletag_pixcel_id" class="form-label"><?php echo e(trans('labels.googletag')); ?>

                                </label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo e(trans('labels.googletag_pixcel_id')); ?>" name="googletag_pixcel_id"
                                    value="<?php echo e(@$pixelsettings->google_tag_id); ?>">
                            </div>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/pixel/pixel_setting.blade.php ENDPATH**/ ?>