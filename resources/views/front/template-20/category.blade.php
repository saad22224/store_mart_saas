@include('front.theme.header')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<div class="vela-category-page" style="background: #fafafa; min-height: 100vh; padding: 60px 0;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 15px;">
        <div class="category-header text-center" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="category-title">{{ $category->name ?? trans('labels.category') }}</h1>
            <p class="category-subtitle">{{ trans('labels.discover_our_latest_collection') }}</p>
        </div>

        <div class="row g-5 mt-4">
            <div class="col-lg-3 col-md-4 col-12" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <aside class="filter-sidebar">
                    <h3 class="filter-title">{{ trans('labels.filters') }}</h3>
                    <div class="filter-group">
                        <h4 class="filter-group-title">{{ trans('labels.categories') }}</h4>
                        <ul class="filter-list">
                            @foreach($getcategory ?? [] as $cat)
                            <li class="filter-item">
                                <a href="{{ URL::to(@$storeinfo->slug.'/category/'.$cat->slug) }}" class="filter-link {{ isset($category) && $category->slug == $cat->slug ? 'active' : '' }}">
                                    <span>{{ $cat->name }}</span>
                                    <i class="fa-solid fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-group">
                        <h4 class="filter-group-title">{{ trans('labels.price') }}</h4>
                        <input type="range" class="form-range custom-range" id="priceRange" min="0" max="5000" value="5000">
                        <div class="d-flex justify-content-between mt-2" style="font-size: 13px; color: #777;">
                            <span>{{ @helper::appdata($storeinfo->id)->currency_symbol ?? '$' }}0</span>
                            <span id="priceValue">{{ @helper::appdata($storeinfo->id)->currency_symbol ?? '$' }}5000</span>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-9 col-md-8 col-12">
                <main>
                    <div class="product-grid-header" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="results-count">{{ trans('labels.showing') }} <span id="showingCount">{{ count($products ?? []) }}</span> {{ trans('labels.results') }}</div>
                        <select class="custom-sort-select" id="sortSelect">
                            <option value="latest">{{ trans('labels.sort_by_latest') }}</option>
                            <option value="low_high">{{ trans('labels.sort_by_price_low') }}</option>
                            <option value="high_low">{{ trans('labels.sort_by_price_high') }}</option>
                        </select>
                    </div>

                    <div class="row g-4" id="productsGrid">
                        @forelse($products ?? [] as $index => $product)
                            <div class="col-lg-4 col-md-6 col-6 product-item-wrapper" data-price="{{ $product->item_price }}" data-date="{{ strtotime($product->created_at) }}" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="{{ 100 + ($index % 3) * 100 }}">
                                @include('front.template-20.partials.product_card', ['product' => $product])
                            </div>
                        @empty
                            <div class="col-12 text-center py-5" data-aos="fade-up">
                                <h3 class="text-muted">{{ trans('labels.no_data') }}</h3>
                            </div>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
<style>
.category-header { margin-bottom: 50px; }
.category-title { font-size: 42px; font-weight: 800; color: #111; margin-bottom: 15px; letter-spacing: -1px; }
.category-subtitle { color: #666; max-width: 600px; margin: 0 auto; font-size: 16px; line-height: 1.6; }
.filter-sidebar { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); }
.filter-title { font-size: 20px; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; color: #111; }
.filter-group { margin-bottom: 30px; }
.filter-group-title { font-size: 15px; font-weight: 700; margin-bottom: 18px; color: #333; text-transform: uppercase; letter-spacing: 0.5px; }
.filter-list { list-style: none; padding: 0; margin: 0; }
.filter-item { margin-bottom: 12px; }
.filter-link { color: #666; text-decoration: none; display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; border-radius: 8px; transition: all 0.3s ease; }
.filter-link:hover, .filter-link.active { background: #f8f9fa; color: #000; font-weight: 600; transform: translateX(5px); }
.product-grid-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: #fff; padding: 15px 25px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); }
.results-count { color: #555; font-size: 14px; font-weight: 500; }
.custom-sort-select { padding: 10px 20px; border-radius: 8px; border: 1px solid #e0e0e0; outline: none; background: #fff; cursor: pointer; font-size: 14px; font-weight: 500; color: #333; transition: border-color 0.3s; }
.custom-sort-select:focus { border-color: #111; }
.custom-range { accent-color: #111; }
</style>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({ once: true, offset: 50, duration: 800, easing: 'ease-in-out' });
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        const sortSelect = document.getElementById('sortSelect');
        const productsGrid = document.getElementById('productsGrid');
        const showingCount = document.getElementById('showingCount');
        let products = Array.from(document.querySelectorAll('.product-item-wrapper'));
        const currencySymbol = '{{ @helper::appdata($storeinfo->id)->currency_symbol ?? "$" }}';
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                priceValue.textContent = currencySymbol + this.value;
                filterAndSortProducts();
            });
        }
        if (sortSelect) { sortSelect.addEventListener('change', filterAndSortProducts); }
        function filterAndSortProducts() {
            if(!productsGrid) return;
            let maxPrice = parseFloat(priceRange ? priceRange.value : 5000);
            let sortOption = sortSelect ? sortSelect.value : 'latest';
            let visibleCount = 0;
            let filteredProducts = products.filter(product => {
                let price = parseFloat(product.getAttribute('data-price'));
                if (price <= maxPrice) { return true; } else { product.style.display = 'none'; return false; }
            });
            filteredProducts.sort((a, b) => {
                let priceA = parseFloat(a.getAttribute('data-price'));
                let priceB = parseFloat(b.getAttribute('data-price'));
                let dateA = parseInt(a.getAttribute('data-date'));
                let dateB = parseInt(b.getAttribute('data-date'));
                if (sortOption === 'low_high') { return priceA - priceB; }
                else if (sortOption === 'high_low') { return priceB - priceA; }
                else { return dateB - dateA; }
            });
            filteredProducts.forEach(product => {
                product.style.display = '';
                productsGrid.appendChild(product);
                visibleCount++;
            });
            if (showingCount) { showingCount.textContent = visibleCount; }
        }
    });
</script>
@include('front.theme.footer')
