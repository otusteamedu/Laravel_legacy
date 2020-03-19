@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('link.system.create_page.title')</div>

                    <div class="card-body">
                        @include('blocks.system.links.create.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
