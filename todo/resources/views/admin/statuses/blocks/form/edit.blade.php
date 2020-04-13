@include('admin.statuses.blocks.form.errors')
{{ Form::model($status, ['url' => route('admin.statuses.update', ['status' => $status]) ])}}
{{ method_field('PUT') }}
@include('admin.statuses.blocks.form.fields')
<div class="form-group">
    {{ Form::submit(trans('statuses.save'), array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}