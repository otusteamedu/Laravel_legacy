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
                    {{ __('admin.pages.dashboard') }}
                </div>
            </div>
        </div>
    </section>
@endsection
