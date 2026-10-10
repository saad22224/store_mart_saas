@extends('admin.layout.default')
@php
    $products = $payload['products'] ?? [];
    $suggestedCategories = $payload['categories'] ?? [];
    $isRtl = session()->get('direction') == 2;
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="text-capitalize color-changer mb-0">{{ trans('labels.review_menu_import') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/products') }}"
                        class="color-changer">{{ trans('labels.products') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/products/menu-import') }}"
                        class="color-changer">{{ trans('labels.import_menu') }}</a></li>
                <li class="breadcrumb-item active {{ $isRtl ? 'breadcrumb-rtl' : '' }}">{{ trans('labels.review') }}</li>
            </ol>
        </nav>
    </div>

    <div class="alert alert-info small">
        {{ trans('labels.review_menu_help') }}
    </div>

    @if (!empty($suggestedCategories))
        <div class="card border-0 box-shadow mb-3">
            <div class="card-body py-2">
                <span class="fw-600">{{ trans('labels.detected_categories') }}:</span>
                @foreach ($suggestedCategories as $catName)
                    <span class="badge bg-light text-dark border mx-1">{{ $catName }}</span>
                @endforeach
            </div>
        </div>
    @endif

    <form action="{{ URL::to('admin/products/menu-import/confirm/' . $token) }}" method="POST"
        enctype="multipart/form-data" id="menuReviewForm">
        @csrf
        <div class="card border-0 box-shadow mb-3">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="toggleAll" checked>
                        <label class="form-check-label" for="toggleAll">{{ trans('labels.select_all') }}</label>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="addRowBtn">
                        <i class="fa-solid fa-plus"></i> {{ trans('labels.add_row') }}
                    </button>
                </div>

                <div id="menuRows">
                    @foreach ($products as $i => $product)
                        @php
                            $needsReview = !empty($product['needs_review']) || empty($product['price']) || empty($product['name']);
                            $matchedCatId = null;
                            if (!empty($product['category_name'])) {
                                $match = $categories->first(function ($c) use ($product) {
                                    return mb_strtolower($c->name) === mb_strtolower($product['category_name']);
                                });
                                $matchedCatId = $match?->id;
                            }
                        @endphp
                        <div class="menu-import-row border rounded p-3 mb-3 {{ $needsReview ? 'border-warning bg-warning-subtle' : 'border-success-subtle' }}"
                            data-row>
                            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input row-include" type="checkbox"
                                        name="products[{{ $i }}][include]" value="1" checked>
                                    <label class="form-check-label fw-600">
                                        #{{ $i + 1 }}
                                        @if ($needsReview)
                                            <span class="badge bg-warning text-dark">{{ trans('labels.needs_review') }}</span>
                                        @else
                                            <span class="badge bg-success">{{ trans('labels.extracted_ok') }}</span>
                                        @endif
                                    </label>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-row">
                                    <i class="fa-regular fa-trash"></i>
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small">{{ trans('labels.name') }} *</label>
                                    <input type="text" class="form-control"
                                        name="products[{{ $i }}][name]"
                                        value="{{ old('products.' . $i . '.name', $product['name'] ?? '') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small">{{ trans('labels.price') }} *</label>
                                    <input type="number" step="0.001" min="0" class="form-control"
                                        name="products[{{ $i }}][price]"
                                        value="{{ old('products.' . $i . '.price', $product['price'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small">{{ trans('labels.category') }}</label>
                                    <select class="form-control cat-select" name="products[{{ $i }}][category_id]">
                                        <option value="">{{ trans('labels.select') }}</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ (string) old('products.' . $i . '.category_id', $matchedCatId) === (string) $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control mt-1"
                                        name="products[{{ $i }}][new_category]"
                                        placeholder="{{ trans('labels.new_category_or_detected') }}"
                                        value="{{ old('products.' . $i . '.new_category', $matchedCatId ? '' : ($product['category_name'] ?? '')) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small">{{ trans('labels.image') }}
                                        ({{ trans('labels.optional') }})</label>
                                    <input type="file" class="form-control"
                                        name="products[{{ $i }}][image]"
                                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small">{{ trans('labels.description') }}</label>
                                    <textarea class="form-control" rows="2"
                                        name="products[{{ $i }}][description]">{{ old('products.' . $i . '.description', $product['description'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <details class="mb-3">
            <summary class="text-muted small">{{ trans('labels.raw_ocr_text') }}</summary>
            <pre class="bg-light border rounded p-3 small mt-2"
                style="white-space: pre-wrap; max-height: 240px; overflow:auto;">{{ $payload['raw_text'] ?? '' }}</pre>
        </details>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-secondary" id="confirmImportBtn">
                <i class="fa-solid fa-check mx-1"></i>{{ trans('labels.confirm_import') }}
            </button>
            <a href="{{ URL::to('admin/products/menu-import') }}"
                class="btn btn-outline-secondary">{{ trans('labels.back') }}</a>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        (function() {
            var rows = document.getElementById('menuRows');
            var toggleAll = document.getElementById('toggleAll');
            var addBtn = document.getElementById('addRowBtn');
            var form = document.getElementById('menuReviewForm');
            var submitBtn = document.getElementById('confirmImportBtn');
            var nextIndex = {{ count($products) }};

            function reindex() {
                // keep names as-is; server accepts sparse keys
            }

            if (toggleAll) {
                toggleAll.addEventListener('change', function() {
                    rows.querySelectorAll('.row-include').forEach(function(cb) {
                        cb.checked = toggleAll.checked;
                    });
                });
            }

            rows.addEventListener('click', function(e) {
                var btn = e.target.closest('.remove-row');
                if (!btn) return;
                var row = btn.closest('[data-row]');
                if (row) row.remove();
            });

            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    var i = nextIndex++;
                    var catOptions = `@foreach ($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach`;
                    var html = `
                    <div class="menu-import-row border rounded p-3 mb-3 border-warning bg-warning-subtle" data-row>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input row-include" type="checkbox" name="products[${i}][include]" value="1" checked>
                                <label class="form-check-label fw-600"><span class="badge bg-warning text-dark">{{ trans('labels.needs_review') }}</span></label>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fa-regular fa-trash"></i></button>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-4"><label class="form-label small">{{ trans('labels.name') }} *</label>
                                <input type="text" class="form-control" name="products[${i}][name]"></div>
                            <div class="col-md-2"><label class="form-label small">{{ trans('labels.price') }} *</label>
                                <input type="number" step="0.001" min="0" class="form-control" name="products[${i}][price]"></div>
                            <div class="col-md-3"><label class="form-label small">{{ trans('labels.category') }}</label>
                                <select class="form-control" name="products[${i}][category_id]"><option value="">{{ trans('labels.select') }}</option>${catOptions}</select>
                                <input type="text" class="form-control mt-1" name="products[${i}][new_category]" placeholder="{{ trans('labels.new_category_or_detected') }}"></div>
                            <div class="col-md-3"><label class="form-label small">{{ trans('labels.image') }}</label>
                                <input type="file" class="form-control" name="products[${i}][image]" accept=".jpg,.jpeg,.png,.webp"></div>
                            <div class="col-12"><label class="form-label small">{{ trans('labels.description') }}</label>
                                <textarea class="form-control" rows="2" name="products[${i}][description]"></textarea></div>
                        </div>
                    </div>`;
                    rows.insertAdjacentHTML('beforeend', html);
                });
            }

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    var missing = 0;
                    rows.querySelectorAll('[data-row]').forEach(function(row) {
                        var include = row.querySelector('.row-include');
                        if (!include || !include.checked) return;
                        var price = row.querySelector('input[name*="[price]"]');
                        var name = row.querySelector('input[name*="[name]"]');
                        var catSelect = row.querySelector('select[name*="[category_id]"]');
                        var newCat = row.querySelector('input[name*="[new_category]"]');
                        var hasCat = (catSelect && catSelect.value) || (newCat && newCat.value.trim());
                        if (!name || !name.value.trim() || !price || price.value === '' || !hasCat) {
                            missing++;
                            row.classList.add('border-danger');
                        }
                    });
                    if (missing > 0) {
                        e.preventDefault();
                        submitBtn.disabled = false;
                        alert(@json(trans('messages.menu_import_nothing_saved')));
                        return;
                    }
                    submitBtn.disabled = true;
                });
            }
        })();
    </script>
@endsection
