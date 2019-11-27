<tr>
    <th scope="row"> {{ $permission['id'] }}</th>
    <th>
        <a href=" {{ route('admin.permissions.show', ['permission' => $permission->id]) }}"> {{  $permission['name'] }} </a>
    </th>
    <th>{{  $permission['route'] }}  </th>
    <td>{{$permission['created_at']  }}   </td>
    <td>
        {!! Form::open(['url' => route('admin.permissions.destroy',['permission'=> $permission->id]),'class'=>'form-delete','id' =>'deleteForm'.$permission->id,'method'=>'POST',
            'onsubmit' => "return confirm('Вы уверены, что хотите удалить роль?');"
        ]) !!}
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
        {!! Form::button('<i class="fa  fa-trash-o" id="deleteBtn"></i>', ['class' => 'btn btn-danger', 'id' => $permission->id,'type'=>'submit']) !!}
        {!! Form::close() !!}

    </td>
</tr>













