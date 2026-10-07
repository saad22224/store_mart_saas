@include('front.theme.header')
@include('front.template-22.partials.theme_styles')

<main class="mp-cms-page mp-body">
    <div class="mp-wrap" style="padding-top:28px;padding-bottom:48px;">
        <nav class="mp-breadcrumb">
            <a href="{{ URL::to($storeinfo->slug . '/') }}">{{ trans('labels.home') }}</a>
            <span>/</span>
            <span>{{ trans('labels.contact_us') }}</span>
        </nav>
        <div class="mp-page-head">
            <h1>{{ trans('labels.contact_us') }}</h1>
            <p>{{ trans('labels.contact_further_question') ?? '' }}</p>
        </div>

        <div class="mp-contact-grid">
            <div class="mp-contact-info">
                @if (!empty(helper::appdata($storeinfo->id)->email))
                    <a href="mailto:{{ helper::appdata($storeinfo->id)->email }}">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <strong>{{ trans('labels.email') }}</strong>
                            <div class="text-muted">{{ helper::appdata($storeinfo->id)->email }}</div>
                        </div>
                    </a>
                @endif
                @if (!empty(helper::appdata($storeinfo->id)->contact))
                    <a href="tel:{{ helper::appdata($storeinfo->id)->contact }}">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <strong>{{ trans('labels.mobile') }}</strong>
                            <div class="text-muted">{{ helper::appdata($storeinfo->id)->contact }}</div>
                        </div>
                    </a>
                @endif
                @if (!empty(helper::appdata($storeinfo->id)->address))
                    <a href="https://www.google.com/maps/place/{{ urlencode(helper::appdata($storeinfo->id)->address) }}" target="_blank" rel="noopener">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <strong>{{ trans('labels.address') }}</strong>
                            <div class="text-muted">{{ helper::appdata($storeinfo->id)->address }}</div>
                        </div>
                    </a>
                @endif
            </div>

            <div class="mp-cms-card">
                <form method="POST" action="{{ URL::to($storeinfo->slug . '/submit') }}">
                    @csrf
                    <input type="hidden" name="vendor_id" value="{{ $storeinfo->id }}">
                    <div class="mp-form-row">
                        <div class="mp-form-group">
                            <label class="mp-form-label">{{ trans('labels.first_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input" name="fname" required placeholder="{{ trans('labels.first_name') }}">
                        </div>
                        <div class="mp-form-group">
                            <label class="mp-form-label">{{ trans('labels.last_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input" name="lname" required placeholder="{{ trans('labels.last_name') }}">
                        </div>
                    </div>
                    <div class="mp-form-row">
                        <div class="mp-form-group">
                            <label class="mp-form-label">{{ trans('labels.email') }} <span class="text-danger">*</span></label>
                            <input type="email" class="mp-input" name="email" required placeholder="{{ trans('labels.email') }}">
                        </div>
                        <div class="mp-form-group">
                            <label class="mp-form-label">{{ trans('labels.mobile') }} <span class="text-danger">*</span></label>
                            <input type="text" class="mp-input mobile-number" name="mobile" required placeholder="{{ trans('labels.mobile') }}">
                        </div>
                    </div>
                    <div class="mp-form-group">
                        <label class="mp-form-label">{{ trans('labels.message') }} <span class="text-danger">*</span></label>
                        <textarea class="mp-textarea" name="message" required placeholder="{{ trans('labels.message') }}"></textarea>
                    </div>
                    @include('landing.layout.recaptcha')
                    <button type="submit" name="submit" id="btnsubmit" class="mp-btn-primary w-100">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</main>

@include('front.theme.footer')
