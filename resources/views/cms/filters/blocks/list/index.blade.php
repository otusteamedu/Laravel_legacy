<table class="table table-striped">
    @include('cms.filters.blocks.list.header', ['filters' => $filters])
    <tbody>
        @each('cms.filters.blocks.list.item', $filters, 'filter')
    </tbody>
</table>

{{ $filters->links() }}
