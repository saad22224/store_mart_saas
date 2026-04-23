<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="<?php echo e(URL::to('admin/products')); ?>"
                        class="color-changer"><?php echo e(trans('labels.products')); ?></a></li>
                <li class="breadcrumb-item  active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <?php if(!empty($getproductdata)): ?>
                        <form action="<?php echo e(URL::to('admin/products/update-' . $getproductdata->slug)); ?>" method="POST"
                            enctype="multipart/form-data" class="m-0">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.category')); ?> <span class="text-danger">
                                                *
                                            </span></label><br>
                                        <select class="form-control selectpicker" name="category[]" data-live-search="true"
                                            id="editcat_id" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                            <?php if(!empty($getcategorylist)): ?>
                                                <?php $__currentLoopData = $getcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($catdata->id); ?>" data-id="<?php echo e($catdata->id); ?>"
                                                        <?php echo e(in_array($catdata->id, explode('|', $getproductdata->cat_id)) ? 'selected' : ''); ?>>
                                                        <?php echo e($catdata->name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.name')); ?> <span class="text-danger">
                                                * </span></label>
                                        <input type="text" class="form-control" name="product_name"
                                            value="<?php echo e($getproductdata->item_name); ?>"
                                            placeholder="<?php echo e(trans('labels.name')); ?>" required>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.sku')); ?></label>
                                        <input type="text" class="form-control" name="product_sku"
                                            value="<?php echo e($getproductdata->sku); ?>" placeholder="<?php echo e(trans('labels.sku')); ?>"
                                            id="product_sku">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.video_url')); ?> </label>
                                        <input class="form-control" type="text" name="video_url"
                                            placeholder="<?php echo e(trans('labels.video_url')); ?>"
                                            value="<?php echo e($getproductdata->video_url); ?>">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.tax')); ?></label>
                                        <select name="tax[]" class="form-control selectpicker" multiple
                                            data-live-search="true">
                                            <?php if(!empty($gettaxlist)): ?>
                                                <?php $__currentLoopData = $gettaxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tax->id); ?>"
                                                        <?php echo e(in_array($tax->id, explode('|', $getproductdata->tax)) ? 'selected' : ''); ?>>
                                                        <?php echo e($tax->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>

                                    </div>
                                </div>
                                <?php if(@helper::checkaddons('frequently_bought_together')): ?>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group add-extra-class <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                            <label class="form-label"><?php echo e(trans('labels.frequently_bought_items')); ?></label>
                                            <select name="frequently_bought_items[]" class="form-control selectpicker"
                                                id="frequently_bought_items" multiple data-live-search="true"
                                                onchange="change_frequently_bought_items()">
                                                <?php $__currentLoopData = $getitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($product->id); ?>"
                                                        <?php echo e(in_array($product->id, explode('|', $getproductdata->frequently_bought_items)) ? 'selected' : ''); ?>>
                                                        <?php echo e($product->item_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.attachment_name')); ?> </label>
                                        <input type="text" class="form-control" name="attachment_name"
                                            id="attachment_name" placeholder="<?php echo e(trans('labels.attachment_name')); ?>"
                                            value="<?php echo e($getproductdata->attchment_name); ?>">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.attachment_file')); ?></label>
                                        <input type="file" class="form-control" name="attachment_file"
                                            id="attachment_file">
                                        <p class="text-danger mt-2"><?php echo e(trans('labels.attachment')); ?> : <span
                                                class="text-dark">
                                                <a href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $getproductdata->attchment_file)); ?>"
                                                    target="_blank"><?php echo e($getproductdata->attchment_file); ?></a></span></p>

                                    </div>
                                </div>
                                <?php if(@helper::checkaddons('digital_product')): ?>
                                    <?php echo $__env->make('admin.product.digital_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                                <div class="col-md-12 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <textarea class="form-control" id="ckeditor" name="description"><?php echo $getproductdata->description; ?></textarea>
                                </div>
                                <div
                                    class="col-12 border-bottom py-2 my-2 d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="form-group">
                                        <label for="has_extras"
                                            class="col-form-label"><?php echo e(trans('labels.product_has_extras')); ?></label>
                                        <div class="col-md-12">
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_extras" type="radio"
                                                    name="has_extras" id="extras_no" value="2"
                                                    <?php echo e(count($getproductdata['extras']) > 0 ? '' : 'checked'); ?>>
                                                <label class="form-check-label"
                                                    for="extras_no"><?php echo e(trans('labels.no')); ?></label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_extras" type="radio"
                                                    name="has_extras" id="extras_yes" value="1"
                                                    <?php echo e(count($getproductdata['extras']) > 0 ? 'checked' : ''); ?>>
                                                <label class="form-check-label"
                                                    for="extras_yes"><?php echo e(trans('labels.yes')); ?></label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <?php if(count($globalextras) > 0): ?>
                                            <button class="btn btn-primary px-sm-4" type="button"
                                                onclick="global_extras()"><i class="fa-sharp fa-solid fa-plus"></i>
                                                <?php echo e(trans('labels.add_global_extras')); ?></button>
                                        <?php endif; ?>
                                        <button class="btn btn-secondary float-end" id="add_extras" type="button"
                                            onclick="more_editextras_fields('<?php echo e(trans('labels.name')); ?>','<?php echo e(trans('labels.price')); ?>')">
                                            <i class="fa-sharp fa-solid fa-plus"></i>
                                        </button>

                                    </div>

                                </div>

                                <div class=" border-bottom pb-2 mb-2" id="extras">
                                    <?php $__empty_1 = true; $__currentLoopData = $getproductdata['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="row pe-0">
                                            <input type="hidden" class="form-control" name="extras_id[]"
                                                value="<?php echo e($extras->id); ?>">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php if($key == 0): ?>
                                                        <label class="col-form-label"><?php echo e(trans('labels.name')); ?> <span
                                                                class="text-danger">
                                                                * </span></label>
                                                    <?php endif; ?>
                                                    <input type="text" class="form-control extras_name"
                                                        name="extras_name[]" value="<?php echo e($extras->name); ?>"
                                                        placeholder="<?php echo e(trans('labels.name')); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php if($key == 0): ?>
                                                        <label class="col-form-label"><?php echo e(trans('labels.price')); ?>

                                                            <span class="text-danger">
                                                                * </span></label>
                                                    <?php endif; ?>
                                                    <div class="d-flex gap-sm-4 gap-2">
                                                        <input type="text"
                                                            class="form-control numbers_only extras_price"
                                                            name="extras_price[]" value="<?php echo e($extras->price); ?>"
                                                            placeholder="<?php echo e(trans('labels.price')); ?>" required>
                                                        <button class="btn btn-danger" type="button"
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/products/delete/extras-' . $extras->id)); ?>')" <?php endif; ?>><i
                                                                class="fa fa-trash" aria-hidden="true"></i> </button>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <span class="hiddenextrascount d-none"><?php echo e($key); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(trans('labels.name')); ?> <span
                                                            class="text-danger">
                                                            * </span></label>
                                                    <input type="text" class="form-control extras_name"
                                                        name="extras_name[]" placeholder="<?php echo e(trans('labels.name')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(trans('labels.price')); ?> <span
                                                            class="text-danger">
                                                            * </span></label>
                                                    <div class="d-flex">
                                                        <input type="text"
                                                            class="form-control numbers_only extras_price"
                                                            name="extras_price[]"
                                                            placeholder="<?php echo e(trans('labels.price')); ?>">
                                                        <button class="btn btn-outline-info mx-2" type="button"
                                                            onclick="more_editextras_fields('<?php echo e(trans('labels.name')); ?>','<?php echo e(trans('labels.price')); ?>')"><i
                                                                class="fa-sharp fa-solid fa-plus"></i> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div id="global-extras"></div>
                                    <div id="more_editextras_fields"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="has_variants"
                                            class="col-form-label"><?php echo e(trans('labels.product_has_variation')); ?></label>
                                        <div class="col-md-12">

                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_variants" type="radio"
                                                    name="has_variants" id="no" value="2" checked
                                                    <?php if($getproductdata->has_variants == 2): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="no"><?php echo e(trans('labels.no')); ?></label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_variants" type="radio"
                                                    name="has_variants" id="yes" value="1"
                                                    <?php if($getproductdata->has_variants == 1): ?> checked <?php endif; ?>>
                                                <label class="form-check-label"
                                                    for="yes"><?php echo e(trans('labels.yes')); ?></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php if($getproductdata->has_variants == 1 && count($getproductdata['variation']) > 0): ?>
                                    <div
                                        class="col-md-6 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <button class="btn btn-secondary get-variants" type="button"
                                            dataa-url="<?php echo e(URL::to('admin/products/variants/edit', $getproductdata->id)); ?>">
                                            <i class="fa-sharp fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div
                                        class="col-md-6 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <button class="btn btn-secondary" type="button" id="btn_addvariants"
                                            onclick="addvariantModal()">
                                            <i class="fa-sharp fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <div class="col-12 <?php if($getproductdata->has_variants == 1): ?> dn <?php endif; ?>" id="price_row">
                                    <div class="row border-top py-2 my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.original_price')); ?> <span
                                                        class="text-danger">
                                                        * </span></label>
                                                <input type="text" step="any" class="form-control numbers_only"
                                                    name="original_price"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : ($getproductdata->item_original_price > 0 ? $getproductdata->item_original_price : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.original_price')); ?>"
                                                    id="original_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.selling_price')); ?> <span
                                                        class="text-danger">
                                                        * </span></label>
                                                <input type="text" step="any" class="form-control numbers_only"
                                                    name="price"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : $getproductdata->item_price); ?>"
                                                    placeholder="<?php echo e(trans('labels.selling_price')); ?>" id="price">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">السعر بالدولار <span
                                                        class="text-danger">
                                                        * </span></label>
                                                <input type="text" step="any" class="form-control numbers_only"
                                                    name="dollar_price"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : $getproductdata->dollar_price); ?>"
                                                    placeholder="السعر بالدولار" id="dollar_price">
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 d-flex border-top border-bottom py-2 my-2 align-items-center justify-content-between">
                                            <div class="form-group">
                                                <label for="has_stock"
                                                    class="form-label"><?php echo e(trans('labels.stock_management')); ?></label>
                                                <div class="col-md-12">
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input me-0 has_stock" type="radio"
                                                            name="has_stock" id="stock_no" value="2" checked
                                                            <?php if($getproductdata->stock_management == 2): ?> checked <?php endif; ?>>
                                                        <label class="form-check-label"
                                                            for="stock_no"><?php echo e(trans('labels.no')); ?></label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input me-0 has_stock" type="radio"
                                                            name="has_stock" id="stock_yes" value="1"
                                                            <?php if($getproductdata->stock_management == 1): ?> checked <?php endif; ?>>
                                                        <label class="form-check-label"
                                                            for="stock_yes"><?php echo e(trans('labels.yes')); ?></label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_stock_qty">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.stock_qty')); ?> <span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control numbers_only" name="qty"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : $getproductdata->qty); ?>"
                                                    placeholder="<?php echo e(trans('labels.stock_qty')); ?>" id="qty">
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_min_order">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.min_order_qty')); ?> <span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control numbers_only" name="min_order"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : ($getproductdata->min_order > 0 ? $getproductdata->min_order : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" id="min_order">

                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_max_order">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.max_order_qty')); ?> <span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control numbers_only" name="max_order"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variants == 1 ? '' : ($getproductdata->max_order > 0 ? $getproductdata->max_order : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" id="max_order">

                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_product_low_qty_warning">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.product_low_qty_warning')); ?>

                                                    <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="low_qty" id="low_qty"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->low_qty); ?>"
                                                    placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?php if($getproductdata->has_variants == 2): ?> dn <?php endif; ?>" id="variations">
                                    <div class="card border my-3 <?php echo e(count($productVariantArrays) > 0 ? 'd-flex' : 'd-none'); ?>"
                                        id="variant_card">
                                        <div class="card-header border-bottom">
                                            <div class="row flex-grow-1">
                                                <div class="col-md d-flex align-items-center">
                                                    <h5 class="card-header-title color-changer text-dark fw-500">
                                                        <?php echo e(trans('labels.product')); ?>

                                                        <?php echo e(trans('labels.variants')); ?>

                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row form-group m-0">
                                                <div class="table-responsive p-0">
                                                    <input type="hidden" id="hiddenVariantOptions"
                                                        name="hiddenVariantOptions"
                                                        value="<?php echo e($getproductdata->variants_json == null ? '{}' : $getproductdata->variants_json); ?>">
                                                    <div class="variant-table">
                                                        <table class="table table-bordered m-0" id='tblvariants'>
                                                            <thead>
                                                                <tr class="text-center fs-15 fw-600">
                                                                    <?php if(isset($product_variant_names)): ?>
                                                                        <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <th><span><?php echo e(ucwords($variant)); ?></span>
                                                                            </th>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                    <th><span><?php echo e(trans('labels.original_price')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.selling_price')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.stock_qty')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.min_order_qty')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.max_order_qty')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.product_low_qty_warning')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.stock_management')); ?></span>
                                                                    </th>
                                                                    <th><span><?php echo e(trans('labels.is_available')); ?></span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php if(isset($productVariantArrays)): ?>
                                                                    <?php $__currentLoopData = $productVariantArrays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $productVariant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr class="fs-7 fw-500"
                                                                            data-id="<?php echo e($productVariant['product_variants']['id']); ?>">
                                                                            <?php $__currentLoopData = explode('|', $productVariant['product_variants']['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][variants][<?php echo e($key); ?>][]"
                                                                                        autocomplete="off"
                                                                                        spellcheck="false"
                                                                                        class="form-control"
                                                                                        value="<?php echo e($values); ?>"
                                                                                        readonly>
                                                                                </td>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][original_price]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.original_price')); ?>"
                                                                                    class="form-control voriginal_price_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['original_price']); ?>"
                                                                                    id="voriginal_price_<?php echo e($counter); ?>"
                                                                                    required>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][price]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.selling_price')); ?>"
                                                                                    class="form-control vprice_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['price']); ?>"
                                                                                    id="vprice_<?php echo e($counter); ?>"
                                                                                    required>
                                                                            </td>

                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][qty]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.stock_qty')); ?>"
                                                                                    class="form-control vqty_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['qty']); ?>"
                                                                                    id="vqty_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][min_order]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.min_order_qty')); ?>"
                                                                                    class="form-control vmin_order_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['min_order']); ?>"
                                                                                    id="vmin_order_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][max_order]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.max_order_qty')); ?>"
                                                                                    class="form-control vmax_order_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['max_order']); ?>"
                                                                                    id="vmax_order_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][low_qty]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?>"
                                                                                    class="form-control vlow_qty_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['low_qty']); ?>"
                                                                                    id="vlow_qty_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input
                                                                                    class="form-check-input  vstock_management_<?php echo e($counter); ?>"
                                                                                    type="checkbox" value="1"
                                                                                    <?php echo e($productVariant['product_variants']['stock_management'] == 1 ? 'checked' : ''); ?>

                                                                                    onclick="edit_stock_management(this.id)"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][stock_management]"
                                                                                    id="vstockmanagement_<?php echo e($counter); ?>">

                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input
                                                                                    class="form-check-input  vis_available_<?php echo e($counter); ?> product_available"
                                                                                    type="checkbox" value="1"
                                                                                    onclick="edit_checkavailable(this.id)"
                                                                                    <?php echo e($productVariant['product_variants']['is_available'] == 1 ? 'checked' : ''); ?>

                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][is_available]"
                                                                                    id="<?php echo e($counter); ?>">

                                                                            </td>

                                                                        </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <div>
                                        <a href="<?php echo e(URL::to('admin/products')); ?>"
                                            class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                        <button
                                            class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                    </div>
                                </div>
                        </form>
                    <?php else: ?>
                        <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card border-0 box-shadow"
            data-url="<?php echo e(url('admin/products/reorder_image-' . $getproductdata->id)); ?>" id="carddetails">
            <div class="card-body">
                <div class="col-12 d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <h5 class="text-capitalize fw-600 text-dark color-changer"><?php echo e(trans('labels.product_images')); ?></h5>
                    <a href="javascript:void(0)" onclick="addimage('<?php echo e($getproductdata->id); ?>')"
                        class="btn btn-secondary px-sm-4">
                        <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add_new')); ?>

                    </a>
                </div>
                <div class="row g-3 sort_menu">
                    <?php $__currentLoopData = $getproductdata['multi_image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6" data-id="<?php echo e($productimage->id); ?>">
                            <div class="card-dec h-100 handle">
                                <img src="<?php echo e(helper::image_path($productimage->image)); ?>"
                                    class="img-fluid product-image rounded-3 h-75 w-100 object">
                                <div class="d-flex gap-1 mt-2 justify-content-center">
                                    <a tooltip="<?php echo e(trans('labels.move')); ?>" class="btn btn-secondary hov btn-sm"><i
                                            class="fa-light fa-up-down-left-right"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-info hov btn-sm"
                                        onclick="imageview('<?php echo e($productimage->id); ?>','<?php echo e($productimage->image); ?>')"><i
                                            class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="javascript:void(0)"
                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/delete_image-' . $productimage->id . '/' . $productimage->item_id)); ?>')" <?php endif; ?>
                                        class="btn btn-danger hov btn-sm <?php if($getproductdata['multi_image']->count() == 1): ?> d-none <?php else: ?> '' <?php endif; ?>"><i
                                            class="fa-regular fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card border-0 box-shadow">
            <div class="card-body">
                <h5 class="text-capitalize color-changer fw-600 text-dark pb-3 border-bottom mb-3">
                    <?php echo e(trans('labels.product_reviews')); ?></h5>
                <div class="table-responsive p-0">
                    <table
                        class="table m-0 table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                        <thead>
                            <tr class="text-capitalize fw-500 fs-15">
                                <td><?php echo e(trans('labels.srno')); ?></td>
                                <td><?php echo e(trans('labels.image')); ?></td>
                                <td><?php echo e(trans('labels.name')); ?></td>
                                <td><?php echo e(trans('labels.description')); ?></td>
                                <td><?php echo e(trans('labels.ratting')); ?></td>
                                <td><?php echo e(trans('labels.action')); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $productreview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="fs-7 row1 align-middle" id="dataid<?php echo e($item->id); ?>"
                                    data-id="<?php echo e($item->id); ?>">
                                    <td><?php
                                        echo $i++;
                                    ?></td>
                                    <td>
                                        <img src="<?php echo e(@helper::image_path($item->image)); ?>"
                                            class="img-fluid rounded hw-50" alt="">
                                    </td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->description); ?></td>
                                    <td><?php echo e($item->star); ?> </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
                                                onclick="statusupdate('<?php echo e(URL::to('/admin/products/review/delete-' . $item->id)); ?>')" <?php endif; ?>
                                            class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                            <i class="fa-regular fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<div class="modal modal-fade-transform" id="addModal" tabindex="-1" aria-labelledby="addModallable"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title color-changer settings-color" id="addModallable"><?php echo e(trans('labels.image')); ?>

                    <span class="text-danger"> *
                    </span></h5>
                <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <form class="m-0" action=" <?php echo e(URL::to('admin/products/add_image')); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="file" name="image[]" class="form-control" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">Close</button>
                    <button
                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                        class="btn btn-primary px-sm-4 m-0"><?php echo e(trans('labels.save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal modal-fade-transform" id="editModal" tabindex="-1" aria-labelledby="editModallable"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-dark justify-content-between">
                <h5 class="modal-title color-changer" id="editModallable"><?php echo e(trans('labels.image')); ?> <span
                        class="text-danger">
                        * </span></h5>
                <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                    <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                </button>
            </div>
            <form action=" <?php echo e(URL::to('admin/products/updateimage')); ?>" method="post"
                enctype="multipart/form-data" class="m-0">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" id="img_id" name="id">
                    <input type="hidden" id="img_name" name="image">
                    <input type="file" name="product_image" class="form-control" id="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">Close</button>
                    <button
                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                        class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-fade-transform" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
        <div class="modal-content">
            <div class="popup-content">
                <div class="modal-header justify-content-between popup-header align-items-center">
                    <h5 class="modal-title mb-0 color-changer" id="modelCommanModelLabel">
                        <?php echo e(trans('labels.add_variants')); ?></h5>
                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-fade-transform" id="addvariantModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
        <div class="modal-content">
            <div class="popup-content">
                <div class="modal-header justify-content-between popup-header align-items-center">
                    <div class="modal-title">
                        <h5 class="mb-0 settings-color color-changer" id="modelCommanModelLabel">
                            <?php echo e(trans('labels.add_variants')); ?></h5>
                    </div>
                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                        <i class="fa-regular fa-xmark fs-4 color-changer"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="<?php echo e(URL::to('admin/products/get-product-variants-possibilities')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group settings-color">
                            <label for="variant_name" class="mb-1"><?php echo e(trans('labels.variant_name')); ?></label>
                            <input class="form-control" name="variant_name" type="text" id="variant_name"
                                onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')"
                                placeholder="<?php echo e('Variant Name, i.e Size, Color etc'); ?>">
                        </div>
                        <div class="form-group settings-color">
                            <label for="variant_options"
                                class="mb-1"><?php echo e(trans('labels.variant_options')); ?></label>
                            <input class="form-control" name="variant_options" type="text" id="variant_options"
                                placeholder="<?php echo e('Variant Options separated by|pipe symbol, i.e Black|Blue|Red'); ?>">
                        </div>
                        <div class="form-group col-12 d-flex gap-2 justify-content-end form-label">
                            <input type="button" value="<?php echo e(trans('labels.cancel')); ?>"
                                class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
                            <input type="button" value="<?php echo e(trans('labels.add_variants')); ?>"
                                class="btn btn-primary px-sm-4 add-variants">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
    <script>
        var extrasurl = "<?php echo e(URL::to('admin/editgetextras-' . $getproductdata->id)); ?>";
        var vendor_id = "<?php echo e($vendor_id); ?>";
        var placehodername = "<?php echo e(trans('labels.name')); ?>";
        var placeholderprice = "<?php echo e(trans('labels.price')); ?>";
        var page = "edit";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');

        $(document).on('click', '.get-variants', function(e) {
            $("#commonModal .modal-title").html('<?php echo e(__('Add Variants')); ?>');
            $("#commonModal .modal-dialog").addClass('modal-md');
            $("#commonModal").modal('show');
            var data_url = $(this).attr('dataa-url');

            $.get(data_url, {}, function(data) {
                $('#commonModal .modal-body').html(data);
            });
        });

        $(document).on('click', '.add-variants', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            var variantNameEle = $('#variant_name');
            var variantOptionsEle = $('#variant_options');
            var isValid = true;
            var hiddenVariantOptions = $('#hiddenVariantOptions').val();

            if (variantNameEle.val() == '') {
                variantNameEle.focus();
                isValid = false;
            } else if (variantOptionsEle.val() == '') {
                variantOptionsEle.focus();
                isValid = false;
            }

            if (isValid) {

                    url: form.attr('action'),
                    datType: 'json',
                    data: {
                        variant_name: variantNameEle.val(),
                        variant_options: variantOptionsEle.val(),
                        hiddenVariantOptions: hiddenVariantOptions
                    },
                    success: function(data) {
                        if (data.message != "" && data.message != null) {
                            toastr.error(data.message);
                        }
                        $('#hiddenVariantOptions').val(data.hiddenVariantOptions);
                        $('.variant-table').html(data.varitantHTML);
                        $('#variant_card').removeClass('d-none');
                        $("#commonModal").modal('hide');
                    }
                })
            }
        });
    </script>
    <script>
        function validation(value, id) {
            if (value.includes('@')) {
                newval = value.replaceAll('@', '');
                $('#' + id).val(newval);
            }
            if (value.includes('\\')) {
                newval = value.replaceAll('\\', '');
                $('#' + id).val(newval);
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            $('.sort_menu').sortable({
                handle: '.handle',
                cursor: 'move',
                placeholder: 'highlight',
                axis: "x,y",

                update: function(e, ui) {
                    var sortData = $('.sort_menu').sortable('toArray', {
                        attribute: 'data-id'
                    })
                    updateToDatabase(sortData.join('|'))
                }
            })

            function updateToDatabase(idString) {


                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    dataType: "json",
                    url: $('#carddetails').attr('data-url'),
                    data: {
                        ids: idString,
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.success(wrong);
                        }
                    }
                });
            }

        })
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Storemart_SaaS\resources\views/admin/product/edit_product.blade.php ENDPATH**/ ?>