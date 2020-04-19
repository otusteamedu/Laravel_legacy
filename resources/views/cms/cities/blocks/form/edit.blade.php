@include('cms.cities.blocks.form.errors')

{{ Form::model($city, ['url' => route('cms.cities.update', ['city' => $city]), 'method' => 'PUT']) }}
@include('cms.cities.blocks.form.fields', $city)
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
