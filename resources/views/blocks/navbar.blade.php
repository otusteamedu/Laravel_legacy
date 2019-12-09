<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">{{ __('message.navbar.title') }}</div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">{{ __('message.navbar.home') }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.user-page') }}">{{ __('message.navbar.my_info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.list') }}">{{ __('message.navbar.users_list') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('site.about') }}">{{ __('message.navbar.about') }}</a>
            </li>
        </ul>

        @include('blocks.auth')
    </div>
</nav>