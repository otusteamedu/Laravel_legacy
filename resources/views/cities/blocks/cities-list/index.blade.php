<table class="table table-striped">
    @include('countries.blocks.cities-list.header', ['cities' => $cities])
    <tbody>
        @each('countries.blocks.cities-list.item', $cities, 'city')
    </tbody>
</table>

{{ $cities->links() }}