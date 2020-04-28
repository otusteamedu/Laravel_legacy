{{ Form::model($country, ['url' => route('cms.countries.update', ['country' => $country])]) }}
    @include('countries.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.addCountry'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}