<?php
/**
 * @var \App\Models\Post\Comment $comment
 */
?>
@extends('cms.layout')
@section('title', __('cms.comment.title.show'))
@section('h1', __('cms.comment.title.show'))
@section('controls')
    @can(\App\Policies\Abilities::PUBLISHED, $comment)
        @if($comment->is_published)
            <div class="p-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#unpublishedModal">
                    {{__('cms.actions.unpublished')}}
                </button>
            </div>
        @else
            <div class="p-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#publishedModal">
                    {{__('cms.actions.published')}}
                </button>
            </div>
        @endif
    @endcan
    @can(\App\Policies\Abilities::DELETE, $comment)
        <div class="p-2">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroyModal">
                {{__('cms.actions.destroy')}}
            </button>
        </div>
    @endcan
@endsection
@section('content')
<table class="table table-striped">
    <tbody>
        <tr>
            <th scope="col">
                {{__('cms.fields.content')}}
            </th>
            <td style="width: 80%">
                {{$comment->content}}
            </td>
        </tr>
        @if($comment->parent)
        <tr>
            <th scope="col">
                {{__('cms.comment.fields.answer')}}
            </th>
            <td>
                {{$comment->parent->content}}
                <p>----------------</p>
                {{ link_to(route('cms.comments.show', ['comment' => $comment->parent->id]), __('cms.comment.actions.open'), ['target' => '_blank']) }}
            </td>
        </tr>
        @endif
        @if($comment->children)
            <tr>
                <th scope="col">
                    {{__('cms.comment.fields.countAnswer')}}
                </th>
                <td>
                    {{$comment->children->count()}}
                </td>
            </tr>
        @endif
        <tr>
            <th scope="col">
                {{__('cms.comment.fields.post')}}
            </th>
            <td>
                {{ link_to(route('cms.posts.show', ['post' => $comment->post->id]), $comment->post->name, ['target' => '_blank']) }}
            </td>
        </tr>
        @if($comment->is_published)
        <tr>
            <th scope="col">
                {{__('cms.fields.published_at')}}
            </th>
            <td>
                {{$comment->published_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        @endif
        <tr>
            <th scope="col">
                {{__('cms.fields.user')}}
            </th>
            <td>
                @if($comment->user->trashed())
                {{$comment->user->name}}
                @else
                {{ link_to(route('cms.users.show', ['user' => $comment->user->id]), $comment->user->name, ['target' => '_blank']) }}
                @endif
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$comment->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$comment->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@if($comment->is_published)
    @include('cms.comment.blocks.form.unpublished')
@else
    @include('cms.comment.blocks.form.published')
@endif
@include('cms.comment.blocks.form.destroy')
@endsection