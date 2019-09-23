@extends('admin.layouts.index')

@section('title', __('admin.companies.pages.create.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.companies.create') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row row-section-header">
                        <div class="col">
                            <h1>{{ __('admin.companies.pages.create.title') }}</h1>
                        </div>
                    </div>
                    @include('admin.models.companies.forms.create')
                </div>
            </div>
        </div>
    </section>
@endsection
