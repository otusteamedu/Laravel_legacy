@include('admin.users.blocks.form.errors')
{{ Form::model($user, ['url' => route('admin.users.update', ['user' => $user]) ])}}
{{ method_field('PUT') }}
@include('admin.users.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('users.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}