@include('admin.statuses.blocks.form.errors')
{{ Form::open(['url' => route('admin.statuses.store')]) }}
@include('admin.statuses.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('statuses.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}