@foreach($row as $item)
    @if(is_array($item))
        <td>
            @include('schedule.schedule_lesson', [
                'item' => $item
            ])
        </td>
    @else
        <td>{{$item}}</td>
    @endif
@endforeach
