@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="{{ URL::to($storeinfo->slug . '/') }}">{{ trans('labels.home') }}</a>
            <span>/</span>
            <span>{{ trans('labels.faqs') }}</span>
        </nav>
        <div class="mp-page-head"><h1>{{ trans('labels.faqs') }}</h1></div>

        @if (helper::getfaqs($storeinfo->id)->count() > 0)
            @foreach (helper::getfaqs($storeinfo->id) as $faq)
                <details class="mp-faq-item">
                    <summary>{{ $faq->question }}</summary>
                    <div class="mp-faq-body">{{ $faq->answer }}</div>
                </details>
            @endforeach
        @else
            @include('front.template-22.partials.empty_state')
        @endif
    </div>
</main>

@include('front.theme.footer')
