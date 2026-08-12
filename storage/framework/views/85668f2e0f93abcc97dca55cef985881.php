<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<div class="vela-category-page" style="background: #fafafa; min-height: 100vh; padding: 60px 0;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 15px;">
        <!-- Header -->
        <div class="category-header text-center" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="category-title"><?php echo e($category->name ?? trans('labels.category')); ?></h1>
            <p class="category-subtitle"><?php echo e(trans('labels.discover_our_latest_collection')); ?></p>
        </div>

        <div class="row g-5 mt-4">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 col-md-4 col-12" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <aside class="filter-sidebar">
                    <h3 class="filter-title"><?php echo e(trans('labels.filters')); ?></h3>
                    
                    <div class="filter-group">
                        <h4 class="filter-group-title"><?php echo e(trans('labels.categories')); ?></h4>
                        <ul class="filter-list">
                            <?php $__currentLoopData = $getcategory ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="filter-item">
                                <a href="<?php echo e(URL::to(@$storeinfo->slug.'/category/'.$cat->slug)); ?>" class="filter-link <?php echo e(isset($category) && $category->slug == $cat->slug ? 'active' : ''); ?>">
                                    <span><?php echo e($cat->name); ?></span>
                                    <i class="fa-solid fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <!-- Add additional filters if needed like Price Range -->
                    <div class="filter-group">
                        <h4 class="filter-group-title"><?php echo e(trans('labels.price')); ?></h4>
                        <input type="range" class="form-range custom-range" id="priceRange" min="0" max="5000" value="5000">
                        <div class="d-flex justify-content-between mt-2" style="font-size: 13px; color: #777;">
                            <span><?php echo e(@helper::appdata($storeinfo->id)->currency_symbol ?? '$'); ?>0</span>
                            <span id="priceValue"><?php echo e(@helper::appdata($storeinfo->id)->currency_symbol ?? '$'); ?>5000</span>
                        </div>
                    </div>
                </aside>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9 col-md-8 col-12">
                <main>
                    <div class="product-grid-header" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="results-count"><?php echo e(trans('labels.showing')); ?> <span id="showingCount"><?php echo e(count($products ?? [])); ?></span> <?php echo e(trans('labels.results')); ?></div>
                        <select class="custom-sort-select" id="sortSelect">
                            <option value="latest"><?php echo e(trans('labels.sort_by_latest')); ?></option>
                            <option value="low_high"><?php echo e(trans('labels.sort_by_price_low')); ?></option>
                            <option value="high_low"><?php echo e(trans('labels.sort_by_price_high')); ?></option>
                        </select>
                    </div>

                    <div class="row g-4" id="productsGrid">
                        <?php $__empty_1 = true; $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-lg-4 col-md-6 col-6 product-item-wrapper" data-price="<?php echo e($product->item_price); ?>" data-date="<?php echo e(strtotime($product->created_at)); ?>" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="<?php echo e(100 + ($index % 3) * 100); ?>">
                                <?php echo $__env->make('front.template-17.partials.product_card', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12 text-center py-5" data-aos="fade-up">
                                <h3 class="text-muted"><?php echo e(trans('labels.no_data')); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<style>
/* Category Page Styles */
.category-header {
    margin-bottom: 50px;
}
.category-title {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 15px;
    letter-spacing: -1px;
}
.category-subtitle {
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    font-size: 16px;
    line-height: 1.6;
}
.filter-sidebar {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.02);
}
.filter-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
    color: #111;
}
.filter-group {
    margin-bottom: 30px;
}
.filter-group-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.filter-item {
    margin-bottom: 12px;
}
.filter-link {
    color: #666;
    text-decoration: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.filter-link:hover, .filter-link.active {
    background: #f8f9fa;
    color: #000;
    font-weight: 600;
    transform: translateX(5px);
}
.product-grid-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    background: #fff;
    padding: 15px 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.02);
}
.results-count {
    color: #555;
    font-size: 14px;
    font-weight: 500;
}
.custom-sort-select {
    padding: 10px 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    outline: none;
    background: #fff;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    transition: border-color 0.3s;
}
.custom-sort-select:focus {
    border-color: #111;
}
.custom-range {
    accent-color: #111;
}
</style>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-in-out'
        });

        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        const sortSelect = document.getElementById('sortSelect');
        const productsGrid = document.getElementById('productsGrid');
        const showingCount = document.getElementById('showingCount');
        let products = Array.from(document.querySelectorAll('.product-item-wrapper'));
        const currencySymbol = '<?php echo e(@helper::appdata($storeinfo->id)->currency_symbol ?? "$"); ?>';

        if (priceRange) {
            priceRange.addEventListener('input', function() {
                priceValue.textContent = currencySymbol + this.value;
                filterAndSortProducts();
            });
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', filterAndSortProducts);
        }

        function filterAndSortProducts() {
            if(!productsGrid) return;
            
            let maxPrice = parseFloat(priceRange ? priceRange.value : 5000);
            let sortOption = sortSelect ? sortSelect.value : 'latest';
            let visibleCount = 0;
            
            let filteredProducts = products.filter(product => {
                let price = parseFloat(product.getAttribute('data-price'));
                if (price <= maxPrice) {
                    return true;
                } else {
                    product.style.display = 'none';
                    return false;
                }
            });

            filteredProducts.sort((a, b) => {
                let priceA = parseFloat(a.getAttribute('data-price'));
                let priceB = parseFloat(b.getAttribute('data-price'));
                let dateA = parseInt(a.getAttribute('data-date'));
                let dateB = parseInt(b.getAttribute('data-date'));

                if (sortOption === 'low_high') {
                    return priceA - priceB;
                } else if (sortOption === 'high_low') {
                    return priceB - priceA;
                } else {
                    return dateB - dateA;
                }
            });

            filteredProducts.forEach(product => {
                product.style.display = '';
                productsGrid.appendChild(product);
                visibleCount++;
            });
            
            if (showingCount) {
                showingCount.textContent = visibleCount;
            }
        }
    });
</script>
<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\matjarhub\resources\views/front/template-17/category.blade.php ENDPATH**/ ?>