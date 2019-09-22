@php /** @var \App\Models\Lead $lead */ @endphp
<div class="model-index-single-controls">
    @if ($lead->trashed())
        <div class="form-restore mb-2">
            {{ Form::modelDeleteActionsForm($lead, 'admin.leads.restore', 'PATCH', __('Restore'), ['class' => 'btn btn-info text-white btn-block']) }}
        </div>
        <div class="form-force-delete">
            {{ Form::modelDeleteActionsForm($lead, 'admin.leads.force_delete', 'DELETE', __('Force delete'), ['class' => 'btn btn-danger btn-block']) }}
        </div>
    @else
        <div class="form-delete">
            {{ Form::modelDeleteActionsForm($lead, 'admin.leads.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark btn-block']) }}
        </div>
    @endif
</div>
