<div class="product-card2" data-aos="fade-up" data-aos-duration="800">
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
    transition: all 0.3s ease;
    margin-bottom: 20px;
    border: none;
}
.product-image-container2 {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 15px;
    width: 100%;
    aspect-ratio: 3/4;
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
    transform: scale(1.05);
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

.product-details2 {
    padding: 0 5px;
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
