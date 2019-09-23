@php /** @var \App\Models\Company $company */ @endphp
<div class="model-single-controls">
    {{ Form::modelDeleteActionsForm($company, 'admin.companies.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark']) }}
</div>
