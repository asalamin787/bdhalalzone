<x-app>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" type="text/css" href="assets/vendor/magnific-popup/magnific-popup.min.css">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.min.css">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">

        <style>
            .btn-checkout{
                color: #ffffff;
                background-color: #cd1921;
                border: #cd1921;
            }
            .btn-checkout:hover{
                color: #ffffff;
                background-color: #00A6E9;
                border: #00A6E9;
            }
            .coupon11:hover{
                color: #ffffffb !important;
                background-color: #00A6E9 !important;
                border: #00A6E9 !important;
            }
        </style>
    </x-slot>

    <main class="main cart container">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="{{ route('cart') }}">Shopping Cart</a></li>
                    <li><a href="{{ route('checkout') }}">Checkout</a></li>
                    <li><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-quantity"><span>Quantity</span></th>
                                    <th class="product-subtotal"><span>Subtotal</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::getContent() as $product)
                        
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{route('product_details',$product->model->slug)}}">
                                                    <figure>
                                                        <img src="{{ Voyager::image($product->model->image) }}"
                                                            alt="product" width="300" height="118">
                                                    </figure>
                                                </a>
                                                <button class="btn btn-close">
                                                    <a href="{{ url('/cart-destroy/' . $product->id) }}"><i
                                                            class="fas fa-times"></i></a>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{route('product_details',$product->model->slug)}}">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td class="product-price"><span
                                                class="amount">{{ Sohoj::price($product->price) }}</span></td>
                                        <td class="product-quantity">
                                            <form method="POST" action="{{ route('cart.update') }}">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                                    <input value="{{ $product->quantity }}" min="1"
                                                        class=" form-control" type="number" name="quantity">
                                                    <button type="submit" class=" btn-apply bg-dark text-white">update</button>
                                                    {{-- <button class="quantity-minus w-icon-minus"></button> --}}
                                                </div>
                                            </form>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">{{ $product->quantity * $product->price }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <div class="cart-action mb-6">
                            <a href="{{route('shops')}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping btn-checkout mr-auto"><i
                                    class="w-icon-long-arrow-left "></i>Continue Shopping</a>
                            <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart"
                                value="Clear Cart">Clear Cart</button>
                            <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart"
                                value="Update Cart">Update Cart</button>
                        </div> --}}
                        @if (!session()->has('discount'))
                            <form class="coupon" action="{{ route('coupon') }}" method="POST">
                                @csrf
                                <h5 class="title coupon-title font-weight-bold text-uppercase mt-5">Coupon Discount</h5>
                                <input type="text" class="form-control mb-4" name="coupon_code" placeholder="Enter coupon code here..."
                                    required />
                                <button type="submit" class="btn btn-dark btn-outline btn-rounded coupon11">Apply
                                    Coupon</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <div class="cart-summary mb-4">
                                <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label class="ls-25">Subtotal</label>
                                    <span>{{ Sohoj::price(Cart::getSubTotal()) }}</span>
                                </div>
                                @if (session()->has('discount'))
                                <hr class="divider">
                                
                              
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label class="ls-25">Discount <a href="{{route('coupon.destroy')}}" class="text-danger ml-2" style="text-decoration: underline;font-size:12px;color:red">Delete</a></label>
                                    <span>{{ Sohoj::price(Sohoj::discount()) }}</span>
                                </div>

                                @endif
                                {{-- <div class="shipping-calculator">
                                    <p class="shipping-destination lh-1">Shipping to <strong>CA</strong>.</p>

                                    <form class="shipping-calculator-form">
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select name="country" class="form-control form-control-md">
                                                    <option value="default" selected="selected">United States
                                                        (US)
                                                    </option>
                                                    <option value="us">United States</option>
                                                    <option value="uk">United Kingdom</option>
                                                    <option value="fr">France</option>
                                                    <option value="aus">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select name="state" class="form-control form-control-md">
                                                    <option value="default" selected="selected">California
                                                    </option>
                                                    <option value="ohaio">Ohaio</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-md" type="text"
                                                name="town-city" placeholder="Town / City">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-md" type="text" name="zipcode"
                                                placeholder="ZIP">
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-outline btn-rounded">Update
                                            Totals</button>
                                    </form>
                                </div> --}}

                                <hr class="divider mb-6">
                                <div class="order-total d-flex justify-content-between align-items-center">
                                    <label>Total</label>
                                    <span class="ls-50">{{ Sohoj::price(Sohoj::newSubtotal()) }}</span>
                                </div>
                                <a href="{{route('checkout')}}"
                                    class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                    Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

    <x-slot name="js">
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/sticky/sticky.js"></script>
        <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/main.min.js"></script>
    </x-slot>
</x-app>
