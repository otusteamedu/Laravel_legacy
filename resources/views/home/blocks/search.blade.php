
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
            <a href="{{route('home.create', ['locale'=>$locale])}}" class="btn btn-info ml-5">Добавить объявление</a>
        </form>
    </div>
</div>



