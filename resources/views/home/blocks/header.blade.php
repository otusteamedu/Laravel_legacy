
{{--@php(App::setLocale('ru'))--}}
<div class="container">
    <div class="row alert alert-primary justify-content-center ">
        <h1> @lang('home.title')</h1>
    </div>
</div>

{{--{{$locale  ?? '' }}--}}

<a href="{{route('home.index', ['locale'=>'en'])}}"<?= $locale === 'en' ? 'class="alert-link"' : '' ?>>En</a>
<a href="{{route('home.index', ['locale'=>'ru'])}}"<?= $locale === 'ru' ? 'class="alert-link"' : '' ?>>Рус</a>


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

    @include('home.blocks.auth')

</div>


    @include('home.blocks.search')
