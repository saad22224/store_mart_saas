<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.media')); ?> <span> (<?php echo e($media->count()); ?> <?php echo e(trans('labels.images')); ?>)
            </span></h5>
    </div>
    <div class="row">
        <form action=" <?php echo e(URL::to('admin/media/add_image')); ?>" method="post" enctype="multipart/form-data"
            class="d-flex gap-2">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" id="product_id" name="product_id">
                <input type="file" name="image[]" class="form-control" multiple>

            </div>
            <div class="modal-footer">
                <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?> class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
            </div>
        </form>
        <div class="col-12">
            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 popup-gallery">
                        <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card rounded overflow-hidden one-card h-100 w-100">
                                <a href="<?php echo e(@helper::image_path($data->image)); ?>">
                                    <img src="<?php echo e(@helper::image_path($data->image)); ?>" alt="pro img"
                                        class="w-100 card-img-top object" id="<?php echo e(@helper::image_path($data->image)); ?>">
                                </a>
                                <div class="card-body">
                                    
                                    
                                    <div class="dropdown">
                                        <button class="one-card-dropdown dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu overflow-hidden rounded p-0 <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                            <li><a class="dropdown-item p-2 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_import_product', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/media/delete-' . $data->id)); ?>')" <?php endif; ?>><?php echo e(trans('labels.delete')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item p-2"
                                                    href="<?php echo e(URL::to('admin/media/download-' . $data->id)); ?>"><?php echo e(trans('labels.download')); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><?php echo e($data->image); ?></p>
                                    <a class="text-dark cursor-pointer <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"
                                        tooltip="<?php echo e(trans('labels.copy')); ?>"
                                        onclick="CopyLink('<?php echo e(helper::image_path($data->image)); ?>')"><i
                                            class="fa-regular fa-copy"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        <?php if(count($errors) > 0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error("<?php echo e($error); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
    <script>
        $(document).ready(function() {
            $('.popup-gallery .one-img').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
            });
        });

        function CopyLink(text) {
            var temp = document.createElement('INPUT');
            temp.style.position = 'fixed'; //hack to keep the input off-screen...
            temp.style.left = '-10000px'; //...but I'm not sure it's needed...
            document.body.appendChild(temp);
            temp.value = text;
            temp.select();
            document.execCommand("copy");
            //temp.remove(); //...as we remove it before reflow (??)
            document.body.removeChild(temp); //to accommodate IE


            toastr.success("<?php echo e(trans('labels.copied')); ?>");
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\media\index.blade.php ENDPATH**/ ?>