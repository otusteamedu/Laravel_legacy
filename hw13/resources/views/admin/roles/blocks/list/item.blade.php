<tr>
    <th scope="row"> {{ $role['id'] }}</th>
    <th><a href=" {{ route('admin.roles.show', ['role' => $role->id]) }}"> {{  $role['name'] }} </a></th>
    <td>{{$role['created_at']  }}   </td>
    <td>
        {!! Form::open(['url' => route('admin.roles.destroy',['role'=> $role->id]),'class'=>'form-delete','id' =>'deleteForm'.$role->id,'method'=>'POST',
            'onsubmit' => "return confirm('Вы уверены, что хотите удалить роль?');"
        ]) !!}
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
        {!! Form::button('<i class="fa  fa-trash-o" id="deleteBtn"></i>', ['class' => 'btn btn-danger', 'id' => $role->id,'type'=>'submit']) !!}
        {!! Form::close() !!}

    </td>
</tr>













