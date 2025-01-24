<x-app>
    <x-slot name='css'>
        <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <!-- Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
    </x-slot>

    <!-- Ec Thank You page -->
    <div class="page-content d-flex align-items-center justify-content-center" style="height: 70vh;">
        <div class="container">
            <div class="row text-center mt-5">
                <div class="col-md-12">
                    <div class="ec-thank-you section-space-p">
                        <!-- thank content Start -->
                        <div class="ec-thank-content">
                            <i class="ecicon eci-check-circle" aria-hidden="true"></i>
                            <div class="section-title">
                                <h2 class="ec-title">Thank You</h2>
                                <p class="sub-title">For Shopping with us.</p>
                            </div>
                        </div>
                        <!--thank content End -->
                        <div class="ec-hunger mb-5">
                            <div class="ec-hunger-detial">
                                <h3>Want to track your order?</h3>
                                <h6>Just click the link below.</h6>
                                <a href="{{ route('user.ordersIndex') }}" class="btn btn-primary btn-rounded">Track Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-slot name='js'>
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sticky/sticky.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.min.js') }}"></script>
    </x-slot>
</x-app>
