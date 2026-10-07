<?php
    $idx = $index;
    $isObj = is_object($section);
    $id = $isObj ? $section->id : '';
    $type = $isObj ? $section->section_type : ($defaultType ?? 'benefits');
    $title = $isObj ? ($section->title ?? '') : '';
    $body = $isObj ? ($section->body ?? '') : '';
    $active = $isObj ? (int) $section->is_active : 1;
    $reorder = $isObj ? (int) $section->reorder_id : 0;
    $mediaUrl = $isObj ? ($section->media['url'] ?? $section->media['image'] ?? ($section->meta['url'] ?? '')) : '';
    $mediaImage = $isObj ? ($section->media['image'] ?? null) : null;
    $imagePos = $isObj ? ($section->meta['image_position'] ?? 'start') : 'start';
    $buttonLabel = $isObj ? ($section->meta['button_label'] ?? '') : '';

    $faqItems = $isObj ? ($section->meta['items'] ?? []) : [['q' => '', 'a' => '']];
    if ($type === 'faq' && empty($faqItems)) {
        $faqItems = [['q' => '', 'a' => '']];
    }

    $listItems = [];
    if (in_array($type, ['benefits', 'trust'], true)) {
        $listItems = $isObj ? ($section->meta['items'] ?? []) : [''];
        if (empty($listItems)) {
            $listItems = [''];
        }
    }

    $featureItems = $type === 'features'
        ? ($isObj ? ($section->meta['items'] ?? [['title' => '', 'text' => '']]) : [['title' => '', 'text' => '']])
        : [['title' => '', 'text' => '']];
    if ($type === 'features' && empty($featureItems)) {
        $featureItems = [['title' => '', 'text' => '']];
    }

    $specItems = $type === 'specifications'
        ? ($isObj ? ($section->meta['items'] ?? [['label' => '', 'value' => '']]) : [['label' => '', 'value' => '']])
        : [['label' => '', 'value' => '']];
    if ($type === 'specifications' && empty($specItems)) {
        $specItems = [['label' => '', 'value' => '']];
    }

    // When switching types in a new row, seed defaults
    if (! $isObj) {
        if ($type === 'faq') $faqItems = [['q' => '', 'a' => '']];
        if (in_array($type, ['benefits', 'trust'], true)) $listItems = [''];
    }
?>

<div class="mp-section-row p-3 mb-3" data-index="<?php echo e($idx); ?>">
    <input type="hidden" name="content_sections[<?php echo e($idx); ?>][id]" value="<?php echo e($id); ?>">

    <div class="mp-section-head row g-2 align-items-end mb-2">
        <div class="col-md-3">
            <label class="form-label fw-semibold">نوع القسم</label>
            <select class="form-select mp-section-type" name="content_sections[<?php echo e($idx); ?>][section_type]" required>
                <?php $__currentLoopData = $sectionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($st); ?>" <?php if($type === $st): echo 'selected'; endif; ?>><?php echo e($typeLabels[$st] ?? $st); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">عنوان القسم</label>
            <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][title]" value="<?php echo e($title); ?>"
                placeholder="مثال: لماذا تختار هذا المنتج؟">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold">الترتيب</label>
            <input type="number" class="form-control" name="content_sections[<?php echo e($idx); ?>][reorder_id]" value="<?php echo e($reorder); ?>">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold">الحالة</label>
            <select class="form-select" name="content_sections[<?php echo e($idx); ?>][is_active]">
                <option value="1" <?php if($active === 1): echo 'selected'; endif; ?>>نشط</option>
                <option value="0" <?php if($active === 0): echo 'selected'; endif; ?>>معطّل</option>
            </select>
        </div>
        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-outline-danger mp-remove-section" title="حذف القسم">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>

    
    <?php
        $sharedList = in_array($type, ['benefits', 'trust'], true)
            ? ($isObj ? ($section->meta['items'] ?? ['']) : [''])
            : [''];
        if (empty($sharedList)) { $sharedList = ['']; }
    ?>
    <div class="mp-type-panel <?php echo e(in_array($type, ['benefits', 'trust'], true) ? 'is-open' : ''); ?>" data-type="benefits,trust">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">العناصر</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="list">+ عنصر</button>
        </div>
        <div data-mp-item-list="list">
            <?php $__currentLoopData = $sharedList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mp-mini-row d-flex gap-2 align-items-center">
                    <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][list][]"
                        value="<?php echo e(is_array($line) ? ($line['text'] ?? $line['title'] ?? '') : $line); ?>"
                        placeholder="مثال: توصيل سريع / ضمان سنة">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>×</button>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <template data-mp-item-tpl="list">
            <div class="mp-mini-row d-flex gap-2 align-items-center">
                <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][list][]" placeholder="عنصر جديد">
                <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>×</button>
            </div>
        </template>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'faq' ? 'is-open' : ''); ?>" data-type="faq">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">الأسئلة والأجوبة</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="faq">+ سؤال</button>
        </div>
        <div data-mp-item-list="faq">
            <?php $__currentLoopData = $faqItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fi => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mp-mini-row">
                    <input type="text" class="form-control mb-2" name="content_sections[<?php echo e($idx); ?>][faq][<?php echo e($fi); ?>][q]"
                        value="<?php echo e(is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : ''); ?>" placeholder="السؤال">
                    <textarea class="form-control" rows="2" name="content_sections[<?php echo e($idx); ?>][faq][<?php echo e($fi); ?>][a]"
                        placeholder="الإجابة"><?php echo e(is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : ''); ?></textarea>
                    <div class="text-end mt-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>حذف</button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <template data-mp-item-tpl="faq">
            <div class="mp-mini-row">
                <input type="text" class="form-control mb-2" name="content_sections[<?php echo e($idx); ?>][faq][__ITEM__][q]" placeholder="السؤال">
                <textarea class="form-control" rows="2" name="content_sections[<?php echo e($idx); ?>][faq][__ITEM__][a]" placeholder="الإجابة"></textarea>
                <div class="text-end mt-1">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>حذف</button>
                </div>
            </div>
        </template>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'features' ? 'is-open' : ''); ?>" data-type="features">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">الخصائص</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="features">+ خاصية</button>
        </div>
        <div data-mp-item-list="features">
            <?php $__currentLoopData = $featureItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fi => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mp-mini-row row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][features][<?php echo e($fi); ?>][title]"
                            value="<?php echo e(is_array($feature) ? ($feature['title'] ?? '') : ''); ?>" placeholder="عنوان الخاصية">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][features][<?php echo e($fi); ?>][text]"
                            value="<?php echo e(is_array($feature) ? ($feature['text'] ?? '') : ''); ?>" placeholder="وصف مختصر">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <template data-mp-item-tpl="features">
            <div class="mp-mini-row row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][features][__ITEM__][title]" placeholder="عنوان">
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][features][__ITEM__][text]" placeholder="وصف">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                </div>
            </div>
        </template>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'specifications' ? 'is-open' : ''); ?>" data-type="specifications">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">المواصفات (مفتاح / قيمة)</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="specs">+ مواصفة</button>
        </div>
        <div data-mp-item-list="specs">
            <?php $__currentLoopData = $specItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $si => $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mp-mini-row row g-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][specs][<?php echo e($si); ?>][label]"
                            value="<?php echo e(is_array($spec) ? ($spec['label'] ?? '') : ''); ?>" placeholder="مثال: المادة">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][specs][<?php echo e($si); ?>][value]"
                            value="<?php echo e(is_array($spec) ? ($spec['value'] ?? '') : ''); ?>" placeholder="مثال: بلاستيك ABS">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <template data-mp-item-tpl="specs">
            <div class="mp-mini-row row g-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][specs][__ITEM__][label]" placeholder="المفتاح">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][specs][__ITEM__][value]" placeholder="القيمة">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                </div>
            </div>
        </template>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'rich_text' ? 'is-open' : ''); ?>" data-type="rich_text">
        <label class="form-label fw-semibold">المحتوى</label>
        <textarea class="form-control" rows="5" name="content_sections[<?php echo e($idx); ?>][body]"
            placeholder="اكتب قصة المنتج أو الوصف التفصيلي"><?php echo e($body); ?></textarea>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'image_text' ? 'is-open' : ''); ?>" data-type="image_text">
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label fw-semibold">النص</label>
                <textarea class="form-control" rows="4" name="content_sections[<?php echo e($idx); ?>][body]"
                    placeholder="وصف القسم"><?php echo e($body); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">موضع الصورة</label>
                <select class="form-select mb-2" name="content_sections[<?php echo e($idx); ?>][image_position]">
                    <option value="start" <?php if($imagePos === 'start'): echo 'selected'; endif; ?>>صورة ثم نص</option>
                    <option value="end" <?php if($imagePos === 'end'): echo 'selected'; endif; ?>>نص ثم صورة</option>
                </select>
                <label class="form-label fw-semibold">رفع صورة</label>
                <input type="file" class="form-control" name="content_sections[<?php echo e($idx); ?>][media_file]" accept="image/*">
                <?php if(!empty($mediaImage)): ?>
                    <div class="mt-2">
                        <img src="<?php echo e(helper::image_path($mediaImage)); ?>" alt="" style="max-height:80px;border-radius:8px;">
                        <input type="hidden" name="content_sections[<?php echo e($idx); ?>][media_url]" value="<?php echo e($mediaImage); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'video' ? 'is-open' : ''); ?>" data-type="video">
        <label class="form-label fw-semibold">رابط الفيديو (YouTube / Vimeo / MP4)</label>
        <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][media_url]" value="<?php echo e($mediaUrl); ?>"
            placeholder="https://www.youtube.com/watch?v=...">
    </div>

    
    <div class="mp-type-panel <?php echo e($type === 'cta' ? 'is-open' : ''); ?>" data-type="cta">
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label fw-semibold">نص الدعوة</label>
                <textarea class="form-control" rows="3" name="content_sections[<?php echo e($idx); ?>][body]"
                    placeholder="جاهز للطلب؟ أضف المنتج للسلة الآن"><?php echo e($body); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">نص الزر</label>
                <input type="text" class="form-control" name="content_sections[<?php echo e($idx); ?>][button_label]"
                    value="<?php echo e($buttonLabel); ?>" placeholder="أضف إلى السلة">
                <small class="text-muted">الزر يرتبط بنظام السلة الحقيقي.</small>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/admin/product/partials/enhanced_section_row.blade.php ENDPATH**/ ?>