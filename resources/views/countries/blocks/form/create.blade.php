@include('cms.blocks.form.messages')
{{ Form::open(['url' => App\Helpers\RouteBuilder::localeRoute('cms.countries.store')]) }}
    @include('countries.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(__('messages.addCountry'), array('class' => 'btn btn-success', 'id' => 'create-country')) }}
    </div>
{{ Form::close() }}