  {{-- <x-app>
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
      </x-slot>
      <x-app.breadcrumb name="Sign In" />
      <section class="ec-page-content  " style="margin:50px 0">
          <div class="container">
              <div class="row">

                  <div class=" "
                      style="max-width: 730px;margin:0 auto;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:20px">
                      <div class="ec-login-container ">
                          <p class="nav-link" style="font-size: 20px">Vendor as Register </p>
                          <div class="ec-login-form">
                              <form method="POST" action="{{ route('register') }}">
                                  @csrf
                                  <div class="row">
                                      <span class="ec-login-wrap col-md-6 mb-3">
                                          <label for="name">First Name <span class="text-danger">*</span></label>
                                          <input id="name" type="text" placeholder="First name"
                                              class="form-control bg-light @error('name') is-invalid @enderror"
                                              name="name" value="{{ old('name') }}" required autocomplete="name"
                                              autofocus>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </span>

                                      <span class="ec-login-wrap col-md-6 mb-3">
                                          <label for="l_name">Last Name <span class="text-danger">*</span></label>
                                          <input id="l_name" type="text" placeholder="{{ __('Last Name') }}"
                                              class="form-control bg-light @error('l_name') is-invalid @enderror"
                                              name="l_name" value="{{ old('l_name') }}" required autocomplete="name"
                                              autofocus>

                                          @error('l_name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </span>
                                  </div>
                                  <div class="row">
                                      <span class="ec-login-wrap col-md-12 mb-3">
                                          <label for="email">Email Address<span class="text-danger">*</span></label>
                                          <input id="email" type="email" placeholder="{{ __('Email Address') }}"
                                              class="form-control bg-light @error('email') is-invalid @enderror"
                                              name="email" value="{{ old('email') }}" required autocomplete="email"
                                              autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </span>

                                  </div>

                                  <div class="row">
                                      <span class="ec-login-wrap col-md-6 mb-3">
                                          <label for="password">Password <span class="text-danger">*</span></label>
                                          <input id="password" type="password" placeholder="{{ __('Password') }}"
                                              class="form-control bg-light @error('password') is-invalid @enderror"
                                              name="password" required autocomplete="current-password">

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </span>
                                      <span class="ec-login-wrap col-md-6 mb-3">
                                          <label for="password-confirm">Confirm Password<span
                                                  class="text-danger">*</span></label>
                                          <input id="password-confirm" type="password"
                                              placeholder="{{ __('Confirm Password') }}" class="form-control bg-light"
                                              name="password_confirmation" required autocomplete="new-password">
                                      </span>
                                  </div>
                                  <input type="hidden" value="vendor" name="role">
                                  <div class="d-flex mb-3">

                                      <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                          id="terms" style="width: 25px;" value="1" name="terms" required><a
                                          href="{{ url('page/policies') }}" style="" target="_banl"
                                          class="mt-0 ml-2">I have
                                          read and agree to the <span>Terms &amp; Conditions of
                                              MYEASYMART</span></a><span class="checked"></span>
                                      @error('terms')
                                          <span class="invalid-feedback " role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                  <span class="ec-login-wrap ec-login-btn">
                                      <div class="col-md-12 ">
                                          <button type="submit" class="btn btn-dark rounded rounded-4">
                                              {{ __('Register') }}
                                          </button>

                                  </span>

                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </x-app> --}}

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
                <h1 class="page-title mb-0">Register as E-shop</h1>
            </div>
        </div>
    </div>

      <!-- End of Breadcrumb -->
      <div class="page-content pb-5" style="background-color: #EEEEEE">
          <div class="container">
              <div class="login-popup mx-auto my-0" style="background-color: #fff">
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
                                  @if (request()->has('referral'))
                                      <input type="hidden" name="referral" value="{{ request()->query('referral') }}">
                                  @endif
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
                                      <label>Your email address or Phone *</label>
                                      <input type="text" class="form-control @error('email') is-invalid @enderror"
                                          name="email" id="email" value="{{ old('email') }}" required
                                          autocomplete="email" autofocus>
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label>Your contact number *</label>
                                      <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                          name="phone" id="phone" value="{{ old('phone') }}" required
                                          autocomplete="phone" autofocus>
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>

                                  <div class="form-group mb-5">
                                      <label>Password *</label>
                                      <input type="password"
                                          class="form-control @error('password') is-invalid @enderror" name="password"
                                          required autocomplete="current-password" id="password">
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

                                  <input type="hidden" value="vendor" name="role">


                                  {{-- <a href="{{ route('vendor.create') }}" class="d-block mb-5 text-primary">Signup as
                                      a vendor?</a> --}}
                                  <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                      <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                          id="terms" style="width: 19px; height: 19px;" value="1"
                                          name="terms" required><span class="mt-0 ml-2">I have
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
