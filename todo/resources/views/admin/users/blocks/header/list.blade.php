<div class="admin_header">
    <h3>  {{ __('users.users')}} </h3>
    <p>  {{  __('users.usersHeaderDescription')}} </p>
    <a class="btn btn-primary btn-lg" href="{{ route('admin.users.create') }}" role="button">@lang('users.addUser')</a>
</div>
@if (Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
@endif