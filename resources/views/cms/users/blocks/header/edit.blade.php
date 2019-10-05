@component('blocks.header.index')
    @slot('title', sprintf('%s #%d', __('messages.editUser'), $user->id))
    @slot('description', __('messages.usersHeaderDescription'))
@endcomponent