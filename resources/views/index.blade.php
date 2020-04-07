@extends('layouts.app')
@section('breadcrumbs', '')

@section("content")
    <div class="row no-gutters">
        <div class="col-12">
            <div class="card-deck mb-3 mt-3 text-center">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h3 class="my-0 font-weight-normal">@lang('pages/index.create_event')</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">@lang('pages/index.opportunity_checklist')</h5>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">@lang('pages/index.proceed')</button>
                </div>
            </div>

            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h3 class="my-0 font-weight-normal">@lang('pages/index.find_event')</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">@lang('pages/index.opportunity_checklist')</h5>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">@lang('pages/index.proceed')</button>
                </div>
            </div>
        </div>
        </div>
    </div>

    <section class="counts section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>232</span>
                        <p>@lang('pages/index.participants')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>521</span>
                        <p>@lang('pages/index.active_events')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>1,463</span>
                        <p>@lang('pages/index.completed_events')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>15</span>
                        <p>@lang('pages/index.regions')</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
@stop
