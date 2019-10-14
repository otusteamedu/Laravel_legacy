<?php /** @var \App\Models\User $user */ ?>
@component('blocks.header.index')
    @slot('title', $user->name)
    @slot('description', __('messages.usersHeaderDescription'))
    @if($user->photo)
        <img src="{{ asset('storage/' . $user->photo) }}" alt="..." class="img-thumbnail">
    @endif
    <a class="btn btn-primary btn-lg" href="{{ App\Helpers\RouteBuilder::localeRoute('cms.users.edit', ['user' => $user]) }}" role="button">@lang('messages.edit')</a>
@endcomponent