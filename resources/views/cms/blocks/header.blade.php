@php(App::setLocale('ru'))
<div class="container">
    <div class="row alert alert-primary justify-content-center ">
        <h1> @lang('home.admin-title')</h1>
    </div>
</div>

<div class="container">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="/divisions">@lang('home.admin-header.divisions')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/towns">@lang('home.admin-header.towns')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.admin-header.adverts')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.admin-header.messages')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.admin-header.any')</a>
        </li>
    </ul>
</div>


