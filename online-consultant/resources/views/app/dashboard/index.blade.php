@extends('app.layouts.index')

@section('title', __('app.pages.dashboard'))

@section('content')
    <section class="page-section">
        <div id="app">
            <card-simple title="{{ __('app.pages.dashboard') }}">
                <p>{{ __('Content') }}</p>
            </card-simple>
        </div>
    </section>
@endsection
