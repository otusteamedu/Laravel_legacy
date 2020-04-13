<tr>
    <th scope="row"> {{ $status['id'] }}</th>
    <th><a href=" {{ route('admin.statuses.show', ['status' => $status->id]) }}"> {{  $status['name'] }} </a></th>

    <td>
        {!! Form::open(['url' => route('admin.statuses.destroy',['status'=> $status->id]),'class'=>'form-delete','id' =>'deleteForm'.$status->id,'method'=>'POST',
            'onsubmit' => "return confirm('Вы уверены, что хотите удалить роль?');"
        ]) !!}
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
        {!! Form::button('<i class="fa  fa-trash-o" id="deleteBtn"></i>', ['class' => 'btn btn-danger', 'id' => $status->id,'type'=>'submit']) !!}
        {!! Form::close() !!}

    </td>
</tr>













