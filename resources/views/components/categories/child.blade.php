<ul>
    @foreach ($childs as $child)
        <li><a href="javascript:void(0)"
                onclick='updateSearchParams("category","{{ $child->slug }}","{{ $route }}")'>{{ $child->name }}</a>
        </li>
    @endforeach
</ul>
