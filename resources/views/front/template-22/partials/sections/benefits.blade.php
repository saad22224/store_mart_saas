@php
    $items = $section->meta['items'] ?? [];
    if (empty($items) && !empty($section->body)) {
        $items = preg_split('/\r\n|\r|\n/', $section->body);
    }
    $items = array_values(array_filter(array_map('trim', (array) $items)));
@endphp
@if (count($items))
<section class="mp-section mp-section-benefits">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <ul class="mp-benefits-list">
            @foreach ($items as $benefit)
                <li><i class="fa-solid fa-circle-check"></i><span>{{ $benefit }}</span></li>
            @endforeach
        </ul>
    </div>
</section>
@endif
