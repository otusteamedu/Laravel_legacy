{{ Form::open(['url' => route('cms.countries.create')]) }}
    @include('companies.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.addCompany'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}