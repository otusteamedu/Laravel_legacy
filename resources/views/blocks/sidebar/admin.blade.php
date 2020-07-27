@can(\App\Services\Helpers\Ability::CHANGE_SETTINGS)
<li class="nav-item">
    <span class="nav-link">@lang('admin.settings')</span>


    <ul>
        <li><span class="nav-link">@lang('admin.telegram')</span></li>
        <ul>
            <li><a href="{{ route('admin.telegram.index') }}">WebHook</a></li>
        </ul>
    </ul>
</li>
@endcan
