@include('cms.offers.blocks.form.errors')

{{ Form::open(['url' => route('cms.offers.store')]) }}
@include('cms.offers.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
