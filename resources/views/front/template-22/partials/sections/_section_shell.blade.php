@php
    $sectionTitle = $section->title ?? null;
@endphp
<section class="mp-section mp-section-{{ $section->section_type }}" data-section-type="{{ $section->section_type }}">
    <div class="mp-section-inner">
        @if (!empty($sectionTitle))
            <h2 class="mp-section-heading">{{ $sectionTitle }}</h2>
        @endif
        {{ $slot ?? '' }}
        @yield('section_body')
    </div>
</section>
