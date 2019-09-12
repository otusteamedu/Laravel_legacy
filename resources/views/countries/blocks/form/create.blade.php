@include('countries.blocks.form.errors')
{{ Form::open(['url' => route('cms.countries.store')]) }}
    @include('countries.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.addCountry'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}