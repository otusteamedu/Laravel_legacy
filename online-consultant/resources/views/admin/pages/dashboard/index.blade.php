@extends('admin.layouts.index')

@section('title', __('admin.pages.dashboard'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.dashboard') }}
@endsection

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <h1>{{ __('admin.pages.dashboard') }}</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
