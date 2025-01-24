@extends('voyager::master')
@section('css')
    <style>
        .mt-section {
            margin-top: 40px;
        }

        .table-head {
            border-top: 1px solid #888;
            border-bottom: 1px solid #888;
        }

        .table-head div {
            border-right: 1px solid #888;
        }

        .table-header {
            font-size: 16px;
            text-align: center;
            color: #888;

            padding: 10px;

        }

        .border-l-0 {
            border-right: 0px !important;
        }

        .mb-0 {
            margin-bottom: 0px !important;
        }

        .mt-mid {
            margin-top: 15px;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            border-left: 0;
            border-right: 0;
        }

        .list-group-item:first-child {
            border-top: 0;
        }

        .list-group-item span {
            font-weight: 700;
        }

        .total {
            text-align: end;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            padding-top: 5px;
            margin: 0;
        }

        .total span {

            font-weight: 600;
        }

        .table th {
            padding: 20px 10px !important;
            background-color: #005EAE !important;
            color: white !important;
        }

        .shop-sec-border {
            border-bottom: 1px solid #ddd;
            padding-top: 10px;
        }
        .border-left{
            border-left: 1px solid #ddd;
        }
        .border-right{
            border-right: 1px solid #ddd;
        }
        .shop-info h4 a{
           text-decoration: none;
        }
        .shop-info p{
            margin: 0 0 3px 0;
        }
        .shop-info p span{
            font-weight: 500;
        }
    </style>

@stop
@section('content')
    <div class="page-content browse container-fluid mt-section">
        <h2 style="margin-bottom: 25px" style=""> <i class="icon voyager-dollar"></i> Earnings</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" class="text-center">Information</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($earningsGrouped as $key => $earnings)
              
                                    <tr>
                                        <td scope="row" class="text-center"> {{ $key }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-10 border-right">
                                                    @foreach ($earnings as $key2 => $items)
                                                    @php
                                                        $shop=App\Models\Shop::find($key2);
                                                  
                                                    @endphp
                                                  
                                                        <div class="{{ count($earnings) > 1 ? 'shop-sec-border' : '' }}">
                                                            <div class="row ">
                                                                <div class="col-md-4 shop-info">
                                                                    <img src="{{Voyager::image($shop->logo)}}" alt="">
                                                                    <h4><a target="_blank" href="{{url('admin/shops',$shop->id)}}">{{ $shop->name }}</a></h4>
                                                                    <p> <span >Phone</span> : {{$shop->phone}}</p>
                                                                    <p> <span >Email</span> : {{$shop->email}}</p>
                                                                    
                                                                </div>
                                                                <div class="col-md-8 border-left ">
                                                                    <ul class="list-group">
                                                                        @foreach ($items as $data)
                                                                            <li class="list-group-item"><a target="_blank"
                                                                                    href="{{route('product_details', $data->order->product->slug)}}">{{ $data->order->product->name }}</a>
                                                                                <span> = {{ $data->order->quantity }} X
                                                                                    {{ Sohoj::price($data->order->product_price) }}</span>
                                                                            </li>
                                                                        @endforeach
                                                                        @php
                                                                        $shop_earn=collect($items)->flatten()->sum('shop_earn');
                                                                        $admin_earn=collect($items)->flatten()->sum('admin_earn');
                                                                        $retailer_earn=collect($items)->flatten()->sum('retailer_earn');
                                                                        $total=$shop_earn+$admin_earn+$retailer_earn

                                                                        @endphp
        
        
                                                         

                                                                        <p class="total"><span>Total :</span> {{Sohoj::price($total)}}</p>
                                                                        <p class="total"><span>E-Shop Profit :</span> {{Sohoj::price($shop_earn)}}</p>
                                                                        <p class="total"><span>Admin Profit :</span> {{Sohoj::price($admin_earn - $retailer_earn)}}</p>
                                                                        <p class="total"><span>UKRBD Affiliate :</span> {{Sohoj::price($retailer_earn)}}</p>
                                                                    </ul>
                                                                </div>
                                                            
                                                                
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                   @php
                                                   $admin_total_own=collect($earnings)->flatten()->sum('admin_earn');
                                                   $retailer_total_own=collect($earnings)->flatten()->sum('retailer_earn')

                                                   @endphp
                                                     
                                                   
                                                </div>
                                                <div class="col-md-2 ">
                                                    <p style="font-size: 16px" class="text-center"> <span style="font-weight:600">Your Total Profit  :</span> </p>
                                                    <p style="font-size: 16px" class="text-center"><span style="font-weight:600"> {{Sohoj::price($admin_total_own - $retailer_total_own)}} </span> </p>
                                                </div>
                                            </div>
                                       





                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
