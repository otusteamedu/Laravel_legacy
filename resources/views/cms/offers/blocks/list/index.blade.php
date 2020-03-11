<table class="table table-striped">
    @include('cms.offers.blocks.list.header', ['offers' => $offers])
    <tbody>
    @each('cms.offers.blocks.list.item', $offers, 'offer')
    </tbody>
</table>

{{ $offers->links() }}
