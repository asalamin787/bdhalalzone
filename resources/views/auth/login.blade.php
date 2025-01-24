<x-app>
    <x-slot name="css">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
        <link rel="stylesheet" type="text/css" href="assets/css/style.min.css">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">

        <style>
            .login-page .login-popup {
                margin: 4.2rem auto 5rem;
                -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </x-slot>

    {{-- <x-app.header /> --}}

    {{-- <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">

                        <h2 class="ec-title">{{ __('Welcome back!') }}</h2>
                        <p class="sub-title mb-3">{{ __('Login to your account') }}</p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                    <div class="ec-login-container" style="border: none">
                        <div class="ec-login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <span class="ec-login-wrap">
                                    <label for="email">Email Address<span class="text-danger">*</span></label>
                                    <input id="email" type="email" placeholder="{{ __('Email Address') }}"
                                        class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </span>
                                <span class="ec-login-wrap">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input id="password" type="password" placeholder="{{ __('Password') }}"
                                        class="form-control bg-light @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </span>
                                <span class="ec-login-wrap ec-login-fp d-flex justify-content-end">
                                    @if (Route::has('password.request'))
                                        <a class="text-success " href="{{ route('password.request') }}">
                                            {{ __('Recover Password') }}
                                        </a>
                                    @endif
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <button type="submit" class="btn btn-dark rounded rounded-4">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <span>Don't Have an account ? <a class="text-success"
                                                    href="{{ route('register') }}"> Create</a></span>
                                        </div>

                                    </div>

                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <div class="login-page">
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">LOG IN</h1>
            </div>
        </div>
    </div>
        <!-- End of Page Header -->
 

    <!-- End of Breadcrumb -->
    <div class="page-content pb-5" style="background-color: #EEEEEE">
        <div class="container">
            <div class="login-popup mx-auto my-0" style="background-color: #fff">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-in" class="nav-link active">Sign In</a>
                        </li>
                        {{-- <li class="nav-item">
                                <a href="#sign-up" class="nav-link">Sign Up</a>
                            </li> --}}
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email or phone *</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="email" value="{{ old('username') }}" required
                                        autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Password *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1">
                                    <label for="remember1">Remember me</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forget your password?</a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
                            </form>
                        </div>

                    </div>
                    <p class="text-center">Don't Have an account ? <a class="text-success"
                            href="{{ route('register') }}"> Create</a></p>
                    {{-- <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div> --}}
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
