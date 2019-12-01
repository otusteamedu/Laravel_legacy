@component('blocks.header.index')
    @slot('title', __('messages.users'))
    @slot('description', __('messages.usersHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ App\Helpers\RouteBuilder::localeRoute('cms.users.create') }}" role="button">@lang('messages.addUser')</a>
@endcomponent