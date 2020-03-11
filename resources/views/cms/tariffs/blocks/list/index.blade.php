<table class="table table-striped">
    @include('cms.tariffs.blocks.list.header', ['tariffs' => $tariffs])
    <tbody>
    @each('cms.tariffs.blocks.list.item', $tariffs, 'tariff')
    </tbody>
</table>

{{ $tariffs->links() }}
