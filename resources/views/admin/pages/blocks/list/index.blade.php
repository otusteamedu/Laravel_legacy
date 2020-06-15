<div class="card-header">


    <h3 class="card-title"> {{__('messages.listPages')}}</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
    </div>
</div>
<div class="card-body p-0">
    <table class="table table-striped projects">
        @include('admin.pages.blocks.list.header', ['pages' => $pages])
        <tbody>
            @each('admin.pages.blocks.list.item', $pages, 'page')
        </tbody>
    </table>
</div>

{{ $pages->links() }}
