@include('products.blocks.form.errors')
{{ Form::open(['url' => route('cms.products.store')]) }}
    @include('products.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.products.add'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}
