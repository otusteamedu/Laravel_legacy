@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="mb-0">@lang('form.register')</h3></div>
                    <div class="card-body">
                        @include('auth/partial/register_form', ['scenario'=>'register'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
