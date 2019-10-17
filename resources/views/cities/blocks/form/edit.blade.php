{{ Form::model($country, ['url' => App\Helpers\RouteBuilder::localeRoute('cms.countries.update', ['country' => $country])]) }}
    @include('companies.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.addCountry'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}