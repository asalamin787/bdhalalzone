<x-marchentiger>

    <div class="ec-shop-rightside col-lg-9 col-md-12">
        <div class="row mb-4">

            <div class="col-md-4">
                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Earn</span>
                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                        {{ Sohoj::price(Sohoj::retailTotalEarn(auth()->user()->retailer)) }}</p>
                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                </div>
            </div>
            <div class="col-md-4">
                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Widthraw</span>
                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                        {{ Sohoj::price(auth()->user()->retailer->total_withdraw) }}</p>
                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                </div>
            </div>

            <div class="col-md-4">
                <div class=" shadow bg-white p-2 text-center" style="border-radius: 12px;">

                    <span class="" style="color:#8B8D97;font-size:14px; ">Total Due</span>
                    <p style="color: #45464E;font-size: 20px;font-weight: 500;margin-top: 16px">
                        {{ Sohoj::price(auth()->user()->retailer->total_own) }}</p>
                    <span class="" style="color:#8B8D97;font-size:14px; "></span>

                </div>
            </div>

        </div>

        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between"
                    style="background-color: #F8D7DA" role="alert">
                    <strong>{{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endforeach
        @endif


        <div class="ec-vendor-dashboard-card space-bottom-30">
            <div class="ec-vendor-card-header row">
                <div class="col-md-9">
                    <h5>Transactions</h5>
                </div>

                <div class="col-md-3">

                    <button type="button" class="btn btn-primary"
                        {{ auth()->user()->retailer->total_own > setting('site.minmum_widthraw_request') ? '' : 'disabled' }}
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Widthraw
                        request</button>
                </div>


            </div>

            @if ($transactions->count() > 0)
                <div class="ec-vendor-card-body">

                    <div class="ec-vendor-card-table">



                        <table class="table ec-table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>

                                    <th scope="col">Created at</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <th scope="row"><span>{{ $loop->index + 1 }}</span></th>
                                        <td><span>{{ Sohoj::price($transaction->amount) }}</span></td>
                                        <td><span>{{ $transaction->status }}</span></td>
                                        <td><span>{{ $transaction->created_at->format('d M, Y') }}</span></td>


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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <form action="{{ route('marchentiger.widthraw.request') }}" method="post">
                    @csrf
                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel">Widthraw Request</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="division" class="form-label">Request amount</label>
                            <input type="number" class="form-control p-2" value="" name="amount" id="amount"
                                required>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-marchentiger>
