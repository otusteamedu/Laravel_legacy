<table class="table table-striped">
    @include('cms.segments.blocks.list.header', ['segments' => $segments])
    <tbody>
    @each('cms.segments.blocks.list.item', $segments, 'segment')
    </tbody>
</table>

{{ $segments->links() }}
