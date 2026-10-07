{{-- Theme 22 empty state --}}
@php
    $mpEmptyTitle = $title ?? (trans('labels.no_data_found') ?: 'لا توجد نتائج');
    $mpEmptyMsg = $message ?? (trans('labels.no_data_msg') ?: 'جرّب تصفح المنتجات أو العودة للرئيسية.');
    $mpEmptyCta = $cta ?? (trans('labels.return_to_shop') ?: 'العودة للمتجر');
    $mpEmptyHref = $href ?? URL::to(@$storeinfo->slug . '/');
    $mpEmptyIcon = $icon ?? 'fa-solid fa-box-open';
@endphp
<div class="mp-empty-state">
    <div class="mp-empty-icon"><i class="{{ $mpEmptyIcon }}"></i></div>
    <h3>{{ $mpEmptyTitle }}</h3>
    <p>{{ $mpEmptyMsg }}</p>
    <a href="{{ $mpEmptyHref }}" class="mp-btn-primary">{{ $mpEmptyCta }}</a>
</div>
