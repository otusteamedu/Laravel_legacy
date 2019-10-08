@include('admin.roles.blocks.form.errors')
{{ Form::open(['url' => route('admin.roles.store')]) }}
@include('admin.roles.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('roles.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}