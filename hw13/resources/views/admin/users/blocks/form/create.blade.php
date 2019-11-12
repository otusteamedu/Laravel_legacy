@include('admin.users.blocks.form.errors')
{{ Form::open(['url' => route('admin.users.store')]) }}
@include('admin.users.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('users.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}