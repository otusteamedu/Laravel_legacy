<table class="table table-striped">
    @include('admin.permissions.blocks.list.header', ['permissions' => $permissions])
    <tbody>
    @each('admin.permissions.blocks.list.item', $permissions, 'permission')
    </tbody>
</table>

