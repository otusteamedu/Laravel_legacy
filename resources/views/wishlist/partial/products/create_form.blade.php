{{ Form::open(['url' => route('product.store'), 'class'=>'form-inline']) }}
{{ Form::input('text', 'product_name', '', ['class'=>'form-control', 'required']) }}
{{ Form::hidden('wishlist_id', $wishlist->id) }}
{{ Form::submit('+ Add new product', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}