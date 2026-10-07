@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="{{ URL::to($storeinfo->slug . '/') }}">{{ trans('labels.home') }}</a>
            <span>/</span>
            <span>{{ trans('labels.terms') }}</span>
        </nav>
        <div class="mp-page-head"><h1>{{ trans('labels.terms') }}</h1></div>
        <div class="mp-cms-card mp-rich-body">
            @if (@$terms->terms_content != '')
                {!! $terms->terms_content !!}
            @else
                @include('front.template-22.partials.empty_state')
            @endif
        </div>
    </div>
</main>

@include('front.theme.footer')
