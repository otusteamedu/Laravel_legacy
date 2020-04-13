<table class="table  table-bordered table-hover table-striped w-auto align-middle">
    @include('cms.mpolls.blocks.list.header', ['mpolls' => $mpolls])
    <tbody>
        @each('cms.mpolls.blocks.list.item', $mpolls, 'mpoll')
    </tbody>
</table>

{{ $mpolls->links() }}
