@php /** @var \App\Models\User $user */ @endphp
<div class="model-index-single-controls">
    @if ($user->trashed())
        @userCanRestore
            <div class="form-restore">
                {{ Form::modelDeleteActionsForm($user, 'admin.users.restore', 'PATCH', __('admin.models.controls.restore'), ['class' => 'btn btn-info text-white btn-block']) }}
            </div>
        @enduserCanRestore
        @userCanForceDelete
            <div class="form-force-delete mt-2">
                {{ Form::modelDeleteActionsForm($user, 'admin.users.force_delete', 'DELETE', __('admin.models.controls.force_delete'), ['class' => 'btn btn-danger btn-block']) }}
            </div>
        @enduserCanForceDelete
    @else
        @userCanUpdate
            <div class="button-edit">
                {{ link_to_route('admin.users.edit', __('admin.models.controls.edit'), [$user->id], ['class' => 'btn btn-success btn-block']) }}
            </div>
        @enduserCanUpdate
        @if ($currentUser->id !== $user->id)
            @userCanDelete
                <div class="form-delete mt-2">
                    {{ Form::modelDeleteActionsForm($user, 'admin.users.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark btn-block']) }}
                </div>
            @enduserCanDelete
        @endif
    @endif
</div>
