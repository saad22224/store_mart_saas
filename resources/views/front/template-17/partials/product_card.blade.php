<div class="product-card2">
    <div class="product-image-container2">
        @if($product->item_original_price > $product->item_price)
            @php
                $discount = round((($product->item_original_price - $product->item_price) / $product->item_original_price) * 100);
            @endphp
            <div class="discount-badge">
                Discount {{ $discount }}%
            </div>
        @elseif($product->top_deals)
            <div class="discount-badge" style="background: #ff3c3c;">
                {{ trans('labels.top_deals') == 'labels.top_deals' ? 'Hot' : trans('labels.top_deals') }}
            </div>
        @elseif($product->is_new_arrival)
            <div class="discount-badge" style="background: #000;">
                {{ trans('labels.new_arrival') == 'labels.new_arrival' ? 'New' : trans('labels.new_arrival') }}
            </div>
        @endif

        <a href="{{ URL::to(@$storeinfo->slug.'/detail-'.$product->slug) }}" class="product-img-link2">
            <img src="{{ helper::image_path($product->image) }}" alt="{{ $product->item_name }}" class="product-img2">
        </a>

        <!-- Hover Floating Actions -->
        <div class="floating-actions2">
            @if(helper::appdata(@$storeinfo->id)->online_order == 1)
                @if($product->has_variants == 1)
                    <a href="javascript:void(0)" onclick="GetProductOverview('{{ $product->slug }}', '')" class="action-btn2" title="{{ trans('labels.add_to_cart') ?? 'Add to Cart' }}">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 14px;"></i>
                    </a>
                @else
                    <a href="javascript:void(0)" onclick="GetProductOverview('{{ $product->slug }}', '')" class="action-btn2" title="{{ trans('labels.add_to_cart') ?? 'Add to Cart' }}">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 14px;"></i>
                    </a>
                @endif
            @endif
            <a href="javascript:void(0)" onclick="GetProductOverview('{{ $product->slug }}', '')" class="action-btn2" title="{{ trans('labels.quick_view') ?? 'Quick View' }}">
                <i class="fa-regular fa-eye" style="font-size: 14px;"></i>
            </a>
        </div>
    </div>

    <div class="product-details2 text-center">
        <p class="product-category2">{{ @$product->category_info->name ?? trans('labels.category') }}</p>

        <h3 class="product-title2">
            <a href="{{ URL::to(@$storeinfo->slug.'/detail-'.$product->slug) }}">
                {{ $product->item_name }}
            </a>
        </h3>

        <div class="price-box2">
            <span class="current-price2">
                {{ helper::currency_formate($product->item_price, @$storeinfo->id) }}
            </span>

            @if($product->item_original_price > $product->item_price)
                <span class="original-price2">
                    {{ helper::currency_formate($product->item_original_price, @$storeinfo->id) }}
                </span>
            @endif
        </div>

        @if($product->has_variants == 1)
            @php
                $variants = json_decode($product->variants_json, true);
                $sizes = [];
                $colors = [];

                if(!empty($variants)){
                    foreach($variants as $variant){
                        $vname = strtolower($variant['variant_name']);

                        if(strpos($vname, 'size') !== false || strpos($vname, 'حجم') !== false){
                            $sizes = $variant['variant_options'];
                        }

                        if(strpos($vname, 'color') !== false || strpos($vname, 'لون') !== false){
                            $colors = $variant['variant_options'];
                        }
                    }
                }
            @endphp

            <div class="variants-preview2">

                @if(!empty($sizes))
                    <div class="variant-sizes2">
                        @foreach(array_slice($sizes, 0, 4) as $size)
                            <span class="v-size2">{{ $size }}</span>
                        @endforeach
                    </div>
                @endif

                @if(!empty($colors))
                    <div class="variant-colors2 mt-2">
                        @foreach(array_slice($colors, 0, 4) as $color)
                            <span class="v-color2"
                                  style="background-color: {{ $color }};"
                                  title="{{ $color }}">
                            </span>
                        @endforeach
                    </div>
                @endif

            </div>
        @endif

    </div>
</div>
<style>
.product-card2 {
    background: transparent;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 20px;
    border: none;
    border-radius: 12px;
    padding-bottom: 15px;
}
.product-card2:hover {
    background: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    z-index: 10;
    transform: scale(1.03) !important;
}
.product-image-container2 {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 0px;
    width: 100%;
    aspect-ratio: 2/3;
    background-color: #f0f0f0;
}
.product-img-link2 {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    display: block;
}
.product-img2 {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.product-card2:hover .product-img2 {
    /* removed image scale, scaling the card itself now */
}
.discount-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #cc3333;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    z-index: 2;
}

.floating-actions2 {
    position: absolute;
    bottom: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    background: rgba(255, 255, 255, 0.95);
    padding: 10px 8px;
    border-radius: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 3;
}
.product-card2:hover .floating-actions2 {
    opacity: 1;
    transform: translateY(0);
}
.action-btn2 {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    border-radius: 50%;
    transition: all 0.2s ease;
    text-decoration: none;
    background: transparent;
    border: none;
    cursor: pointer;
}
.action-btn2:hover {
    background: #f0f0f0;
    color: #000;
}
.action-btn2 svg {
    width: 18px;
    height: 18px;
}

.product-details2 {
    padding: 15px 10px;
}
.product-category2 {
    color: #6a829e;
    font-size: 14px;
    margin-bottom: 5px;
    font-weight: 500;
}
.product-title2 {
    font-size: 16px;
    color: #444;
    font-weight: 500;
    margin-bottom: 10px;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product-title2 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}
.product-title2 a:hover { color: #000; }

.price-box2 {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}
.current-price2 {
    font-size: 18px;
    font-weight: 700;
    color: #000;
}
.original-price2 {
    font-size: 13px;
    color: #999;
    text-decoration: line-through;
}

.variants-preview2 {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.variant-sizes2 {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}
.v-size2 {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 13px;
    color: #555;
    background: #fff;
    font-weight: 500;
}
.variant-colors2 {
    display: flex;
    justify-content: center;
    gap: 8px;
}
.v-color2 {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #ddd;
    display: inline-block;
}
</style>
