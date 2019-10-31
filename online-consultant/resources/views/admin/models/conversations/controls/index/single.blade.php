@php /** @var \App\Models\Conversation $conversation */ @endphp
<div class="model-index-single-controls">
    @if ($conversation->trashed())
        @userCanRestore
            <div class="form-restore">
                {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.restore', 'PATCH', __('admin.models.controls.restore'), ['class' => 'btn btn-info text-white btn-block']) }}
            </div>
        @enduserCanRestore
        @userCanForceDelete
            <div class="form-force-delete mt-2">
                {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.force_delete', 'DELETE', __('admin.models.controls.force_delete'), ['class' => 'btn btn-danger btn-block']) }}
            </div>
        @enduserCanForceDelete
    @else
        @userCanUpdate
            <div class="button-edit">
                {{ link_to_route('admin.conversations.edit', __('admin.models.controls.edit'), [$conversation->id], ['class' => 'btn btn-success btn-block']) }}
            </div>
        @enduserCanUpdate
        @userCanDelete
            <div class="form-delete mt-2">
                {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark btn-block']) }}
            </div>
        @enduserCanDelete
    @endif
</div>
