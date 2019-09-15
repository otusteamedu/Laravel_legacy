@extends('admin.layouts.index')

@section('title', __('admin.pages.dashboard'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.dashboard') }}
@endsection

@section('content')
    <section class="page-section">
        <div id="app">
            <card-simple title="{{ __('admin.pages.dashboard') }}">
                <p>{{ __('Content') }}</p>
            </card-simple>
        </div>
    </section>
@endsection
