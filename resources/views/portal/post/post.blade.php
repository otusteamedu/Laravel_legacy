<?php
/** @var \App\Models\Post\Post $post */
?>
@extends('portal.layout')
@section('title', $post->title)
@section('description', $post->description)
@section('keywords', $post->keywords)
@section('content')
    <h1>{{$post->name}}</h1>
    <p>{{$post->created_at->format('d.m.Y')}}</p>
    <img src="{{$post->image['path'] . '/' . $post->image['image']}}" alt="{{$post->name}}" class="mw-100 h-auto d-block pb-1">
    {{$post->content}}
    <p>{{$post->user->name}}</p>
    @if (!empty($comments))
        @include('portal.post.blocks.comments', ['comments' => $comments, 'path' => 'root'])
    @endif
@endsection