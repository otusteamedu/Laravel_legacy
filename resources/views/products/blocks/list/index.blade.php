<table class="table table-striped">
    @include('products.blocks.list.header')
    <tbody>
        @each('products.blocks.list.item', $products, 'product')
    </tbody>
</table>

{{ $products->links() }}
