{{ Form::open() }}
    @csrf
    @include('products.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.addProduct'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}