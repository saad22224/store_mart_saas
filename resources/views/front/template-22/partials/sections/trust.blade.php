@php
    $items = $section->meta['items'] ?? [];
    if (empty($items) && !empty($section->body)) {
        $items = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $section->body))));
    }
@endphp
@if (count($items))
<section class="mp-section mp-section-trust">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <div class="mp-trust-banner">
            @foreach ($items as $item)
                <div class="mp-trust-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>{{ is_array($item) ? ($item['text'] ?? $item['title'] ?? '') : $item }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
