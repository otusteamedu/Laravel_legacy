@userCanDelete
    @php /** @var \App\Models\Conversation $conversation */ @endphp
    <div class="model-single-controls">
        {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark']) }}
    </div>
@enduserCanDelete
