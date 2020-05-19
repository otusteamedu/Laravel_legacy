@extends('layouts.welcome')

@section('welcome_content')
    <div class="content">
        <div class="card h5">
            <div class="card-body">
                <h2>@lang('scheduler.contacts')</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">@lang('scheduler.address'): </li>
                    <li class="list-group-item">@lang('scheduler.email'): </li>
                    <li class="list-group-item">@lang('scheduler.tel'): </li>
                </ul>
            </div>
            <div class="col-md-8 offset-md-2">
                @include('blocks.pages.feedback')
            </div>
        </div>
    </div>
@endsection
