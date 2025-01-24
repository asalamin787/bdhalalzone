<x-app>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{asset('assets/css/chat.css')}}">
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
    </x-slot>

    <div class="container bootstrap snippets bootdey my-5">
        <div class="tile tile-alt" id="messages-main">
            <div class="ms-menu">
                <div class="ms-user clearfix">
                    <img src="{{asset('assets/images/default-avatar.png')}}" alt="" class="img-avatar pull-left">
                    <div>Signed in as <br> {{ auth()->user()->name }}</div>
                </div>


                <div class="list-group lg-alt mt-3" style="height: 70vh;overflow-x: auto;">

                    @if($user->isNotEmpty)


                    <a class="list-group-item media" href="" style="background-color: #EEEEEE;">
                        <div class="pull-left">
                            <img src="{{ $user->logo ? Storage::url($user->logo) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png' }}" alt="" class="img-avatar">
                        </div>
                        <div class="media-body">
                            <small class="list-group-item-heading ms-2">{{$user->name}}</small>

                        </div>
                    </a>
                    @endif
                    @foreach ($shops as $u)

                    <a class="list-group-item media" href="{{route('massage.create',$u->id)}}">
                        <div class="pull-left">
                            <img src="{{ $u->logo ? Storage::url($u->logo) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png' }}" alt="" class="img-avatar">
                        </div>
                        <div class="media-body">
                            <small class="list-group-item-heading ms-2">{{ $u->name }}</small>

                        </div>
                    </a>
                    @endforeach


                </div>


            </div>

            <div class="ms-body">
                <div class="action-header clearfix">
                    <div class="visible-xs" id="ms-menu-trigger">
                        <i class="fa fa-bars"></i>
                    </div>

                    <div class="pull-left hidden-xs">
                        <img src="{{ $user->logo ? Storage::url($user->logo) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png' }}" alt="" class="img-avatar m-r-10">
                        <div class="lv-avatar pull-left">

                        </div>
                        <span>{{ $user->name }}</span>
                    </div>

                </div>
                <div style="position:relative; ">
                    <div style="height: 70vh; overflow-x: auto;">


                        @if($massages)
                        @foreach ($massages as $massage)
                        @if($massage->sender_id==auth()->id())

                        <div class="message-feed media">
                            <div class="pull-left">
                                <img src="{{asset('assets/img/User-avatar.png')}}" alt="" class="img-avatar">
                            </div>
                            <div class="media-body">
                                <div class="mf-content">
                                    {{ $massage->massage }}
                                </div>
                                <small class="mf-date"><i class="fa fa-clock-o"></i> {{$massage->created_at->diffForHumans()}}</small>
                            </div>
                        </div>

                        @else

                        <div class="message-feed right">
                            <div class="pull-right">
                                <img src="{{ $user->logo ? Storage::url($user->logo) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png' }}" alt="" class="img-avatar">
                            </div>
                            <div class="media-body">
                                <div class="mf-content">
                                    {{ $massage->massage }}
                                </div>
                                <small class="mf-date"><i class="fa fa-clock-o"></i> {{$massage->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        @endif

                        @endforeach
                        @endif


                    </div>
                    @if($user->id)
                    <form action="{{route('massage.store',$user->id)}}">
                        <div class="msb-reply" style="position: absolute;width: 100%;bottom:0">
                            <input type="test" style="border:none" placeholder="What's on your mind..." name="massage">
                            <button type="submit"><i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            if ($('#ms-menu-trigger')[0]) {
                $('body').on('click', '#ms-menu-trigger', function() {
                    $('.ms-menu').toggleClass('toggled');
                });
            }
        });
    </script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>

</x-app>