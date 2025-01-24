@props(['products', 'pagination' => true])
<div class="ec-vendor-dashboard-card space-bottom-30">
    <div class="ec-vendor-card-header">
        <h5>Latest Products</h5>
        <div class="ec-header-btn">
            <a href="{{ route('vendor.category_list') }}" class="btn btn-primary">Category List</a>
            <a href="{{ route('vendor.products.export') }}" class="btn btn-primary">Export Products</a>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="btn btn-lg btn-primary">Import</a>
            <a class="btn btn-lg btn-primary" href="{{ route('vendor.create.product') }}">Create Product</a>
        </div>

    </div>
    <form action="" method="get">
        <div class="row mt-2 justify-content-end me-3">
            <div class="input-group mb-3 col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search product">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text h-100" id="basic-addon2">Search</button>
                </div>
            </div>
        </div>
    </form>
    @if (count($products) == !0)
        <div class="ec-vendor-card-body">

            <div class="ec-vendor-card-table">



                <table class="table ec-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            if ($pagination) {
                                $i = $products->perPage() * ($products->currentPage() - 1) + 1;
                            } else {
                                $i = 1;
                            }
                        @endphp
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row"><span>{{ $i }}</span></th>

                                @php
                                    $i++;
                                @endphp
                                <td> <a href="{{ $product->path() }}"><img class="prod-img"
                                            src="{{ Voyager::image($product->image) }}" alt="product image"></a></td>
                                <td><a href="{{ $product->path() }}"><span>{{ $product->name }}</span></a>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($product->prodcats as $prodcat)
                                            <li>
                                                {{ $prodcat->name }}
                                                {{ $prodcat->parent ? '- ' . $prodcat->parent->name : '' }}
                                            </li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td><span>{{ $product->status == 0 ? 'Pending' : 'Active' }}</span></td>
                                <td><span>{{ Sohoj::price($product->sale_price ?? $product->price) }}</span></td>

                                <td>
                                    <div class="d-flex gap-2">


                                        <a class="btn btn-primary"
                                            href="{{ route('vendor.product.edit', $product->slug) }}"> <i
                                                class="fas fa-edit"></i></a>

                                        <x-delete route="{{ route('vendor.products.delete', $product->id) }}" />
                                    </div>

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
    @if ($pagination)
        {{ $products->links() }}
    @endif
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title " id="exampleModalLabel">Import Products</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vendor.products.import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-5">
                        <label>Excel File *</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                            id="file" value="{{ old('file') }}" required>
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
