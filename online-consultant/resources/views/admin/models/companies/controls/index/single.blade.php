@php /** @var \App\Models\Company $company */ @endphp
<div class="model-index-single-controls">
    @if ($company->trashed())
        @userCanRestore
            <div class="form-restore mb-2">
                {{ Form::modelDeleteActionsForm($company, 'admin.companies.restore', 'PATCH', __('admin.models.controls.restore'), ['class' => 'btn btn-info text-white btn-block']) }}
            </div>
        @enduserCanRestore
        @userCanForceDelete
            <div class="form-force-delete">
                {{ Form::modelDeleteActionsForm($company, 'admin.companies.force_delete', 'DELETE', __('admin.models.controls.force_delete'), ['class' => 'btn btn-danger btn-block']) }}
            </div>
        @enduserCanForceDelete
    @else
        @userCanUpdate
            <div class="button-edit mb-2">
                {{ link_to_route('admin.companies.edit', __('admin.models.controls.edit'), [$company->id], ['class' => 'btn btn-success btn-block']) }}
            </div>
        @enduserCanUpdate
        @userCanDelete
            <div class="form-delete">
                {{ Form::modelDeleteActionsForm($company, 'admin.companies.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark btn-block']) }}
            </div>
        @enduserCanDelete
    @endif
</div>
