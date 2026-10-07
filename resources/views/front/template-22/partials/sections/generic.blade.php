{{-- Fallback renderer for unknown future section types --}}
@if (!empty($section->title) || !empty($section->body))
<section class="mp-section mp-section-generic" data-section-type="{{ $section->section_type }}">
    <div class="mp-section-inner mp-prose">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        @if (!empty($section->body))
            <div class="mp-rich-body">{!! \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li>') !!}</div>
        @endif
    </div>
</section>
@endif
