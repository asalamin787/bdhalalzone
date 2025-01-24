<x-marchentiger>

    <x-slot name="css">
        <style>
            .urlinput {
                background-color: transparent !important;
                border: 1px solid orange !important;
                border-radius: 20px;
                height: 5px !important;

            }

            .copy-btn {
                border: 1px solid orange !important;
                border-radius: 20px;
                color: orange;
            }

            .copy-active {
                border: none !important;
                background-color: rgb(109, 184, 109);
                color: white;
            }

            .copy-input-active {
                border: 1px solid rgb(109, 184, 109) !important;
            }

            .shadow {
                box-shadow: 0 4px 6px rgba(0, 0, 255, 0.2) !important;
            }
        </style>
    </x-slot>

    <div class="ec-shop-rightside col-lg-9 col-md-12" style="position: relative;">
        <div class="ec-vendor-dashboard-card ec-vendor-profile-card">

            <div class="ec-vendor-card-body">
                <div class="container">

                    @if (auth()->user()->retailer)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Earning</span>
                                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                                        {{ Sohoj::price(Sohoj::retailTotalEarn(auth()->user()->retailer)) }}</p>
                                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Widthraw</span>
                                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                                        {{ Sohoj::price(auth()->user()->retailer->total_withdraw) }}</p>
                                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Due</span>
                                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                                        {{ Sohoj::price(auth()->user()->retailer->total_own) }}</p>
                                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-7">

                                <input type="text" id="inputURL" class="form-control urlinput"
                                    value="{{ route('vendor.create') }}?referral={{ auth()->user()->retailer->unique_id }}"
                                    readonly>
                            </div>
                            <div class="col-md-2">
                                <button id="copyButton" class="btn copy-btn w-100">Copy</button>
                            </div>
                            <div class="col-md-3">

                                <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Scan QR Code
                                </button>


                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Scan With QR Code</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ route('vendor.create') }}?referral={{ auth()->user()->retailer->unique_id }}"
                                            alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    <form class="g-3 " action="{{ route('marchentiger.create_or_update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card  mb-4" id="contactInfo">
                            <div class="card-header bg-transparent">
                                <h5 class="my-3">
                                    Contact Information :
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ auth()->user() ? auth()->user()->email : ' ' }}" name="email"
                                            id="inputEmail4" required readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Phone Number<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->phone ? auth()->user()->retailer->phone : old('phone') }}"
                                            name="phone" id="phone" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" id="addressInfo">
                            <div class="card-header bg-transparent">
                                <h5 class="my-3">
                                    Address Information :
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text"
                                            class="form-control p-2 @error('division') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->division ? auth()->user()->retailer->division : old('division') }}"
                                            name="division" id="division" required>
                                        @error('division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="zilla" class="form-label">Zilla</label>
                                        <input type="text"
                                            class="form-control p-2 @error('zilla') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->zilla ? auth()->user()->retailer->zilla : old('zilla') }}"
                                            name="zilla" id="zilla" required>
                                        @error('zilla')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="upzilla" class="form-label">Upzilla</label>
                                        <input type="text"
                                            class="form-control p-2 @error('upzilla') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->upzilla ? auth()->user()->retailer->upzilla : old('upzilla') }}"
                                            name="upzilla" id="upzilla" required>
                                        @error('upzilla')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City / Village</label>
                                        <input type="text"
                                            class="form-control p-2 @error('city') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->city ? auth()->user()->retailer->city : old('city') }}"
                                            name="city" id="city" required>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="inputZip" class="form-label">Zip</label>
                                        <input type="text"
                                            class="form-control p-2 @error('post_code') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->post_code ? auth()->user()->retailer->post_code : old('post_code') }}"
                                            name="post_code" id="post_code" required>
                                        @error('post_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text"
                                            class="form-control p-2 @error('address') is-invalid @enderror"
                                            value="{{ auth()->user()->retailer && auth()->user()->retailer->address ? auth()->user()->retailer->address : old('address') }}"
                                            name="address" id="address" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary ">Save <i class="fa fa-save"></i></button>

                    </form>


                </div>


            </div>
        </div>
    </div>

    <x-slot name="js">
        <script>
            document.getElementById('copyButton').addEventListener('click', function() {
                var inputField = document.getElementById('inputURL');
                var copyButton = document.getElementById('copyButton');
                inputField.select();
                inputField.setSelectionRange(0, 99999);
                document.execCommand('copy');
                copyButton.innerHTML = 'Copied';
                copyButton.classList.add('copy-active');
                inputField.classList.add('copy-input-active');
            });
        </script>
    </x-slot>


</x-marchentiger>
