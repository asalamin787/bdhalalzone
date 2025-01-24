@if (!$shop->isComplete())
    @if (!$shop->status)
        <div class="alert alert-primary" role="alert">

            There are some information we need . <a class="btn btn-link p-0" href="">Complete your profile</a> or
            you will not able to sell anything  .

        </div>
    @endif
    @if (!$shop->is_shipping_enabled)
        <div class="alert alert-primary" role="alert">
            Shipping is not set up yet for your shop . <a class="btn btn-link p-0" href="{{route('vendor.shop')}}#courierInfo">Complete your
                profile</a> or you will not able to sell .

        </div>
    @endif
@endif
