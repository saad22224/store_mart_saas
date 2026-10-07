@php
    $specs = $section->meta['items'] ?? [];
    if (empty($specs) && !empty($section->body)) {
        $lines = preg_split('/\r\n|\r|\n/', $section->body);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || !str_contains($line, ':')) continue;
            [$k, $v] = array_map('trim', explode(':', $line, 2));
            $specs[] = ['label' => $k, 'value' => $v];
        }
    }
@endphp
@if (count($specs))
<section class="mp-section mp-section-specifications">
    <div class="mp-section-inner">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        <dl class="mp-specs">
            @foreach ($specs as $spec)
                @php
                    $label = is_array($spec) ? ($spec['label'] ?? '') : '';
                    $value = is_array($spec) ? ($spec['value'] ?? '') : $spec;
                @endphp
                <div class="mp-spec-row">
                    <dt>{{ $label }}</dt>
                    <dd>{{ $value }}</dd>
                </div>
            @endforeach
        </dl>
    </div>
</section>
@endif
