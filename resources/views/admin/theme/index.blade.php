@extends('admin.layout.default')

@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold color-changer text-dark m-0">
                <i class="fa-solid fa-palette text-primary me-2"></i>{{ trans('labels.themes') ?? 'الثيمات' }}
            </h4>
            <p class="text-muted fs-7 m-0">
                {{ Auth::user()->type == 1 ? 'إدارة ثيمات النظام وروابط المعاينة والصور' : 'استعرض الثيمات المتاحة لمتجرك واطلب تفعيل الثيم المناسب باختيارك' }}
            </p>
        </div>

        @if (Auth::user()->type == 1)
            <div class="d-flex align-items-center" style="gap: 10px;">
                @if (@helper::checkaddons('bulk_delete'))
                    <button id="bulkDeleteBtn"
                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="deleteSelected('{{ URL::to('admin/themes/bulk_delete') }}')" @endif
                        class="btn btn-danger hov btn-sm d-none d-flex align-items-center gap-1" tooltip="{{ trans('labels.delete') }}">
                        <i class="fa-regular fa-trash"></i> {{ trans('labels.delete') }}
                    </button>
                @endif

                <a href="{{ URL::to('admin/themes/add') }}" class="btn btn-secondary px-sm-4 d-flex align-items-center gap-1">
                    <i class="fa-regular fa-plus"></i> {{ trans('labels.add') ?? 'إضافة ثيم جديد' }}
                </a>
            </div>
        @endif
    </div>

    @if (Auth::user()->type == 1)
        {{-- Admin View: Table Management --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-0 mb-3 box-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                                <thead>
                                    <tr class="text-capitalize fw-500 fs-15">
                                        <td></td>
                                        @if (@helper::checkaddons('bulk_delete'))
                                            @if ($themes->count() > 0)
                                                <td><input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                            @endif
                                        @endif
                                        <td>#</td>
                                        <td>{{ trans('labels.image') }}</td>
                                        <td>{{ trans('labels.name') }}</td>
                                        <td>{{ trans('labels.link') ?? 'رابط المعاينة' }}</td>
                                        <td>{{ trans('labels.created_date') }}</td>
                                        <td>{{ trans('labels.action') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="tabledetails" data-url="{{ url('admin/themes/reorder_theme') }}">
                                    @php $i = 1; @endphp
                                    @foreach ($themes as $theme)
                                        <tr class="fs-7 row1 align-middle" id="dataid{{ $theme->id }}" data-id="{{ $theme->id }}">
                                            <td>
                                                <a tooltip="{{ trans('labels.move') }}">
                                                    <i class="fa-light fa-up-down-left-right mx-2"></i>
                                                </a>
                                            </td>
                                            @if (@helper::checkaddons('bulk_delete'))
                                                <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="{{ $theme->id }}"></td>
                                            @endif
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <img src="{{ helper::image_path($theme->image) }}" class="img-fluid rounded hw-50 object-fit-cover" alt="{{ $theme->name }}">
                                            </td>
                                            <td class="fw-bold">{{ $theme->name }}</td>
                                            <td>
                                                @php $link = $theme->preview_link ?? $theme->link; @endphp
                                                @if (!empty($link) && $link != '#')
                                                    <a href="{{ $link }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fs-8">
                                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> {{ trans('labels.preview') ?? 'معاينة' }}
                                                    </a>
                                                @else
                                                    <span class="text-muted fs-8">غير محدد</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ helper::date_format($theme->created_at, $vendor_id) }}<br>
                                                {{ helper::time_format($theme->created_at, $vendor_id) }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="{{ URL::to('/admin/themes/edit-' . $theme->id) }}" class="btn btn-info hov btn-sm" tooltip="{{ trans('labels.edit') }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/themes/delete-' . $theme->id) }}')" @endif
                                                        class="btn btn-danger hov btn-sm">
                                                        <i class="fa-regular fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Merchant / Vendor View: Grid of Available Themes --}}
        <div class="row g-4 mb-5">
            @forelse ($themes as $theme)
                @php
                    $previewUrl = !empty($theme->preview_link) ? $theme->preview_link : (!empty($theme->link) ? $theme->link : '#');
                    $waText = urlencode('مرحباً، أريد طلب تفعيل ثيم: (' . $theme->name . ') لمتجري.');
                    $waPhone = !empty($adminWhatsapp) ? preg_replace('/[^0-9]/', '', $adminWhatsapp) : '';
                    $waLink = !empty($waPhone) ? "https://api.whatsapp.com/send?phone={$waPhone}&text={$waText}" : "https://api.whatsapp.com/send?text={$waText}";
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden theme-card-vendor hover-lift transition-all">
                        <div class="position-relative overflow-hidden bg-light" style="aspect-ratio: 16/10;">
                            <img src="{{ helper::image_path($theme->image) }}" class="w-100 h-100 object-fit-cover theme-preview-img" alt="{{ $theme->name }}">
                            <div class="theme-card-overlay d-flex align-items-center justify-content-center gap-2">
                                @if ($previewUrl != '#')
                                    <a href="{{ $previewUrl }}" target="_blank" class="btn btn-light rounded-pill px-4 fw-bold text-dark shadow">
                                        <i class="fa-solid fa-eye me-1"></i> {{ trans('labels.preview') ?? 'معاينة الثيم' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between bg-white">
                            <div>
                                <h5 class="fw-bold text-dark mb-2">{{ $theme->name }}</h5>
                                <p class="text-muted fs-7 mb-4">تصميم مميز وعصري يناسب هويتك التجارية ويرفع معدل المبيعات.</p>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-auto">
                                @if ($previewUrl != '#')
                                    <a href="{{ $previewUrl }}" target="_blank" class="btn btn-outline-secondary rounded-pill flex-fill fw-bold btn-sm py-2">
                                        <i class="fa-solid fa-eye me-1"></i> معاينة
                                    </a>
                                @endif
                                <a href="{{ $waLink }}" target="_blank" class="btn btn-success rounded-pill flex-fill fw-bold btn-sm py-2 d-flex align-items-center justify-content-center gap-1 shadow-sm">
                                    <i class="fa-brands fa-whatsapp fs-5"></i> طلب الثيم عبر واتساب
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="card border-0 shadow-sm p-5 rounded-4">
                        <i class="fa-solid fa-palette fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted fw-bold">لا توجد ثيمات متاحة حالياً</h5>
                        <p class="text-muted fs-7 mb-0">يرجى التواصل مع الإدارة للاستفسار عن الباقات والثيمات المتوفرة.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <style>
            .theme-card-vendor { transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.06) !important; }
            .theme-card-vendor:hover { transform: translateY(-6px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
            .theme-preview-img { transition: transform 0.5s ease; }
            .theme-card-vendor:hover .theme-preview-img { transform: scale(1.05); }
            .theme-card-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.4); opacity: 0; transition: all 0.3s ease; }
            .theme-card-vendor:hover .theme-card-overlay { opacity: 1; }
        </style>
    @endif
@endsection
