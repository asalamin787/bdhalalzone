<style>
    .w-icon-cart {
        font-size: 24px;
        width: 24px;
        height: 24px;
        padding: 5px;
    }

    .w-icon-cart .cart-count {
        font-size: 14px;
        padding: 2px;
    }
</style>
@php
    $route = route('shops');
@endphp
<div class="header-middle">
    <div class="container">
        <div class="header-left mr-md-4">
            <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
            </a>
            <a href="{{ route('homepage') }}" class="logo ml-lg-0">
                <img src="{{ Voyager::image(setting('site.logo')) }}" alt="logo" width="145" height="45" />
            </a>
            <form method="get" action="{{ route('shops') }}"
                class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                <div class="select-box">
                    <select id="category" name="category">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                </div>
                <input type="text" class="form-control" name="search" id="search" placeholder="Search in..."
                    required />
                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                </button>
            </form>
        </div>
        <div class="header-right ml-4">
            <div class="header-call d-xs-show d-lg-flex align-items-center">
                <a href="#" class="w-icon-call"></a>
                <div class="call-info d-lg-show">
                    <h4 class="chat font-weight-normal font-size-md text-normal ls-normal  mb-0">
                        Call Us Now :
                    </h4>
                    <a href="tel:{{ setting('site.phone') }}"
                        class="phone-number font-weight-bolder ls-50">{{ setting('site.phone') }}</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="wishlist label-down link d-xs-show" data-toggle="dropdown"
                    style=" border: none; background-color: white;">
                    <i class="w-icon-user" style="font-weight: 600;"></i>
                    <span class="wishlist-label d-lg-show">user</span>
                </button>
                <div class="dropdown-menu "
                    style=" padding-left: 20px; padding-top: 10px; padding-bottom: 10px">
                    @if (auth()->check())
                        @if (auth()->user()->role_id == 2)
                            <a class="dropdown-item wishlist-label d-lg-show pt-2" href="{{ route('user.dashboard') }}"
                                style="font-size: small">My Account</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="logout-button" style="font-size: small">
                                    Logout</button>

                            </form>
                        @elseif(auth()->user()->role_id == 3)
                            <a class="dropdown-item wishlist-label d-lg-show pt-2"
                                href="{{ route('vendor.dashboard') }}" style="font-size: small">My Account</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="logout-button" style="font-size: small">
                                    Logout</button>

                            </form>
                        @elseif(auth()->user()->role_id == 1)
                            <a class="dropdown-item wishlist-label d-lg-show pt-2"
                                href="{{ route('vendor.dashboard') }}" style="font-size: small">My Account</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="logout-button"
                                    style="font-size: small;background:none;border:none">
                                    Logout</button>

                            </form>
                        @elseif(auth()->user()->role_id == 4)
                            <a class="dropdown-item wishlist-label d-lg-show pt-2"
                                href="{{ route('marchentiger.dashboard') }}" style="font-size: small">My Account</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="logout-button"
                                    style="font-size: small;background:none;border:none">
                                    Logout</button>

                            </form>
                        @endif
                    @else
                        <a class="dropdown-item wishlist-label d-lg-show" href="{{ route('login') }}"
                            style="font-size: small">Login</a>
                        <a class="dropdown-item wishlist-label d-lg-show" href="{{ route('register') }}"
                            style="font-size: small">Register as Customer</a>
                        <a class="dropdown-item wishlist-label d-lg-show" href="{{ route('vendor.create') }}"
                            style="font-size: small">Register as E-Shop </a>
                        <a class="dropdown-item wishlist-label d-lg-show" href="{{ route('marchentiger.create') }}"
                            style="font-size: small">Register as UKRBD Affiliate </a>

                    @endif
                </div>
            </div>
            <a class="wishlist label-down link d-xs-show" href="{{ route('wishlist.index') }}"
                style="text-decoration: none;">
                <i class="w-icon-heart"></i>
                <span class="wishlist-label d-lg-show">Wishlist</span>
            </a>

            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                <div class="cart-overlay"></div>
                <div class="label-down link" style="text-decoration:none; " onclick="toggleCart()">
                    <i class="w-icon-cart">
                        <span class="cart-count" id="cartQty2">0</span>
                    </i>
                    <span class="cart-label"style="margin-right:-9px; margin-top:8px;">Cart</span>
                </div>
                <div class="dropdown-box d-flex flex-column h-100 justify-content-between   ">
                    <div>
                        <div class="d-flex justify-content-between">
                            <span style="font-size: 18px">Shopping Cart</span>
                            <a href="#" class="" style="font-size: 15px" onclick="toggleCart()">Close<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products">
                            @foreach (Cart::getContent() as $product)
                                <div class="product product-cart" style="overflow: visible;padding:2rem 10px;">
                                    <div class="product-detail">
                                        <a href="#" class="product-name">{{ $product->name }}</a>
                                        <div class="price-box">
                                            <span class="product-quantity">{{ Sohoj::price($product->price) }}</span>
                                            <span class="product-price">{{ $product->quantity }}</span>
                                        </div>
                                    </div>

                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="{{ Voyager::image($product->model->image) }}" alt="product"
                                                height="84" width="94" />
                                        </a>
                                    </figure>
                                    <button class="btn btn-link btn-close" aria-label="button">
                                        <a href="{{ url('/cart-destroy/' . $product->id) }}"><i
                                                class="fas fa-times"></i></a>
                                    </button>
                                </div>
                            @endforeach
                        </div>


                    </div>
                    <div class="">
                        <div class="cart-total">
                            <strong>Subtotal:</strong>
                            <span class="price">{{ Sohoj::price(Cart::getSubTotal()) }}</span>
                        </div>

                        <div class="cart-action justify-content-end">
                            <a href="{{ route('cart') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                </div>
                <!-- End of Dropdown Box -->
            </div>
            <div style="position:relative" class="d-none d-md-block">

                <select class="form-control form-control-sm" id="division-select">
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barishal" {{ session()->get('division') == 'Barishal' ? 'selected' : '' }}>Barishal
                    </option>
                    <option value="Chattogram" {{ session()->get('division') == 'Chattogram' ? 'selected' : '' }}>
                        Chattogram</option>
                    <option value="Dhaka" {{ session()->get('division') == 'Dhaka' ? 'selected' : '' }}>Dhaka
                    </option>
                    <option value="Khulna" {{ session()->get('division') == 'Khulna' ? 'selected' : '' }}>Khulna
                    </option>
                    <option value="Rajshahi" {{ session()->get('division') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi
                    </option>
                    <option value="Rangpur" {{ session()->get('division') == 'Rangpur' ? 'selected' : '' }}>Rangpur
                    </option>
                    <option value="Mymensingh" {{ session()->get('division') == 'Mymensingh' ? 'selected' : '' }}>
                        Mymensingh</option>
                    <option value="Sylhet" {{ session()->get('division') == 'Sylhet' ? 'selected' : '' }}>Sylhet
                    </option>
                </select>
                <i style="font-size: 20px;position:absolute;top:10px;left:12px" class="w-icon-map-marker">

                </i>
            </div>
        </div>
    </div>
</div>
<div class="mb-3 d-md-none">
    <form action="{{ route('shops') }}" method="get" class="input-wrapper d-flex">
        <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
            required />
        <button class="btn btn-search" type="submit">
            <i class="w-icon-search"></i>
        </button>
    </form>
    <div style="position:relative" class="mt-2">

        <select class="form-control form-control-sm" id="division-select2">
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barishal" {{ session()->get('division') == 'Barishal' ? 'selected' : '' }}>Barishal
            </option>
            <option value="Chattogram" {{ session()->get('division') == 'Chattogram' ? 'selected' : '' }}>
                Chattogram</option>
            <option value="Dhaka" {{ session()->get('division') == 'Dhaka' ? 'selected' : '' }}>Dhaka
            </option>
            <option value="Khulna" {{ session()->get('division') == 'Khulna' ? 'selected' : '' }}>Khulna
            </option>
            <option value="Rajshahi" {{ session()->get('division') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi
            </option>
            <option value="Rangpur" {{ session()->get('division') == 'Rangpur' ? 'selected' : '' }}>Rangpur
            </option>
            <option value="Mymensingh" {{ session()->get('division') == 'Mymensingh' ? 'selected' : '' }}>
                Mymensingh</option>
            <option value="Sylhet" {{ session()->get('division') == 'Sylhet' ? 'selected' : '' }}>Sylhet
            </option>
        </select>
        <i style="font-size: 20px;position:absolute;top:10px;left:12px" class="w-icon-map-marker">

        </i>
    </div>
    <div class="dropdown category-dropdown  mt-2" data-visible="false">
        <a href="#" class="text-white category-toggle" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories"
            style="background-color: #2A9CF5 !important;">
            <i class="w-icon-category"></i>
            <span>Browse Categories</span>
        </a>


        <div class="dropdown-box">
            <ul class="menu vertical-menu category-menu">
                @foreach ($categories as $category)
                @if ($category->childrens->count() > 0)
                    <details class="style2" >
                        <summary>{{ $category->name }}</summary>
                        @foreach ($category->childrens as $subChild)
                            <x-category-tree :child="$subChild" />
                        @endforeach
                    </details>
                @else
                    <div class="content">
                        <a href="javascript:void(0)" onclick='updateSearchParams("category","{{ $category->slug }}","{{ $route }}")'>{{ $category->name }}</a>
                    </div>
                @endif
            @endforeach
                <li>

                    <a id="categoryId" class="menu-item-line" style="font-weight: 400"
                        href="javascript:void(0)"
                        onclick='updateSearchParams("category","","{{ $route }}")'>
                        View All Categories<i class="w-icon-angle-right"></i>
                    </a>
                </li>
                {{-- <li>
                <a href="#" class="font-weight-bold text-uppercase ls-25">
                   
                </a>
            </li> --}}
            </ul>

        </div>
    </div>
    
</div>
<script>
    function toggleCart() {
        const cartDropdown = document.querySelector('.cart-dropdown');
        cartDropdown.classList.toggle('opened');
    }
</script>
