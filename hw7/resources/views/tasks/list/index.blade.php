<table class="table table-striped">
    @include('tasks.list.header')
    <tbody>
    @each('tasks.list.item', $tasks, 'task')
    </tbody>
</table>