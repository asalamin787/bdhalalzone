<x-seller>

    <x-slot name="css">

        @livewireStyles

        <style>
            .breadcrumb {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .breadcrumb li::after {

                font-size: 14px;
                font-weight: 600;
                color: rgb(255, 51, 0);
                content: ">"
            }

            .breadcrumb li a {
                font-size: 14px;
                font-weight: 600;
            }

            .breadcrumb li:last-child::after {
                content: ""
            }
        </style>
    </x-slot>

    <div class="ec-shop-rightside col-lg-9 col-md-12" style="position: relative;">
        <div class="ec-vendor-dashboard-card ec-vendor-profile-card">
            @if (auth()->user()->shop)
                @if (auth()->user()->shop->status == 0)
                    <div class="card-header text-center">
                        <span style="color: red">Your shop is pending approval. We'll notify you once it's
                            approved.</span>
                    </div>
                @endif
            @endif
            <div class="ec-vendor-card-body">


                <div class="row">
                    <div class="col-md-12">
                        <div class="ec-vendor-block-profile">
                            <div class="vendor-block-bg"></div>
                            <a href="javascript:void(0)" class="shadow-lg"
                                style="position: absolute; top:0px; right:20px; background-color: #fff; border-radius:50%;padding:10px 0"
                                data-bs-toggle="modal" data-bs-target="#coverModal"><span class="mx-3">
                                    <i class="fas fa-edit"></i></span></a>
                            <div class="ec-vendor-block-img space-bottom-30" style="background-color: snow;">
                                <div class="ec-vendor-block-b"></div>
                                <div class="ec-vendor-block-detail">
                                    <div style="position: relative;">

                                        <img class="v-img img-fluid"
                                            src="{{ auth()->user()->shop && auth()->user()->shop->logo ? Voyager::image(auth()->user()->shop->logo) : asset('seller-assets/images/2.jpg') }}"
                                            alt="E-shop image">

                                        <a href="javascript:void(0)" class="shadow-lg"
                                            style="position: absolute; top:-59px; right:-21px; background-color: #fff; border-radius:50%;padding:10px 0"
                                            data-bs-toggle="modal" data-bs-target="#logoModal"><span class="mx-3">
                                                <i class="fas fa-edit"></i></span></a>
                                    </div>
                                    <h5>{{ auth()->user()->name }}</h5>
                                    <p>( {{ auth()->user()->shop ? auth()->user()->shop->name : 'no shop has been created' }}
                                        )</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ route('vendor.shop') }}#generalInfo">General Informations</a>
                        </li>
                        <li>
                            <a href="{{ route('vendor.shop') }}#contactInfo">Contact Informations</a>
                        </li>
                        <li>
                            <a href="{{ route('vendor.shop') }}#addressInfo">Address Informations</a>
                        </li>
                        <li>
                            <a href="{{ route('vendor.shop') }}#courierInfo">Courier Section</a>
                        </li>
                        <li>
                            <a href="{{ route('vendor.shop') }}#socialInfo">Social Links</a>
                        </li>
                    </ul>

                    <form class="g-3 " action="{{ route('vendor.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card mb-4" id="generalInfo">
                            <div class="card-header bg-transparent">
                                <h5 class="my-3">
                                    General Informations :
                                </h5>
                            </div>
                            <div class="card-body">


                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Shop Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->name ? auth()->user()->shop->name : old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Company Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->company_name && auth()->user()->shop->company_name ? auth()->user()->shop->company_name : old('company_name') }}"
                                            name="company_name" id="company_name" required>
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Shop Registration<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_registration') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->company_registration ? auth()->user()->shop->company_registration : old('company_registration') }}"
                                            name="company_registration" id="company_registration" required>
                                        @error('company_registration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-floating">
                                            <textarea required maxlength="300" class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Short Description" name="short_description" id="short_description" style="height: 150px" required>{{ auth()->user()->shop && auth()->user()->shop->short_description ? auth()->user()->shop->short_description : old('short_description') }}</textarea>
                                            <label for="floatingTextarea2">Short Description<span
                                                    class="text-danger">*</span></label>
                                            <span id="charCount">Characters left: 300</span>
                                            @error('short_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-floating">

                                            <textarea id="description" class="form-control" style="height: 200px" required maxlength="1000" name="description"
                                                cols="20" rows="10" required>{{ auth()->user()->shop && auth()->user()->shop->description ? auth()->user()->shop->description : old('description') }}</textarea>
                                            <label for="inputAddress2" class="form-label">About Shop<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <span id="descriptionCharCount">Characters left: 1000</span>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card  mb-4" id="contactInfo">
                            <div class="card-header bg-transparent">
                                <h5 class="my-3">
                                    Contact Informations :
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ auth()->user() ? auth()->user()->email : ' ' }}" name="email"
                                            id="inputEmail4" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Phone Number<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->phone ? auth()->user()->shop->phone : old('phone') }}"
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
                                    Address Informations :
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text"
                                            class="form-control p-2 @error('division') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->division ? auth()->user()->shop->division : old('meta.division') }}"
                                            name="meta[division]" id="division" required>
                                        @error('division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                   
                                    <div class="col-md-6 mb-3">
                                        <label for="division" class="form-label">Division <span
                                            class="text-danger">*</span></label>
                                        <select class="form-control border" name="division" onchange="updateDropdown(this.value)" required>
                                            <option value="">Select a Division</option>
                                            <option value="Barishal" {{ auth()->user()->shop?->division == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                            <option value="Chattogram" {{ auth()->user()->shop?->division == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                                            <option value="Dhaka" {{ auth()->user()->shop?->division == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                            <option value="Khulna" {{ auth()->user()->shop?->division == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                            <option value="Rajshahi" {{ auth()->user()->shop?->division == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                            <option value="Rangpur" {{ auth()->user()->shop?->division == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                            <option value="Mymensingh" {{ auth()->user()->shop?->division == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                            <option value="Sylhet" {{ auth()->user()->shop?->division == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                            
                                        </select>
                                        
                                        @error('division')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">District <span
                                            class="text-danger">*</span></label>
                                        <select class="form-control border" id="district" name="district" required>
                                            <option value="">Select a division first</option>
                                            @if(auth()->user()->shop && auth()->user()->shop->district)
                                            <option value="{{auth()->user()->shop->district}}" selected>{{auth()->user()->shop->district}}</option>
                                            @endif
                                        </select>
                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="upzilla" class="form-label">Upzilla</label>
                                        <input type="text"
                                            class="form-control p-2 @error('meta.upzilla') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->upzilla ? auth()->user()->shop->upzilla : old('meta.upzilla') }}"
                                            name="meta[upzilla]" id="upzilla" required>
                                        @error('meta.upzilla')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City / Village</label>
                                        <input type="text"
                                            class="form-control p-2 @error('city') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->city ? auth()->user()->shop->city : old('city') }}"
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
                                            value="{{ auth()->user()->shop && auth()->user()->shop->post_code ? auth()->user()->shop->post_code : old('post_code') }}"
                                            name="post_code" id="post_code" required>
                                        @error('post_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputZip" class="form-label">Address</label>
                                        <input type="text"
                                            class="form-control p-2 @error('address') is-invalid @enderror"
                                            value="{{ auth()->user()->shop && auth()->user()->shop->address ? auth()->user()->shop->address : old('meta.address') }}"
                                            name="meta[address]" id="address" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @if (auth()->user()->shop && auth()->user()->shop->is_shipping_enabled == false)
                        <div class="card mb-4" id="courierInfo">
                            <div class="card-header bg-transparent py-3">
                                <h5 class="">
                                    Courier's Section
                                </h5>
                                <p class="">
                                    Please note that this section will be removed after you have provided your
                                    information. Therefore, ensure that all details are accurate and complete before
                                    submission.
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="store_name">
                                                Store Name
                                            </label>
                                            <input type="text"
                                                class="form-control @error('post_code') is-invalid @enderror"
                                                name="store_name" required id="store_name"
                                                value="{{ old('store_name') }}" required>
                                            @error('store_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="pathao_contact_name">
                                                Contact name
                                            </label>
                                            <input type="text" class="form-control" name="pathao[contact_name]"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="pathao_contact_number]">
                                                Contact number
                                            </label>
                                            <input type="text" class="form-control" name="pathao[contact_number]"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="secondary_contact_name">
                                                Secondary contact number
                                            </label>
                                            <input type="text" class="form-control"
                                                name="pathao[secondary_contact_number]" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <livewire:pathao-form />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="pathao_address">
                                                Address
                                            </label>
                                            <input type="text" class="form-control" name="pathao[address]"
                                                required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="card mb-4" id="socialInfo">
                            <div class="card-header bg-transparent">
                                <h5 class="my-3">
                                    Social Links :
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Facebook</label>
                                        <input type="text" name="meta[facebook]"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->facebook : old('facebook') }}"
                                            class="form-control @error('meta') is-invalid @enderror" id="title">
                                        @error('meta.*.facebook')
                                            <p>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title2" class="form-label">Linkedin</label>
                                        <input type="text" name="meta[linkedin]"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->linkedin : old('linkedin') }}"
                                            class="form-control @error('meta') is-invalid @enderror" id="title2">
                                        @error('meta.*.linkedin')
                                            <p>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title3" class="form-label">Instagram</label>
                                        <input type="text" name="meta[instagram]"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->instagram : old('instagram') }}"
                                            class="form-control @error('meta') is-invalid @enderror" id="title3">
                                        @error('meta.*.instagram')
                                            <p>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title4" class="form-label">Twitter</label>
                                        <input type="text" name="meta[twitter]"
                                            value="{{ auth()->user()->shop ? auth()->user()->shop->twitter : old('twitter') }}"
                                            class="form-control @error('meta') is-invalid @enderror" id="title4">
                                        @error('meta.*.twitter')
                                            <p>
                                                {{ $message }}
                                            </p>
                                        @enderror
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
            const showInputFiledValueLength = (inputFieldID, messageBoxID) => {
                const el = document.getElementById(inputFieldID);
                const messageBox = document.getElementById(messageBoxID);
                const maxLength = el.maxLength;
                const currentLength = el.value.length;
                messageBox.textContent = `Characters left: ${maxLength - currentLength}`
            }
            document.addEventListener('DOMContentLoaded', function() {
                showInputFiledValueLength('short_description', 'charCount');
                showInputFiledValueLength('description', 'descriptionCharCount');

            })
            document.getElementById('short_description').addEventListener('input', () => showInputFiledValueLength(
                'short_description', 'charCount'))
            document.getElementById('description').addEventListener('input', () => showInputFiledValueLength('description',
                'descriptionCharCount'))
        </script>

       <script>
           const districts = {
            Barishal: ["Barguna", "Barishal", "Bhola", "Jhalokathi", "Patuakhali", "Pirojpur"],
            Chattogram: ["Bandarban", "Brahmanbaria", "Chandpur", "Chattogram", "Cox's Bazar", "Cumilla", "Feni",
                "Khagrachari", "Lakshmipur", "Noakhali", "Rangamati"
            ],
            Dhaka: ["Dhaka", "Faridpur", "Gazipur", "Gopalganj", "Kishoreganj", "Madaripur", "Manikganj", "Munshiganj",
                "Narayanganj", "Narsingdi", "Rajbari", "Shariatpur", "Tangail"
            ],
            Khulna: ["Bagerhat", "Chuadanga", "Jashore", "Jhenaidah", "Khulna", "Kushtia", "Magura", "Meherpur",
                "Narail", "Satkhira"
            ],
            Rajshahi: ["Bogura", "Joypurhat", "Naogaon", "Natore", "Nawabganj", "Pabna", "Rajshahi", "Sirajganj"],
            Rangpur: ["Dinajpur", "Gaibandha", "Kurigram", "Lalmonirhat", "Nilphamari", "Panchagarh", "Rangpur",
                "Thakurgaon"
            ],
            Mymensingh: ["Jamalpur", "Mymensingh", "Netrokona", "Sherpur"],
            Sylhet: ["Habiganj", "Moulvibazar", "Sunamganj", "Sylhet"]
        };

        function updateDropdown(division) {
            const districtSelect = document.getElementById("district");
            districtSelect.innerHTML = "";

            if (division) {
                districtSelect.disabled = false;

                districts[division].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            } else {
                districtSelect.disabled = true;
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Select a division first";
                districtSelect.appendChild(defaultOption);
            }
        }
       </script>
        @livewireScripts
    </x-slot>

</x-seller>
