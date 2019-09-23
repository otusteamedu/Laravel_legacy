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

<nav class="admin-dashboard-nav">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="nav">
                    <li>
                        {{ link_to_route('admin.companies.index', __('admin.companies.pages.index.title'), null, ['class' => 'nav-link']) }}
                    </li>
                    <li>
                        {{ link_to_route('admin.leads.index', __('admin.leads.pages.index.title'), null, ['class' => 'nav-link']) }}
                    </li>
                    <li>
                        {{ link_to_route('admin.widgets.index', __('admin.widgets.pages.index.title'), null, ['class' => 'nav-link']) }}
                    </li>
                    <li>
                        {{ link_to_route('admin.users.index', __('admin.users.pages.index.title'), null, ['class' => 'nav-link']) }}
                    </li>
                    <li>
                        {{ link_to_route('admin.conversations.index', __('admin.conversations.pages.index.title'), null, ['class' => 'nav-link']) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
