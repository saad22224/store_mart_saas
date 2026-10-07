<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.firebase_notification')); ?></h5>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php if(Auth::user()->type == 1 || Auth::user()->type == 2): ?>
                <form action="<?php echo e(URL::to('admin/notification/savekey')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card border-0 mb-3 p-3 box-shadow">
                        <div class="row">
                            <?php if(Auth::user()->type == 1): ?>
                                <?php if(App\Models\SystemAddons::where('unique_identifier', 'vendor_app')->first() != null &&
                                        App\Models\SystemAddons::where('unique_identifier', 'vendor_app')->first()->activated == 1): ?>
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.firebase_server_key')); ?></label>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                        <input type="text" class="form-control" name="firebase_server_key"
                                            value="<?php echo e(@$settingdata->firebase); ?>"
                                            placeholder="<?php echo e(trans('labels.firebase_server_key')); ?>" required>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(Auth::user()->type == 2): ?>
                                <?php if(App\Models\SystemAddons::where('unique_identifier', 'user_app')->first() != null &&
                                        App\Models\SystemAddons::where('unique_identifier', 'user_app')->first()->activated == 1): ?>
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.firebase_server_key')); ?></label>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                        <?php endif; ?>
                                        <input type="text" class="form-control" name="firebase_server_key"
                                            value="<?php echo e(@$settingdata->firebase); ?>"
                                            placeholder="<?php echo e(trans('labels.firebase_server_key')); ?>" required>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                                <button
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                    class="btn btn-primary"><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
            <div class="card border-0 mb-3 box-shadow">
                <div class="<?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">
                    <a href="<?php echo e(URL::to('admin/notification/add')); ?>"
                        class="btn btn-secondary mx-3 mt-3 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_firebase_notification', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                        <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">

                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.title')); ?></td>
                                    <td><?php echo e(trans('labels.sub_title')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $firebasecontent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">

                                        <td><?php

                                            echo $i++;

                                        ?></td>

                                        <td><?php echo e($content->title); ?></td>
                                        <td><?php echo e($content->sub_title); ?></td>
                                        <td><?php echo e(helper::date_format($content->created_at, $content->vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($content->created_at, $content->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_format($content->updated_at, $content->vendor_id)); ?><br>
                                            <?php echo e(helper::time_format($content->updated_at, $content->vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a onclick="statusupdate('<?php echo e(URL::to('/admin/notification/resend-' . $content->id)); ?>')"
                                                    tooltip="<?php echo e(trans('labels.resend')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_firebase_notification', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-reply-clock"></i>
                                                </a>
                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/notification/delete-' . $content->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_firebase_notification', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\firebase\index.blade.php ENDPATH**/ ?>