@include('admin.permissions.blocks.form.errors')
{{ Form::model($permission, ['url' => route('admin.permissions.update', ['permission' => $permission]) ])}}
{{ method_field('PUT') }}
@include('admin.permissions.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('permissions.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}