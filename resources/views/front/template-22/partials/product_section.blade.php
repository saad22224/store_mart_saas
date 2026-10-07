{{-- Section: title on top + view all + arrows + horizontal product row --}}
@php
    $sectionId = $sectionId ?? ('mp-sec-' . uniqid());
    $viewAllUrl = $viewAllUrl ?? null;
    $products = $products ?? collect();
@endphp
@if ($products->count() > 0)
@php $mpSecCount = $products->count(); @endphp
<section class="mp-product-sec" id="{{ $sectionId }}" data-count="{{ $mpSecCount }}">
    <div class="mp-sec-bar">
        <h2 class="mp-sec-title">{{ $title }}</h2>
        <div class="mp-sec-controls">
            @if ($viewAllUrl)
                <a href="{{ $viewAllUrl }}" class="mp-view-all">عرض الكل</a>
            @endif
            @if ($mpSecCount > 1)
                <button type="button" class="mp-scroll-btn" data-mp-scroll="{{ $sectionId }}" data-dir="next" aria-label="التالي">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
                <button type="button" class="mp-scroll-btn" data-mp-scroll="{{ $sectionId }}" data-dir="prev" aria-label="السابق">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            @endif
        </div>
    </div>
    <div class="mp-product-rail" data-mp-rail="{{ $sectionId }}" data-count="{{ $mpSecCount }}">
        @foreach ($products as $product)
            @include('front.template-22.partials.product_card', ['product' => $product, 'storeinfo' => $storeinfo])
        @endforeach
    </div>
</section>
@endif
