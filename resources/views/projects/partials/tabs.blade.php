<ul class="nav nav-tabs pt-4">
    <li class="nav-item">
        <a class="nav-link @if(Route::is('projects.show'))active @endif" href="{{ route('projects.show', $project) }}">@lang('projects.dashboard')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('projects.commits'))active @endif" href="{{ route('projects.commits', $project) }}">@lang('projects.commits')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::is('projects.edit'))active @endif" href="{{ route('projects.edit', $project) }}">@lang('projects.settings')</a>
    </li>
    <li class="nav-item ml-auto">
        @include('projects.partials.delete')
    </li>
</ul>
