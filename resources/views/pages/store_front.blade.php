@php
    $route = route('store_front', $shop->slug);
@endphp
<x-app>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugin CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <style>
            .search-container {
                display: flex;
                align-items: space-between;
                background-color: transparent;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 33.33%;
                padding-left: 15px;
                position: relative;
                margin-left: 10px;
                margin-bottom: 10px;
            }

            .search-container i {
                color: #888;
                position: absolute;
                right: 5px;
                top: 9px;
            }

            .search-container input {
                border: none;
                outline: none;
                background: transparent;
                font-size: 16px;
                width: 100%;
                padding: 10px;
            }

            .sbutton {
                display: flex;
                /* height: 80%; */
                background: transparent;
                border: none;
                margin-right: -20px;
                margin-bottom: -2px;
                cursor: pointer;
                font-size: 20px;

            }
            .main{
                background-color: #EEEEEE;
            }
        </style>
    </x-slot>

    <!-- Start of Pgae Contetn -->
    <div class="container">
        <div class="main">
            <nav class="breadcrumb-nav mb-3 pt-3">
                <div class="container">
                    <ul class="breadcrumb bb-no ">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">E-shop</a></li>
                        <li><a href="#">WC Marketplace</a></li>
                        <li>Store</li>
                    </ul>
                </div>
            </nav>
            <div class="row gutter-lg">
                <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-right"></i></a>
                    <div class="sidebar-content" style="background-color:#EEEEEE">
                        <div class="sticky-sidebar">

                            <!-- End of Widget -->
                            <div class="widget widget-collapsible widget-contact">
                                <h3 class="widget-title"><span>Contact E-shop</span></h3>
                                <div class="widget-body">
                                    <p>Connect directly with the E-shop here</p>
                                    <a href="{{ route('massage.create', ['id' => $shop->id]) }}"
                                        class="btn btn-dark btn-rounded">Send Message</a>
                                </div>
                            </div>
                            <div class="widget widget-collapsible widget-products">
                                <h3 class="widget-title"><span>Best Selling</span></h3>
                                <div class="widget-body">
                                    @foreach ($bestSellingProducts as $product)
                                        <div class="product product-widget pl-2" style="background-color: white">
                                            <figure class="product-media">
                                                <a href="{{ $product->path() }}">
                                                    <img src="{{ Voyager::image($product->image) }}" alt="Product"
                                                        width="100" height="106" />
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name">
                                                    <a href="{{ $product->path() }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <input value="{{ Sohoj::average_rating($product->ratings) }}"
                                                        class="rating published_rating" data-size="sm">
                                                </div>
                                                <a href="{{ $product->path() }}"
                                                    class="product-price">{{ Sohoj::price($product->price) }}</a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- End of Widget -->
                            {{-- @if ($featuredproducts->count() > 0) --}}
                            <div class="widget widget-collapsible widget-products">
                                <h3 class="widget-title"><span>Top Feature</span></h3>
                                <div class="widget-body">
                                    {{-- @dd($featuredproducts) --}}

                                    @foreach ($featuredproducts as $feature)
                                        <div class="product product-widget">
                                            <figure class="product-media">
                                                <a href="product-default.html">
                                                    <img src="{{ Voyager::image($feature->image) }}" alt="Product"
                                                        width="100" height="106" />
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name">
                                                    <a href="product-default.html">{{ $feature->name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <input value="{{ Sohoj::average_rating($feature->ratings) }}"
                                                        class="rating published_rating" data-size="sm">
                                                </div>
                                                <div class="product-price">{{ Sohoj::price($feature->price) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                </aside>

                <div class="main-content">
                    <div class="store store-wcmp-banner">

                        <figure class="store-media">
                            <img src="{{ $shop->banner ? Voyager::image($shop->banner) : asset('assets/images/defult.png') }}"
                                alt="Vendor" width="930" height="390"
                                style="background-color: #ECE7E3;height:390px" />
                        </figure>
                        <div class="store-content">
                            <figure class="seller-brand">
                                <img src="{{ $shop->logo ? Voyager::image($shop->logo) : asset('assets/images/defult.png') }}"
                                    alt="Brand" width="100" height="100" />
                            </figure>
                            <h4 class="store-title">{{ $shop->name }}</h4>
                            <div class="seller-info-list">
                                <div class="store-address">
                                    <i class="w-icon-map-marker"></i>
                                    {{ $shop->state }} {{ $shop->city }} {{ $shop->country }}
                                    {{ $shop->post_code }}
                                </div>
                                <div class="store-phone">
                                    <a href="tel:123456789">
                                        <i class="w-icon-phone"></i>
                                        {{ $shop->phone }}
                                    </a>
                                </div>
                                <div class="store-rating">
                                    <i class="w-icon-star-full"></i>
                                    {{ $shop->ratings->count() }} Rating From 1 Review
                                </div>
                                <div class="store-email">
                                    <span>Email : {{ $shop->email }}</span>
                                    {{-- <a href="email:#">
                                        <i class="w-icon-envelope"></i>
                                        <span class="__cf_email__"
                                            data-cfemail="6f180003020e1d1b190a010b001d5e2f0a020e0603410c0002">[email&#160;protected]</span>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="social-icons social-icons-colored border-thin">
                                <a href="{{ $shop->facebook }}"
                                    class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="{{ $shop->twitter }}" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="{{ $shop->instagram }}"
                                    class="social-icon social-instagram w-icon-instagram"></a>
                            </div>
                        </div>
                    </div>
                    <!-- End of Store WCMP Banner -->

                    <div class="tab tab-nav-underline tab-nav-boxed type2 tab-vendor-products">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#tab-1" class="nav-link active">Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-2" class="nav-link">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content" style="background-color: #EEEEEE">
                            <div class="tab-pane active" id="tab-1">
                                <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                    <div class="toolbox-left" style="width: 100%">
                                        <a href="#"
                                            class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                            btn-icon-left d-block d-lg-none"><i
                                                class="w-icon-category"></i><span>Filters</span></a>
                                        <div class="toolbox-item toolbox-sort select-box text-dark">
                                            <label>Sort By :</label>
                                            <select name="orderby" class="form-control" name="filter_products"
                                                onchange='updateSearchParams("filter_products",this.value,"{{ $route }}")'>
                                                <option value="default" selected="selected">Relevance</option>
                                                <option value="most-popular">Sort by popularity</option>
                                                <option value="trending">Trending</option>
                                                <option value="price-low-high">Sort by pric: low to high</option>
                                                <option value="price-high-low">Sort by price: high to low</option>
                                            </select>
                                        </div>
                                        <form class="search-container" action="" method="get">
                                            <input type="text" name="search" value="{{request()->search}}"
                                                placeholder="Search...">
                                            <button class="sbutton" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </form>
                                        @if (request()->filled('search'))
                                            <a href="{{ url()->current() }}" class="btn btn-primary"
                                                style="padding:15px;margin-top: -10px;margin-left: 7px;"><i
                                                    class="fas fa-undo"></i> </a>
                                        @endif
                                    </div>
                                    {{-- <div class="toolbox-right">
                                        <div class="toolbox-item toolbox-show select-box">
                                            <select name="count" class="form-control">
                                                <option value="9">Show 9</option>
                                                <option value="12" selected="selected">Show 12</option>
                                                <option value="24">Show 24</option>
                                                <option value="36">Show 36</option>
                                            </select>
                                        </div>
                                        <div class="toolbox-item toolbox-layout">
                                            <a href="vendor-wcmp-store-product-grid.html"
                                                class="icon-mode-grid btn-layout active">
                                                <i class="w-icon-grid"></i>
                                            </a>
                                            <a href="vendor-wcmp-store-product-list.html"
                                                class="icon-mode-list btn-layout">
                                                <i class="w-icon-list"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                </nav>
                                <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                                    @foreach ($products as $product)
                                        @if ($product->slug)
                                            <div class="product-wrap">
                                                <div class=" text-center">
                                                    <x-products.card :product="$product" />
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <h4 class="title review-title pt-6 mb-0">{{ $reviews->count() }} review for
                                    {{ $shop->name }}</h4>
                                <ul class="comments list-style-none">
                                    <li class="comment">
                                        {{-- @dd($reviews) --}}
                                        @foreach ($reviews as $review)
                                            <div class="comment-body">
                                                <figure class="comment-avatar">
                                                    <img src="" alt="Avatar" width="100"
                                                        height="100" />
                                                </figure>
                                                <div class="comment-content">
                                                    <div class="ratings-container">
                                                        <input value="{{ $review->rating }}"
                                                            class="rating published_rating" data-size="sm">
                                                    </div>
                                                    <h4 class="comment-author">
                                                        {{ $review->name }}
                                                        <span class="comment-date">-
                                                            {{ $review->created_at->format('M d, Y  ') }}</span>
                                                    </h4>
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</x-app>
