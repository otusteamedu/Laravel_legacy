@extends('admin.layouts.index')

@section('title', __('admin.widgets.pages.create.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.widgets.create') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row row-section-header">
                        <div class="col">
                            <h1>{{ __('admin.widgets.pages.create.title') }}</h1>
                        </div>
                    </div>
                    @if(count($companiesSelectList) > 0)
                        <div class="row">
                            <div class="col">
                                @include('admin.models.widgets.forms.create')
                            </div>
                        </div>
                    @else
                        @include('common.errors.no_companies')
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
