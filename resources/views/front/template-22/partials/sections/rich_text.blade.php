@if (!empty($section->body) || !empty($section->title))
<section class="mp-section mp-section-rich_text">
    <div class="mp-section-inner mp-prose">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        @if (!empty($section->body))
            <div class="mp-rich-body">{!! \Illuminate\Support\Str::of($section->body)->stripTags('<p><br><strong><b><em><i><ul><ol><li><h3><h4><a>') !!}</div>
        @endif
    </div>
</section>
@endif
