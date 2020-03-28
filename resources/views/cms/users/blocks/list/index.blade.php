<table class="table table-striped">
    @include('cms.users.blocks.list.header', ['users' => $users])
    <tbody>
    @each('cms.users.blocks.list.item', $users, 'user')
    </tbody>
</table>

{{ $users->links() }}
