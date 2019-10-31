<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ __('common.app_name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('common.navbar_toggle_nav') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('common.pages.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('common.pages.register') }}</a>
                    </li>
                @else
                    @php
                        $currentUser = Auth::user();
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">App</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $currentUser->name }} ({{ $currentUser->top_role->name }}) <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.users.edit', ['user' => $currentUser]) }}">
                                {{ __('admin.users.pages.profile.title') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('common.pages.logout') }}
                            </a>

                            {{ Form::open(['url' => route('logout'), 'id' => 'logout-form', 'style' => 'display: none;']) }}
                                @csrf
                            {{ Form::close() }}
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
