
@php(App::setLocale('ru'))
<div class="container">
    <div class="row alert alert-primary justify-content-center ">
        <h1> @lang('home.title')</h1>
    </div>
</div>

<div class="container">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="#">@lang('home.header.car')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.header.realty')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.header.job')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.header.services')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.header.any')</a>
        </li>
    </ul>
</div>

<br>
<div class="container">
    <div class="row alert alert-primary justify-content-start ">
        <form class="form-inline">
            <div class="form-group ml-1 ">
                <select class="custom-select" required>
                    <option value="selected">@lang('home.search.realty')</option>
                    <option value="1">@lang('home.search.job')</option>
                    <option value="2">@lang('home.search.car')</option>
                    <option value="3">@lang('home.search.services')</option>
                </select>
            </div>
            <div class="form-group ml-1">
                <input type="password" class="form-control" id="inputPassword2" placeholder="@lang('home.search.placeholder') ">
            </div>
            <div class="form-group ml-1">
                <button type="submit" class=" btn btn-primary ml-2">@lang('home.search.button')</button>
            </div>
        </form>
    </div>
</div>
