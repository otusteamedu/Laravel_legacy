@include('admin.permissions.blocks.form.errors')
{{ Form::open(['url' => route('admin.permissions.store')]) }}
@include('admin.permissions.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('permissions.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}