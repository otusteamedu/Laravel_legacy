<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">@lang('app.nav.home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users') }}">@lang('app.nav.users')</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="@lang('app.nav.search')" aria-label="@lang('app.nav.search')">
            <button class="btn btn-success my-2 my-sm-0" type="submit">@lang('app.nav.search')</button>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('registration') }}">@lang('app.registration.form_header')</a>
            </li>
        </ul>
    </div>
</nav>
