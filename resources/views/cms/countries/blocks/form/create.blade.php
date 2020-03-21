@include('cms.countries.blocks.form.errors')
{{ Form::open(['url' => route('cms.countries.store')]) }}
@include('cms.countries.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Добавить страну', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
