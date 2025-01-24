@foreach ($products as $product)
    <x-products.card :product="$product" />
@endforeach
