<table class="table table-striped">
    @include('countries.blocks.list.header', ['countries' => $countries])
    <tbody>
        @each('countries.blocks.list.item', $countries, 'country')
    </tbody>
</table>

{{ $countries->links() }}