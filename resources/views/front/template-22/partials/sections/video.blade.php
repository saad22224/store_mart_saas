@php
    $url = $section->media['url'] ?? ($section->meta['url'] ?? $section->body);
    $embed = null;
    if (!empty($url) && is_string($url)) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/', $url, $m)) {
            $embed = 'https://www.youtube.com/embed/' . $m[1];
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            $embed = 'https://player.vimeo.com/video/' . $m[1];
        }
    }
@endphp
@if ($embed || (!empty($url) && str_ends_with(strtolower((string) $url), '.mp4')))
<section class="mp-section mp-section-video">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <div class="mp-video-wrap">
            @if ($embed)
                <iframe src="{{ $embed }}" title="{{ $section->title ?? 'video' }}" allowfullscreen loading="lazy"></iframe>
            @else
                <video controls preload="metadata" src="{{ $url }}"></video>
            @endif
        </div>
    </div>
</section>
@endif
