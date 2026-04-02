<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-capitalize fw-600 text-dark fs-4">Landing Page 2 Settings</h5>
        <div class="d-flex gap-2">
            <span class="badge bg-primary fs-6">AR</span>
            <span class="badge bg-secondary fs-6">EN</span>
        </div>
    </div>

    <form action="<?php echo e(url('admin/landing2/update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row">
            
            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-globe me-2"></i>Meta / Page Title
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Page Title (Arabic)</label>
                                <input type="text" name="translations[meta][page_title][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['meta']['page_title']['ar']['value'] ?? 'Matjar Hub - منصة التجارة الإلكترونية المتكاملة'); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Page Title (English)</label>
                                <input type="text" name="translations[meta][page_title][en]" class="form-control" 
                                    value="<?php echo e(@$translations['meta']['page_title']['en']['value'] ?? 'Matjar Hub - Integrated E-Commerce Platform'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-bars me-2"></i>Navigation / Menu
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php $__currentLoopData = ['home', 'who_we_are', 'why_us', 'faq', 'contact', 'start_now']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 form-group mb-3">
                                <label class="fw-500 text-capitalize"><?php echo e(str_replace('_', ' ', $field)); ?> (AR)</label>
                                <input type="text" name="translations[nav][<?php echo e($field); ?>][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['nav'][$field]['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label class="fw-500 text-capitalize"><?php echo e(str_replace('_', ' ', $field)); ?> (EN)</label>
                                <input type="text" name="translations[nav][<?php echo e($field); ?>][en]" class="form-control" 
                                    value="<?php echo e(@$translations['nav'][$field]['en']['value'] ?? ''); ?>">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-star me-2"></i>Hero Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Text (AR)</label>
                                <input type="text" name="translations[hero][badge][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['badge']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Text (EN)</label>
                                <input type="text" name="translations[hero][badge][en]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['badge']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (AR)</label>
                                <input type="text" name="translations[hero][title_line1][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['title_line1']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (EN)</label>
                                <input type="text" name="translations[hero][title_line1][en]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['title_line1']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (AR)</label>
                                <input type="text" name="translations[hero][title_highlight][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['title_highlight']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (EN)</label>
                                <input type="text" name="translations[hero][title_highlight][en]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['title_highlight']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (AR)</label>
                                <textarea name="translations[hero][description][ar]" class="form-control" rows="3"><?php echo e(@$translations['hero']['description']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (EN)</label>
                                <textarea name="translations[hero][description][en]" class="form-control" rows="3"><?php echo e(@$translations['hero']['description']['en']['value'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Primary Button (AR)</label>
                                <input type="text" name="translations[hero][btn_primary][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['btn_primary']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Primary Button (EN)</label>
                                <input type="text" name="translations[hero][btn_primary][en]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['btn_primary']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Secondary Button (AR)</label>
                                <input type="text" name="translations[hero][btn_secondary][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['btn_secondary']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Secondary Button (EN)</label>
                                <input type="text" name="translations[hero][btn_secondary][en]" class="form-control" 
                                    value="<?php echo e(@$translations['hero']['btn_secondary']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-chart-simple me-2"></i>Stats Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-12 mb-2">
                                <strong class="text-secondary">Stat #<?php echo e($i); ?></strong>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Number</label>
                                <input type="text" name="translations[stats][stat<?php echo e($i); ?>_number][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['stats']['stat'.$i.'_number']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Label (AR)</label>
                                <input type="text" name="translations[stats][stat<?php echo e($i); ?>_label][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['stats']['stat'.$i.'_label']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Number (EN)</label>
                                <input type="text" name="translations[stats][stat<?php echo e($i); ?>_number][en]" class="form-control" 
                                    value="<?php echo e(@$translations['stats']['stat'.$i.'_number']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Label (EN)</label>
                                <input type="text" name="translations[stats][stat<?php echo e($i); ?>_label][en]" class="form-control" 
                                    value="<?php echo e(@$translations['stats']['stat'.$i.'_label']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-users me-2"></i>Who We Are Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Tag (AR)</label>
                                <input type="text" name="translations[who_we_are][tag][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['tag']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Tag (EN)</label>
                                <input type="text" name="translations[who_we_are][tag][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['tag']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (AR)</label>
                                <input type="text" name="translations[who_we_are][title_line1][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['title_line1']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (EN)</label>
                                <input type="text" name="translations[who_we_are][title_line1][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['title_line1']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (AR)</label>
                                <input type="text" name="translations[who_we_are][title_highlight][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['title_highlight']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (EN)</label>
                                <input type="text" name="translations[who_we_are][title_highlight][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['title_highlight']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description 1 (AR)</label>
                                <textarea name="translations[who_we_are][description1][ar]" class="form-control" rows="3"><?php echo e(@$translations['who_we_are']['description1']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description 1 (EN)</label>
                                <textarea name="translations[who_we_are][description1][en]" class="form-control" rows="3"><?php echo e(@$translations['who_we_are']['description1']['en']['value'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description 2 (AR)</label>
                                <textarea name="translations[who_we_are][description2][ar]" class="form-control" rows="3"><?php echo e(@$translations['who_we_are']['description2']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description 2 (EN)</label>
                                <textarea name="translations[who_we_are][description2][en]" class="form-control" rows="3"><?php echo e(@$translations['who_we_are']['description2']['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Stats in Who We Are</h6>
                        <?php for($i = 1; $i <= 3; $i++): ?>
                        <div class="row mb-3">
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Stat <?php echo e($i); ?> Number</label>
                                <input type="text" name="translations[who_we_are][stat<?php echo e($i); ?>_number][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['stat'.$i.'_number']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Stat <?php echo e($i); ?> Label (AR)</label>
                                <input type="text" name="translations[who_we_are][stat<?php echo e($i); ?>_label][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['stat'.$i.'_label']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Stat <?php echo e($i); ?> Number (EN)</label>
                                <input type="text" name="translations[who_we_are][stat<?php echo e($i); ?>_number][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['stat'.$i.'_number']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Stat <?php echo e($i); ?> Label (EN)</label>
                                <input type="text" name="translations[who_we_are][stat<?php echo e($i); ?>_label][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['stat'.$i.'_label']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        <?php endfor; ?>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Floating Badge</h6>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Title (AR)</label>
                                <input type="text" name="translations[who_we_are][float_badge_title][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['float_badge_title']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Title (EN)</label>
                                <input type="text" name="translations[who_we_are][float_badge_title][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['float_badge_title']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Subtitle (AR)</label>
                                <input type="text" name="translations[who_we_are][float_badge_subtitle][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['float_badge_subtitle']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge Subtitle (EN)</label>
                                <input type="text" name="translations[who_we_are][float_badge_subtitle][en]" class="form-control" 
                                    value="<?php echo e(@$translations['who_we_are']['float_badge_subtitle']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-thumbs-up me-2"></i>Why Us Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title (AR)</label>
                                <input type="text" name="translations[why_us][title][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['title']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title (EN)</label>
                                <input type="text" name="translations[why_us][title][en]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['title']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (AR)</label>
                                <input type="text" name="translations[why_us][title_highlight][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['title_highlight']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (EN)</label>
                                <input type="text" name="translations[why_us][title_highlight][en]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['title_highlight']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Subtitle (AR)</label>
                                <textarea name="translations[why_us][subtitle][ar]" class="form-control" rows="2"><?php echo e(@$translations['why_us']['subtitle']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Subtitle (EN)</label>
                                <textarea name="translations[why_us][subtitle][en]" class="form-control" rows="2"><?php echo e(@$translations['why_us']['subtitle']['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Why Us Cards</h6>
                        <?php for($i = 1; $i <= 3; $i++): ?>
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-12 mb-2">
                                <strong class="text-secondary">Card #<?php echo e($i); ?></strong>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="fw-500">Title (AR)</label>
                                <input type="text" name="translations[why_us][card<?php echo e($i); ?>_title][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['card'.$i.'_title']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="fw-500">Title (EN)</label>
                                <input type="text" name="translations[why_us][card<?php echo e($i); ?>_title][en]" class="form-control" 
                                    value="<?php echo e(@$translations['why_us']['card'.$i.'_title']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Description (AR)</label>
                                <textarea name="translations[why_us][card<?php echo e($i); ?>_desc][ar]" class="form-control" rows="2"><?php echo e(@$translations['why_us']['card'.$i.'_desc']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Description (EN)</label>
                                <textarea name="translations[why_us][card<?php echo e($i); ?>_desc][en]" class="form-control" rows="2"><?php echo e(@$translations['why_us']['card'.$i.'_desc']['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-gem me-2"></i>Value Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge (AR)</label>
                                <input type="text" name="translations[value][badge][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['badge']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Badge (EN)</label>
                                <input type="text" name="translations[value][badge][en]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['badge']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (AR)</label>
                                <input type="text" name="translations[value][title_line1][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_line1']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (EN)</label>
                                <input type="text" name="translations[value][title_line1][en]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_line1']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (AR)</label>
                                <input type="text" name="translations[value][title_highlight][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_highlight']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (EN)</label>
                                <input type="text" name="translations[value][title_highlight][en]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_highlight']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 2 (AR)</label>
                                <input type="text" name="translations[value][title_line2][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_line2']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 2 (EN)</label>
                                <input type="text" name="translations[value][title_line2][en]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['title_line2']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (AR)</label>
                                <textarea name="translations[value][description][ar]" class="form-control" rows="3"><?php echo e(@$translations['value']['description']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (EN)</label>
                                <textarea name="translations[value][description][en]" class="form-control" rows="3"><?php echo e(@$translations['value']['description']['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Checkmarks</h6>
                        <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="row mb-3">
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Check <?php echo e($i); ?> (AR)</label>
                                <input type="text" name="translations[value][check<?php echo e($i); ?>][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['check'.$i]['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Check <?php echo e($i); ?> (EN)</label>
                                <input type="text" name="translations[value][check<?php echo e($i); ?>][en]" class="form-control" 
                                    value="<?php echo e(@$translations['value']['check'.$i]['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-circle-question me-2"></i>FAQ Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title (AR)</label>
                                <input type="text" name="translations[faq][title][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['title']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title (EN)</label>
                                <input type="text" name="translations[faq][title][en]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['title']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Subtitle (AR)</label>
                                <input type="text" name="translations[faq][subtitle][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['subtitle']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Subtitle (EN)</label>
                                <input type="text" name="translations[faq][subtitle][en]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['subtitle']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">FAQ Items</h6>
                        <?php for($i = 1; $i <= 3; $i++): ?>
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-12 mb-2">
                                <strong class="text-secondary">FAQ #<?php echo e($i); ?></strong>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="fw-500">Question (AR)</label>
                                <input type="text" name="translations[faq][q<?php echo e($i); ?>][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['q'.$i]['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label class="fw-500">Question (EN)</label>
                                <input type="text" name="translations[faq][q<?php echo e($i); ?>][en]" class="form-control" 
                                    value="<?php echo e(@$translations['faq']['q'.$i]['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Answer (AR)</label>
                                <textarea name="translations[faq][a<?php echo e($i); ?>][ar]" class="form-control" rows="3"><?php echo e(@$translations['faq']['a'.$i]['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Answer (EN)</label>
                                <textarea name="translations[faq][a<?php echo e($i); ?>][en]" class="form-control" rows="3"><?php echo e(@$translations['faq']['a'.$i]['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-envelope me-2"></i>Contact Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (AR)</label>
                                <input type="text" name="translations[contact][title_line1][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['title_line1']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Line 1 (EN)</label>
                                <input type="text" name="translations[contact][title_line1][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['title_line1']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (AR)</label>
                                <input type="text" name="translations[contact][title_highlight][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['title_highlight']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Title Highlight (EN)</label>
                                <input type="text" name="translations[contact][title_highlight][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['title_highlight']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (AR)</label>
                                <textarea name="translations[contact][description][ar]" class="form-control" rows="2"><?php echo e(@$translations['contact']['description']['ar']['value'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Description (EN)</label>
                                <textarea name="translations[contact][description][en]" class="form-control" rows="2"><?php echo e(@$translations['contact']['description']['en']['value'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Contact Information</h6>
                        
                        
                        <div class="row mb-3">
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Phone Label (AR)</label>
                                <input type="text" name="translations[contact][phone_label][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['phone_label']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Phone Label (EN)</label>
                                <input type="text" name="translations[contact][phone_label][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['phone_label']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Phone Value</label>
                                <input type="text" name="translations[contact][phone_value][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['phone_value']['ar']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <div class="col-md-3 form-group">
                                <label class="fw-500">WhatsApp Label (AR)</label>
                                <input type="text" name="translations[contact][whatsapp_label][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['whatsapp_label']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">WhatsApp Label (EN)</label>
                                <input type="text" name="translations[contact][whatsapp_label][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['whatsapp_label']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">WhatsApp Value</label>
                                <input type="text" name="translations[contact][whatsapp_value][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['whatsapp_value']['ar']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Email Label (AR)</label>
                                <input type="text" name="translations[contact][email_label][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['email_label']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="fw-500">Email Label (EN)</label>
                                <input type="text" name="translations[contact][email_label][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['email_label']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Email Value</label>
                                <input type="text" name="translations[contact][email_value][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['email_value']['ar']['value'] ?? ''); ?>">
                            </div>
                        </div>
                        
                        
                        <hr class="my-4">
                        <h6 class="fw-600 text-secondary mb-3">Contact Form</h6>
                        <div class="row">
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Name Label (AR)</label>
                                <input type="text" name="translations[contact][form_name][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_name']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Name Label (EN)</label>
                                <input type="text" name="translations[contact][form_name][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_name']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Name Placeholder (AR)</label>
                                <input type="text" name="translations[contact][form_name_placeholder][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_name_placeholder']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Name Placeholder (EN)</label>
                                <input type="text" name="translations[contact][form_name_placeholder][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_name_placeholder']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Email Label (AR)</label>
                                <input type="text" name="translations[contact][form_email][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_email']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Email Label (EN)</label>
                                <input type="text" name="translations[contact][form_email][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_email']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry Type Label (AR)</label>
                                <input type="text" name="translations[contact][form_inquiry_type][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_type']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry Type Label (EN)</label>
                                <input type="text" name="translations[contact][form_inquiry_type][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_type']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Support (AR)</label>
                                <input type="text" name="translations[contact][form_inquiry_support][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_support']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Support (EN)</label>
                                <input type="text" name="translations[contact][form_inquiry_support][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_support']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Sales (AR)</label>
                                <input type="text" name="translations[contact][form_inquiry_sales][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_sales']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Sales (EN)</label>
                                <input type="text" name="translations[contact][form_inquiry_sales][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_sales']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Partners (AR)</label>
                                <input type="text" name="translations[contact][form_inquiry_partners][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_partners']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Partners (EN)</label>
                                <input type="text" name="translations[contact][form_inquiry_partners][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_partners']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Other (AR)</label>
                                <input type="text" name="translations[contact][form_inquiry_other][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_other']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Inquiry - Other (EN)</label>
                                <input type="text" name="translations[contact][form_inquiry_other][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_inquiry_other']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Message Label (AR)</label>
                                <input type="text" name="translations[contact][form_message][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_message']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Message Label (EN)</label>
                                <input type="text" name="translations[contact][form_message][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_message']['en']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Message Placeholder (AR)</label>
                                <input type="text" name="translations[contact][form_message_placeholder][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_message_placeholder']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-2">
                                <label class="fw-500">Message Placeholder (EN)</label>
                                <input type="text" name="translations[contact][form_message_placeholder][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_message_placeholder']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Submit Button (AR)</label>
                                <input type="text" name="translations[contact][form_submit][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_submit']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-500">Submit Button (EN)</label>
                                <input type="text" name="translations[contact][form_submit][en]" class="form-control" 
                                    value="<?php echo e(@$translations['contact']['form_submit']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="fw-600 text-primary mb-0">
                            <i class="fa-solid fa-copyright me-2"></i>Footer Section
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Brand Description (AR)</label>
                                <input type="text" name="translations[footer][brand_desc][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['footer']['brand_desc']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Brand Description (EN)</label>
                                <input type="text" name="translations[footer][brand_desc][en]" class="form-control" 
                                    value="<?php echo e(@$translations['footer']['brand_desc']['en']['value'] ?? ''); ?>">
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Copyright (AR)</label>
                                <input type="text" name="translations[footer][copyright][ar]" class="form-control" 
                                    value="<?php echo e(@$translations['footer']['copyright']['ar']['value'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="fw-500">Copyright (EN)</label>
                                <input type="text" name="translations[footer][copyright][en]" class="form-control" 
                                    value="<?php echo e(@$translations['footer']['copyright']['en']['value'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-end mb-5">
            <button type="submit" class="btn btn-primary px-5 py-2 fw-600">
                <i class="fa-solid fa-save me-2"></i>Save All Changes
            </button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459716940/domains/matjarhub.com/public_html/resources/views/admin/landing2/index.blade.php ENDPATH**/ ?>