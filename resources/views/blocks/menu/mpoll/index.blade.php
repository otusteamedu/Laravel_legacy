@can(\App\Policies\Abilities::VIEW_ANY, \App\Models\Mpoll::class)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cms.mpolls.index') }}">{{ __('Surveys') }}</a>
    </li>
@endcan
