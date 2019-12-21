@extends('layouts.page')

@section('page_class', 'tm-teal-bg')

@section('content')
    <section class="uk-section tm-section-lines uk-flex uk-flex-middle uk-light" data-uk-height-viewport="offset-top: true">
        <div class="uk-container uk-flex uk-flex-center uk-margin-large-bottom">
            <div class="tm-login__content uk-width-xlarge@s">
                <div class="tm-login__header">
                    <h1 class="uk-margin-remove">@yield('page_title')</h1>
                    <div class="uk-divider-small"></div>
                </div>
                <div class="uk-flex uk-flex-column uk-flex-center uk-margin-medium-top">
                    @yield('form')
                </div>
            </div>
        </div>
    </section>
@endsection
