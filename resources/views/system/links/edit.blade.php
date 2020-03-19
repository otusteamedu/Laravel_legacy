@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('blocks.success_message.default')
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('link.system.edit_page.title') {{ $link->id }}</div>

                    <div class="card-body">
                        @include('blocks.system.links.edit.form', ['link' => $link])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
