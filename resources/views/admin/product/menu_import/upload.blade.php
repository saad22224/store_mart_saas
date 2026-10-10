@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="text-capitalize color-changer mb-0">{{ trans('labels.import_menu_from_image') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/products') }}"
                        class="color-changer">{{ trans('labels.products') }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.import_menu') }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <p class="text-muted mb-3">{{ trans('labels.import_menu_help') }}</p>

                    @if (!$visionAvailable)
                        <div class="alert alert-warning">
                            {{ trans('messages.menu_import_gemini_missing') }}
                        </div>
                    @else
                        <div class="alert alert-info small">
                            {{ trans('labels.import_menu_ai_ready') }}
                        </div>
                    @endif

                    <form action="{{ URL::to('admin/products/menu-import/process') }}" method="POST"
                        enctype="multipart/form-data" id="menuImportForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">{{ trans('labels.menu_image') }} <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="menu_image" id="menu_image" class="form-control"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required
                                @if (!$visionAvailable) disabled @endif>
                            <small class="text-muted">{{ trans('labels.import_menu_formats', ['size' => $maxMb]) }}</small>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-secondary" id="menuImportSubmit"
                                @if (!$visionAvailable) disabled @endif>
                                <i class="fa-solid fa-wand-magic-sparkles mx-1"></i>
                                {{ trans('labels.extract_menu') }}
                            </button>
                            <a href="{{ URL::to('admin/products') }}"
                                class="btn btn-outline-secondary">{{ trans('labels.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <h6 class="fw-600 mb-2">{{ trans('labels.import_menu_tips_title') }}</h6>
                    <ul class="small text-muted mb-0 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                        <li>{{ trans('labels.import_menu_tip_1') }}</li>
                        <li>{{ trans('labels.import_menu_tip_2') }}</li>
                        <li>{{ trans('labels.import_menu_tip_3') }}</li>
                        <li>{{ trans('labels.import_menu_tip_4') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function() {
            var form = document.getElementById('menuImportForm');
            var btn = document.getElementById('menuImportSubmit');
            if (!form || !btn) return;
            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm mx-1"></span> {{ trans('labels.processing') }}';
            });
        })();
    </script>
@endsection
