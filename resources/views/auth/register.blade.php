<x-app>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.min.css">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">

        <style>
            .login-page .login-popup {
                margin: 4.2rem auto 5rem;
                -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </x-slot>



    <div class="login-page">
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Sign Up</h1>
            </div>
        </div>
    </div>
    <!-- End of Breadcrumb -->
    <div class="page-content pb-5" style="background-color: #EEEEEE">
        <div class="container">
            <div class="login-popup mx-auto" style="background-color: #fff">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        {{-- <li class="nav-item">
                                <a href="#sign-in" class="nav-link active">Sign In</a>
                            </li> --}}
                        <li class="nav-item">
                            <a href="#sign-up" class="nav-link">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">


                        <div class="tab-pane active">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group mb-5">
                                    <label> Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}" required
                                        autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Your email address Or Phone *</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" required
                                        autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-5">
                                    <label>Password *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-5">
                                    <label>Confirmation Password *</label>
                                    <input type="password" class="form-control" name="password_confirmation" required
                                        autocomplete="new-password" id="password_confirmation">
                                </div>

                                <input type="hidden" name="role" value="user" id="">


                                <a href="{{ route('vendor.create') }}" class="d-block mb-5 text-primary">Signup as a
                                    E-shop?</a>
                                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                    <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                                    <label for="remember" class="font-size-md">I agree to the <a href="{{url('page/privacy')}}"
                                            class="text-primary font-size-md">privacy policy</a></label>
                                </div>
                                <button class="btn btn-primary" style="width: 100%">Sign Up</button>
                            </form>
                        </div>

                    </div>
                    <p class="text-center">Already have an account ? <a class="text-success"
                            href="{{ route('login') }}"> Sign In</a></p>

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app>

@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
