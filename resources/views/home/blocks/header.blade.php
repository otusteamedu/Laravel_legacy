
{{--@php(App::setLocale('ru'))--}}
<div class="container">
    <div class="row alert alert-primary justify-content-center ">
        <h1> @lang('home.title')</h1>
    </div>
</div>

{{--{{$locale  ?? '' }}--}}
@include('home.blocks.towns')

<a class="ml-1" href="{{route('home.index', ['locale'=>'en'])}}"<?= $locale === 'en' ? 'class="alert-link"' : '' ?>>En</a>
<a href="{{route('home.index', ['locale'=>'ru'])}}"<?= $locale === 'ru' ? 'class="alert-link"' : '' ?>>Рус</a>


<div class="container">
    <ul class="nav justify-content-center">

        @include('home.blocks.nav')

        <li class="nav-item">
            <a class="nav-link" href="{{route('cms')}}">CMS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.header.any')</a>
        </li>

    </ul>


    @include('home.blocks.auth')

</div>


    @include('home.blocks.search')
