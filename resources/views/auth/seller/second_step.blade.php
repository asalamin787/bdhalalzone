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
    </x-slot>

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <div class="section-title">
                        {{-- <h2 class="ec-bg-title">Log In</h2> --}}

                        <h2 class="ec-title">2nd Step Verification <span class="text-success">UKRBD</span> </h2>
                        <p class="sub-title mb-3">{{ __('Register as vendor') }}</p>
                    </div>
                </div>

                <div class="ec-login-wrapper mb-5"
                    style="max-width: 730px; margin:0 auto;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:20px">

                    <div class="ec-login-container" style="border: none">
                        <div class="ec-login-form">
                            <form method="POST" action="{{ route('vendor.second.step.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <label for="">Personal Info</label> --}}

                                <div class="row">

                                    <span class="ec-login-wrap col-md-6 mb-3">
                                        <label for="phone">Phone<span class="text-danger">*</span></label>
                                        <input id="phone" type="text" placeholder="Phone"
                                            class="form-control bg-light @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') ?? '' }}" required
                                            autocomplete="phone" autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                    <span class="ec-login-wrap col-md-6 mb-3">
                                        <label for="birth_date">Date Of Birth<span class="text-danger">*</span></label>
                                        <input id="birth_date" type="date" id="dob" max="2003-05-29"
                                            placeholder="Date Of Birth"
                                            class="form-control bg-light @error('dob') is-invalid @enderror"
                                            name="dob" value="{{ old('dob') ?? '' }}" required
                                            autocomplete="birth_date" autofocus>

                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                </div>
                                <div class="row mb-3">

                                    <span class="ec-login-wrap col-md-12">
                                        <label for="tax_no">Taxpayer's Identification Number (TIN) <span
                                                class="text-danger">*</span></label>
                                        <input id="tax_no" type="text"
                                            placeholder="Leave blank if you don't have an TIN number."
                                            class="form-control bg-light @error('tax_no') is-invalid @enderror"
                                            name="tax_no" value="{{ old('tax_no') ?? '' }}" autocomplete="phone"
                                            autofocus>

                                        @error('tax_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                </div>




                                <div class="row mt-3 mb-3">
                                    <p>Please provide a valid government ID for identify verification</p>
                                    <span class="ec-login-wrap col-md-6">
                                        <label for="govt_id_front">NID Front side <span
                                                class="text-danger">*</span></label>
                                        <input id="govt_id_front" type="file"
                                            class="form-control bg-light @error('govt_id_front') is-invalid @enderror"
                                            name="govt_id_front" value="" required
                                            autofocus>

                                        @error('govt_id_front')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                    <span class="ec-login-wrap col-md-6">
                                        <label for="govt_id_back">NID Back side <span
                                                class="text-danger">*</span></label>
                                        <input id="govt_id_back" type="file" multiple
                                            placeholder="One Government ID for verification"
                                            class="form-control bg-light @error('govt_id_back') is-invalid @enderror"
                                            name="govt_id_back" value="" required
                                            autofocus>

                                        @error('govt_id_back')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                </div>



                                <div class="row ">


                                    <span class="ec-login-wrap col-md-6 mb-3">
                                        <label for="inputCity" class="form-label mt-2">City<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('city') is-invalid @enderror bg-light"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->city : ' ' }}"
                                            name="city" id="city" required>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                    <span class="ec-login-wrap col-md-6 mb-3">
                                        <label for="inputZip" class="form-label">Zip</label>
                                        <input type="text" placeholder="post code"
                                            class="form-control bg-light p-2  @error('post_code') is-invalid @enderror"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->post_code : ' ' }}"
                                            name="post_code" id="post_code" required>
                                        @error('post_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                    <span class="ec-login-wrap col-md-12 mb-3">

                                        <label class="mt-2" for="address">Street address<span
                                                class="text-danger">*</span></label>
                                        <textarea id="address" placeholder="Address"
                                            class="form-control mb-3 bg-light @error('address') is-invalid @enderror" name="address" required>{{ old('address') ?? '' }}</textarea>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>



                                </div>






                                <div class="d-flex mb-3">

                                    <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                        id="terms" style="width: 25px;" value="1" name="terms"><span>I
                                        have
                                        read and agree to the <a href="https://ukrbd.sohojearning.com/page/privacy"
                                            style="" class="ml-2 ">Terms
                                            &amp; Conditions</a></span><span class="checked"></span>
                                    @error('terms')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <span class="ec-login-wrap ec-login-btn">
                                    <div class="col-md-12 ">
                                        <button type="submit" id="submit" class="btn btn-dark rounded rounded-4">
                                            Submit
                                        </button>

                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
