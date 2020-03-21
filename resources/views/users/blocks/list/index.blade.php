<table class="table table-striped">
    @include('users.blocks.list.header', ['users' => $users])
    <tbody>
    @each('users.blocks.list.item', $users, 'user')
    </tbody>
</table>

{{ $users->links() }}
