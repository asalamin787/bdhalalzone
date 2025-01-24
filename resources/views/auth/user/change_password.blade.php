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
                            <div class="container">
                                <div class="row">
            
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <h1>Change password</h1>
            
                                            <div class="panel-body">
            
                                                <form class="form-horizontal" method="POST" action="{{ route('user.update_password') }}">
                                                    @csrf
            
                                                    <div class="form-group{{ $errors->has('current_password') ? '  has-error' : '' }}">
                                                        <label for="new_password" class="col-md-4 control-label">Current
                                                            Password</label>
            
                                                        <div class="col-md-6">
                                                            <input id="current-password" type="password" class="form-control"
                                                                name="current_password" required>
            
            
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                                        <label for="new_password" class="col-md-4 control-label mt-2">New
                                                            Password</label>
            
                                                        <div class="col-md-6">
                                                            <input id="new_password" type="password" class="form-control"
                                                                name="new_password" required>
            
            
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group">
                                                        <label for="new_password_confirm" class="col-md-4 control-label mt-2">Confirm
                                                            New
                                                            Password</label>
            
                                                        <div class="col-md-6">
                                                            <input id="new_password_confirm" type="password" class="form-control"
                                                                name="new_password_confirmation" required>
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group mt-3">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-danger rounded">
                                                                Update Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-app>
