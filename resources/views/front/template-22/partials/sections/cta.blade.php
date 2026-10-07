<section class="mp-section mp-section-cta">
    <div class="mp-section-inner mp-cta-box">
        @if (!empty($section->title))
            <h2 class="mp-section-heading">{{ $section->title }}</h2>
        @endif
        @if (!empty($section->body))
            <p class="mp-cta-text">{{ strip_tags($section->body) }}</p>
        @endif
        @if (helper::appdata($storeinfo->id)->online_order == 1)
            <button type="button" class="mp-btn-primary addtocart" onclick="AddtoCart('0')">
                {{ $section->meta['button_label'] ?? trans('labels.add_to_cart') }}
            </button>
        @endif
    </div>
</section>
