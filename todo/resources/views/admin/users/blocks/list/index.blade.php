<table class="table table-striped">
    @include('admin.users.blocks.list.header', ['users' => $users])
    <tbody>
    @each('admin.users.blocks.list.item', $users, 'user')
    </tbody>
</table>

