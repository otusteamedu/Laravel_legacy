{{ Form::open(['url' => route('cms.categories.store')]) }}
    @include('categories.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.categories.add'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}
