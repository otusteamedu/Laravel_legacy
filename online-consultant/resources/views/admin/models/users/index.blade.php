@extends('admin.layouts.index')

@section('title', __('admin.users.pages.index.title'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.index') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row row-section-header">
                <div class="col">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h1>{{ __('admin.users.pages.index.title') }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('admin.models.users.controls.index.page')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('admin.models.users.lists.index')
                </div>
            </div>
        </div>
    </section>
@endsection
