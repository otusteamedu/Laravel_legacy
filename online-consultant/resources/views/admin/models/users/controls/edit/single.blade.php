@if ($currentUser->id !== $user->id)
    @userCanDelete
        @php /** @var \App\Models\User $user */ @endphp
        <div class="model-single-controls">
            {{ Form::modelDeleteActionsForm($user, 'admin.users.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark']) }}
        </div>
    @enduserCanDelete
@endif
