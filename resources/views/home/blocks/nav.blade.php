

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link active" href="#">@lang('home.header.car')</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('division', ['division'=>'2', 'locale'=>$locale]) }}">@lang('home.header.realty')</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#">@lang('home.header.job')</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#">@lang('home.header.services')</a>--}}
{{--        </li>--}}

{{--@foreach($divisionList->items as $item)--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('division', ['division'=>$item->id, 'locale'=>$locale]) }}">{{$item->name}}</a>--}}
{{--    </li>--}}
{{--@Endforeach--}}

@foreach($divisionList->items as $item)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('town', ['division'=>$item->id, 'town'=>$town_id, 'locale'=>$locale]) }}">{{$item->name}}</a>
    </li>
@Endforeach
