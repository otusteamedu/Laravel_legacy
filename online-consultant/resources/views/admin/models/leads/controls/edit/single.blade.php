@userCanDelete
    @php /** @var \App\Models\Lead $lead */ @endphp
    <div class="model-single-controls">
        {{ Form::modelDeleteActionsForm($lead, 'admin.leads.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark']) }}
    </div>
@enduserCanDelete
