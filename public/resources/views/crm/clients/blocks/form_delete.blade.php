{{ Form::open(array('route' => array('crm.clients.destroy', 'client' => $item), 'method' => 'post')) }}
{{ method_field('DELETE') }}
{{ Form::submit('удалить', ['class' => 'btn btn-sm btn-outline-danger']) }}
{{ Form::close() }}
