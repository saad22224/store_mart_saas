{{-- Full-width image-only storytelling section --}}
@php
    $image = $section->media['image'] ?? ($section->media['url'] ?? null);
@endphp
@if (!empty($image))
<section class="mp-section mp-section-image-only">
    <div class="mp-image-only-wrap">
        <img src="{{ helper::image_path($image) }}" alt="" loading="lazy">
    </div>
</section>
@endif
