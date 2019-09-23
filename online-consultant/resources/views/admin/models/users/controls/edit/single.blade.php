@php /** @var \App\Models\User $user */ @endphp
<div class="model-single-controls">
    {{ Form::modelDeleteActionsForm($user, 'admin.users.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark']) }}
</div>
