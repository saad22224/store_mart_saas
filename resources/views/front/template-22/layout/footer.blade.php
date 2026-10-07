{{-- Theme 22 footer — newsletter + pages (reference) --}}
<footer class="mp-footer">
    <div class="mp-footer-grid">
        <div class="mp-footer-news">
            <h5>اشترك في نشرتنا الإخبارية</h5>
            <form action="{{ URL::to(@$storeinfo->slug . '/subscribe') }}" method="POST" class="mp-news-form">
                @csrf
                <input type="email" name="subscribe_email" placeholder="Email Address" required>
                <button type="submit" aria-label="اشتراك"><i class="fa-solid fa-arrow-left"></i></button>
            </form>
        </div>
        <div class="mp-footer-pages">
            <h5>الصفحات</h5>
            <ul>
                <li><a href="{{ URL::to(@$storeinfo->slug . '/privacy') }}">سياسات الخصوصية</a></li>
                <li><a href="{{ URL::to(@$storeinfo->slug . '/refund_policy') }}">سياسة الاستبدال و الاسترجاع</a></li>
                <li><a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">سياسة الشحن</a></li>
                <li><a href="{{ URL::to(@$storeinfo->slug . '/terms') }}">شروط الاستخدام</a></li>
            </ul>
        </div>
    </div>
    <div class="mp-footer-bottom">
        {{ helper::appdata(@$storeinfo->id)->copyright ?? ('© ' . date('Y') . ' ' . @$storeinfo->name) }}
    </div>
</footer>
