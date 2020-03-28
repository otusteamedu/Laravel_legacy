@include('cms.categories.blocks.form.errors')
{{ Form::open(['url' => route('cms.categories.store')]) }}
@include('cms.categories.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
