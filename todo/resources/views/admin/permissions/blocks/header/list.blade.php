<div class="admin_header">
    <h3>  {{ __('permissions.permissions')}} </h3>
    <p>  {{  __('permissions.permissionsHeaderDescription')}} </p>

    <a class="btn btn-primary btn-lg" href="{{ route('admin.permissions.create') }}"
       permission="button">@lang('permissions.addPermission')</a>
</div>