@php

    $shipping = json_decode($orders->first()->shipping);
    $shop = App\Models\Shop::find($orders->first()->shop_id);
    $parentOrder = App\Models\Order::where('parent_id', $orders->first()->parent_id)->first();
@endphp



<div class="d-flex justify-content-start mb-2">
    <button onclick="printDiv('printableArea')" class="btn btn-primary">Print this page</button>

</div>

<div id="printableArea">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h2>INVOICE #{{ $orders->first()->id }}</h2>
                    </div>
                    <div class="col-md-4">
                        
                        <h3>

                            {{ $orders->first()->created_at->format('d M, Y') }}
                        </h3>
                        <h4 style="color:{{$orders->first()->getStatus()['color']}};text-transform:uppercase">
                            {{$orders->first()->getStatus()['label']}}
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
                        <p class="text-dark" style="font-size: 16px;">MYEASYMART
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
                                @foreach ($orders as $order)
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
                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr style="border-top: 2px solid black">
                                    <td colspan="3"></td>
                                    <td colspan="" class="h5">Subtotal</td>
                                    <td class="text-center h5">
                                        {{ Sohoj::price($orders->sum('subtotal')) }}
                                    </td>
                                </tr>
                                <tr style="border-top: 2px solid black">
                                    <td colspan="3"></td>
                                    <td colspan="" class="h5">Shipping </td>
                                    <td class="text-center h5">
                                        {{ Sohoj::price($orders->sum('shipping_total')) }}
                                    </td>
                                </tr>
                                <tr style="border-top: 2px solid black">
                                    <td colspan="3"></td>
                                    <td colspan="" class="h4">Total</td>
                                    <td class="text-center h4">
                                        {{ Sohoj::price($orders->sum('total')) }}
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
