@extends('layouts.app')
@section('main')
    <div class="row row-cols-1 row-cols-md-6">
        @foreach($users as $user)
            <div class="col mb-4">
                @include('components.profile.profile_card', [$user])
            </div>
        @endforeach
    </div>
@endsection
