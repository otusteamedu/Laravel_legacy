@php /** @var \App\Models\Lead $lead */ @endphp
<div class="model-index-single-controls">
    @if ($lead->trashed())
        @userCanRestore
            <div class="form-restore">
                {{ Form::modelDeleteActionsForm($lead, 'admin.leads.restore', 'PATCH', __('admin.models.controls.restore'), ['class' => 'btn btn-info text-white btn-block']) }}
            </div>
        @enduserCanRestore
        @userCanForceDelete
            <div class="form-force-delete mt-2">
                {{ Form::modelDeleteActionsForm($lead, 'admin.leads.force_delete', 'DELETE', __('admin.models.controls.force_delete'), ['class' => 'btn btn-danger btn-block']) }}
            </div>
        @enduserCanForceDelete
    @else
        @userCanUpdate
            <div class="button-edit">
                {{ link_to_route('admin.leads.edit', __('admin.models.controls.edit'), [$lead->id], ['class' => 'btn btn-success btn-block']) }}
            </div>
        @enduserCanUpdate
        @userCanDelete
            <div class="form-delete mt-2">
                {{ Form::modelDeleteActionsForm($lead, 'admin.leads.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark btn-block']) }}
            </div>
        @enduserCanDelete
    @endif
</div>
