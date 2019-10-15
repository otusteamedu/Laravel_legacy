@foreach($categories as $category)
    @if($category->children->where('published', 1)->count())
        <li class="nav-item dropdown">
            <a href="{{url("/blog/category/$category->slug")}}" class="nav-link dropdown-toggle" id="navbarDropdown"
               aria-haspopup="true"
               data-toggle="dropdown" role="button" aria-expanded="false">{{$category->title}}</a>
            <div class="dropdown-menu" role="menu" aria-labelledby="navbarDropdown">
                @include('admin.layouts.top_menu', ['categories' => $category->children, 'dropdownItem' => true])
            </div>
        </li>
    @elseif($dropdownItem !== null && $dropdownItem === true)
        <a class="dropdown-item" href="{{url("/blog/category/$category->slug")}}">{{$category->title}}</a>
    @else
        <li class="nav-item">
            <a class="dropdown-item" href="{{url("/blog/category/$category->slug")}}">{{$category->title}}</a>
        </li>
    @endif

@endforeach
