@foreach($products as $product)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td><a href="{{route('product.show', $product->id)}}">{{$product->productTitle}}</a></td>
        <td class="text-center">

            {{ Form::open(['url' => route('wishlist-products.destroy', $product->wishlistProductsId)]) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('X', ['class' => 'btn btn-outline-secondary btn-sm']) }}
            {{ Form::close() }}

        </td>
    </tr>
@endforeach