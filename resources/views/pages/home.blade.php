@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-md-3">
            @include('components.profile.profile' , [$user])
        </div>
        <div class="col-md-6 feed">
            @include('components.feed.form')
            @foreach($posts as $post)
                @include('components.feed.post.post', [$post])
            @endforeach
        </div>
    </div>
@endsection
