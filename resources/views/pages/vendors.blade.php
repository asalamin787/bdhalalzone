@php
    $route = route('shops');
@endphp
<x-app>
    <x-slot name="css">
        <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <link rel="preload" href="assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
            type="font/woff2" crossorigin="anonymous">
        <!-- Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
        <style>
            .vendor-brand {
                max-width: 100%;
            }

            .search-container {
                display: flex;
                align-items: space-between;
                background-color: #f1f4f9;
                border: 1px solid #ccc;
                border-radius: 15px;
                width: 33.33vh;
                padding-left: 15px;
            }

            .search-container i {
                color: #888;
            }

            .search-container input {
                border: none;
                outline: none;
                background: transparent;
                font-size: 16px;
                width: 100%;
            }

            .sbutton {
                display: flex;
                /* height: 80%; */
                background: transparent;
                border: none;
                margin-right: -20px;
                margin-bottom: -2px;
                cursor: pointer;
                font-size: 20px;
        
            }

            /* Sidebar CSS */
            .sidebar {
                height: 100%;
                width: 0;
                position: fixed;
                top: 0;
                right: 0;
                background-color: white;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
                z-index: 1000;
            }

            .sidebar a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidebar a:hover {
                color: #f1f1f1;
            }

            .sidebar .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            .open-sidebar-btn {
                font-size: 20px;
                cursor: pointer;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .radio-container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 14px;
                user-select: none;
                font-weight: 20;
            }

            .radio-container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .radiomark {
                position: absolute;
                top: 0;
                left: 0;
                height: 20px;
                width: 20px;
                background-color: #eee;
                border-radius: 50%;
            }

            .radio-container:hover input~.radiomark {
                background-color: #ccc;
            }

            .radio-container input:checked~.radiomark {
                background-color: #2196F3;
            }

            .radiomark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .radio-container input:checked~.radiomark:after {
                display: block;
            }

            .radio-container .radiomark:after {
                top: 7px;
                left: 7px;
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: white;
            }

            #district {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
            }

            .star-rating {
                display: flex;
                flex-direction: column;
            }

            .star-rating label {
                display: flex;
                align-items: center;
                cursor: pointer;
                margin-bottom: 5px;
            }

            .star-rating label input {
                margin-right: 10px;
                display: inline-block;
            }



            .star-rating label i {
                color: gold;
                margin-right: 2px;
            }

            button {
                margin-right: 10px;
            }

            .Cbutton {
                background: transparent;
                width: auto;
                height: 42px;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 200;
                padding: 10px 10px 10px 10px;
                margin-bottom: 10px;
                border: .5px solid grey;
            }

            .Cbutton:hover {
                background: red;
                color: #eee;

            }

            .Abutton {
                background: transparent;
                width: auto;
                height: 42px;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 600;
                padding: 10px 10px 10px 10px;
                margin-bottom: 70px;
                border: .5px solid grey;
                font-weight: 200;



            }

            .Abutton:hover {
                background-color: blue;
                color: #eee;
            }

            .clear-btn {
                background-color: #333;
                border-radius: 5px;
                color: #fff;
                border: none;
                padding: 10px;
            }
            main{
                background-color: #EEEEEE;
            }
        </style>
    </x-slot>

    <div class="container">
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb mb-8" >
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li><a href="#">Vendors</a></li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid d-flex"
                style="padding-bottom: 20px; margin-top:-20px;justify-content: end; gap:3vh;">
                <form class="search-container" action="" method="get">
                    <input type="text" name="search" value="{{request()->search}}" placeholder="Search...">
                    <button class="sbutton" type="submit"><i class="fas fa-search"></i></button>

                </form>
                <button style="background:transparent; border-radius:5px;margin-right:0"
                    onclick="openSidebar()">
                    <svg  height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg>
                      
                </button>
                @if (request()->has('search'))
                    <a href="{{route('vendors')}}" class="btn clear-btn">X</a>
                @endif
            </div>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-4">
                <div class="container">
                    <div class="row cols-xl-5 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                        @foreach ($shops as $shop)
                            <div class="vendor-brand-wrap mb-8">
                                <div class="vendor-brand">
                                    <x-shop.card :shop="$shop" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
        <form action="" method="get">
        <div class="container d-flex" style="flex-direction: column">
            <div class="form-group">
                <div style="margin-top: 20px">
                    <h3>Filter Options</h3>
                </div>
                <label for="division">
                    <h4>Select Division</h4>
                </label>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Barishal" onclick="updateDropdown('Barishal')" {{ request()->division == 'Barishal' ? 'checked' : '' }}>
                        Barishal
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Chattogram" onclick="updateDropdown('Chattogram')" {{ request()->division == 'Chattogram' ? 'checked' : '' }}>
                        Chattogram
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Dhaka" onclick="updateDropdown('Dhaka')" {{ request()->division == 'Dhaka' ? 'checked' : '' }}>
                        Dhaka
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Khulna" onclick="updateDropdown('Khulna')" {{ request()->division == 'Khulna' ? 'checked' : '' }}>
                        Khulna
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Rajshahi" onclick="updateDropdown('Rajshahi')" {{ request()->division == 'Rajshahi' ? 'checked' : '' }}>
                        Rajshahi
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Rangpur" onclick="updateDropdown('Rangpur')" {{ request()->division == 'Rangpur' ? 'checked' : '' }}>
                        Rangpur
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Mymensingh" onclick="updateDropdown('Mymensingh')" {{ request()->division == 'Mymensingh' ? 'checked' : '' }}>
                        Mymensingh
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="division" value="Sylhet" onclick="updateDropdown('Sylhet')" {{ request()->division == 'Sylhet' ? 'checked' : '' }}>
                        Sylhet
                        <span class="radiomark"></span>
                    </label>
                </div>
                
            </div>

            <div class="form-group">
                <label for="district">
                    <h4>Select District</h4>
                </label>
                <select id="district" name="district" disabled>
                    <option value="{{ request()->district}}">{{request()->has('district') ? request()->district :'Select a division first'}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reviews">
                    <h4>Select Reviews</h4>
                </label>
                <div class="star-rating">
                    <label>
                        <input type="checkbox" name="reviews" value="1" {{ request()->reviews == 1 ? 'checked' : '' }}>
                        <i class="fas fa-star"></i>
                    </label>
                    <label>
                        <input type="checkbox" name="reviews" value="2" {{ request()->reviews == 2 ? 'checked' : '' }}>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                    <label>
                        <input type="checkbox" name="reviews" value="3" {{ request()->reviews == 3 ? 'checked' : '' }}>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                    <label>
                        <input type="checkbox" name="reviews" value="4" {{ request()->reviews == 4 ? 'checked' : '' }}>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                    <label>
                        <input type="checkbox" name="reviews" value="5" {{ request()->reviews == 5 ? 'checked' : '' }}>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                    
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="available-products">
                    <h4>Available Products</h4>
                </label>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="available-products" value="1-50"> 1-50
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="available-products" value="50-100"> 50-100
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="available-products" value="100-150"> 100-150
                        <span class="radiomark"></span>
                    </label>
                </div>
                <div>
                    <label class="radio-container">
                        <input type="radio" name="available-products" value="150+"> 150+
                        <span class="radiomark"></span>
                    </label>
                </div>
            </div> --}}

            <div class="container d-flex">
                <button type="button" class="Cbutton" onclick="window.location.href='{{route('vendors')}}';">Clear</button>
                <button type="submit" class="Abutton" >Apply
                    Filter</button>
            </div>
        </div>

    </form>
    </div>

    <script>
        function openSidebar() {
            document.getElementById("mySidebar").style.width = "300px";
        }

        function closeSidebar() {
            document.getElementById("mySidebar").style.width = "0";
        }
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

        function clearSelection() {
            const radioButtons = document.querySelectorAll('input[name="division"]');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });

            const districtSelect = document.getElementById("district");
            districtSelect.innerHTML = "<option value=''>Select a division first</option>";
            districtSelect.disabled = true;

            const reviewCheckboxes = document.querySelectorAll('input[name="reviews"]');
            reviewCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            const productRadioButtons = document.querySelectorAll('input[name="available-products"]');
            productRadioButtons.forEach(radio => {
                radio.checked = false;
            });
        }

        function applySelection() {
            const selectedDivision = document.querySelector('input[name="division"]:checked');
            const selectedDistrict = document.getElementById("district").value;
            const selectedReviews = Array.from(document.querySelectorAll('input[name="reviews"]:checked')).map(cb => cb
                .value);
            const selectedProducts = document.querySelector('input[name="available-products"]:checked');



        }
    </script>

    <x-slot name="js">
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sticky/sticky.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.min.js') }}"></script>
    </x-slot>
</x-app>
