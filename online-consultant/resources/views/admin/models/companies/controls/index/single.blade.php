@php /** @var \App\Models\Company $company */ @endphp
<div class="model-index-single-controls">
    @if ($company->trashed())
        <div class="form-restore mb-2">
            {{ Form::modelDeleteActionsForm($company, 'admin.companies.restore', 'PATCH', __('Restore'), ['class' => 'btn btn-info text-white btn-block']) }}
        </div>
        <div class="form-force-delete">
            {{ Form::modelDeleteActionsForm($company, 'admin.companies.force_delete', 'DELETE', __('Force delete'), ['class' => 'btn btn-danger btn-block']) }}
        </div>
    @else
        <div class="form-delete">
            {{ Form::modelDeleteActionsForm($company, 'admin.companies.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark btn-block']) }}
        </div>
    @endif
</div>
