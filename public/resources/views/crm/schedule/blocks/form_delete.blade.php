{{ Form::open(array('route' => array('clients.destroy', 'client' => $item), 'method' => 'post')) }}
{{ method_field('DELETE') }}
{{ Form::submit('удалить', ['class' => 'btn btn-outline-secondary']) }}
{{ Form::close() }}
