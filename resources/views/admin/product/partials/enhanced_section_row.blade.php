@php
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
@endphp

<div class="mp-section-row p-3 mb-3" data-index="{{ $idx }}">
    <input type="hidden" name="content_sections[{{ $idx }}][id]" value="{{ $id }}">

    <div class="mp-section-head row g-2 align-items-end mb-2">
        <div class="col-md-3">
            <label class="form-label fw-semibold">نوع القسم</label>
            <select class="form-select mp-section-type" name="content_sections[{{ $idx }}][section_type]" required>
                @foreach ($sectionTypes as $st)
                    <option value="{{ $st }}" @selected($type === $st)>{{ $typeLabels[$st] ?? $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">عنوان القسم</label>
            <input type="text" class="form-control" name="content_sections[{{ $idx }}][title]" value="{{ $title }}"
                placeholder="مثال: لماذا تختار هذا المنتج؟">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold">الترتيب</label>
            <input type="number" class="form-control" name="content_sections[{{ $idx }}][reorder_id]" value="{{ $reorder }}">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold">الحالة</label>
            <select class="form-select" name="content_sections[{{ $idx }}][is_active]">
                <option value="1" @selected($active === 1)>نشط</option>
                <option value="0" @selected($active === 0)>معطّل</option>
            </select>
        </div>
        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-outline-danger mp-remove-section" title="حذف القسم">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>

    {{-- Benefits / Trust list (shared) --}}
    @php
        $sharedList = in_array($type, ['benefits', 'trust'], true)
            ? ($isObj ? ($section->meta['items'] ?? ['']) : [''])
            : [''];
        if (empty($sharedList)) { $sharedList = ['']; }
    @endphp
    <div class="mp-type-panel {{ in_array($type, ['benefits', 'trust'], true) ? 'is-open' : '' }}" data-type="benefits,trust">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">العناصر</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="list">+ عنصر</button>
        </div>
        <div data-mp-item-list="list">
            @foreach ($sharedList as $line)
                <div class="mp-mini-row d-flex gap-2 align-items-center">
                    <input type="text" class="form-control" name="content_sections[{{ $idx }}][list][]"
                        value="{{ is_array($line) ? ($line['text'] ?? $line['title'] ?? '') : $line }}"
                        placeholder="مثال: توصيل سريع / ضمان سنة">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>×</button>
                </div>
            @endforeach
        </div>
        <template data-mp-item-tpl="list">
            <div class="mp-mini-row d-flex gap-2 align-items-center">
                <input type="text" class="form-control" name="content_sections[{{ $idx }}][list][]" placeholder="عنصر جديد">
                <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>×</button>
            </div>
        </template>
    </div>

    {{-- FAQ --}}
    <div class="mp-type-panel {{ $type === 'faq' ? 'is-open' : '' }}" data-type="faq">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">الأسئلة والأجوبة</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="faq">+ سؤال</button>
        </div>
        <div data-mp-item-list="faq">
            @foreach ($faqItems as $fi => $faq)
                <div class="mp-mini-row">
                    <input type="text" class="form-control mb-2" name="content_sections[{{ $idx }}][faq][{{ $fi }}][q]"
                        value="{{ is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : '' }}" placeholder="السؤال">
                    <textarea class="form-control" rows="2" name="content_sections[{{ $idx }}][faq][{{ $fi }}][a]"
                        placeholder="الإجابة">{{ is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : '' }}</textarea>
                    <div class="text-end mt-1">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>حذف</button>
                    </div>
                </div>
            @endforeach
        </div>
        <template data-mp-item-tpl="faq">
            <div class="mp-mini-row">
                <input type="text" class="form-control mb-2" name="content_sections[{{ $idx }}][faq][__ITEM__][q]" placeholder="السؤال">
                <textarea class="form-control" rows="2" name="content_sections[{{ $idx }}][faq][__ITEM__][a]" placeholder="الإجابة"></textarea>
                <div class="text-end mt-1">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-mp-remove-item>حذف</button>
                </div>
            </div>
        </template>
    </div>

    {{-- Features --}}
    <div class="mp-type-panel {{ $type === 'features' ? 'is-open' : '' }}" data-type="features">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">الخصائص</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="features">+ خاصية</button>
        </div>
        <div data-mp-item-list="features">
            @foreach ($featureItems as $fi => $feature)
                <div class="mp-mini-row row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="content_sections[{{ $idx }}][features][{{ $fi }}][title]"
                            value="{{ is_array($feature) ? ($feature['title'] ?? '') : '' }}" placeholder="عنوان الخاصية">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="content_sections[{{ $idx }}][features][{{ $fi }}][text]"
                            value="{{ is_array($feature) ? ($feature['text'] ?? '') : '' }}" placeholder="وصف مختصر">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                    </div>
                </div>
            @endforeach
        </div>
        <template data-mp-item-tpl="features">
            <div class="mp-mini-row row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="content_sections[{{ $idx }}][features][__ITEM__][title]" placeholder="عنوان">
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="content_sections[{{ $idx }}][features][__ITEM__][text]" placeholder="وصف">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                </div>
            </div>
        </template>
    </div>

    {{-- Specifications --}}
    <div class="mp-type-panel {{ $type === 'specifications' ? 'is-open' : '' }}" data-type="specifications">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-semibold mb-0">المواصفات (مفتاح / قيمة)</label>
            <button type="button" class="btn btn-sm btn-outline-primary" data-mp-add-item="specs">+ مواصفة</button>
        </div>
        <div data-mp-item-list="specs">
            @foreach ($specItems as $si => $spec)
                <div class="mp-mini-row row g-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="content_sections[{{ $idx }}][specs][{{ $si }}][label]"
                            value="{{ is_array($spec) ? ($spec['label'] ?? '') : '' }}" placeholder="مثال: المادة">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="content_sections[{{ $idx }}][specs][{{ $si }}][value]"
                            value="{{ is_array($spec) ? ($spec['value'] ?? '') : '' }}" placeholder="مثال: بلاستيك ABS">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                    </div>
                </div>
            @endforeach
        </div>
        <template data-mp-item-tpl="specs">
            <div class="mp-mini-row row g-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="content_sections[{{ $idx }}][specs][__ITEM__][label]" placeholder="المفتاح">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="content_sections[{{ $idx }}][specs][__ITEM__][value]" placeholder="القيمة">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" data-mp-remove-item>×</button>
                </div>
            </div>
        </template>
    </div>

    {{-- Rich text --}}
    <div class="mp-type-panel {{ $type === 'rich_text' ? 'is-open' : '' }}" data-type="rich_text">
        <label class="form-label fw-semibold">المحتوى</label>
        <textarea class="form-control" rows="5" name="content_sections[{{ $idx }}][body]"
            placeholder="اكتب قصة المنتج أو الوصف التفصيلي">{{ $body }}</textarea>
    </div>

    {{-- Image only --}}
    <div class="mp-type-panel {{ $type === 'image' ? 'is-open' : '' }}" data-type="image">
        <label class="form-label fw-semibold">صورة القسم (بدون عنوان أو نص)</label>
        <input type="file" class="form-control" name="content_sections[{{ $idx }}][media_file]" accept="image/*">
        <small class="text-muted d-block mt-1">الصورة وحدها تُعرض بعرض كامل في صفحة المنتج.</small>
        @if (!empty($mediaImage))
            <div class="mt-2">
                <img src="{{ helper::image_path($mediaImage) }}" alt="" style="max-width:100%;max-height:180px;border-radius:10px;">
                <input type="hidden" name="content_sections[{{ $idx }}][media_url]" value="{{ $mediaImage }}">
            </div>
        @endif
    </div>

    {{-- Image + text --}}
    <div class="mp-type-panel {{ $type === 'image_text' ? 'is-open' : '' }}" data-type="image_text">
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label fw-semibold">النص</label>
                <textarea class="form-control" rows="4" name="content_sections[{{ $idx }}][body]"
                    placeholder="وصف القسم">{{ $body }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">موضع الصورة</label>
                <select class="form-select mb-2" name="content_sections[{{ $idx }}][image_position]">
                    <option value="start" @selected($imagePos === 'start')>صورة ثم نص</option>
                    <option value="end" @selected($imagePos === 'end')>نص ثم صورة</option>
                </select>
                <label class="form-label fw-semibold">رفع صورة</label>
                <input type="file" class="form-control" name="content_sections[{{ $idx }}][media_file]" accept="image/*">
                @if (!empty($mediaImage))
                    <div class="mt-2">
                        <img src="{{ helper::image_path($mediaImage) }}" alt="" style="max-height:80px;border-radius:8px;">
                        <input type="hidden" name="content_sections[{{ $idx }}][media_url]" value="{{ $mediaImage }}">
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Video --}}
    <div class="mp-type-panel {{ $type === 'video' ? 'is-open' : '' }}" data-type="video">
        <label class="form-label fw-semibold">رابط الفيديو (YouTube / Vimeo / MP4)</label>
        <input type="text" class="form-control" name="content_sections[{{ $idx }}][media_url]" value="{{ $mediaUrl }}"
            placeholder="https://www.youtube.com/watch?v=...">
    </div>

    {{-- CTA --}}
    <div class="mp-type-panel {{ $type === 'cta' ? 'is-open' : '' }}" data-type="cta">
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label fw-semibold">نص الدعوة</label>
                <textarea class="form-control" rows="3" name="content_sections[{{ $idx }}][body]"
                    placeholder="جاهز للطلب؟ أضف المنتج للسلة الآن">{{ $body }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">نص الزر</label>
                <input type="text" class="form-control" name="content_sections[{{ $idx }}][button_label]"
                    value="{{ $buttonLabel }}" placeholder="أضف إلى السلة">
                <small class="text-muted">الزر يرتبط بنظام السلة الحقيقي.</small>
            </div>
        </div>
    </div>
</div>
