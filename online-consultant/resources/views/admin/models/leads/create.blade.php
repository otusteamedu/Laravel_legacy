@extends('admin.layouts.index')

@section('title', __('admin.leads.pages.create.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.leads.create') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row row-section-header">
                        <div class="col">
                            <h1>{{ __('admin.leads.pages.create.title') }}</h1>
                        </div>
                    </div>
                    @if(count($companiesSelectList) > 0)
                        <div class="row">
                            <div class="col">
                                {{-- TODO we don't ever need companies to create leads and widgets, change select items to users list --}}
                                @include('admin.models.leads.forms.create')
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
