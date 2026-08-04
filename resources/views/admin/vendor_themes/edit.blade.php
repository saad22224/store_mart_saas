@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">تعديل بيانات الثيم</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark">
                    <a href="{{ URL::to('admin/vendor_themes') }}" class="color-changer">معرض الثيمات</a>
                </li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}" aria-current="page">{{ trans('labels.edit') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow rounded-4">
                <div class="card-body p-4">
                    <form action="{{ URL::to('/admin/vendor_themes/update-' . $theme->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label class="form-label fw-bold">{{ trans('labels.name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $theme->name }}" placeholder="اسم الثيم" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fw-bold">{{ trans('labels.image') }}</label>
                                <input type="file" class="form-control" name="image">
                                @if (!empty($theme->image))
                                    <div class="mt-2">
                                        <img src="{{ helper::image_path($theme->image) }}" class="img-fluid rounded hw-50 object-fit-cover shadow-sm" alt="{{ $theme->name }}">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label fw-bold">رابط معاينة الثيم (Preview Link)</label>
                                <input type="url" class="form-control" name="preview_link" value="{{ $theme->preview_link }}" placeholder="https://example.com/demo-theme">
                                <small class="text-muted fs-8">رابط الـ Demo المباشر ليتمكن التاجر من معاينة الثيم قبل اﻹجراء.</small>
                            </div>
                        </div>
                        <div class="mt-4 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                            <a href="{{ URL::to('admin/vendor_themes') }}" class="btn btn-outline-secondary px-sm-4 me-2">{{ trans('labels.cancel') }}</a>
                            <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif class="btn btn-primary px-sm-4">{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
