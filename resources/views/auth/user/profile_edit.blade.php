<x-app>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('seller-assets/css/plugins/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('seller-assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('seller-assets/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/seller.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
    </x-slot>
    <section class="ec-page-content ec-vendor-dashboard section-space-p mt-4">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <x-app.user_sidebar />
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <form action="{{ route('user.profile.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">
                                                First name
                                            </label>
                                            <input id="first_name" type="text" name="first_name"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                value="{{ Auth::user()->name }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">
                                                Last name
                                            </label>
                                            <input id="last_name" type="text" name="last_name"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                value="{{ Auth::user()->l_name }}">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="avatar">
                                                Avatar
                                            </label>
                                            <input id="avatar" type="file" name="avatar"
                                                class="form-control @error('avatar') is-invalid @enderror"
                                                value="{{ Auth::user()->avatar }}">
                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="email">
                                                Email
                                            </label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" value="{{ Auth::user()->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="contact_number">
                                                Contact number
                                            </label>
                                            <input class="form-control  @error('meta') is-invalid @enderror"
                                                name="phone" id="contact_number" value="{{ Auth::user()->phone }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-sm btn-dark mt-2 rounded">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</x-app>
