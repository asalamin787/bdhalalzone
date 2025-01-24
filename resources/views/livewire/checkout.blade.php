<main class="main checkout container">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="{{ route('cart') }}">Shopping Cart</a></li>
                <li class="active"><a href="{{ route('checkout') }}">Checkout</a></li>
                <li><a href="#">Order Complete</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            @if (!Auth()->check())
                <div class="">
                    Returning customer? <a href="{{ route('login') }}"
                        class=" font-weight-bold text-uppercase text-dark">Login</a>
                </div>
            @endif

            @if (!session()->has('discount'))
                <div class="coupon-toggle"> Have a coupon?
                    <a href="#" class="show-coupon font-weight-bold text-uppercase text-dark">Enter your
                        code</a>
                </div>

                <div class="coupon-content mb-4">
                    <p>If you have a coupon code, please apply it below.</p>

                    <form action="{{ route('coupon') }}" method="POST">
                        @csrf
                        <div class="input-wrapper-inline">
                            <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2"
                                placeholder="Coupon code" id="coupon_code">
                            <button type="submit" class="btn button btn-rounded btn-coupon mb-2">Apply
                                Coupon</button>
                        </div>
                    </form>

                </div>
            @endif


            <form class="form checkout-form" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row mb-9">
                    <div class="col-lg-7 pr-lg-4 mb-4">
                        <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                            Billing & Shipping Details
                        </h3>

                        <div class="row gutter-sm">
                            <div class="col-xs-12" wire:ignore>
                                <x-forms.input type="text" label=" Name *" placeholder="eg: Kazi Rayhan"
                                    name="name" :value="old('name',@auth()->user()->name)" />
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12" wire:ignore>

                                
                                <x-forms.input type="text" label="Phone *" placeholder="eg: 017XXXXX431"
                                    name="phone" :value="old('phone',@auth()->user()->phone)" />
                            </div>
                            <div class="col-md-6 col-12 " wire:ignore>

                                <x-forms.input type="email" label="Email" placeholder="eg: example@mail.com"
                                    name="email" :value="old('email',@auth()->user()->email)" />
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-4 col-12">
                                <x-forms.input type="select" label="City *" :disabled="count($cities) ? false : true" wire:model="selectedCity" name="city" :options="$cities" :value="old('city')" />
                            </div>
                            <div class="col-md-4 col-12">
                                <x-forms.input type="select" label="Zone *" :disabled="count($zones) ? false : true" wire:model="selectedZone" name="zone" :options="$zones"  :value="old('zone')"/>

                            </div>
                            <div class="col-md-4 col-12">
                                <x-forms.input type="select" label="Area *" :disabled="count($areas) ? false : true" wire:model="selectedArea" name="area" :options="$areas"  :value="old('area')"/>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.input type="text" label="Post Code *" wire:ignore name="post_code" :value="old('post_code')" placeholder="eg: 1000"/>
                            </div>
                            <div class="col-md-8">
                                <x-forms.input type="text" label="Address *" wire:ignore
                                placeholder="eg: Commerce College Rd, Savar, Dhaka" name="address" :value="old('address')" />
                                <small>Atleast 10 character long</small>
                            </div>
                        </div>
                      
                        <div class="form-group mt-3">
                            <label for="order-notes">Order notes (optional)</label>
                            <textarea wire:ignore class="form-control mb-0" id="order-notes" name="order_notes" cols="30" rows="4"
                                placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                        </div>
                    </div>
                    @if (session()->get('division'))
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            <h3 class="title text-uppercase ls-10">Your Order</h3>
                            <div class="order-summary">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <b>Product</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::getContent() as $item)
                                            <tr class="bb-no">
                                                <td class="product-name" style="
                                                white-space: normal;
                                            ">{{ $item->name }}<i class="fas fa-times"></i>
                                                    <span class="product-quantity">{{ $item->quantity }}</span>
                                                </td>
                                                <td class="product-total">{{ Sohoj::price($item->price) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="cart-subtotal">
                                            <td>
                                                Subtotal
                                            </td>
                                            <td>
                                                {{ Sohoj::price(Cart::getSubTotal()) }}
                                            </td>
                                        </tr>
                                        @if (session()->has('discount'))
                                            <tr class="cart-subtotal">
                                                <td>
                                                    Discount <a href="{{ route('coupon.destroy') }}"
                                                        class="text-danger ml-2"
                                                        style="text-decoration: underline;font-size:12px;color:red">Delete</a>
                                                </td>
                                                <td>
                                                    {{ Sohoj::price(Sohoj::discount()) }}
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr class="shipping-methods">
                                            <td class="">
                                                <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                </h4>
                                                <ul id="shipping-method" class="mb-4">

                                                   
                                                    <li>
                                                        <div class="custom-radio" style="line-height:1;">
                                                            <input type="radio" id="flat-rate"
                                                                class="custom-control-input" value="home_delivery" name="shipping" readonly checked>
                                                            <label for="flat-rate"
                                                                class="custom-control-label color-dark">Home
                                                                Delivery</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <b>
                                                    {{ Sohoj::price($shippingCost) }}
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b>{{ Sohoj::price(Sohoj::newSubtotal() + $shippingCost) }}</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="payment-methods" id="payment_method">
                                    <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                     {{-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="card" id="payment_method_card" checked />
                                        <label class="form-check-label" for="payment_method_card"> Card / Mobile Banking / Wallet </label>
                                     </div> --}}
                                     <div class="form-check">
                                        <input  class="form-check-input" type="radio" name="payment_method" value="cod" id="payment_method_cod" checked/>
                                        <label class="form-check-label" for="payment_method_cod"> Cash on delivery </label>
                                     </div>
                                     
                                    </div>
                                </div>

                                <input type="hidden" name="order[shipping]" value="0">
                                <input type="hidden" name="order[subtotal]" value="{{ Cart::getSubTotal() }}">
                                <input type="hidden" name="order[total]" value="{{ Cart::getTotal() }}">
                                <div class="form-group place-order pt-6">
                                    <button type="submit" class="btn btn-dark btn-primary btn-rounded"
                                        style="width:100%">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            @if ($selectedArea)
                            <h3 class="title text-uppercase ls-10">Your Order</h3>
                            <div class="order-summary">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <b>Product</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::getContent() as $item)
                                            <tr class="bb-no">
                                                <td class="product-name" style="
                                                white-space: normal;
                                            ">{{ $item->name }}<i class="fas fa-times"></i>
                                                    <span class="product-quantity">{{ $item->quantity }}</span>
                                                </td>
                                                <td class="product-total">{{ Sohoj::price($item->price) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="cart-subtotal">
                                            <td>
                                                Subtotal
                                            </td>
                                            <td>
                                                {{ Sohoj::price(Cart::getSubTotal()) }}
                                            </td>
                                        </tr>
                                        @if (session()->has('discount'))
                                            <tr class="cart-subtotal">
                                                <td>
                                                    Discount <a href="{{ route('coupon.destroy') }}"
                                                        class="text-danger ml-2"
                                                        style="text-decoration: underline;font-size:12px;color:red">Delete</a>
                                                </td>
                                                <td>
                                                    {{ Sohoj::price(Sohoj::discount()) }}
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr class="shipping-methods">
                                            <td class="">
                                                <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                </h4>
                                                <ul id="shipping-method" class="mb-4">

                                                   
                                                    <li>
                                                        <div class="custom-radio">
                                                            <input type="radio" id="flat-rate"
                                                                class="custom-control-input" value="home_delivery" name="shipping" readonly checked>
                                                            <label for="flat-rate"
                                                                class="custom-control-label color-dark">Home
                                                                Delivery</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <b>
                                                    {{ Sohoj::price($shippingCost) }}
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b>{{ Sohoj::price(Sohoj::newSubtotal() + $shippingCost) }}</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="payment-methods" id="payment_method">
                                    <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                     {{-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="card" id="payment_method_card" checked />
                                        <label class="form-check-label" for="payment_method_card"> Card / Mobile Banking / Wallet </label>
                                     </div> --}}
                                     <div class="form-check">
                                        <input checked class="form-check-input" type="radio" name="payment_method" value="cod" id="payment_method_cod" />
                                        <label class="form-check-label" for="payment_method_cod"> Cash on delivery </label>
                                     </div>
                                     
                                    </div>
                                </div>

                                <input type="hidden" name="order[shipping]" value="{{ $orderPaymentInfo['shipping'] }}">
                                <input type="hidden" name="order[subtotal]" value="{{ $orderPaymentInfo['subtotal'] }}">
                                <input type="hidden" name="order[total]" value="{{ $orderPaymentInfo['total'] }}">
                                <div class="form-group place-order pt-6">
                                    <button type="submit" class="btn btn-dark btn-primary btn-rounded"
                                        style="width:100%">Place
                                        Order</button>
                                </div>
                            </div>
                            @else
                            <div
                                class="alert alert-primary "
                                role="alert"
                            >
                             <i class="fa fa-info-circle mr-2"></i>   <span>Select shipping area</span> 
                            </div>
                            
                            @endif

                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
