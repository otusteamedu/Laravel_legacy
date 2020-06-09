@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('overview/general.balance.title') }}</h3>
                </div>
                <div class="card-body">
                    <h4 class="{{ $balance >= 0 ? 'text-success' : 'text-danger' }} text-center">
                        @moneyFormat($balance)
                    </h4>
                </div>
                <div class="card-footer">
                    <p class="text-center">
                        <a href="#" class="btn btn-success">{{ __('overview/general.balance.deposit') }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('overview/general.tasks.title') }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ __('overview/general.tasks.today') }}: <b>{{ $tasks['today'] }}</b></p>
                    <p>{{ __('overview/general.tasks.tomorrow') }}: <b>{{ $tasks['tomorrow'] }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('overview/general.projects.title') }}</h3>
                </div>
                <div class="card-body">
                    <div class="nav flex-column nav-pills">
                        @foreach($projects as $project)
                            <a class="nav-link" href="#">
                                <span class="float-right">
                                    <span class="badge badge-info" data-toggle="tooltip" title="{{ __('overview/general.projects.hint.new') }}">
                                        {{ $project['new'] }}
                                    </span>
                                    <span class="badge badge-success" data-toggle="tooltip" title="{{ __('overview/general.projects.hint.process') }}">
                                        {{ $project['process'] }}
                                    </span>
                                    <span class="badge badge-secondary" data-toggle="tooltip" title="{{ __('overview/general.projects.hint.ended') }}">
                                        {{ $project['ended'] }}
                                    </span>
                                </span>
                                {{ $project['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
