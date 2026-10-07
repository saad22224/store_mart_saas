<?php
    $sectionTypes = \App\Models\ItemContentSection::SECTION_TYPES;
    $typeLabels = [
        'benefits' => 'مزايا المنتج',
        'rich_text' => 'قصة / نص',
        'image_text' => 'صورة مع نص',
        'features' => 'خصائص',
        'specifications' => 'مواصفات',
        'faq' => 'أسئلة شائعة',
        'video' => 'فيديو',
        'trust' => 'عناصر ثقة',
        'cta' => 'دعوة للشراء',
    ];
    $existingSections = $contentSections ?? collect();
    $productVideo = old('video_url', isset($getproductdata) ? ($getproductdata->video_url ?? '') : '');
?>

<div class="col-12 mt-4" id="mpEnhancedEditor">
    <div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
        <div class="card-header text-white d-flex justify-content-between align-items-center flex-wrap gap-2"
            style="background:linear-gradient(135deg,#1a1f2e,#2d3447);">
            <div>
                <h5 class="mb-0 fw-bold">ثيم 22 — صفحة المنتج المحسّنة</h5>
                <small class="opacity-75">ابنِ صفحة هبوط للمنتج: مزايا، أسئلة، مواصفات، قصة، فيديو…</small>
            </div>
            <button type="button" class="btn btn-sm btn-light fw-bold" id="mpAddSectionBtn">
                <i class="fa-solid fa-plus"></i> إضافة قسم
            </button>
        </div>
        <div class="card-body bg-light">
            <input type="hidden" name="content_sections_present" value="1">

            <div class="alert alert-info border-0 mb-3" style="background:#eef4ff;">
                <div class="row g-2 small">
                    <div class="col-md-4"><strong>الصور:</strong> استخدم معرض صور المنتج أعلى/أسفل النموذج (رفع متعدد + حذف).</div>
                    <div class="col-md-4"><strong>الفيديو:</strong> ضع رابط يوتيوب في حقل فيديو المنتج أو أضف قسم فيديو أدناه.</div>
                    <div class="col-md-4"><strong>الحفظ:</strong> الأقسام تُحفظ مع المنتج وتظهر في واجهة ثيم 22 فقط.</div>
                </div>
            </div>

            <div id="mpSectionsContainer">
                <?php $__empty_1 = true; $__currentLoopData = $existingSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php echo $__env->make('admin.product.partials.enhanced_section_row', [
                        'index' => $index,
                        'section' => $section,
                        'sectionTypes' => $sectionTypes,
                        'typeLabels' => $typeLabels,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <?php echo $__env->make('admin.product.partials.enhanced_section_row', [
                        'index' => 0,
                        'section' => null,
                        'sectionTypes' => $sectionTypes,
                        'typeLabels' => $typeLabels,
                        'defaultType' => 'benefits',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>

            <template id="mpSectionTemplate">
                <?php echo $__env->make('admin.product.partials.enhanced_section_row', [
                    'index' => '__INDEX__',
                    'section' => null,
                    'sectionTypes' => $sectionTypes,
                    'typeLabels' => $typeLabels,
                    'defaultType' => 'faq',
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </template>
        </div>
    </div>
</div>

<style>
    #mpEnhancedEditor .mp-section-row { background:#fff; border:1px solid #e6e6e6; border-radius:12px; }
    #mpEnhancedEditor .mp-type-panel { display:none; }
    #mpEnhancedEditor .mp-type-panel.is-open { display:block; }
    #mpEnhancedEditor .mp-mini-row { background:#f8f9fb; border:1px dashed #d0d5dd; border-radius:10px; padding:10px; margin-bottom:8px; }
    #mpEnhancedEditor .mp-section-head { cursor:default; }
</style>

<script>
(function () {
    var container = document.getElementById('mpSectionsContainer');
    var tpl = document.getElementById('mpSectionTemplate');
    var addBtn = document.getElementById('mpAddSectionBtn');
    if (!container || !tpl || !addBtn) return;

    function nextIndex() {
        var max = -1;
        container.querySelectorAll('.mp-section-row').forEach(function (row) {
            var i = parseInt(row.getAttribute('data-index'), 10);
            if (!isNaN(i) && i > max) max = i;
        });
        return max + 1;
    }

    function togglePanels(row) {
        var typeSelect = row.querySelector('.mp-section-type');
        if (!typeSelect) return;
        var type = typeSelect.value;
        // benefits + trust share list fields via data-types CSV
        row.querySelectorAll('.mp-type-panel').forEach(function (p) {
            var types = (p.getAttribute('data-type') || '').split(',');
            var open = types.indexOf(type) !== -1;
            p.classList.toggle('is-open', open);
            p.querySelectorAll('input, textarea, select').forEach(function (el) {
                el.disabled = !open;
            });
        });
    }

    function bindRow(row) {
        var typeSelect = row.querySelector('.mp-section-type');
        if (typeSelect) {
            typeSelect.addEventListener('change', function () { togglePanels(row); });
            togglePanels(row);
        }
    }

    container.querySelectorAll('.mp-section-row').forEach(bindRow);

    addBtn.addEventListener('click', function () {
        var idx = nextIndex();
        var html = tpl.innerHTML.replace(/__INDEX__/g, String(idx));
        container.insertAdjacentHTML('beforeend', html);
        var row = container.querySelector('.mp-section-row[data-index="' + idx + '"]');
        if (row) bindRow(row);
    });

    container.addEventListener('click', function (e) {
        var removeBtn = e.target.closest('.mp-remove-section');
        if (removeBtn) {
            var row = removeBtn.closest('.mp-section-row');
            if (row) row.remove();
            return;
        }

        var addItem = e.target.closest('[data-mp-add-item]');
        if (addItem) {
            var kind = addItem.getAttribute('data-mp-add-item');
            var row = addItem.closest('.mp-section-row');
            var list = row.querySelector('[data-mp-item-list="' + kind + '"]');
            var itemTpl = row.querySelector('template[data-mp-item-tpl="' + kind + '"]');
            if (!list || !itemTpl) return;
            var i = list.querySelectorAll('.mp-mini-row').length;
            list.insertAdjacentHTML('beforeend', itemTpl.innerHTML.replace(/__ITEM__/g, String(i)));
            return;
        }

        var removeItem = e.target.closest('[data-mp-remove-item]');
        if (removeItem) {
            var mini = removeItem.closest('.mp-mini-row');
            if (mini) mini.remove();
        }
    });
})();
</script>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\product\partials\enhanced_content_sections.blade.php ENDPATH**/ ?>