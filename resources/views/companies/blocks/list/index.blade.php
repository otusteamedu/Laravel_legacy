<table class="table table-striped">
    @include('companies.blocks.list.header', ['companies' => $companies])
    <tbody>
        @each('companies.blocks.list.item', $companies, 'company')
    </tbody>
</table>

{{ $companies->links() }}