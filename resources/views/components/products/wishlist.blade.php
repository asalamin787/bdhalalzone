{{-- <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-6  pro-gl-content">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="{{ $product->path() }}" class="image">
                    <img class="main-image" src="{{ Storage::url($product->image) }}" alt="Product" />
                    <img class="hover-image" src="{{ Storage::url($product->image) }}" alt="Product" />
                </a>


                <div class="ec-pro-actions">


                    <a href="{{ route('wishlist.remove', $product->id) }}" class="ec-btn-group wishlist"
                        title="Wishlist"><i class="fi-rr-trash text-danger"></i></a>
                </div>
            </div>
        </div>
        <div class="ec-pro-content text-center" style="margin-top: 14px">
            <h5 class="ec-pro-title"><a href="{{ $product->path() }}">{{ $product->name }}</a>
            </h5>
            <div class="ec-pro-list-desc py-2" style="height: 55px">
                <p style="font-size: 12px; color: #787885">
                    {{ Str::limit(strip_tags($product->short_description), $limit = 50, $end = '...') }}
                </p>
            </div>
            <div class="ec-pro-rating reco-ratting d-flex justify-content-center">
                <input value="{{ Sohoj::average_rating($product->ratings) }}" class="rating published_rating"
                    data-size="xs">
            </div>


            <div class="d-flex justify-content-between button-size" style="margin-top: 23px">
                <span class="ec-price">

                    <span class="new-price">{{ Sohoj::price($product->sale_price ?? $product->price) }}</span>

                </span>

                <a href="{{ route('wishlistToCart', $product->id) }}" class="btn btn-sm btn-dark cart-store"
                    type="submit"><i class="fi-rr-shopping-cart"></i>
                    Add
                </a>

            </div>
        </div>
    </div>
</div> --}}
<tr class="text-center">
    <td class="product-thumbnail">
        <div class="p-relative">
            <a href="{{ route('product_details', $product->slug) }}">
                <figure>
                    <img src="{{ Storage::url($product->image) }}" alt="product" width="300" height="118">
                </figure>
            </a>
            <button class="btn btn-close"><a href="{{ route('wishlist.remove', $product->id) }}"title="Wishlist"><i
                        class="fas fa-times"></i></a></button>
            {{-- <a href="{{ route('wishlist.remove', $product->id) }}" class="btn btn-close" title="Wishlist"><i
                    class="fas fa-times"></i></a> --}}
        </div>
    </td>
    <td class="product-name">
        <a href="{{ route('product_details', $product->slug) }}">
            {{ $product->name }}
        </a>
    </td>
    <td class="product-price">
        <ins class="new-price">{{ Sohoj::price($product->sale_price ?? $product->price) }}</ins>
    </td>
    <td class="product-stock-status">

        @if ($product->quantity > 0)
            <span class="wishlist-in-stock">In Stock</span>
        @else
            <span class="wishlist-out-stock">Out of Stock</span>
        @endif
    </td>
    <td class="wishlist-action">
        <div class="d-lg-flex justify-content-center">
            {{-- <a href="JavaScript:void(0)" onclick="quickView({{ $product->id }})"
                class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0"><i
                    class="far fa-eye"></i> Quick
                View </a> --}}

            <form action="{{ route('wishlistToCart', $product) }}" method="GET">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-cart-plus"></i> Move to Cart</button>
            </form>
            {{-- <a href="#" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                cart</a> --}}
        </div>
    </td>
</tr>
