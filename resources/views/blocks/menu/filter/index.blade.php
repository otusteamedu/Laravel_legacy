@can(\App\Policies\Abilities::VIEW_ANY, \App\Models\Filter::class)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cms.filters.index') }}">{{ __('Filter') }}</a>
    </li>
@endcan
