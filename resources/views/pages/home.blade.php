@php
    $route = route('shops');

@endphp
<x-app>
    <x-slot name="css">
        <!-- Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}?v={{uniqid()}}">
        <style>
            .intro-slide{
                min-height: auto;
            }
            main{
                background-color: #EEEEEE;
            }
        </style>
    </x-slot>


    <div class="container">
        <!-- Slider section -->
        <x-pages.home.slider :sliders="$sliders" />
        <!-- End of slider section -->
        <x-pages.home.categories param="parent" :categories="$prodcats" :route="$route" />
        <!-- Features section -->
        {{-- <x-pages.home.features /> --}}
        <!-- End of features section -->

        @if (false)
            <!-- Daily deals section -->
            <x-pages.home.dailydeals offerEndAt="+10d" />
            <!-- End of daily deals section -->
        @endif


        <x-pages.home.productrow title="Trending Product" :products="$latest_products" url="" />
        <!-- End of Prodcut Deals Wrapper -->


      
    </div>
    <!-- End of Container -->


    <!-- End of Grey Section -->

    <div class="container mt-10 pt-2">
      
        <!-- End of Banner Simple -->

        {{-- <div class="title-link-wrapper appear-animate mb-4">
            <h2 class="title title-link pt-1">Featured Products</h2>
            <a href="{{ route('shops') }}">More Products<i class="w-icon-long-arrow-right"></i></a>
        </div>
        <div class="swiper-container swiper-theme products-apparel appear-animate mb-7"
            data-swiper-options="{
            'spaceBetween': 20,
            'slidesPerView': 2,
            'breakpoints': {
                '576': {
                    'slidesPerView': 3
                },
                '768': {
                    'slidesPerView': 4
                },
                '992': {
                    'slidesPerView': 5
                }
            }
        }">
            <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                @foreach ($featuredproducts as $product)
                    <x-products.card :product="$product" />
                @endforeach

                <!-- End of Product Wrap -->
            </div>
            <div class="swiper-pagination"></div>
        </div> --}}

        @foreach ($bestSellingCategories as $category)
            <div class="category-product">
                <div class="title-link-wrapper appear-animate mt-10 mb-4">
                    <h2 class="title title-link pt-1">{{ $category->name }}</h2>
                    <a href="javascript:void(0)"
                        onclick='updateSearchParams("category","{{ $category->slug }}","{{ $route }}")'
                        class="ls-normal">More Products<i class="w-icon-long-arrow-right"></i></a>
                </div>

                <div class=" row cols-lg-5 cols-md-4 cols-sm-3 cols-2">

                    @foreach ($category->products as $product)
                        <x-products.card :product="$product" />
                    @endforeach
                    <!-- End of Product Wrap -->
                </div>
            </div>
        @endforeach
        <!-- End of Products -->

        {{-- <h2 class="title text-left title-client  mb-5 appear-animate">Our Clients</h2>
        <div class="swiper-container swiper-theme  brands-wrapper br-sm mb-10 appear-animate"
            data-swiper-options="{
            'autoplay': false,
            'autoplayTimeout': 4000,
            'loop': true,
            'spaceBetween': 20,
            'slidesPerView': 2,
            'breakpoints': {
                '576': {
                    'slidesPerView': 3
                },
                '768': {
                    'slidesPerView': 4
                },
                '992': {
                    'slidesPerView': 6
                },
                '1200': {
                    'slidesPerView': 8
                }
            }
        }">
            <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
                @foreach ($clients as $client)
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ Voyager::image($client) }}" alt="Brand" width="310" height="180" />
                        </figure>
                    </div>
                @endforeach

            </div>
        </div> --}}
        <!-- End of Brands Wrapper -->

    </div>
</x-app>
