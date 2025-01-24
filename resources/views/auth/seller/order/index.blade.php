<x-seller>
    <div class="ec-shop-rightside col-lg-9 col-md-12">
        <div class="ec-vendor-dashboard-card space-bottom-30 shadow-sm" style="border-radius: 12px !important;">
            <div class="ec-vendor-card-header">
                <h5>Customer Orders</h5>
                <div class="d-flex">
                    <div class="ec-header-btn">
                        <input class="form-control ec-search-bar" placeholder="Search products..." type="text">

                    </div>
                    <div class="ec-header-btn">
                        <a class="btn  btn-outline-dark" style="height: 47px;line-height: 48px; border:1px solid black"
                            href="#"><i class="fi-rr-filter"></i> Filter</a>
                    </div>


                </div>

            </div>
            <div class="ec-vendor-card-body">
                <div class="row row-cols-1">

                    {{-- <div class="card my-2 border-dark ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
                                        <img src="{{ Voyager::image($order->product->getImage()) }}" height="200px"
                                            style="object-fit: cover" alt="">
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-between flex-column">
                                        <h6 class=" pb-2 mb-2 border-bottom border-dark">Order Details: </h6>
                                        <div>
                                            <p class="text-secondary">#{{ $order->id }}</p>
                                            <p class="mt-2 h6">{{ $order->product->name }} X {{ $order->quantity }}
                                            </p>
                                            <p>
                                            <ul>
                                                @if ($order->product->variations)
                                                @foreach ($order->product->variations as $varition => $value)
                                                    <li>
                                                        {{ $varition }} : {{ $value }}
                                                    </li>
                                                @endforeach
                                                @endif
                                                <li>
                                                    SKU : {{ $order->product->sku }}
                                                </li>
                                            </ul>
                                            </p>
                                            <p class="h4 mt-3">
                                                {{ Sohoj::price($order->total + $order->platform_fee) }}
                                            </p>
                                        </div>

                                        <p class="mt-3">Order Date : {{ $order->created_at->format('d M, Y h:i A') }}
                                        </p>
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-between flex-column">
                                        <h6 class=" pb-2 mb-2 border-bottom border-dark">Delivery Details: </h6>

                                        <p>
                                            <strong>{{ $order->full_name }}</strong>
                                            <br>
                                            <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                                            <br>
                                            <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                                            <br>
                                            <br>
                                            {{ $order->zone }}, {{ $order->area }}, {{ $order->city }}
                                            {{ $order->post_code }}
                                            <br>
                                            {{ $order->address }}
                                        </p>
                                        <p>
                                            Delivered At : N/A
                                        </p>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer bg-transparent">
                                @if ($order->status == 1)
                                    <a href="{{ route('vendor.order.pickup', $order) }}" class="btn btn-link"
                                        style="float:right;"> Ready for pickup <i class="fa fa-truck"></i> </a>
                                @endif
                                <a href="{{ route('vendor.invoice', $order->id) }}" class="btn btn-link"
                                    style="float:right;">Invoice</a>
                                @if ($order->status == 1)
                                    <a href="{{ route('vendor.invoice', $order->id) }}" class="btn btn-link"
                                        style="float:right;">Cancel Order</a>
                                @endif
                            </div>
                            <span class="badge"
                                style="background-color: {{ $order->getStatus()['color'] }};position:absolute;top:-8px;right:-5px">
                                {{ $order->getStatus()['label'] }}
                            </span>

                        </div> --}}

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Adress</th>
                                <th scope="col">Items</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($latest_orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $order->first()->full_name }}</td>
                                    <td>{{ $order->first()->email }}</td>
                                    <td>{{ $order->first()->phone }}</td>
                                    <td>

                                        {{ $order->first()->zone }}, {{ $order->first()->area }},
                                        {{ $order->first()->city }}
                                        {{ $order->first()->post_code }}
                                    </td>
                                    <td>{{ $order->count() }}</td>
                                    <td>
                                        <div class="d-flex">

                                            <a class="btn btn-success btn-sm p-2 pt-0 m-1"
                                                href="{{ route('vendor.order.products') }}?ids={{ json_encode($order->pluck('id')) }}&parent={{ $order->first()->parent_id }}">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            @php
                                                $allOrdersStatusOne = $order->every(function ($item) {
                                                    return $item->status == 1;
                                                });
                                            @endphp



                                            <a href="{{ route('vendor.invoice') }}?ids={{ json_encode($order->pluck('id')) }}&parent={{ $order->first()->parent_id }}"
                                                class="btn btn-info btn-sm p-2 m-1 pt-0">
                                                Invoice
                                            </a>



                                        </div>
                                   
                                        @if ($allOrdersStatusOne)
                                     
                                            @if ($order->first()->parent->shipping_method == 'home_delivery')
                                                <a style="font-size: 12px"
                                                    href="{{ route('vendor.order.delivered', $order->first()->parent_id) }}"
                                                    class="btn btn-warning btn-sm p-2 pt-0 m-1">
                                                    Complete deliver
                                                </a>
                                            @endif
                                            @if ($order->first()->parent->shipping_method == 'pathao')
                                                <a style="font-size: 12px"
                                                    href="{{ route('vendor.order.pickup', $order->first()->parent_id) }}"
                                                    class="btn btn-warning btn-sm p-2 pt-0 m-1">
                                                    Ready for pickup
                                                </a>
                                            @endif
                                        @endif
                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            {{-- <div class="ec-vendor-card-body">
                <div class="ec-vendor-card-table">
                    <table class="table ec-table table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order Total</th>
                                <th scope="col">Order Date</th>



                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_orders as $order)
                                <tr>
                                    <td><span> <a href="{{ route('vendor.orderView', $order) }}"
                                                style="text-decoration: underline;">{{ $order->id }}</a> </span>
                                    </td>
                                    <th scope="row"><span>{{ $order->full_name }} </span></th>
                                    <td><a
                                            href="{{ route('vendor.orderView', $order) }}">{{ $order->product->name }}</a>
                                    </td>

                                    <td>

                                    </td>
                                    <td><span>{{ Sohoj::price($order->total + $order->platform_fee) }}</span></td>
                                    <td><span>{{ $order->created_at->format('M-d-Y') }}</span></td>

                                    <td class="">
                                        <div class="d-flex align-items-center">



                                            <div class="dropdown me-2">
                                                <button class="btn btn-dark dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown{{ $order->id }}" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" id="dropdown{{ $order->id }}">
                                                    <li class="d-flex justify-content-center mb-2"><a
                                                            href="{{ route('vendor.order.action', ['order' => $order->id]) }}"
                                                            class="btn btn-outline-dark border">Deliver
                                                            <i class="fa-solid fa-truck-ramp-box"></i></a></li>
                                                    <li class="d-flex justify-content-center mb-2"><a
                                                            href="{{ route('vendor.order.cancel', ['order' => $order->id]) }}"
                                                            class="btn btn-outline-dark border">Cancel
                                                            <i class="fa-solid fa-ban"></i></a></li>
                                                    <li class="d-flex justify-content-center"><span class="pt-0"><a
                                                                href="{{ route('vendor.invoice', $order->id) }}"
                                                                class="btn btn-dark">Invoice <i
                                                                    class="fa-solid fa-receipt"></i></a> </span></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                    </td>

                                </tr>
                            @endforeach




                        </tbody>


                    </table>

                </div>
            </div> --}}
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
