{{ Form::model($category, ['url' => route('cms.categories.update', ['category' => $category])]) }}
    @include('categories.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.categories.edit'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}
