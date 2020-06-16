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
        @include('admin.films.blocks.list.header', ['films' => $films])
        <tbody>
            @each('admin.films.blocks.list.item', $films, 'film')
        </tbody>
    </table>
</div>

{{ $films->links() }}
