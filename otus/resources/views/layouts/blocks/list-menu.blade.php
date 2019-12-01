<ul class="listMenu">
    @foreach ($items as $item)
        <li class="listMenu__item"><a class="listMenu__link" href="#">{{$item['name']}}</a>
            @if($item['count'])
                <div class="listMenu__icon count blue">{{$item['count']}}</div>
            @endif
        </li>
    @endforeach
</ul>
