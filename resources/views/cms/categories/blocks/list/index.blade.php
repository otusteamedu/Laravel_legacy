<table class="table table-striped">
    @include('cms.categories.blocks.list.header', ['categories' => $categories])
    <tbody>
    @each('cms.categories.blocks.list.item', $categories, 'category')
    </tbody>
</table>

{{ $categories->links() }}
