<style>
    /* Template 17 Footer Styles */
    .vela-footer-top {
        background: #fff;
        padding: 50px 0;
    }
    .vela-feature-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        height: 100%;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.3s ease;
    }
    .vela-feature-card:hover {
        transform: translateY(-5px);
    }
    .vela-feature-icon {
        width: 50px;
        height: 50px;
        background: var(--bs-primary); 
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin: 0 auto 20px;
    }
    .vela-feature-title {
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .vela-feature-desc {
        color: #777;
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
    }
    
    .vela-footer-main {
        background: color-mix(in srgb, var(--bs-primary) 15%, transparent); /* Light background based on primary */
        padding: 60px 0 30px;
    }
    .vela-footer-title {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        margin-bottom: 25px;
    }
    .vela-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .vela-contact-list li {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        color: #333;
        font-size: 14px;
    }
    .vela-contact-icon {
        width: 35px;
        height: 35px;
        background: #fff;
        color: var(--bs-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .vela-contact-icon i {
        color: var(--bs-primary); 
    }
    .vela-footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .vela-footer-links li {
        margin-bottom: 15px;
    }
    .vela-footer-links a {
        color: #444;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    .vela-footer-links a:hover {
        color: #000;
        font-weight: 600;
    }
    
    .vela-social-icons {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }
    .vela-social-icons a {
        color: #111;
        font-size: 18px;
        text-decoration: none;
        transition: transform 0.3s ease;
    }
    .vela-social-icons a:hover {
        transform: scale(1.1);
    }
    
    .vela-footer-bottom {
        background: #fff;
        padding: 20px 0;
        text-align: center;
    }
    .vela-footer-bottom p {
        margin: 0;
        color: var(--bs-primary);
        font-weight: 600;
        font-size: 14px;
    }
</style>

<!-- Top White Section: Features -->
<section class="vela-footer-top">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @php 
                $features = helper::footer_features(@$storeinfo->id); 
            @endphp
            @if(count($features) > 0)
                @foreach ($features->take(2) as $feature)
                <div class="col-lg-5 col-md-6">
                    <div class="vela-feature-card">
                        <div class="vela-feature-icon">
                            {!! $feature->icon !!}
                        </div>
                        <h4 class="vela-feature-title">{{ $feature->title }}</h4>
                        <p class="vela-feature-desc">{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-5 col-md-6">
                    <div class="vela-feature-card">
                        <div class="vela-feature-icon">
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <h4 class="vela-feature-title">{{ trans('labels.offers_discounts') == 'labels.offers_discounts' ? 'OFFERS & DISCOUNTS' : trans('labels.offers_discounts') }}</h4>
                        <p class="vela-feature-desc">{{ trans('labels.offers_desc') == 'labels.offers_desc' ? 'Our store provides high-quality products at competitive prices, with numerous offers and discounts available on all products year-round.' : trans('labels.offers_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="vela-feature-card">
                        <div class="vela-feature-icon">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <h4 class="vela-feature-title">{{ trans('labels.customer_reviews') == 'labels.customer_reviews' ? 'CUSTOMER REVIEWS 4.8/5' : trans('labels.customer_reviews') }}</h4>
                        <p class="vela-feature-desc">{{ trans('labels.reviews_desc') == 'labels.reviews_desc' ? 'Customer satisfaction is our primary goal. We believe you will find the products that best meet your needs.' : trans('labels.reviews_desc') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Pink Footer Section -->
@php
    $store = App\Models\User::where('id' , $storeinfo->id)->first();
    $storeEmail = helper::appdata(@$storeinfo->id)->email != '-' ? helper::appdata(@$storeinfo->id)->email : $store->email;
    $storePhone = helper::appdata(@$storeinfo->id)->contact != '-' ? helper::appdata(@$storeinfo->id)->contact : $store->mobile;
@endphp
<footer class="vela-footer-main">
    <div class="container">
        <div class="row g-4">
            
            <!-- Column 1: Contact Info -->
            <div class="col-lg-4 col-md-12">
                <ul class="vela-contact-list">
                    <li>
                        <div class="vela-contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <strong>{{ trans('labels.address') == 'labels.address' ? 'Address' : trans('labels.address') }}:</strong> 
                            {{ empty(helper::appdata($storeinfo->id)->address) ? '-' : helper::appdata($storeinfo->id)->address }}
                        </div>
                    </li>
                    <li>
                        <div class="vela-contact-icon"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <strong>{{ trans('labels.mobile') == 'labels.mobile' ? 'Phone' : trans('labels.mobile') }}:</strong> 
                            <a href="tel:{{ $storePhone }}" style="color: inherit; text-decoration: none;" dir="ltr">{{ $storePhone }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="vela-contact-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <strong>{{ trans('labels.email') == 'labels.email' ? 'Email' : trans('labels.email') }}:</strong> 
                            <a href="mailto:{{ $storeEmail }}" style="color: inherit; text-decoration: none;">{{ $storeEmail }}</a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Categories -->
            <div class="col-lg-3 col-md-4 col-6">
                <h5 class="vela-footer-title">{{ trans('labels.categories') == 'labels.categories' ? 'Categories' : trans('labels.categories') }}</h5>
                <ul class="vela-footer-links">
                    @foreach(helper::getcategory($storeinfo->id)->take(5) as $cat)
                        <li><a href="{{ URL::to(@$storeinfo->slug.'/category/'.$cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 3: Pages -->
            <div class="col-lg-3 col-md-4 col-6">
                <h5 class="vela-footer-title">{{ trans('labels.pages') == 'labels.pages' ? 'Pages' : trans('labels.pages') }}</h5>
                <ul class="vela-footer-links">
                    <li><a href="{{ URL::to($storeinfo->slug . '/privacypolicy') }}">{{ trans('labels.privacy_policy') }}</a></li>
                    <li><a href="{{ URL::to($storeinfo->slug . '/contact') }}">{{ trans('labels.contact_us') }}</a></li>
                    <li><a href="{{ URL::to($storeinfo->slug . '/terms_condition') }}">{{ trans('labels.terms_condition') }}</a></li>
                    <li><a href="{{ URL::to($storeinfo->slug . '/refund_policy') }}">{{ trans('labels.refund_policy') }}</a></li>
                </ul>
            </div>

            <!-- Column 4: Social Media -->
            <div class="col-lg-2 col-md-4 col-12 d-flex flex-column {{ session()->get('direction') == 2 ? 'align-items-start' : 'align-items-end' }}">
                @if (helper::getsociallinks($storeinfo->id)->count() > 0)
                    <div class="vela-social-icons">
                        @foreach (helper::getsociallinks($storeinfo->id) as $links)
                            <a href="{{ $links->link }}" target="_blank" aria-label="social-link">
                                {!! $links->icon !!}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</footer>

<!-- Bottom White Section: Powered By -->
<div class="vela-footer-bottom">
    <div class="container">
        <p>Powered By <a href="{{ env('APP_URL', url('/')) }}" style="color: inherit; text-decoration: none; font-weight: 700;">matjarhub</a></p>
    </div>
</div>

<style>
/* Hide the default copyright section that's included in front.theme.footer */
.copy-right-sec { display: none !important; }
</style>
