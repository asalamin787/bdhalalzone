@php
    $route = route('shops');
@endphp

<div class="header-bottom sticky-content fix-top sticky-header has-dropdown"
    style="background-color: #007cc5 !important;">
    <div class="container">
        <div class="inner-wrap">
            <div class="header-left">
                <div class="dropdown category-dropdown" data-visible="false">
                    <a href="javascript:void(0)" class="text-white category-toggle" role="button" aria-haspopup="true"
                        aria-expanded="false" title="Browse Categories" style="background-color: #2A9CF5 !important;"
                        onclick="toggleDropdown()">
                        <i class="w-icon-category"></i>
                        <span>Browse Categories</span>
                    </a>

                    <div class="dropdown-box" id="categoryDropdown" style="display: none;">
                        <ul class="menu vertical-menu category-menu">
                            @foreach ($categories as $category)
                                @if ($category->childrens->count() > 0)
                                    <details class="style2">
                                        <summary
                                            class="{{ request()->category == $category->slug ? 'active-cat' : '' }}">
                                            {{ $category->name }}</summary>
                                        @foreach ($category->childrens as $subChild)
                                            <x-category-tree :child="$subChild" />
                                        @endforeach
                                    </details>
                                @else
                                    <div
                                        class="content {{ request()->category == $category->slug ? 'active-cat' : '' }}">
                                        <a href="javascript:void(0)"
                                            onclick='updateSearchParams("category","{{ $category->slug }}","{{ $route }}")'>{{ $category->name }}</a>
                                    </div>
                                @endif
                            @endforeach
                            <li>

                                <a id="categoryId" class="menu-item-line" style="font-weight: 400"
                                    href="javascript:void(0)"
                                    onclick='updateSearchParams("category","","{{ $route }}")'>
                                    View All Categories<i class="w-icon-angle-right"></i>
                                </a>
                            </li>
                        </ul>


                    </div>

                </div>

                <nav class="main-nav">
                    <ul class="menu active-underline">
                        <li class="{{ url()->current() == url('/') ? 'active' : '' }}">
                            <a href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="{{ url()->current() == url('/shops') ? 'active' : '' }}">
                            <a href="{{ route('shops') }}">Products</a>
                        </li>
                        <li class="{{ url()->current() == url('/vendors') ? 'active' : '' }}">
                            <a href="{{ route('vendors') }}">E-shops</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('categoryDropdown');
        const expanded = dropdown.style.display === 'block';
        dropdown.style.display = expanded ? 'none' : 'block';
    }
</script>
