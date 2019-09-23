@extends('web.layouts.index')

@section('title', __('common.pages.home'))

@section('content')
    <section class="page-section frontpage-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1>{{ __('common.app_name') }}</h1>
                    <p>Quisque egestas odio vitae blandit tempor. Nullam eget tempor libero. Integer lorem risus,
                        mollis eget tempus vitae, semper a felis. Vestibulum pharetra ut lorem vitae
                        pellentesque.</p>
                </div>
                <div class="col-md-6">
                    <div class="frontpage-form">
                        <h2 class="frontpage-form__subheading">Vestibulum pharetra</h2>

                        @component('common.forms.register')@endcomponent
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section frontpage-product-description">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3>Lorem ipsum dolor sit amet</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean enim nunc, congue et dictum
                        sed, varius vel orci. Proin congue turpis at luctus vehicula.</p>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3>In ut massa justo</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean enim nunc, congue et dictum
                        sed, varius vel orci. Proin congue turpis at luctus vehicula.</p>
                </div>
                <div class="col-lg-4">
                    <h3>Integer nunc lacus</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean enim nunc, congue et dictum
                        sed, varius vel orci. Proin congue turpis at luctus vehicula.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
