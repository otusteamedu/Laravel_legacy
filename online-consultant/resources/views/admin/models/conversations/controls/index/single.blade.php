@php /** @var \App\Models\Conversation $conversation */ @endphp
<div class="model-index-single-controls">
    @if ($conversation->trashed())
        <div class="form-restore mb-2">
            {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.restore', 'PATCH', __('Restore'), ['class' => 'btn btn-info text-white btn-block']) }}
        </div>
        <div class="form-force-delete">
            {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.force_delete', 'DELETE', __('Force delete'), ['class' => 'btn btn-danger btn-block']) }}
        </div>
    @else
        <div class="form-delete">
            {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark btn-block']) }}
        </div>
    @endif
</div>
