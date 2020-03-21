<table class="table table-striped">
    @include('cmc.countries.blocks.cities-list.header', ['cities' => $cities])
    <tbody>
    @each('cmc.countries.blocks.cities-list.item', $cities, 'city')
    </tbody>
</table>

{{ $cities->links() }}
