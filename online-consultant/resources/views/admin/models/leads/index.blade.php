@extends('admin.layouts.index')

@section('title', __('admin.leads.pages.index.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.leads.index') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row row-section-header">
                <div class="col">
                    <h1>{{ __('admin.leads.pages.index.title') }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('admin.models.leads.controls.index.page')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('admin.models.leads.lists.index')
                </div>
            </div>
        </div>
    </section>
@endsection
