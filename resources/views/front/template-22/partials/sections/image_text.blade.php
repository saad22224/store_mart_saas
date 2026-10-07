@php
    $image = $section->media['image'] ?? ($section->media['url'] ?? null);
    $position = $section->meta['image_position'] ?? 'start';
@endphp
@if (!empty($section->body) || !empty($image) || !empty($section->title))
<section class="mp-section mp-section-image_text">
    <div class="mp-section-inner mp-image-text {{ $position === 'end' ? 'mp-image-end' : '' }}">
        @if (!empty($image))
            <div class="mp-image-text-media">
                <img src="{{ helper::image_path($image) }}" alt="{{ $section->title ?? '' }}" loading="lazy">
            </div>
        @endif
        <div class="mp-image-text-copy">
            @if (!empty($section->title))
                <h2 class="mp-section-heading">{{ $section->title }}</h2>
            @endif
            @if (!empty($section->body))
                <div class="mp-rich-body">{!! \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li>') !!}</div>
            @endif
        </div>
    </div>
</section>
@endif
