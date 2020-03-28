<table class="table table-striped">
    @include('cms.tariffs.blocks.list.header', ['tariffs' => $tariff])
    <tbody>
    @each('cms.tariffs.blocks.list.item', $tariff, 'tariff')
    </tbody>
</table>

{{ $tariff->links() }}
