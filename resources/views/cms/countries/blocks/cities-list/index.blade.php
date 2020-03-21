<table class="table table-striped">
    @include('cms.countries.blocks.cities-list.header', ['cities' => $cities])
    <tbody>
    @each('cms.countries.blocks.cities-list.item', $cities, 'city')
    </tbody>
</table>

{{ $cities->links() }}
