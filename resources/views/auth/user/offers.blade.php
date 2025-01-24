<x-app>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('seller-assets/css/plugins/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('seller-assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('seller-assets/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/seller.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
    </x-slot>
    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <x-app.user_sidebar />
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card space-bottom-30">
                        <div class="ec-vendor-card-header">
                            <h5>Offers</h5>
            
            
                        </div>
            
                        @if (count($offers) == !0)
                            <div class="ec-vendor-card-body">
            
                                <div class="ec-vendor-card-table">
            
            
            
                                    <table class="table ec-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Massage</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Cart</th>
            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offers as $offer)
                                                <tr>
                                                    <th scope="row"><span>{{ $loop->index + 1 }}</span></th>
                                                    <td><span>{{ Sohoj::price($offer->price) }}</span></td>
                                                    <td><span>{{ $offer->massage }}</span></td>
                                                    <td><span>{{ $offer->user->name }}</span></td>
                                                    <td><span>{{ $offer->product->name }}</span></td>
            
                                                    <td>
                                                        @if ($offer->status == 0)
                                                            <span class="bg-warning p-1 d-inline text-white">Pending</span>
                                                        @else
                                                            <span
                                                                class="bg-warning p-1 d-inline text-white">{{ $offer->status == 2 ? 'Decline' : 'Accepted' }}</span>
                                                        @endif
            
            
                                                    </td>
            
                                                    <td>
                                                        @if ($offer->status == 1)
                                                            <a href="{{ route('offer.cart', ['quantity' => 1, 'product_id' => $offer->product->id, 'offer_price' => $offer->price,'offer'=>$offer->id]) }}"
                                                                class="btn btn-dark">View Cart</a>
                                                        @endif
                                                    </td>
            
                                                </tr>
                                            @endforeach
            
            
                                        </tbody>
                                    </table>
            
                                </div>
            
                            </div>
                        @else
                            <h3 class="text-center text-danger">No Items Found</h3>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section> 
</x-app>
