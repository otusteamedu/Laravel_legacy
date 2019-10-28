@php /** @var \App\Models\Widget $widget */ @endphp
<div class="model-index-single-controls">
    @if ($widget->trashed())
        @userCanRestore
            <div class="form-restore mb-2">
                {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.restore', 'PATCH', __('admin.models.controls.restore'), ['class' => 'btn btn-info text-white btn-block']) }}
            </div>
        @enduserCanRestore
        @userCanForceDelete
            <div class="form-force-delete">
                {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.force_delete', 'DELETE', __('admin.models.controls.force_delete'), ['class' => 'btn btn-danger btn-block']) }}
            </div>
        @enduserCanForceDelete
    @else
        @userCanUpdate
            <div class="button-edit mb-2">
                {{ link_to_route('admin.widgets.edit', __('admin.models.controls.edit'), [$widget->id], ['class' => 'btn btn-success btn-block']) }}
            </div>
        @enduserCanUpdate
        @userCanDelete
            <div class="form-delete">
                {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark btn-block']) }}
            </div>
        @enduserCanDelete
    @endif
</div>
