@php
    $faqs = $section->meta['items'] ?? [];
    if (empty($faqs) && !empty($section->body)) {
        $blocks = preg_split('/\r\n\r\n|\n\n/', $section->body);
        foreach ($blocks as $block) {
            $lines = preg_split('/\r\n|\r|\n/', trim($block));
            if (count($lines) >= 2) {
                $faqs[] = [
                    'q' => trim($lines[0]),
                    'a' => trim(implode("\n", array_slice($lines, 1))),
                ];
            }
        }
    }
@endphp
@if (count($faqs))
<section class="mp-section mp-section-faq">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <div class="mp-faq-list">
            @foreach ($faqs as $i => $faq)
                @php
                    $q = is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : '';
                    $a = is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : '';
                @endphp
                <details class="mp-faq-item" @if ($i === 0) open @endif>
                    <summary>{{ $q }}</summary>
                    <div class="mp-faq-body">{{ $a }}</div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif
