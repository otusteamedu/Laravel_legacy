{{ Form::open(['url' => localize_route('wishlists.store'), 'class'=>'form-inline']) }}
{{ Form::input('text', 'name', '', ['class'=>'form-control', 'required']) }}
{{ Form::submit('+ Add new whishlist', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}