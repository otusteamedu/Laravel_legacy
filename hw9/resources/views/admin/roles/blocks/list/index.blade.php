<table class="table table-striped">
    @include('admin.roles.blocks.list.header', ['roles' => $roles])
    <tbody>
    @each('admin.roles.blocks.list.item', $roles, 'role')
    </tbody>
</table>

