<table class="table table-striped">
    @include('cms.projects.blocks.list.header', ['projects' => $projects])
    <tbody>
    @each('cms.projects.blocks.list.item', $projects, 'project')
    </tbody>
</table>

{{ $projects->links() }}
