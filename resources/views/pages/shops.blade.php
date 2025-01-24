  <x-app>
      @php
          $route = route('shops');
      @endphp

      <x-slot name="css">
          <!-- Vendor CSS -->
          <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
          <!-- Plugins CSS -->
          <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
          <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
          <link rel="stylesheet" type="text/css"
              href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
          <!-- Default CSS -->
          <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">

          <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}?v={{ uniqid() }}">
          <style>
              .rating-input {
                  margin-right: 8px;
                  transform: scale(1.5);
                  height: 13px;
                  width: 13px;
                  accent-color: #f93;
              }

              .category-height {
                  height: 70vh;
                  overflow-y: scroll;
              }

              .category-height::-webkit-scrollbar {
                  width: 12px;
              }

              .category-height::-webkit-scrollbar-track {
                  background: #f1f1f1;
              }

              .category-height::-webkit-scrollbar-thumb {
                  background: #888;
                  border-radius: 6px;
              }

              .category-height::-webkit-scrollbar-thumb:hover {
                  background: #555;
              }

              .category-height {
                  scrollbar-width: thin;
                  scrollbar-color: #eca09a #f1f1f1;
              }

              .category-height {
                  -ms-overflow-style: -ms-autohiding-scrollbar;
              }

              main {
                  background-color: #EEEEEE;
              }

              .sticky-sidebar {
                  padding: 0 10px
              }
              .select-box select, .select-menu select{
                  height: 100% !important;
              }
          </style>
      </x-slot>

      <nav class="breadcrumb-nav">
          <div class="container">
              <ul class="breadcrumb" style="margin-top:5px">
                  <li><a href="{{ route('homepage') }}">Home</a></li>
                  <li><a href="#">Shops</a></li>
              </ul>
          </div>
      </nav>
      <div class="page-content mt-5">
          @if ($parent)
              <div style="position: relative; height: 250px;">
                  <img src="{{ Storage::url($parent->cover) }}" style="height: 100%; width: 100%;" alt="">
                  <div
                      style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                      <h1 style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                          {{ $parent->name }}
                      </h1>
                  </div>
              </div>

              <br>
              <br>
          @endif
          <div class="container">
              @if (request()->filled('parent') && $categories->count())
                  <x-pages.home.categories param="category" :categories="$categories" :route="route('shops')" />
              @endif
              <div class="shop-content row gutter-lg mb-10">
                  <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                      <div class="sidebar-overlay"></div>
                      <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                      <!-- Start of Sidebar Content -->
                      <div class="sidebar-content scrollable">
                          <!-- Start of Sticky Sidebar -->
                          <div class="sticky-sidebar">
                              <div class="filter-actions">
                                  <label>Filter :</label>
                                  <a href="{{ route('shops') }}" class="btn btn-dark btn-link ">Clean All</a>
                              </div>
                              <!-- Start of Collapsible widget -->
                              <div class="widget widget-collapsible category-height">
                                  <h3 class="widget-title"><label>All Categories</label></h3>
                                  <ul class="widget-body filter-items search-ul">
                                      @foreach ($categories as $category)
                                          <li><a style="text-transform: capitalize" href="javascript::void(0)"
                                                  onclick='updateSearchParams("category","{{ $category->slug }}","{{ $route }}")'>{{ $category->name }}
                                                  <small>({{ $category->products_count }})</small></a>
                                          </li>
                                      @endforeach

                                  </ul>
                              </div>
                              <!-- End of Collapsible Widget -->

                              <!-- Start of Collapsible Widget -->
                              <div class="widget widget-collapsible">
                                  <h3 class="widget-title"><label>Price</label></h3>
                                  <div class="widget-body">
                                      <ul class="filter-items search-ul">
                                          <li><a href="javascript::void(0)"
                                                  onclick='updateSearchParams("","","{{ $route }}","0","500")'>0.00
                                                  Tk - 500.00 Tk</a></li>
                                          <li><a href="javascript::void(0)"
                                                  onclick='updateSearchParams("","","{{ $route }}","500","1000")'>500.00
                                                  TK - 1000.00 Tk</a></li>
                                          <li><a href="javascript::void(0)"`
                                                  onclick='updateSearchParams("","","{{ $route }}","1000","5000")'>1000.00
                                                  Tk - 5000.00 Tk</a></li>
                                          <li><a href="javascript::void(0)"
                                                  onclick='updateSearchParams("","","{{ $route }}","5000","10000")'>5000.00
                                                  Tk - 10000.00 Tk</a></li>
                                          <li><a href="javascript::void(0)"
                                                  onclick='updateSearchParams("","","{{ $route }}","10000","")'>10000.00
                                                  Tk +</a></li>
                                      </ul>

                                  </div>
                              </div>
                              <!-- End of Collapsible Widget -->
                              @if ($filters)
                                  @foreach ($filters as $filter)
                                      <div class="widget widget-collapsible">
                                          <h3 class="widget-title"><label>{{ $filter->name }}</label></h3>


                                          <ul class="widget-body filter-items item-check mt-1">
                                              @foreach ($filter->getValue() as $value)
                                                  <li class="" style="margin:10px 0;">
                                                      <label>
                                                          <input class="input" onchange="filterAttributes(this)"
                                                              type="checkbox"
                                                              name="filter[{{ $filter->name }}][{{ $loop->index }}]"
                                                              value="{{ $value }}"
                                                              {{ in_array($value, @request()->filter[$filter->name] ?? []) ? 'checked' : '' }}>
                                                          {{ $value }}
                                                      </label>
                                                  </li>
                                              @endforeach
                                          </ul>

                                      </div>
                                  @endforeach
                              @endif
                              <!-- Start of Collapsible Widget -->
                              <div class="widget widget-collapsible">
                                  <h3 class="widget-title"><label>Rating</label></h3>


                                  <form id="ratingForm" action="{{ $route }}" method="GET">
                                      <ul class="widget-body filter-items item-check mt-1">
                                          @foreach ([5, 4, 3, 2, 1] as $rating)
                                              <li class="{{ request()->ratings == $rating ? 'active' : '' }}"
                                                  style="margin:10px 0;">
                                                  <label>
                                                      <input class="rating-input" type="checkbox" name="ratings"
                                                          value="{{ $rating }}"
                                                          {{ request()->ratings == $rating ? 'checked' : '' }}>
                                                      @for ($i = 0; $i < 5; $i++)
                                                          @if ($i < $rating)
                                                              <i class="fas fa-star" style="color: #f93"></i>
                                                          @else
                                                              <i class="far fa-star" style="color: #f93"></i>
                                                          @endif
                                                      @endfor
                                                  </label>
                                              </li>
                                          @endforeach
                                      </ul>
                                  </form>
                              </div>
                              <!-- End of Collapsible Widget -->




                          </div>
                          <!-- End of Sidebar Content -->
                      </div>
                      <!-- End of Sidebar Content -->
                  </aside>
                  <!-- End of Shop Sidebar -->

                  <!-- Start of Shop Main Content -->
                  <div class="main-content">
                      <nav class="toolbox sticky-toolbox sticky-content fix-top">
                          <div class="toolbox-left">
                              <a href="#"
                                  class="btn  btn-outline btn-rounded left-sidebar-toggle 
                                btn-icon-left d-block d-lg-none"><i
                                      class="w-icon-category"></i><span>Filters</span></a>
                              <div class="toolbox-item toolbox-sort select-box text-dark">
                                  <label>Sort By :</label>
                                  <select name="orderby" class="form-control"
                                      onchange='updateSearchParams("filter_products",this.value,"{{ $route }}")'>
                                      <option value="default" selected="selected">Default sorting</option>
                                      <option value="most-sold"
                                          {{ request()->filter_products == 'most-sold' ? 'selected' : '' }}>Sort by
                                          popularity</option>
                                      <option value="price-low-high"
                                          {{ request()->filter_products == 'price-low-high' ? 'selected' : '' }}>Sort
                                          by pric: low to high</option>
                                      <option value="price-high-low"
                                          {{ request()->filter_products == 'price-high-low' ? 'selected' : '' }}>Sort
                                          by price: high to low</option>
                                  </select>
                              </div>
                          </div>
                          {{-- <div class="toolbox-right">
                              <div class="toolbox-item toolbox-show select-box">
                                  <select name="count" class="form-control">
                                      <option value="9">Show 9</option>
                                      <option value="12" selected="selected">Show 12</option>
                                      <option value="24">Show 24</option>
                                      <option value="36">Show 36</option>
                                  </select>
                              </div>
                              <div class="toolbox-item toolbox-layout">
                                  <a href="shop-banner-sidebar.html" class="icon-mode-grid btn-layout active">
                                      <i class="w-icon-grid"></i>
                                  </a>
                                  <a href="shop-list.html" class="icon-mode-list btn-layout">
                                      <i class="w-icon-list"></i>
                                  </a>
                              </div>
                          </div> --}}
                      </nav>
                      <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                          @include('partials.products', ['products' => $products])

                      </div>


                  </div>
                  <!-- End of Shop Main Content -->
              </div>
              <!-- End of Shop Content -->
          </div>
      </div>
      <!-- End of Page Content -->

  </x-app>
