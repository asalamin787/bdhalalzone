<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="swiper-container swiper-theme animation-slider pg-inner slider-image"
                data-swiper-options="{
                'slidesPerView': 1,
                'navigation':1,
                'autoplay': {
                    'delay': 8000,
                    'disableOnInteraction': false
                },
                'lazy': {
                    'loadOnTransitionStart': true,
                    'loadPrevNext': true
                }
            }">
                <div class="swiper-wrapper row gutter-no cols-1">
                    @foreach ($sliders as $slider)
                        <a href="{{ $slider->url }}" target="_blank"
                            class="swiper-slide intro-slide intro-slide2 banner banner-fixed br-sm"
                            style="background-color: #EBEDEC;">
                            <img data-src="{{ Voyager::image($slider->image) }}" class="swiper-lazy"  alt="Slider Image">
                            <div class="swiper-lazy-preloader"></div>
                        </a>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
             
            </div>
        </div>
    </div>
</div>