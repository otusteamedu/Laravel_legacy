@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="accordion" id="accordionExample">
                    @include('blocks.profile.account')
                    @include('blocks.profile.security')
                    @include('blocks.profile.other')
                </div>
            </div>
        </div>
    </div>
@endsection
