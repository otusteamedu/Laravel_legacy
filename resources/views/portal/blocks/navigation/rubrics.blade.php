<nav class="navbar float-lg-right float-md-right">
@foreach($rubrics as $rubric)
    @if($rubric['is_active'])
        <span class="nav-item">{{$rubric['name']}}</span>
    @else
        <a class="nav-item nav-link" href="{{$rubric['slug']}}">{{$rubric['name']}}</a>
    @endif
@endforeach
</nav>