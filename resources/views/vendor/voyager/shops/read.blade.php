@php
    $earningqueries = App\Models\Earning::where('shop_id', $dataTypeContent->id)
        ->orderBy('created_at', 'desc')
        ->get();
    $earnings = $earningqueries->groupBy(function ($item) {
        return Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
    });

@endphp
@extends('voyager::master')

@section('page_title', __('voyager::generic.view') . ' ' . $dataType->getTranslatedAttribute('display_name_singular'))

{{-- @dd($dataTypeContent) --}}
@section('css')
    <style>
        hr {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .row>[class*=col-] {
            margin-bottom: 10px;
        }

        .rounded-circle {
            border-radius: 100%;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .custom-card {
            border-radius: 20px !important;
            box-shadow: 0px -5px 0px #007CC5 !important;

        }

        .widget {
            padding: 20px;
            min-height: 180px;
            width: 100%;
            background-color: #fff;
            box-shadow: 5px 5px 0px #007CC5;
            position: relative;
            border-radius: 10px;

            border: 2px solid #fff;
            margin-bottom: 10px;
            transition: .2s ease-in;
        }

        .widget:hover {
            border: 2px solid #007CC5;

            box-shadow: 5px 5px 0px #007CC5;
        }

        .widget:hover i,
        .widget:hover svg {
            filter: blur(0px);
            opacity: 1;
            transform: scale(1.3);
        }

        .widget * {
            padding: 0px;
            margin: 0px;
        }

        .widget h6 {
            color: #D37676;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .widget h2 {
            color: #756AB6;
            font-size: 40px;
        }

        .widget i,
        .widget svg {
            color: #D37676;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 40px;
            filter: blur(1px);
            opacity: 0.2;
            transition: .5s ease-in;
        }

        .widget a {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 12px;
            color: #fff;
            background-color: #756AB6;
            padding: 5px 10px;
            border-radius: 5px;
            transition: .1s ease-in;
        }

        .widget a:hover {
            background-color: #D37676;

        }
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

        .custom-table {
            padding: 20px 10px !important;
            background-color: #005EAE !important;
            color: white !important;
        }
        .border-right{
            border-right: 1px solid #ddd;
        }

       
    </style>

@stop
@section('page_header')
    {{-- <h1 class="page-title">
        <span class="icon voyager-company"></span> {{ $dataTypeContent->name }}
    </h1> --}}
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid" style="margin-top: 35px;">
        <div class="row">
            <div class="col-md-12">

                <div class="" style="padding-bottom:5px;">

                    <div class="row gutters-sm">
                        <div class="col-md-5 mb-3">
                            <div class="panel custom-card">
                                <div class="panel-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ Voyager::image($dataTypeContent->logo) }}" alt="Admin"
                                            class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4>{{ $dataTypeContent->name }}</h4>

                                            <p class="text-muted font-size-sm">
                                                {{ $dataTypeContent->post_code }},{{ $dataTypeContent->city }}</p>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Company Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $dataTypeContent->company_name }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $dataTypeContent->email }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Phone</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $dataTypeContent->phone }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Pickup Address</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">

                                                    {{ json_decode($dataTypeContent->pickup_address)->address ?? null }}
                                                </div>
                                            </div>
                                            <hr>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="widget">
                                        <h6>
                                            Total Sell :
                                        </h6>
                                        <h2>
                                            {{ Sohoj::price(Sohoj::shopTotalEarn($dataTypeContent)) }}
                                        </h2>
                                        {{-- <i class="icon voyager-basket"></i> --}}
                                        <svg height="40" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                        {{-- <a href="{{ url('admin/orders') }}">View</a> --}}
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="widget">
                                        <h6>
                                            Total Withdraw :
                                        </h6>
                                        <h2>
                                            {{ Sohoj::price($dataTypeContent->total_withdraw) }}
                                        </h2>

                                        {{-- <i class="icon voyager-basket"></i> --}}
                                        <svg height="40" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                        {{-- <a href="{{ url('admin/orders') }}">View</a> --}}
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="widget">
                                        <h6>
                                            Total Due :
                                        </h6>
                                        <h2>
                                            {{ Sohoj::price($dataTypeContent->total_own) }}
                                        </h2>

                                        {{-- <i class="icon voyager-basket"></i> --}}
                                        <svg height="40" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                        {{-- <a href="{{ url('admin/orders') }}">View</a> --}}
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @if($earnings->count() > 0)
                    <div class="panel">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center custom-table">Date</th>
                                    <th scope="col" class="text-center custom-table">Information</th>
    
    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($earnings as $key => $earning)
              
                                    <tr>
                                        <td scope="row" class="text-center"> {{ $key }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    @foreach ($earning as $key2 => $data)
                                                 
                                                  
                                                        <div >
                                                            <div class="row ">
                                                           
                                                                <div class="col-md-6 border-left border-right">
                                                                    <ul class="list-group">
                                                                       
                                                                            <li class="list-group-item"><a target="_blank"
                                                                                    href="{{route('product_details', $data->order->product->slug)}}">{{ $data->order->product->name }}</a>
                                                                                <span> = {{ $data->order->quantity }} X
                                                                                    {{ Sohoj::price($data->order->product_price) }}</span>
                                                                            </li>
                                                                       
                                                                        @php
                                                                        $shop_earn=collect($earning)->flatten()->sum('shop_earn');
                                                                        $admin_earn=collect($earning)->flatten()->sum('admin_earn');
                                                                        $retailer_earn=collect($earning)->flatten()->sum('retailer_earn');
                                                                        $total=$shop_earn+$admin_earn+$retailer_earn
    
                                                                        @endphp
        
        
                                                         
    
                                                                        <p class="total"><span>Total :</span> {{Sohoj::price($total)}}</p>
                                                                        
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <table class="table">
                                                                        <thead>
                                                                          <tr>
                                                                            
                                                                            <th scope="col">Shop Profit</th>
                                                                            <th scope="col">Admin Profit</th>
                                                                            <th scope="col">Retailer Profit</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          <tr>
                                                                           
                                                                            <td>{{Sohoj::price($shop_earn)}}</td>
                                                                            <td>{{Sohoj::price($admin_earn - $retailer_earn)}}</td>
                                                                            <td>{{Sohoj::price($retailer_earn)}}</td>
                                                                          </tr>
                                                                      
                                                                        </tbody>
                                                                      </table>
                                                                </div>
                                                            
                                                                
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                   @php
                                                   $admin_total_own=collect($earnings)->flatten()->sum('admin_earn');
                                                   $retailer_total_own=collect($earnings)->flatten()->sum('retailer_earn')
    
                                                   @endphp
                                                     
                                                   
                                                </div>
                                           
                                            </div>
                                       
    
    
    
    
    
                                        </td>
    
    
                                    </tr>
                                @endforeach
    
                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
