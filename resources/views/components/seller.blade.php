<!DOCTYPE html>
<html lang="en">



<title>UKR | Dashboard</title>
<link rel="icon" type="image/png" href="{{ asset('assets/images/icons/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('seeler-assets/css/vendor/ecicons.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('seller-assets/css/plugins/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('seller-assets/css/responsive.css') }}" />
<link rel="stylesheet" href="{{ asset('seller-assets/css/style.css') }}" />
<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
{{ $css ?? null }}
@stack('css')
<style>
    .vendor-block-bg {
        width: 100%;
        height: 200px;
        background-image: url("{{ auth()->user()->shop && auth()->user()->shop->banner ? Voyager::image(auth()->user()->shop->banner) : asset('seller-assets/images/7.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-blend-mode: overlay;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 5px;
    }

    .taglist {
        display: flex;
    }

    .taglist li::after {
        content: ","
    }

    
</style>
</head>

<body class="shop_page">

    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">

                        <x-app.seller.sidebar />
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </section>
    <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Logo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('vendor.logo.cover') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Logo</label>
                            <input type="file" class="form-control" required name="logo" id="logo"
                                aria-describedby="emailHelp">
                        </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="coverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Cover Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('vendor.logo.cover') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Cover</label>
                            <input type="file" class="form-control" required name="banner" id="banner"
                                aria-describedby="emailHelp">
                        </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @stack('js')
    <script src="{{ asset('seller-assets/js/main.js') }}"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <x-alert :exclude="[route('user.update_profile')]" />
    <script src="{{ asset('seller-assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller-assets/js/vendor/jquery-3.5.1.min.js') }}"></script>




    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        })
        $('.toast_close').click(function() {
            $('.toast').toast('hide');
        })
    </script>

    {{ $js ?? null }}
    @stack('script')
</body>


</html>
