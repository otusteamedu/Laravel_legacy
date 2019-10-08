<table class="table table-striped">
    @include('admin.statuses.blocks.list.header', ['statuses' => $statuses])
    <tbody>
    @each('admin.statuses.blocks.list.item', $statuses, 'status')
    </tbody>
</table>

