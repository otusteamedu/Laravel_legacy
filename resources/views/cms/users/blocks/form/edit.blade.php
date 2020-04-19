@include('users.blocks.form.errors')

{{ Form::model($user, ['url' => route('cms.users.update', ['user' => $user]), 'method' => 'PUT']) }}
@include('users.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
