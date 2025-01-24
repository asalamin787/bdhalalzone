<x-marchentiger>
    <div class="ec-shop-rightside col-lg-9 col-md-12">
        <div class="ec-vendor-dashboard-card ec-vendor-profile-card">
            <div class="ec-vendor-card-body">


                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-vendor-block-profile">

                            <h3 class="mt-3 mb-3 text-center">Change Password</h3>
                            <form method="POST" action="{{ route('marchentiger.password.change') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 my-2">
                                        <div class="form-group">

                                            <input type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                id="current_password" placeholder="Current password"
                                                name="current_password">
                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-group">

                                            <input type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" placeholder="New password" name="new_password">
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-12 my-2">
                                        <div class="form-group">

                                            <input type="password"
                                                class="form-control @error('new_confirm_password') is-invalid @enderror"
                                                id="new_confirm_password" placeholder="Confirm password"
                                                name="new_confirm_password">
                                            @error('new_confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="form-group d-flex justify-content-end">
                                            <button class="btn btn-dark btn-lg" type="submit"> Change Password</button>
                                        </div>
                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-marchentiger>
