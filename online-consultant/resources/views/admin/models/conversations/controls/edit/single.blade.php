@php /** @var \App\Models\Conversation $conversation */ @endphp
<div class="model-single-controls">
    {{ Form::modelDeleteActionsForm($conversation, 'admin.conversations.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark']) }}
</div>
