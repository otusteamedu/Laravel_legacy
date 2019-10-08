<tr>
    <th scope="row"> {{ $user['id'] }}</th>
    <th><a href=" {{ route('admin.users.show', ['user' => $user->id]) }}"> {{  $user['name'] }} </a></th>
    <td>{{$user['email']}}</td>
    <td>{{ $user->roles()->first()->name }}</td>
    <td>{{$user['created_at']  }}   </td>
    <td>
        {!! Form::open(['url' => route('admin.users.destroy',['user'=> $user->id]),'class'=>'form-delete','id' =>'deleteForm'.$user->id,'method'=>'POST',
            'onsubmit' => "return confirm('Вы уверены, что хотите удалить пользователя?');"
        ]) !!}
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
        {!! Form::button('<i class="fa  fa-trash-o" id="deleteBtn"></i>', ['class' => 'btn btn-danger', 'id' => $user->id,'type'=>'submit']) !!}
        {!! Form::close() !!}


    </td>
</tr>













