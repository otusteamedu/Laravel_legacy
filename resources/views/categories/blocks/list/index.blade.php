<table class="table table-striped">
    @include('categories.blocks.list.header')
    <tbody>
        @each('categories.blocks.list.item', $categories, 'category')
    </tbody>
</table>

{{ $categories->links() }}
