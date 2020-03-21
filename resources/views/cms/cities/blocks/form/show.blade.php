{{ Form::open(['url' => route('cms.countries.create')]) }}
@include('cms.cities.blocks.form.fields-show', $country)
<div class="form-group">
    {{ Form::submit('Изменить город', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
