@include('cms.categories.blocks.form.errors')

{{ Form::model($category, ['url' => route('cms.categories.update', ['category' => $category]), 'method' => 'PUT']) }}
@include('cms.categories.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
