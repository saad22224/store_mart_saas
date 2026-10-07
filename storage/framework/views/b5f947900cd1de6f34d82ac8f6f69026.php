<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

    ?>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 mb-3 box-shadow">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">

                            <thead>

                                <tr class="text-capitalize fw-500 fs-15">

                                    <td><?php echo e(trans('labels.srno')); ?></td>

                                    <td><?php echo e(trans('labels.name')); ?></td>

                                    <td><?php echo e(trans('labels.question')); ?></td>

                                    <td><?php echo e(trans('labels.answer')); ?></td>

                                    <td><?php echo e(trans('labels.created_date')); ?></td>

                                    <td><?php echo e(trans('labels.updated_date')); ?></td>

                                    <td><?php echo e(trans('labels.action')); ?></td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                    $i = 1;

                                ?>

                                <?php $__currentLoopData = $service_ques_ans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->product_id == null): ?>
                                        <tr class="fs-7 align-middle">

                                            <td><?php

                                                echo $i++;

                                            ?></td>



                                            <td><?php echo e(@$item->service->name); ?></td>
                                            <td><?php echo e($item->question); ?></td>

                                            <td><?php echo e($item->answer); ?></td>

                                            <td><?php echo e(helper::date_formate($item->created_at, $vendor_id)); ?><br>

                                                <?php echo e(helper::time_format($item->created_at, $vendor_id)); ?>


                                            </td>

                                            <td><?php echo e(helper::date_formate($item->updated_at, $vendor_id)); ?><br>

                                                <?php echo e(helper::time_format($item->updated_at, $vendor_id)); ?>


                                            </td>


                                            <td>
                                                <div class="d-flex flex-wrap gap-2">

                                                    <a href="javascript:void(0)" class="btn btn-info hov btn-sm"
                                                        tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                        onclick="answer('<?php echo e($item->id); ?>','<?php echo e($item->question); ?>','<?php echo e(@$item->answer); ?>')">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/question_answer/delete-' . $item->id)); ?>')" <?php endif; ?>
                                                        class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_question_answer', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                        <i class="fa-regular fa-trash"></i>
                                                    </a>


                                                </div>
                                            </td>

                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    
    <div class="modal fade" id="qustions_answer" tabindex="-1" aria-labelledby="qustions_answerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h1 class="modal-title fs-5 fw-600 m-0 color-changer" id="qustions_answer"><?php echo e(trans('labels.answer')); ?>

                    </h1>
                    <button type="button" class="bg-transparent border-0 m-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>
                <form action="<?php echo e(URL::to('/admin/product_answer')); ?>" method="post" class=" mt-3 pt-2">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="id" name="id" value="">
                    <div class="modal-body">

                        <div class="d-flex align-items-center border-bottom pb-2">
                            <div class="col-2">
                                <label for="exampleFormControlTextarea1" class="form-label d-flex ">
                                    <?php echo e(trans('labels.question')); ?>

                                    <div aria-hidden="true" class="text-danger">*</div>
                                </label>
                            </div>
                            <div class="col-10">
                                <label for="question" class="form-label d-flex " id="question"></label>
                            </div>
                        </div>

                        <div class="d-flex align-items-center pt-2">
                            <div class="col-2">
                                <label for="exampleFormControlTextarea1" class="form-label d-flex ">
                                    <?php echo e(trans('labels.answer')); ?>

                                    <div aria-hidden="true" class="text-danger">*</div>
                                </label>
                            </div>
                            <div class="col-10  ">
                                <textarea class="form-control " id="answer" name="answer" placeholder="Your Questions" rows="3" required=""></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger fs-7  fw-500" data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button type="submit" class="btn btn-primary fs-7 fw-500"><?php echo e(trans('labels.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function answer(id, question,answer) {

            $('#question').html(question);
            $('#id').val(id);
             $('#answer').val(answer);
            $("#qustions_answer").modal('show');

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\question_answer\service_index.blade.php ENDPATH**/ ?>