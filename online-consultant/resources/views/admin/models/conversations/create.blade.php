@extends('admin.layouts.index')

@section('title', __('admin.conversations.pages.create.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.conversations.create') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row row-section-header">
                        <div class="col">
                            <h1>{{ __('admin.conversations.pages.create.title') }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('admin.models.conversations.forms.create')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection