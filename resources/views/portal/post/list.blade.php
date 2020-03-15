@extends('portal.layout')
@section('title', $rubric->title ?? __('message.news'))
@section('description', $rubric->description ?? '')
@section('keywords', $rubric->keywords ?? '')
@section('content')
    <div class="row mb-2">
        @foreach($posts as $key=>$post)
            @include('portal.blocks.posts.list', ['post' => $post])
            @if(($key+1)%2 === 0)
                <div class="clearfix"></div>
            @endif
        @endforeach
    </div>
    {{ $posts->links() }}
@endsection
