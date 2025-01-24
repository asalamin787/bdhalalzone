<div class="title-link-wrapper appear-animate mt-10 mb-4">
    <h2 class="title title-link pt-1">{{ $title }}</h2>
    <a href="{{ route('shops') }}" class="ls-normal">More Products<i class="w-icon-long-arrow-right"></i></a>
</div>

<div class=" row cols-lg-5 cols-md-4 cols-sm-3 cols-2">

    @foreach ($products as $product)
        <x-products.card :product="$product" />
    @endforeach
    <!-- End of Product Wrap -->
</div>
