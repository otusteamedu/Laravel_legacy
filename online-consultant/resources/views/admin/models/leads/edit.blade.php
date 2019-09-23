@extends('admin.layouts.index')

@section('title', __('admin.leads.pages.edit.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.leads.edit', $lead) }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row row-section-header">
                        <div class="col">
                            <h1>{{ __('admin.leads.pages.edit.title') }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('admin.models.leads.controls.edit.single')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('admin.models.leads.forms.edit')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
