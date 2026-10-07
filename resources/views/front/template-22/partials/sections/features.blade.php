@php
    $features = $section->meta['items'] ?? [];
    if (empty($features) && !empty($section->body)) {
        $lines = preg_split('/\r\n|\r|\n/', $section->body);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;
            $parts = explode('|', $line, 2);
            $features[] = [
                'title' => trim($parts[0]),
                'text' => trim($parts[1] ?? ''),
            ];
        }
    }
@endphp
@if (count($features))
<section class="mp-section mp-section-features">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <div class="mp-features-grid">
            @foreach ($features as $feature)
                @php
                    $ft = is_array($feature) ? ($feature['title'] ?? '') : $feature;
                    $fx = is_array($feature) ? ($feature['text'] ?? '') : '';
                @endphp
                <div class="mp-feature-card">
                    <div class="mp-feature-icon"><i class="fa-solid fa-sparkles"></i></div>
                    <h3>{{ $ft }}</h3>
                    @if ($fx)<p>{{ $fx }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
