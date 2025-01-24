@php
    $route = route('shops');
@endphp
@if ($child->childrens->count() > 0)
    <details class="style2" style="padding-left: 30px">
        <summary class="{{request()->category==$child->id ? 'active' : ''}}">{{ $child->name }}</summary>


        @foreach ($child->childrens as $item)
            <x-category-tree :route="$route" :child="$item" />
        @endforeach
    </details>
@else
<div class="content content-x {{request()->category==$child->slug ? 'active-cat' : ''}}" style="padding-left: 25px">
    <a href="javascript:void(0)" onclick='updateSearchParams("category","{{ $child->slug }}","{{ $route }}")'>{{ $child->name }}</a>
</div>
@endif

