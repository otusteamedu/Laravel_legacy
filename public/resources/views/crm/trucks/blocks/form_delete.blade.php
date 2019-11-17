{{ Form::open(array('route' => array('crm.trucks.destroy', 'truck' => $item), 'method' => 'post')) }}
{{ method_field('DELETE') }}
{{ Form::submit('удалить', ['class' => 'btn btn-outline-secondary']) }}
{{ Form::close() }}


