<table class="table table-striped">
    @include('cms.cities.blocks.list.header', ['cities' => $cities])
    <tbody>
    @each('cms.cities.blocks.list.item', $cities, 'city')
    </tbody>
</table>

{{ $cities->links() }}
