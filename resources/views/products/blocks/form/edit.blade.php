@include('products.blocks.form.errors')

{{ Form::model($product, ['url' => route('cms.products.update', ['product' => $product]), 'method' => 'PUT']) }}
    @include('products.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(trans('messages.products.edit'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}
