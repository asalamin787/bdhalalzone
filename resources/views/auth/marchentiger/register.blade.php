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
                <h1 class="page-title mb-0">Register as MYEASYMART Affiliate</h1>
            </div>
        </div>
    </div>
    <!-- End of Breadcrumb -->
    <div class="page-content pb-5" style="background-color: #EEEEEE">
        <div class="container">
            <div class="login-popup mx-auto my-0" style="background-color:#fff">
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
                                    <label>Name *</label>
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
                                    <label>Your Phone *</label>
                                    <input type="number" class="form-control @error('email') is-invalid @enderror"
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

                                <input type="hidden" value="marchentiger" name="role">


                                {{-- <a href="{{ route('vendor.create') }}" class="d-block mb-5 text-primary">Signup as
                                    a vendor?</a> --}}
                                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                    <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                        id="terms" style="width: 19px; height: 19px;" value="1" name="terms"
                                        required><span class="mt-0 ml-2">I have
                                        read and agree to the <a href="{{ url('page/policies') }}" style=""
                                            target="_blank">Terms &amp; Conditions of
                                            MYEASYMART</a></span><span class="checked"></span>
                                    @error('terms')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- <label for="remember" class="font-size-md">I agree to the <a href="#"
                                            class="text-primary font-size-md">privacy policy</a></label> --}}
                                </div>
                                <button class="btn btn-primary" style="width: 100%">Sign Up</button>
                            </form>
                        </div>

                    </div>
                    <p class="text-center">Already have an account ? <a class="text-success"
                            href="{{ route('login') }}"> Sign In</a></p>
                    {{-- <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</x-app>
