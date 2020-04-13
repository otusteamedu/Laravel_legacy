<table class="table  table-bordered table-hover table-striped w-auto align-middle">
    @include('cms.filters.blocks.list.header', ['filters' => $filters])
    <tbody>
        @each('cms.filters.blocks.list.item', $filters, 'filter')
    </tbody>
</table>

{{ $filters->links() }}
