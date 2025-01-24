<div class="swiper-slide product-wrap">
    <div class="product-hover text-center">
        <figure class="product-media">
            <a href="{{ route('product_details', $product->slug) }}">
                <img src="{{ asset('placeholder.jpg') }}" data-src="{{ Voyager::image($product->image) }}" alt="Product"
                    style="height: 280px;width:280px;object-fit:contain;" loading="lazy">
            </a>
            <div class="product-action-vertical">

                <a href="javascript:void(0)" onclick="wishlist({{ $product->id }})"
                    class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                {{-- <a href="JavaScript:void(0)" onclick="quickView({{ $product->id }})" class="btn-product-icon btn-quickview w-icon-search"
                    title="Quickview"></a> --}}
                {{-- <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                    title="Add to Compare"></a> --}}
            </div>
        </figure>
        <div class="product-details">
            <h3 class="product-name "><a href="{{ route('product_details', $product->slug) }}">{{ $product->name }}</a>
            </h3>
            {{-- <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: 80%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="product-default.html" class="rating-reviews">(1 Reviews)</a>
            </div> --}}

            <div class="">
                <input value="{{ Sohoj::average_rating($product->ratings) }}" class="rating published_rating"
                    data-size="sm">
            </div>
            <div class="product-price">
                <a href="{{ route('product_details', $product->slug) }}">
                    <ins class="new-price">{{ Sohoj::price($product->sale_price ?? $product->price) }}</ins>
                    @if ($product->sale_price)
                        <del class="old-price">{{ Sohoj::price($product->price) }}</del>
                    @endif
                </a>

                <form action="{{route('cart.store')}}" method="post">
                    @csrf
                    <input type="hidden" class="form-control qty" value="1" min="1" name="quantity">
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    {{-- <button class="btn  btn-cart w-icon-cart cart-store add-to-cart-btn"
                        style="cursor: pointer" data-product-id="{{ $product->id }}" title="Add to cart"
                        onclick="setTimeout(function() { location.reload(); }, 500);"> Add To Cart
                    </button> --}}
                    <button class="btn btn-primary mt-2 btn-cart cart-store add-to-cart-btn"
                       type="submit"
                        style="border-radius: 10px;overflow:hidden;font-size:1rem"> <i class="fa fa-shopping-cart"></i>
                        Add to cart</button>


                </form>
            </div>
        </div>
    </div>
</div>
