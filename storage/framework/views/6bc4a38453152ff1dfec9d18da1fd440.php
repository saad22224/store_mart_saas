<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center">
    <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/employees')); ?>" class="color-changer"><?php echo e(trans('labels.employees')); ?></a></li>
            <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
        </ol>
    </nav>
</div>
    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="<?php echo e(URL::to('/admin/employees/update-'.$editemployee->id)); ?>" method="post"
                        enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">

                                <input type="hidden" value="<?php echo e($editemployee->id); ?>" name="id">

                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                    </span></label>

                                <input type="text" class="form-control" name="name" value="<?php echo e($editemployee->name); ?>"
                                    placeholder="name" required>

                                <?php $__errorArgs = ['name'];
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

                            <div class="form-group col-md-6">

                                <label class="form-label"><?php echo e(trans('labels.email')); ?><span class="text-danger"> *
                                    </span></label>

                                <input type="email" class="form-control" name="email" value="<?php echo e($editemployee->email); ?>"
                                    placeholder="email" required>

                                <?php $__errorArgs = ['email'];
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
                            <div class="col-md-6">
                                <div class="form-group ">

                                    <label class="form-label"><?php echo e(trans('labels.mobile')); ?><span class="text-danger"> *
                                        </span></label>

                                    <input type="number" class="form-control" name="mobile" value="<?php echo e($editemployee->mobile); ?>"
                                        placeholder="mobile" required>

                                    <?php $__errorArgs = ['mobile'];
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
                               
                            </div>
                            <div class="col-md-6 form-group">

                                <label class="form-label"><?php echo e(trans('labels.image')); ?> (250 x 250) </label>

                                <input type="file" class="form-control" name="profile">

                                <img class="rounded-circle mt-2" src="<?php echo e(helper::image_path($editemployee->image)); ?>"
                                    alt="" width="70" height="70">

                                <?php $__errorArgs = ['profile'];
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
                            <div class="form-group col-md-6">
                                <label for="role" class="form-label"><?php echo e(trans('labels.role')); ?><span
                                        class="text-danger"> * </span></label>
                                <select name="role" class="form-select" id="role" required>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"
                                            <?php echo e($role->id == $editemployee->role_id ? 'selected' : ''); ?>><?php echo e($role->role); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                          
                           
                            <div class="mt-3 <?php echo e(session()->get('direction') == '2' ? 'text-start' : 'text-end'); ?>">

                                <a href="<?php echo e(URL::to('admin/employees')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                <button
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_employees', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </div>



                    </form>

                </div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\employee\edit.blade.php ENDPATH**/ ?>