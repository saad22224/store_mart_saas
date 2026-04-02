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

        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.who_we_are')); ?></h5>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <form action="<?php echo e(URL::to('admin/whoweare/savecontent')); ?>" method="POST" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <div class="card border-0 mb-3 p-3 box-shadow">

                    <div class="row">

                        <div class="col-md-6 mb-lg-0">

                            <div class="form-group">

                                <label class="form-label"><?php echo e(trans('labels.title')); ?><span class="text-danger"> *

                                    </span></label>

                                <input type="text"
                                    class="form-control <?php echo e(session()->get('direction') == 2 ? 'input-group-rtl' : ''); ?>"
                                    name="title" placeholder="<?php echo e(trans('labels.title')); ?>"
                                    value="<?php echo e(@$content->whoweare_title); ?>" required>

                            </div>

                        </div>

                        <div class="col-md-6 mb-lg-0">

                            <div class="form-group">

                                <label class="form-label"><?php echo e(trans('labels.sub_title')); ?><span class="text-danger"> *

                                    </span></label>

                                <input type="text"
                                    class="form-control <?php echo e(session()->get('direction') == 2 ? 'input-group-rtl' : ''); ?>"
                                    name="sub_title" placeholder="<?php echo e(trans('labels.sub_title')); ?>"
                                    value="<?php echo e(@$content->whoweare_subtitle); ?>" required>
                            </div>

                        </div>

                        <div class="col-md-6 mb-lg-0">

                            <div class="form-group">

                                <label class="form-label"><?php echo e(trans('labels.description')); ?><span class="text-danger"> *

                                    </span></label>

                                <textarea class="form-control" placeholder="<?php echo e(trans('labels.description')); ?>" name="description" rows="5"
                                    required><?php echo e(@$content->whoweare_description); ?></textarea>

                            </div>

                        </div>

                        <div class="col-md-6 mb-lg-0">

                            <div class="form-group">

                                <label class="form-label"><?php echo e(trans('labels.image')); ?><span class="text-danger"> *
                                    </span></label>

                                <input type="file" class="form-control" name="image">

                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                            <img src="<?php echo e(helper::image_path(@$content->whoweare_image)); ?>" class="img-fluid rounded hw-70"
                                alt="">

                        </div>

                        <div class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">

                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_who_we_are', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>

                        </div>

                    </div>

                </div>

            </form>

            <div class="card border-0 mb-3 box-shadow">

                <div class="text-end">

                    <a href="<?php echo e(URL::to(request()->url() . '/add')); ?>"
                        class="btn btn-secondary px-sm-4 text-capitalize mx-3 mt-3 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_who_we_are', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">

                        <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?></a>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>

                                    <td><?php echo e(trans('labels.image')); ?></td>

                                    <td><?php echo e(trans('labels.title')); ?></td>

                                    <td><?php echo e(trans('labels.sub_title')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>

                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/whoweare/reorder_whoweare')); ?>">

                                <?php

                                    $i = 1;

                                ?>

                                <?php $__currentLoopData = $allworkcontent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align row1" id="dataid<?php echo e($content->id); ?>"
                                        data-id="<?php echo e($content->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>">
                                                <i class="fa-light fa-up-down-left-right mx-2"></i>
                                            </a>
                                        </td>
                                        <td><?php

                                            echo $i++;

                                        ?></td>

                                        <td>
                                            <img src="<?php echo e(helper::image_path($content->image)); ?>"
                                                class="img-fluid rounded hw-50 object-fit-cover" alt="">
                                        </td>

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
                                                <a href="<?php echo e(URL::to('/admin/whoweare/edit-' . $content->id)); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_who_we_are', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/whoweare/delete-' . $content->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_who_we_are', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-trash"></i></a>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/who_we_are/index.blade.php ENDPATH**/ ?>