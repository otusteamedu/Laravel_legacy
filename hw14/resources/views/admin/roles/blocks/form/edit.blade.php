@include('admin.roles.blocks.form.errors')
{{ Form::model($role, ['url' => route('admin.roles.update', ['role' => $role]) ])}}
{{ method_field('PUT') }}
@include('admin.roles.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('roles.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}