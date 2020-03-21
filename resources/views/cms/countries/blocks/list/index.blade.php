<table class="table table-striped">
    @include('cms.countries.blocks.list.header', ['countries' => $countries])
    <tbody>
    @each('cms.countries.blocks.list.item', $countries, 'country')
    </tbody>
</table>

{{ $countries->links() }}
