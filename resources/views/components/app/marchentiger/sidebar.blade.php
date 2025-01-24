<div class="ec-sidebar-wrap ec-border-box">
    <!-- Sidebar Category Block -->
    <div class="ec-sidebar-block shadow-sm">
        <div class="ec-vendor-block " style="position:relative">
            {{-- @dd(auth()->user()->retailer) --}}
            {{-- @if (auth()->user()->retailer)
                <div class="vendor-block-bg"></div>
                <a href="javascript:void(0)" class="shadow-lg"
                    style="position: absolute; top:-11px; right:-11px; background-color: #fff; border-radius:50%;padding:10px 0"
                    data-bs-toggle="modal" data-bs-target="#coverModal"><span class="mx-3">
                        <i class="fas fa-edit"></i></span></a>
            @else --}}
            <img src="{{ asset('assets/images/marchent-banner.jpg') }}" alt="{{ auth()->user()->name }}"
                style="height: 190px;
                                width: 100%;
                                object-fit: cover;">
            {{-- <a href="javascript:void(0)" class="shadow-lg"
                    style="position: absolute; top:-11px; right:-11px; background-color: #fff; border-radius:50%;padding:10px 0"
                    data-bs-toggle="modal" data-bs-target="#coverModal"><span class="mx-3">
                        <i class="fas fa-edit"></i></span></a> --}}
            {{-- @endif --}}

            <div class="ec-vendor-block-detail" style="background-color: snow; position:relative">
                {{-- @if (auth()->user()->retailer)
                    <div style="position: relative;">
                        <img class="v-img img-fluid"
                            src="{{ auth()->user()->retailer && auth()->user()->retailer->logo ? Voyager::image(auth()->user()->retailer->logo) : asset('seller-assets/images/2.jpg') }}"
                            alt="vendor image">
                        <a href="javascript:void(0)" class="shadow-lg"
                            style="position: absolute; top:-70px; right:9px; background-color: #fff; border-radius:50%;padding:10px 0"
                            data-bs-toggle="modal" data-bs-target="#logoModal"><span class="mx-3"><i
                                    class="fas fa-edit"></i></span></a>
                    </div>
                    <!-- <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>><i class="fi-rr-edit"></i></a> -->
                @else
                    <div style="position: relative;">
                        <img class="v-img" src="{{ asset('assets/img/heaer.jpg') }}" style="object-fit: cover;"
                            alt="vendor image">
                        <a href="javascript:void(0)" class="shadow-lg"
                            style="position: absolute; top:-70px; right:9px; background-color: #fff; border-radius:50%;padding:10px 0"
                            data-bs-toggle="modal" data-bs-target="#logoModal"><span class="mx-3"><i
                                    class="fas fa-edit"></i></span></a>
                    </div>
                @endif --}}
                <div style="position: relative;">
                    <img class="v-img" src="{{ asset('assets/images/marchent-logo.png') }}" style="object-fit: cover;"
                        alt="E-shop image">
                    {{-- <a href="javascript:void(0)" class="shadow-lg"
                        style="position: absolute; top:-70px; right:9px; background-color: #fff; border-radius:50%;padding:10px 0"
                        data-bs-toggle="modal" data-bs-target="#logoModal"><span class="mx-3"><i
                                class="fas fa-edit"></i></span></a> --}}
                </div>
                <h5 class="text-dark">{{ auth()->user()->name }}</h5>

            </div>
            <div class="ec-vendor-block-items">
                <ul>
                    <li><a href="{{ route('homepage') }}">Home</a></li>
                    <li><a href="{{ route('marchentiger.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('marchentiger.password.change') }}">Settings</a></li>
                    @if (Auth()->user()->retailer)
                        <li><a href="{{ route('marchentiger.transictions') }}">Transactions</a></li>
                    @endif

                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
