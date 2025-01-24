<x-app>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('seller-assets/css/plugins/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">

        <!-- Plugin CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
        <!-- Default CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo5.min.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        @livewireStyles
    </x-slot>

    @php
        $cartItems = Cart::getContent();
        $groupedByShopItems = $cartItems->groupBy(function ($item) {
            return $item->model->shop->id;
        })->count();


    @endphp
    <livewire:checkout />
    <x-slot name="js">
       
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sticky/sticky.js') }}"></script>
        <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.min.js') }}"></script>


        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                );

                if (error) {
                    if (error?.setupIntent) {
                        document.getElementById('paymentmethod').value = error.setupIntent.payment_method
                        document.getElementById('paymentmethod').checked = true
                        document.getElementById('card-button').style.display = 'none'
                        toastr.success('Card added');
                    } else {
                        toastr.error('Something went wrong. Try again letter');
                    }

                } else {
                    document.getElementById('paymentmethod').value = setupIntent.payment_method
                    document.getElementById('paymentmethod').checked = true
                    document.getElementById('card-button').style.display = 'none'
                    toastr.success('Card added');
                }
            });
        </script>



    </x-slot>
    @push('script')
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            toastr.options = {
                "newestOnTop": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": true,
                "showDuration": "150",
                "hideDuration": "200",
                "timeOut": "4500",
                "extendedTimeOut": "500",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error("{{ $error }}")
                </script>
            @endforeach
        @endif
        @livewireScripts


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if($groupedByShopItems > 1)
        <script>
            var groupedByShopItems ="{{$groupedByShopItems}}"
            var imgUrl="{{asset('assets/img/2706962.png')}}"
           
            Swal.fire({
                title: `<img height="70" src="${imgUrl}">`,
                icon: "",
                html: `
   Your orders from <b>${groupedByShopItems}</b> different shops will arrive soon!
  `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
    <i class="fa fa-thumbs-up"></i> Great!
  `,
       
            });
        </script>
        @endif
    @endpush
</x-app>
