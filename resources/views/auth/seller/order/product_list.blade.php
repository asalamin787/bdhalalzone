<x-seller>
    <div class="ec-shop-rightside col-lg-9 col-md-12">
        <div class="ec-vendor-dashboard-card space-bottom-30 shadow-sm" style="border-radius: 12px !important;">
            <div class="ec-vendor-card-header">
                <h5> Order Products</h5>
                {{-- <div class="d-flex">
                    <div class="ec-header-btn">
                        <input class="form-control ec-search-bar" placeholder="Search products..." type="text">

                    </div>
                    <div class="ec-header-btn">
                        <a class="btn  btn-outline-dark" style="height: 47px;line-height: 48px; border:1px solid black"
                            href="#"><i class="fi-rr-filter"></i> Filter</a>
                    </div>


                </div> --}}

            </div>
            <div class="ec-vendor-card-body">
                <div class="row row-cols-1">
                    @foreach($orders as $order )
                    @php
                        
                        $product=App\Models\Product::find($order->product_id);
                        $shipping=json_decode($order->shipping);
                    @endphp
                    <div class="card my-2 border-dark ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
                                    <img src="{{ Voyager::image($product->getImage()) }}" height="200px"
                                        style="object-fit: cover" alt="">
                                </div>
                                <div class="col-md-5 d-flex justify-content-between flex-column">
                                    <h6 class=" pb-2 mb-2 border-bottom border-dark">Order Details: </h6>
                                    <div>
                                        <p class="text-secondary">#{{ $order->id }}</p>
                                        <p class="mt-2 h6">{{ $product->name }} X {{ $order->quantity }}
                                        </p>
                                        <p>
                                        <ul>
                                            @if ($product->variations)
                                                @foreach ($order->product->variations as $varition => $value)
                                                    <li>
                                                        {{ $varition }} : {{ $value }}
                                                    </li>
                                                @endforeach
                                            @endif
                                            <li>
                                                SKU : {{ $product->sku }}
                                            </li>
                                        </ul>
                                        </p>
                                        <p class="h4 mt-3">
                                            {{ Sohoj::price($order->total + $order->platform_fee) }}
                                        </p>
                                    </div>

                                    <p class="mt-3">Order Date : {{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                                    </p>
                                </div>
                                <div class="col-md-5 d-flex justify-content-between flex-column">
                                    <h6 class=" pb-2 mb-2 border-bottom border-dark">Delivery Details: </h6>
                                    
                               
                                    <p>
                                        <strong>{{ $shipping->name }} </strong>
                                        <br>
                                        <a href="mailto:{{ $shipping->email }}">{{ $shipping->email }}</a>
                                        <br>
                                        <a href="tel:{{ $shipping->phone }}">{{ $shipping->phone }}</a>
                                        <br>
                                        <br>
                                        {{ $shipping->zone->name }}, {{ $shipping->area->name }}, {{ $shipping->city->name }}
                                        {{ $shipping->post_code }}
                                        <br>
                                        {{ $shipping->address }}
                                    </p>
                                    <p>
                                        Delivered At : N/A
                                    </p>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer bg-transparent">
                            {{-- @if ($order->status == 1)
                                <a href="{{ route('vendor.order.pickup', $order->id) }}" class="btn btn-link"
                                    style="float:right;"> Ready for pickup <i class="fa fa-truck"></i> </a>
                            @endif
                            <a href="{{ route('vendor.invoice', $order->id) }}" class="btn btn-link"
                                style="float:right;">Invoice</a> --}}
                            @if ($order->status == 1)
                                <a href="{{ route('vendor.order.cancel', $order->id) }}" class="btn btn-link"
                                    style="float:right;">Cancel Order</a>
                            @endif
                        </div>
                        @if($order->status == 0)
                        <span class="badge"
                            style="background-color:#cd5c5c;position:absolute;top:-8px;right:-5px">
                            Pending
                        </span>
                        @endif
                        @if($order->status == 1)
                        <span class="badge"
                            style="background-color:#ffa500;position:absolute;top:-8px;right:-5px">
                            Processing
                        </span>
                        @endif
                        @if($order->status == 2)
                        <span class="badge"
                            style="background-color:#0000ff;position:absolute;top:-8px;right:-5px">
                            On it's way
                        </span>
                        @endif
                        
                        @if($order->status == 3)
                        <span class="badge"
                            style="background-color:#ff0000;position:absolute;top:-8px;right:-5px">
                           Cenceled
                        </span>
                        @endif
                 
                 
                        @if($order->status == 4)
                        <span class="badge"
                            style="background-color:#008000;position:absolute;top:-8px;right:-5px">
                            Delivered
                        </span>
                        @endif
                        @if($order->status == 5)
                        <span class="badge"
                            style="background-color:#cd5c5c;position:absolute;top:-8px;right:-5px">
                            Refund Request
                        </span>
                        @endif

                    </div>
                    @endforeach



                </div>
            </div>

        </div>
    </div>


    <x-slot name="js">
        <script>
            var exampleModal = document.getElementById('exampleModal')
            exampleModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget
                var recipient = button.getAttribute('data-bs-id')
                var modalBodyInput = exampleModal.querySelector('#orderId')

                modalBodyInput.value = recipient
            })
        </script>
    </x-slot>
</x-seller>
