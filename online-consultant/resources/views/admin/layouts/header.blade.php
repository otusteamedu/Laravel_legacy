<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ __('common.app_name') }} <small>{{ __('admin.admin_panel_name') }}</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('common.navbar_toggle_nav') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user.profile') }}">{{ __('admin.pages.user_profile') }}</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('common.pages.logout') }}
                            </a>

                            {{ Form::open(['url' => route('logout'), 'id' => 'logout-form', 'style' => 'display: none;']) }}
                                @csrf
                            {{ Form::close() }}
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="app-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                @yield('breadcrumbs')
            </div>
        </div>
    </div>
</div>
