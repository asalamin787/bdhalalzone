<div class="swiper-slide vendor-widget" style="background-color: #fff;border-radius:10px">
    <div class="vendor-widget-banner" style="height: 300px;">
        <figure class="vendor-banner">
            <a href="{{ route('store_front', $shop->slug) }}">
                <img loading="lazy" src="{{asset('placeholder.jpg')}}"  data-src="{{ Voyager::image($shop->banner) }}" alt="Vendor Banner" width="1200" height="210"
                    style="background-color: #ECE7DF;height:20vh;" />
            </a>
        </figure>

        <div class="vendor-details" >
            <figure class="vendor-logo" style="background-color:#fff ">
                <a href="{{ route('store_front', $shop->slug) }}">
                    <img loading="lazy" src="{{asset('placeholder.jpg')}}" data-src="{{ Voyager::image($shop->logo) }}" alt="Vendor Logo" height="90" width="60"  />
                </a>
            </figure>
            <div class="vendor-personal">
                <h3 class="vendor-name" style="font-size: 18px; word-wrap:wrap;">
                    <a href="{{ route('store_front', $shop->slug) }}">{{ $shop->name }}</a>
                </h3>
                <span class="vendor-product-count">{{ $shop->products_count }} Products</span>
            </div>
        </div>
    </div>
    <!-- End of Vendor Widget Banner -->
</div>
