<div id="custom_domain">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form method="POST" action="<?php echo e(URL::to('admin/settings/updatecustomedomain')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.cname_section_title')); ?>

                                        <span class="text-danger"> * </span> </label>
                                    <input type="text" class="form-control" name="cname_title" required
                                        value="<?php echo e(@$setting->cname_title); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.cname_section_text')); ?>

                                        <span class="text-danger"> * </span> </label>
                                    <textarea class="form-control" rows="3" id="cname_text" required name="cname_text"><?php echo $setting->cname_text; ?></textarea>
                                </div>
                            </div>
                            <div
                                class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\customdomain\setting_form.blade.php ENDPATH**/ ?>