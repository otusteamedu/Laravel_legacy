@php /** @var \App\Models\User $user */ @endphp
<div class="model-index-single-controls">
    @if ($user->trashed())
        <div class="form-restore mb-2">
            {{ Form::modelDeleteActionsForm($user, 'admin.users.restore', 'PATCH', __('Restore'), ['class' => 'btn btn-info text-white btn-block']) }}
        </div>
        <div class="form-force-delete">
            {{ Form::modelDeleteActionsForm($user, 'admin.users.force_delete', 'DELETE', __('Force delete'), ['class' => 'btn btn-danger btn-block']) }}
        </div>
    @else
        <div class="form-delete">
            {{ Form::modelDeleteActionsForm($user, 'admin.users.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark btn-block']) }}
        </div>
    @endif
</div>
