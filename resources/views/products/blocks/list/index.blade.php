<table class="table table-striped">
    @include('products.blocks.list.header', ['products' => $products])
    <tbody>
        @each('products.blocks.list.item', $products, 'product')
    </tbody>
</table>
