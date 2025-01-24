<div class="title-link-wrapper title-deals appear-animate mb-5 mt-3 ">



    <a href="{{ route('shops') }}" class="ml-0">More Categories<i class="w-icon-long-arrow-right"></i></a>
</div>

<div class="container mb-5" style="overflow:hidden;position:relative">


    <div class="category-swiper-container d-md-block d-none">
        <div class="swiper-wrapper">
            @foreach ($categories->chunk(16) as $row)
                <div class="swiper-slide">
                    <div class="categories-row mx-auto">
                        @foreach ($row as $category)
                            <div class="category category-classic overlay-zoom br-xs"
                                onclick='updateSearchParams("{{ $param }}","{{ $category->slug }}","{{ $route }}",null,null,"_taget")'>
                                <a href="javascript:void(0)"
                                    onclick='updateSearchParams("{{ $param }}","{{ $category->slug }}","{{ $route }}",null,null,"_taget")'
                                    class="category-media">
                                    <img src="{{ Voyager::image($category->logo) }}" alt="Category"
                                        style="height: 30px !important;width:30px !important;">
                                </a>
                                <p class="px-1 text-center text-dark">{{ $category->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="category-swiper-container d-block d-md-none">
        <div class="swiper-wrapper">
            @foreach ($categories->chunk(8) as $row)
                <div class="swiper-slide">
                    <div class="categories-row mx-auto">
                        @foreach ($row as $category)
                            <div class="category category-classic overlay-zoom br-xs"
                                onclick='updateSearchParams("{{ $param }}","{{ $category->slug }}","{{ $route }}",null,null,"_taget")'>
                                <a href="javascript:void(0)"
                                    onclick='updateSearchParams("{{ $param }}","{{ $category->slug }}","{{ $route }}",null,null,"_taget")'
                                    class="category-media">
                                    <img src="{{ Voyager::image($category->logo) }}" alt="Category"
                                        style="height: 30px !important;width:30px !important;">
                                </a>
                                <p class="px-1 text-center text-dark">{{ $category->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Navigation Controls -->
    @if ($categories->count() > 12)
        <div class="nav-prev"><i class="fa fa-2x fa-chevron-left"></i></div>
        <div class="nav-next"><i class="fa fa-2x fa-chevron-right"></i></div>
    @endif
</div>



<!-- End of Icon Category Wrapper -->
