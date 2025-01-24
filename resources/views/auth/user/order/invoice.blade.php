@php

    $shipping = json_decode($order->shipping);
    $shop = App\Models\Shop::find($order->shop_id);
    $parentOrder = App\Models\Order::where('parent_id', $order->parent_id)->first();
@endphp
<x-app>

    <x-slot name="css">
        <!-- Vendor CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <style>
            .invoice {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .invoice-container {
                /* max-width: 700px; */
                margin: 0 auto;
                padding: 20px;
                /* background-color: #fff;
                                    border-top: 8px solid #4a4a4a;
                                    border-bottom: 8px solid #4a4a4a;
                                    border-left: 1px solid #ccc;
                                    border-right: 1px solid #ccc;
                                    color: #333; */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                background-color: white;
                font-family: Arial, sans-serif;
            }

            @media print {
                .invoice-container {
                    max-width: 800px;
                    height: auto;
                }
            }

            .invoice-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .invoice-header h2 {
                font-size: 24px;
                margin: 0;
                color: #555;
            }

            .invoice-info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 40px;
            }

            .invoice-info .shop-info {
                flex-grow: 1;
            }

            .invoice-info .shop-info p {
                margin: 0;
                color: #777;
            }

            .invoice-info .customer-info {
                text-align: right;
            }

            .invoice-info .customer-info p {
                margin: 0;
                color: #777;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 40px;
            }

            .invoice-table-shop {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 40px;
            }

            .invoice-table th {
                border-bottom: 2px solid #000;
                padding: 10px;
                text-align: center;
                color: #000;
            }

            .cricle {
                background-color: #000;
                border-radius: 50%;
                height: 10px;
                width: 10px;
            }

            .invoice-table th {
                /* background-color: #f7f7f7; */
            }

            .invoice-total {
                text-align: right;
                margin-bottom: 40px;
            }

            .total-amount {
                font-size: 20px;
                margin: 0;
                color: #555;
            }

            .thank-you {
                text-align: center;
                margin-top: 40px;
                font-style: italic;
                color: #777;
            }

            .shop p {
                font-size: 12px
            }
        </style>
    </x-slot>


    <div class="invoice mt-5 mb-5">
        <div class="col-lg-9 col-md-12">
        
        
        
        
        <div class="d-flex justify-content-start mb-2">
            <button onclick="printDiv('printableArea')" class="btn btn-primary">Print this page</button>
        
        </div>
        
        <div id="printableArea">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>INVOICE #{{ $order->id }}</h2>
                            </div>
                            <div class="col-md-4">
                                
                                <h3>
        
                                    {{ $order->created_at->format('d M, Y') }}
                                </h3>
                                <h4 style="color:{{$order->getStatus()['color']}};text-transform:uppercase">
                                    {{$order->getStatus()['label']}}
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
        
                                <br>
        
                                <p class="text-dark" style="font-size: 16px;">{{ $shipping->name }}
                                    <br>
                                    {{ $shipping->email }}
                                    <br>
                                    {{ $shipping->phone }}
                                    <br>
                                    <br>
                                    {{ $shipping->area->name }}, {{ $shipping->zone->name }}, {{ $shipping->city->name }}
                                    <br>
                                    {{ $shipping->address }}, {{ $shipping->post_code }}
                                </p>
        
                            </div>
                            <div class="col-md-6">
                                <br>
                                <p class="text-dark" style="font-size: 16px;">UKRBD
                                    <br>
                                    info@urkbd.com
                                    <br>
                                    +8801877774081
                                    <br>
                                    <br>
                                    Barishal Sadar
                                    <br>
                                    Barishal, 8200
                                </p>
        
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>
                                                E-Shop
                                            </th>
                                            <th class="text-start">Title</th>
                                            <th class="text-start">Qty</th>
                                            <th class="text-start">Price</th>
                                            <th class="text-start">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                            @php
                                                $product = App\Models\Product::find($order->product_id);
                                                $orderProduct = App\Models\OrderProduct::where('order_id', $order->id)->first();
                                                if ($orderProduct) {
                                                    $variation = $orderProduct->variation
                                                        ? json_decode($orderProduct->variation)
                                                        : null;
                                                } else {
                                                    $variation = null;
                                                }
                                            @endphp
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('voyager.shops.show', $order->shop) }}">{{ $order->shop->name }}</a>
                                                    <br>
                                                    <a href="mailto:{{ $order->shop->email }}">{{ $order->shop->email }}</a>
                                                    <br>
                                                    <a href="tel:{{ $order->shop->phone }}">{{ $order->shop->phone }}</a>
                                                </td>
                                                <td>
                                                    {{ $product->name }}
        
                                                </td>
                                                <td>
                                                    {{ $order->quantity }}
                                                </td>
                                                <td>
                                                    {{ Sohoj::price($product->price) }}
                                                </td>
                                                <td>{{ Sohoj::price($order->subtotal) }}</td>
                                            </tr>
                                    
                                    </tbody>
                                    <tfoot>
        
                                        <tr style="border-top: 2px solid black">
                                            <td colspan="3"></td>
                                            <td colspan="" class="h5">Subtotal</td>
                                            <td class="text-center h5">
                                                {{ Sohoj::price($order->subtotal) }}
                                            </td>
                                        </tr>
                                        <tr style="border-top: 2px solid black">
                                            <td colspan="3"></td>
                                            <td colspan="" class="h5">Shipping </td>
                                            <td class="text-center h5">
                                                {{ Sohoj::price($order->shipping_total) }}
                                            </td>
                                        </tr>
                                        <tr style="border-top: 2px solid black">
                                            <td colspan="3"></td>
                                            <td colspan="" class="h4">Total</td>
                                            <td class="text-center h4">
                                                {{ Sohoj::price($order->total + $order->shipping_total) }}
                                            </td>
                                        </tr>
        
        
        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <script type="text/javascript">
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
        
                document.body.innerHTML = printContents;
        
                window.print();
        
                document.body.innerHTML = originalContents;
            }
        </script>
        
        </div>
    </div>

</x-app>
