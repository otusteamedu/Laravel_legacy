@foreach($wishlists as $wishlist)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td><a href="{{route('wishlists.show', $wishlist->id)}}">{{$wishlist->name}}</a></td>
        <td class="text-center">

            {{ Form::open(['url' => route('wishlists.destroy', $wishlist->id)]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('X', ['class' => 'btn btn-outline-secondary btn-sm']) }}
            {{ Form::close() }}

        </td>
    </tr>
@endforeach