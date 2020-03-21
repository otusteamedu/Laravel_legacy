{{ Form::open(['url' => route('cms.countries.create')]) }}
@include('cms.cities.blocks.form.fields', $countries)
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
