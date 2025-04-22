@php
    $categories = App\Services\DependencyVariables::categories();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Quality Products at Unbeatable Prices</title>

    <meta name="keywords"
        content="MYEASYMART, online shopping, buy products online, affordable prices, electronics, fashion, home essentials, Bangladesh eCommerce, quality products, fast shippin" />
    <meta name="description"
        content="Discover a wide range of quality products on MYEASYMART. From electronics and fashion to home essentials, we offer competitive prices, fast delivery, and secure shopping for customers worldwide.">


    <meta property="og:title" content="Quality Products at Unbeatable Prices" />
    <meta property="og:description"
        content="Discover a wide range of quality products on MYEASYMART. From electronics and fashion to home essentials, we offer competitive prices, fast delivery, and secure shopping for customers worldwide." />
    {{-- <meta property="og:url" content="https://myeasymart.com" /> --}}
    <meta property="og:type" content="website" />
    {{-- <meta property="og:image" content="{{ asset('assets/social.png') }}" /> --}}
    {{-- <meta property="og:site_name" content="MYEASYMART" /> --}}
    <meta property="og:locale" content="en_US" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Quality Products at Unbeatable Prices" />
    <meta name="twitter:description"
        content="Discover a wide range of quality products on MYEASYMART. From electronics and fashion to home essentials, we offer competitive prices, fast delivery, and secure shopping for customers worldwide." />
    {{-- <meta name="twitter:image" content="{{ asset('assets/social.png') }}" /> --}}
    {{-- <meta name="twitter:site" content="@MYEASYMART" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <!-- Favicon -->
    {{-- <link rel="icon" type="image/png" href="{{ asset('assets/images/icons/favicon.png') }}"> --}}

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Poppins:400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <script>
        const base_url = "{{ url('/') }}"
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="assets/fonts/wolmart87d5.woff?png09e" as="font" type="font/woff"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
    <style>
        .nav-next,
        .nav-prev {
            position: absolute;
            top: 100px;
            width: calc(var(--swiper-navigation-size)/ 44 * 27);
            height: var(--swiper-navigation-size);
            margin-top: calc(0px - (var(--swiper-navigation-size)/ 2));
            z-index: 10;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--swiper-navigation-color, var(--swiper-theme-color));
        }

        .nav-next {
            color: #bb1218 !important;
            right: 0px;
            left: auto;

        }

        .nav-prev {
            color: #bb1218 !important;
            left: 0px;
            right: auto;

        }

        #division-select {
            border: none;
            font-size: 16px;
            color: #000;
            font-weight: 600;
            padding-left: 40px !important;
        }

        #division-select2 {
            border: none;
            font-size: 16px;
            color: #000;
            font-weight: 600;
            padding-left: 40px !important;
        }

        /* Dropdown button */
        .dropdown .wishlist.label-down.link.d-xs-show {
            border: none;
            background-color: white;
        }

        .dropdown .wishlist.label-down.link.d-xs-show i.w-icon-user {
            font-weight: 600;
        }

        /* Dropdown menu */
        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 100px;
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu .dropdown-item {
            font-size: small;
        }

        .dropdown-menu .dropdown-item.wishlist-label.d-lg-show {
            display: block;
        }

        .dropdown-menu .dropdown-item.wishlist-label.d-lg-show:last-child {
            margin-bottom: 0;
        }

        .dropdown-menu .dropdown-item.wishlist-label.d-lg-show:hover {
            background-color: #f8f9fa;
        }

        .logout-button {
            border-radius: 0;
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
            overflow: visible;
            text-transform: none;
            -webkit-appearance: button;
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            text-decoration: none;
            background-color: transparent;
            border: 0;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #f8f9fa;
            color: #007cc;
        }

        .slider-image {
            /* object-fit: cover !important; */
            /* aspect-ratio: 6/2 !important; */
        }

        /* .slider-image img {
            aspect-ratio: 16/5 !important;
            object-fit: fill;
        } */

        .product {
            margin: 5px;
            border-radius: 10px;
            overflow: hidden;
            padding: 0px 10px;
            padding-bottom: 10px;
            transition: .9s cubic-bezier(0.075, 0.82, 0.165, 1) !important;
        }

        .product:hover {

            box-shadow: 2px 2px 10px #00000079;
        }

        .product-name {
            font-size: 17px !important;
            font-weight: 700;
        }

        .swiper-slide img {
            /* object-fit: cover !important; */
            /* aspect-ratio: 6/2 !important; */
        }

        @media only screen and (max-width: 600px) {
            .product-name {
                font-size: 15px !important;
                font-weight: 700;
            }

            .swiper-slide img {
                /* object-fit: fill !important; */
                /* aspect-ratio: 4/2 !important; */
            }

        }

        body.menu-open {
            overflow: hidden;
            height: 100%;
        }

        /* # The Rotating Marker # */
        details summary::-webkit-details-marker {
            display: none;
        }

        summary::before {
            font-family: "Hiragino Mincho ProN", "Open Sans", sans-serif;
            content: "";
            position: absolute;
            top: 1rem;
            right: 0;
            transform: rotate(0);
            transform-origin: center;
            transition: 0.2s transform ease;
            color: #000000;
        }

        details[open]>summary:before {
            transform: rotate(90deg);
            transition: 0.45s transform ease;
        }

        /* # The Sliding Summary # */
        details {
            overflow: hidden;
        }

        details summary {
            position: relative;
            z-index: 10;
            /* padding-left: 22px; */
        }

        @keyframes details-show {
            from {
                /* margin-bottom: -80%; */
                opacity: 0;
                transform: translateY(-100%);
            }

        }

        .vertical-menu {
            height: 50vh;
            overflow-y: auto;
        }

        details>*:not(summary) {
            animation: details-show 500ms ease-in-out;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease-in-out;
            color: transparent;
            overflow: hidden;
        }

        details[open]>*:not(summary) {
            color: inherit;
        }

        /* # Style 2 # */
        details.style2 summary::before {
            content: "×";
            color: #888;
            font-size: 2rem;
            line-height: 1rem;
            transform: rotate(-45deg);
            right: 0;
            top: 17px;
        }

        details[open].style2>summary::before {
            transform: rotate(90deg);
            color: #888 !important;
            transition: color ease 2s, transform ease 1s;
        }



        body {
            font-family: "Open Sans", sans-serif;

        }

        img {
            max-width: 100%;
        }

        p {
            margin: 0;
            padding-bottom: 10px;
        }

        p:last-child {
            padding: 0;
        }

        details {
            max-width: 500px;
            box-sizing: border-box;
            margin-top: 5px;
            background: white;
        }

        summary {
            /* border: 4px solid transparent; */
            outline: none;
            padding: 1rem;
            display: block;
            /* background: #666; */
            color: #888;
            /* padding-left: 2.2rem; */
            position: relative;
            cursor: pointer;
            margin: 0 10px;
        }

        details[open] summary,
        summary:hover {
            color: #888;
            /* background: #e4e4e4;
            border-radius: 10px; */


        }

        .content:hover {
            background: #e4e4e4;
            border-radius: 10px;


        }

        .active-cat {
            background: #e4e4e4;
            border-radius: 10px;

        }

        summary:hover strong,
        details[open] summary strong,
        summary:hover::before,
        details[open] summary::before {
            color: #888;
        }

        .content {
            padding: 5px 10px;
            margin-bottom: 5px;

        }

        .content-position {
            position: absolute;
            right: 20px;

        }

        /* ul .content-x{
            position: absolute;
            right: -50px;
            top: auto;
        } */
    </style>
    {{ $css ?? null }}
    @stack('css')
</head>

<body>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header">

            <!-- End of Header Top -->

            <x-app.header-top :categories="$categories" />
            <!-- End of Header Middle -->

            <x-app.header-middle :categories="$categories" />
        </header>
        <!-- End of Header -->

        <!-- Start of Main-->
        <main class="main">
            {{ $slot }}
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
        <footer class="footer appear-animate">
            <div class="container">
                <div class="footer-newsletter">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <a href="#" class="logo-footer">
                                <img src="{{ Voyager::image(setting('site.logo')) }}" alt="logo-footer" width="145"
                                    height="45" />
                            </a>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="swiper-slide icon-box icon-box-side text-dark">
                                <div class="icon-box-icon d-inline-flex">
                                    <i class="w-icon-envelop3"></i>
                                </div>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-uppercase font-weight-bold">Subscribe To Our
                                        Newsletter</h4>
                                    <p>Get all the latest information on Events, Sales and Offers.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-9 mt-4 mt-lg-0 ">
                            <form action="{{ route('subscribe') }}" method="POST"
                                class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                                @csrf
                                <input type="email" class="form-control mr-2 bg-white text-default" name="email"
                                    id="email" placeholder="Your E-mail Address" />
                                <button class="btn btn-primary btn-rounded" type="submit">Subscribe<i
                                        class="w-icon-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="widget widget-about">
                                <div class="widget-body">
                                    <p class="widget-about-title">Got Question? Call us 24/7</p>
                                    <a href="#" class="widget-about-call">{{ setting('site.phone') }}</a>
                                    <p class="widget-about-desc">{{ setting('site.description') }}
                                    </p>
                                    <label class="label-social d-block text-dark">Social Media</label>
                                    <div class="social-icons social-icons-colored">
                                        <a href="{{ setting('social.fb_link') }}"
                                            class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="{{ setting('social.youtube_link') }}"
                                            class="social-icon social-youtube w-icon-youtube"></a>
                                        {{-- <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="widget-body">
                                    {!! menu('leftside', 'bootstrap') !!}
                                </ul>
                            </div>
                        </div>


                        <div class="col-lg-2 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>
                                <ul class="widget-body">
                                    {!! menu('middle', 'bootstrap') !!}
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">Company</h3>
                                <ul class="widget-body">
                                    {!! menu('main', 'bootstrap') !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-left">
                        <p class="copyright">Copyright © 2024 MYEASYMART Store. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">We're using safe payment for</span>
                        <figure class="payment">
                            <img src="assets/images/payment.png" alt="payment" width="159" height="25" />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Start of Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="{{ route('homepage') }}" class="sticky-link active">
            <i class="w-icon-home"></i>
            <p>Home</p>
        </a>
        <a href="{{ route('shops') }}" class="sticky-link">
            <i class="w-icon-category"></i>
            <p>E-Shops</p>
        </a>
        <a href="{{ auth()->check() ? route('user.dashboard') : route('login') }}" class="sticky-link">
            <i class="w-icon-account"></i>
            <p>Account</p>
        </a>
        {{-- <div class="cart-dropdown dir-up"> --}}
        <a href="{{ route('cart') }}" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>

    </div>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i
            class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10"
                cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">


            <div class="tab-content">
                <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li>
                            <a href="{{ route('shops') }}">Products</a>

                        </li>
                        <li>
                            <a href="{{ route('vendors') }}">E-shops</a>

                        </li>

                        <li>
                            <a href="#">
                                User

                            </a>
                            <ul>
                                @if (!auth()->check())
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li> <a class="" href="{{ route('register') }}"
                                            style="font-size: small">Register as Customer</a></li>
                                    <li> <a class="" href="{{ route('vendor.create') }}"
                                            style="font-size: small">Register as E-Shop </a> </li>
                                    <li> <a class="" href="{{ route('marchentiger.create') }}"
                                            style="font-size: small">Register as MYEASYMART Affiliate </a> </li>
                                @elseif(auth()->user()->role_id == 3)
                                    <li><a href="{{ route('vendor.dashboard') }}">My Account</a></li>

                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="logout-button ml-4 "
                                                style="font-size: small">
                                                Logout</button>

                                        </form>
                                    </li>
                                @elseif(auth()->user()->role_id == 1)
                                    <li><a href="{{ url('/admin') }}">My Account</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class=" ml-4 " style="font-size: small">
                                                Logout</button>

                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class=" ml-4 " style="font-size: small">
                                                Logout</button>

                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="divisionForm" action="{{ route('select.division') }}" method="get">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose your city</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                            
                                <select class="form-control form-control-sm" id="division-select-app"
                                    onchange="updateDistricts()">
                                    <option value="">Select Division</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                          
                                <select class="form-control form-control-sm" id="district-select-app">
                                    <option value="">Select a District</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- End of Quick view -->

    <!-- Plugin JS File -->

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
    {{-- <script src="{{asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script> --}}
    <script src="{{ asset('assets/vendor/floating-parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/zoom/jquery.zoom.js') }}"></script>
    <script src="{{ asset('assets/vendor/skrollr/skrollr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/star-rating.js') }}"></script>
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    @if (!session()->has('division'))
        <script>
            $(document).ready(function() {
                $('#cityModal').modal('show');
            });

            $('#divisionForm').on('submit', function(e) {
                e.preventDefault();

                var selectedDivision = $('#division-select-app').val();
                $.ajax({
                    type: 'get',
                    url: $(this).attr('action'),
                    data: {
                        division: selectedDivision
                    },
                    success: function(response) {
                        $('#cityModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('An error occurred:', error);
                    }
                });
            });
        </script>
    @endif
    @yield('script')
    <script>
        function cartQnty() {
            $.ajax({
                type: 'get',
                url: '/cart-qty',
                success: function(response) {
                    console.log(response);

                    $('#cartQty').text(response);
                    $('#cartQty2').text(response);
                    if (response == 0) {
                        $('#cartQty').hide();
                    } else {
                        $('#cartQty').show();
                    }
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        }

        cartQnty();
        console.log(cartQnty())
        $(document).ready(function() {
            $('.cart-store').click(function() {
                var addToCartBtn = $(this);
                var productId = $(this).data('product-id');
                var quantity = $('.addToCartForm_' + productId).find('.qty').val();
                var oldQty = "{{ Cart::getTotalQuantity() }}";
                var parentDiv = $(this).closest('.ec-product-inner');

                $.ajax({
                    type: 'POST',
                    url: '/add-cart',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        cartQnty();
                        addToCartBtn.attr('disabled', true);
                        addToCartBtn.css('background-color', '#2A9CF5 !important').attr(
                            'disabled', true);
                        addToCartBtn.attr('title', 'added');


                    },
                    error: function(xhr) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function quickView(id) {

            $.ajax({
                url: '/quickview',
                method: 'GET',
                data: {
                    division: selectedDivision,
                }
                success: function(response) {
                    // $('#ec_quickview_modal').modal('show')
                    $('#quick_view').html(response)
                },

            });
        }
    </script>

    <script>
        function wishlist(id) {

            $.ajax({
                url: '/wishlist/add',
                method: 'GET',
                data: {
                    productId: id
                },
                success: function() {
                    var element = $('.add-wish-new_' + id);
                    if (element.hasClass('fa-solid')) {
                        element.addClass('fa-regular').removeClass('fa-solid text-success');
                    } else {
                        element.addClass('fa-solid text-success').removeClass('fa-regular ');
                    }


                }

            });
        }
    </script>
    <script>
        var shopUrl = "{{ route('shops') }}";

        $(document).ready(function() {
            $('#ratingForm input[type="checkbox"]').on('change', function() {
                if ($(this).is(':checked')) {
                    updateSearchParams("ratings", $(this).val(), shopUrl);
                } else {

                    removeSearchParam("ratings", shopUrl);
                }
            });



        });

        const filterAttributes = (el) => {

            if ($(el).is(':checked')) {
                updateSearchParams($(el).attr('name'), $(el).val(), shopUrl);
            } else {
                removeSearchParam($(el).attr('name'), shopUrl);
            }
        }

        function updateSearchParams(searchParam, searchValue, route, priceMin, priceMax, target = "_self") {
            var url;

            if (window.location.pathname !== "/shops" || (new URL(route)).pathname == '/vendors') {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            url.searchParams.set(searchParam, searchValue);

            // Set the price range parameters if provided
            if (priceMin !== undefined && priceMin !== null) {
                url.searchParams.set('priceMin', priceMin);
            }

            if (priceMax !== undefined && priceMax !== null) {
                url.searchParams.set('priceMax', priceMax);
            }

            var existingParams = new URLSearchParams(window.location.search);
            existingParams.delete(searchParam);

            // Remove existing price range parameters
            existingParams.delete('priceMin');
            existingParams.delete('priceMax');

            existingParams.forEach(function(value, key) {
                url.searchParams.set(key, value);
            });

            const newUrl = url.href;
            window.open(newUrl, target); // Open the new URL in a new tab
        }


        function removeSearchParam(searchParam, route) {
            var url;

            if (window.location.pathname !== "/shops" || (new URL(route)).pathname == '/vendors') {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            var existingParams = new URLSearchParams(window.location.search);
            existingParams.delete(searchParam);

            var newUrl = url.href.split('?')[0] + '?' + existingParams.toString();
            window.location = newUrl;
        }
    </script>

    <script>
        $("#product_rating").rating({
            showCaption: true
        });
        $(".published_rating").rating({
            showCaption: false,
            readonly: true,
        });
    </script>

    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <script>
        toastr.options = {
            "newestOnTop": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": true,
            "showDuration": "150",
            "hideDuration": "200",
            "timeOut": "4500",
            "extendedTimeOut": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.onload = function() {
                            lazyImage.removeAttribute("data-src");
                            lazyImage.removeAttribute("loading");
                        };
                        observer.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(function(lazyImage) {
                imageObserver.observe(lazyImage);
            });
        });
    </script>
    {{-- <x-alert/> --}}
    @stack('script')
    @if (session()->has('success_msg'))
        <x-alert.success />
    @endif
    @if (session()->has('error'))
        <x-alert.error />
    @endif

    <script>
        $(document).ready(function() {
            $('#division-select2').change(function() {
                var selectedDivision = $(this).val();

                if (selectedDivision) {
                    $.ajax({
                        url: '{{ url('select/division') }}', // The route to hit
                        method: 'GET', // You could also use POST if needed
                        data: {
                            division: selectedDivision,
                        },
                        success: function(response) {
                            // Handle the response if needed
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#division-select').change(function() {
                var selectedDivision = $(this).val();

                if (selectedDivision) {
                    $.ajax({
                        url: '{{ url('select/division') }}', // The route to hit
                        method: 'GET', // You could also use POST if needed
                        data: {
                            division: selectedDivision,
                        },
                        success: function(response) {
                            // Handle the response if needed
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        document.querySelector('.input-wrapper').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const swiperContainers = document.querySelectorAll('.swiper');
            swiperContainers.forEach(function(container) {
                new Swiper(container, JSON.parse(container.dataset.swiperOptions));
            });

            var swiper = new Swiper('.category-swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: 1,
                navigation: {
                    nextEl: '.nav-next',
                    prevEl: '.nav-prev',
                },

            });
        });
    </script>
    <script>
        // Object holding division-wise districts
        const districts = {
            Barishal: ["Barguna", "Barishal Sadar", "Bhola", "Jhalokati", "Patuakhali", "Pirojpur"],
            Chattogram: ["Bandarban", "Brahmanbaria", "Chandpur", "Chattogram Sadar", "Cox's Bazar", "Feni", "Khagrachari", "Lakshmipur", "Noakhali", "Rangamati"],
            Dhaka: ["Dhaka Sadar", "Faridpur", "Gazipur", "Gopalganj", "Kishoreganj", "Madaripur", "Manikganj", "Munshiganj", "Narayanganj", "Narsingdi", "Rajbari", "Shariatpur", "Tangail"],
            Khulna: ["Bagerhat", "Chuadanga", "Jashore", "Jhenaidah", "Khulna Sadar", "Kushtia", "Magura", "Meherpur", "Narail", "Satkhira"],
            Rajshahi: ["Bogura", "Joypurhat", "Naogaon", "Natore", "Chapai Nawabganj", "Pabna", "Rajshahi Sadar", "Sirajganj"],
            Rangpur: ["Dinajpur", "Gaibandha", "Kurigram", "Lalmonirhat", "Nilphamari", "Panchagarh", "Rangpur Sadar", "Thakurgaon"],
            Mymensingh: ["Jamalpur", "Mymensingh Sadar", "Netrokona", "Sherpur"],
            Sylhet: ["Habiganj", "Moulvibazar", "Sunamganj", "Sylhet Sadar"],
        };
    
        // Function to update districts based on selected division
        function updateDistricts() {
            const divisionSelect = document.getElementById("division-select-app");
            const districtSelect = document.getElementById("district-select-app");
            const selectedDivision = divisionSelect.value;
    
            // Clear existing districts
            districtSelect.innerHTML = '<option value="">Select a District</option>';
    
            // Populate districts based on selected division
            if (districts[selectedDivision]) {
                districts[selectedDivision].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        }
    </script>
</body>

