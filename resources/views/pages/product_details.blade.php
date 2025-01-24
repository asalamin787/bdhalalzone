@php
    $images = json_decode($product->images) ?? [];

@endphp
<x-app>
    <x-slot name="css">
        <!-- Vendor CSS -->
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
            .radio-container {
                display: flex;
                flex-direction: column;
                position: relative;
            }

            input[type="radio"] {

                position: absolute;
                opacity: 0;
                left: 24px;

            }

            input[type="radio"]+label {
                font-size: 10px;
                cursor: pointer;
                margin-bottom: 10px;
            }

            input[type="radio"]+label:before {
                content: "";
                display: inline-block;
                width: 10px;
                height: 10px;
                border: 1px solid #4CACF7;
                border-radius: 50%;
                margin-right: 8px;
                vertical-align: middle;
            }

            input[type="radio"]:checked+label:before {
                background-color: #4CACF7;
                /* Change background color when checked */
            }

            .rating-container .rating-stars {
                height: 20px;
            }
        </style>
    </x-slot>



    {{-- <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li>Products</li>
        </ul>
        <ul class="product-nav list-style-none">
            <li class="product-nav-prev">
                <a href="#">
                    <i class="w-icon-angle-left"></i>
                </a>
                <span class="product-nav-popup">
                    <img src="{{ asset('assets/images/products/product-nav-prev.jpg') }}" alt="Product" width="110"
                        height="110" />
                    <span class="product-name">Soft Sound Maker</span>
                </span>
            </li>
            <li class="product-nav-next">
                <a href="#">
                    <i class="w-icon-angle-right"></i>
                </a>
                <span class="product-nav-popup">
                    <img src="{{ asset('assets/images/products/product-nav-next.jpg') }}" alt="Product" width="110"
                        height="110" />
                    <span class="product-name">Fabulous Sound Speaker</span>
                </span>
            </li>
        </ul>
    </nav> --}}
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product-single row" style="margin-top: 30px">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                                <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                    data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ Voyager::image($product->image) }}"
                                                    data-zoom-image="{{ Voyager::image($product->image) }}"
                                                    alt="Electronics Black Wrist Watch" width="800" height="549">
                                            </figure>
                                        </div>
                                        @if ($images)
                                            @foreach ($images as $image)
                                                <div class="swiper-slide">
                                                    <figure class="product-image">
                                                        <img src="{{ Voyager::image($image) }}"
                                                            data-zoom-image="{{ Voyager::image($image) }}"
                                                            alt="Electronics Black Wrist Watch" width="488"
                                                            height="549">
                                                    </figure>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                    <a href="#" class="product-gallery-btn product-image-full"><i
                                            class="w-icon-zoom"></i></a>
                                </div>
                                <div class="product-thumbs-wrap swiper-container"
                                    data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                        <div class="product-thumb swiper-slide" style="height: 110px">
                                            <img src="{{ Voyager::image($product->image) }}" alt="Product Thumb"
                                                style="height: 100%">
                                        </div>

                                        @if ($images)
                                            @foreach ($images as $image)
                                                <div class="product-thumb swiper-slide" style="height: 110px">
                                                    <img src="{{ Voyager::image($image) }}" alt="Product Thumb"
                                                        style="height: 100%">
                                                </div>
                                            @endforeach
                                        @endif



                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                <div class="product-bm-wrapper">
                                    <figure class="brand">
                                        <img src="{{ $product->shop->logo ? Voyager::image($product->shop->logo) : asset('assets/images/defult.png') }}"
                                            alt="Brand" width="102" height="48" style="object-fit: contain" />
                                    </figure>
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category">
                                                @if ($product->prodcats->count() > 0)
                                                    @foreach ($product->prodcats as $category)
                                                        <a href="#">{{ $category->name }} ,</a>
                                                    @endforeach

                                                @endif
                                            </span>
                                        </div>
                                        <div class="product-sku">
                                            SKU: <span>{{ $product->sku }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="product-divider">

                                <div class="product-price"><ins class="new-price"
                                        id="amount">{{ Sohoj::price($product->sale_price ?? $product->price) }}</ins>
                                    @if ($product->sale_price)
                                        <del class="old-price">{{ Sohoj::price($product->price) }}</del>
                                    @endif
                                </div>

                                <div class="ratings-container">
                                    <input value="{{ Sohoj::average_rating($product->ratings) }}"
                                        class="rating published_rating" data-size="sm">
                                    <a href="#product-tab-reviews"
                                        class="rating-reviews scroll-to">{{ $product->ratings->count() }}</a>
                                </div>

                                <div class="product-short-desc">
                                    {!! $product->short_description !!}
                                </div>

                                <hr class="product-divider">
                                <form class="" action="{{ route('cart.boynow') }}" method="POST">
                                    @csrf
                                    @if ($product->is_variable_product && count($product->subproductsuser) > 0)
                                        @foreach ($product->attributes as $attribute)
                                            <div
                                                class=" mt-2 pt-2 w-100 mb-2  product-variation-form product-size-swatc">
                                                <div class="form-group col-md-12 pl-0 ">
                                                    <h5 class="ms-3">{{ str_replace('_', ' ', $attribute->name) }}
                                                        </h4>
                                                        <div class="" role="group">
                                                            @foreach ($attribute->value as $value)
                                                                <input type="radio"
                                                                    class="btn-check {{ str_replace(' ', '_', $attribute->name) }}"
                                                                    name="variable_attribute[{{ $attribute->name }}]"
                                                                    id="{{ str_replace(' ', '_', $value) }}"
                                                                    value="{{ $value }}" required
                                                                    onclick="change_variable()"
                                                                    {{ $loop->first ? 'checked' : '' }}>
                                                                <label class="btn btn-info p-2"
                                                                    style="padding: 5px 12px;"
                                                                    for="{{ str_replace(' ', '_', $value) }}">{{ str_replace('_', ' ', $value) }}</label>
                                                            @endforeach
                                                        </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif




                                    <p id="notice">

                                    </p>
                                    <div class="fix-bottom sticky-content">
                                        <div class="product-form container p-0">

                                            <div class="product-qty-form">


                                                <input type="hidden" class="form-control qty" value="1"
                                                    min="1" name="quantity">
                                                <input type="hidden" name="product_id"
                                                    value="{{ $product->id }}" />

                                                <button type="submit" class="btn btn-primary" id="cart_button">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="social-links-wrapper">
                                    <div class="social-links">
                                        {{-- <div class="social-icons social-no-color border-thin">
                                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="#"
                                                class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="#"
                                                class="social-icon social-youtube fab fa-linkedin-in"></a>
                                        </div> --}}
                                    </div>
                                    <span class="divider d-xs-show"></span>
                                    <div class="product-link-wrapper d-flex">
                                        <a href="javascript:void(0)" onclick="wishlist({{ $product->id }})"
                                            class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#product-tab-description" class="nav-link active">Description</a>
                        </li>

                        <li class="nav-item">
                            <a href="#product-tab-vendor" class="nav-link">E-shop Info</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-tab-reviews" class="nav-link">Customer Reviews
                                {{ $product->ratings->count() > 0 ? $product->ratings->count() : '' }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-tab-description">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-5">
                                    {!! $product->description !!}
                                </div>

                            </div>

                        </div>

                        <div class="tab-pane" id="product-tab-vendor">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-4">
                                    <figure class="vendor-banner br-sm">
                                        <img src="{{ $product->shop->banner ? Voyager::image($product->shop->banner) : asset('assets/images/defult.png') }}"
                                            alt="Vendor Banner" width="610" height="295"
                                            style="background-color: #353B55;" />
                                    </figure>
                                </div>
                                <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                    <div class="vendor-user">
                                        <figure class="vendor-logo mr-4">
                                            <a href="#">
                                                <img src="{{ $product->shop->logo ? Voyager::image($product->shop->logo) : asset('assets/images/defult.png') }}"
                                                    alt="Vendor Logo" width="80" height="80" />
                                            </a>
                                        </figure>
                                        <div>
                                            <div class="vendor-name"><a
                                                    href="#">{{ $product->shop->user->name }}</a></div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 90%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="#" class="rating-reviews">(32 Reviews)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="vendor-info list-style-none">
                                        <li class="store-name">
                                            <label>Store Name:</label>
                                            <span class="detail">{{ $product->shop->name }}</span>
                                        </li>
                                        <li class="store-address">
                                            <label>Address:</label>
                                            <span class="detail">{{ $product->shop->post_code }},
                                                {{ $product->shop->city }}</span>
                                        </li>
                                        <li class="store-phone">
                                            <label>Phone:</label>
                                            <a href="#tel:">{{ $product->shop->phone }}</a>
                                        </li>
                                        <li class="store-phone">
                                            <label>Email:</label>
                                            <a href="#tel:">{{ $product->shop->email }}</a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('store_front', $product->shop->slug) }}"
                                        class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                        Store<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                            {!! $product->shop->description !!}
                        </div>
                        <div class="tab-pane" id="product-tab-reviews">
                            <div class="row mb-4">
                                <div class="col-xl-4 col-lg-5 mb-4">
                                    <div class="ratings-wrapper">
                                        <div class="avg-rating-container">
                                            <h4 class="avg-mark font-weight-bolder ls-50">
                                                {{ Sohoj::average_rating($product->ratings) }}.1</h4>
                                            <div class="avg-rating">
                                                <p class="text-dark mb-1">Average Rating</p>
                                                <div class="ratings-container">
                                                    <input value="{{ Sohoj::average_rating($product->ratings) }}"
                                                        class="rating published_rating" data-size="sm">
                                                    <a href="#"
                                                        class="rating-reviews">({{ $product->ratings->count() }}
                                                        Reviews)</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @php
                                    $user = Auth()->id();
                                    $rating = App\Models\Rating::where('user_id', $user)
                                        ->where('product_id', $product->id)
                                        ->get();

                                @endphp
                                @if (Auth::check())
                                    @if ($rating->count() == 0)
                                        <div class="col-xl-8 col-lg-7 mb-4">
                                            <div class="review-form-wrapper">
                                                <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                    Review</h3>
                                                <p class="mb-3">Your email address will not be published. Required
                                                    fields are marked *</p>
                                                <form action="{{ route('rating', ['product_id' => $product->id]) }}"
                                                    method="POST" class="review-form">
                                                    @csrf
                                                    <div class="rating-form">
                                                        <label for="rating">Your Rating Of This Product :</label>
                                                        <input value="1" name="rating"
                                                            class="rating product_rating" data-size="xs">

                                                        {{-- <select name="rating" id="rating" required=""
                                                    style="display: none;">
                                                    <option value="">Rate…</option>
                                                    <option value="5">Perfect</option>
                                                    <option value="4">Good</option>
                                                    <option value="3">Average</option>
                                                    <option value="2">Not that bad</option>
                                                    <option value="1">Very poor</option>
                                                </select> --}}
                                                    </div>
                                                    <textarea name="review" cols="30" rows="6"
                                                        placeholder="Write Your Review Here..." class="form-control"
                                                        id="review"></textarea required>
                                            <div class="row gutter-md">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Your Name" id="name" name="name">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                        placeholder="Your Email" id="email" name="email">
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <input type="checkbox" class="custom-checkbox" id="save-checkbox">
                                                <label for="save-checkbox">Save my name, email, and website
                                                    in this browser for the next time I comment.</label>
                                            </div> --}}
                                            <button type="submit" class="btn btn-dark">Submit
                                                Review</button>
                                        </form>
                                    </div>
                                </div>
@endif
                                @endif
                            </div>

                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                {{-- <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#show-all" class="nav-link active">Show All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#helpful-positive" class="nav-link">Most Helpful
                                            Positive</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#helpful-negative" class="nav-link">Most Helpful
                                            Negative</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                    </li>
                                </ul> --}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="show-all">
                                        <ul class="comments list-style-none">
                                            @foreach ($product->ratings as $rating)
<li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                            alt="Commenter Avatar" width="90" height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">{{ $rating->name }}</a>
                                                            <span class="comment-date">{{ $rating->created_at->format('d M, y') }}</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <input value="{{ $rating->rating }}" class="rating published_rating" data-size="sm">
                                                        </div>
                                                        <p>{{ $rating->review }}</p>
                                                        {{-- <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (1)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (0)
                                                            </a>
                                                            <div class="review-image">
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="{{ asset('assets/images/products/default/review-img-1.jpg') }}"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="{{ asset('assets/images/products/default/review-img-1-800x900.jpg') }}" />
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </li>
@endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="vendor-product-section">
                    <div class="title-link-wrapper title-deals appear-animate mb-4">
                        <h2 class="title title-link">Related Products</h2>
                        <div class="product-countdown-container font-size-sm text-white  align-items-center mr-auto">
                            {{-- <label>Offer Ends in: </label>
                            <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+10d"
                                data-relative="true" data-compact="true">10days,00:00:00</div> --}}
                        </div>
                        <a href="" class="ml-0">More Products<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="swiper-container swiper-theme appear-animate mb-6"
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
                            @foreach ($related_products as $data)
<x-products.card :product="$data" />
@endforeach

                            <!-- End of Product Wrap -->
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@push('script')
    <script>
        var products = {!! $product->subproductsuser->toJson() !!};


        function change_variable() {

            variations = {
                @foreach ($product->attributes as $attribute)
                    @foreach ($attribute->value as $value)

                        '{{ $attribute->name }}': $(
                            'input[name="variable_attribute[{{ $attribute->name }}]"]:checked').val(),
                    @endforeach
                @endforeach
            }
            console.log(variations);
            var product = products.filter(function(product) {
                return Object.keys(variations).every(function(variation) {

                    return product.variations[variation] === variations[variation];
                });
            });

            //$('.preview-slider').slick('slickGoTo', 1);
            // console.log(product[0].image);

            if (product.length > 0) {
                if (product[0].quantity == 0) {
                    $('#cart_button').prop("disabled", true);
                    $('#notice').text('This variation is not available please try different variation');
                } else {
                    $('#cart_button').prop("disabled", false);
                    $('#notice').text('');
                }
                if (product[0].image) {
                    var element = $(`.preview-slider img[data-image='${product[0].image}']`);
                    //console.log(element.attr('data-slick-index'));
                    // $('.preview-slider').slick('slickGoTo', element.attr('data-slick-index'))
                }
                let text = '';
                if (product[0].saleprice) {
                    text = "<del class='mr-2'>" + product[0].price + "Tk </del><span id='sale'>" + product[0]
                        .saleprice + "Tk </span>";
                } else {
                    text = product[0].price + " Tk";
                }
                console.log(text)
                $("#amount").html(text);
                if (product[0].image) {
                    $("#showcase").attr("src", "/storage/" + product[0].image);
                }
            } else {
                // $("#amount").text("No variation found. Please select other variation");
            }
        };

        change_variable();
    </script>
@endpush
</x-app>
