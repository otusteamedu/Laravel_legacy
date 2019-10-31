@userCanDelete
    @php /** @var \App\Models\Company $company */ @endphp
    <div class="model-single-controls">
        {{ Form::modelDeleteActionsForm($company, 'admin.companies.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark']) }}
    </div>
@enduserCanDelete
