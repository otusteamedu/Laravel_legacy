<?php
/**
 * @var \App\Models\Post\Post $post
 */
?>
@extends('cms.layout')
@section('title', __('cms.post.title.show'))
@section('h1', __('cms.post.title.show'))
@section('controls')
    @can(\App\Policies\Abilities::UPDATE, $post)
        <div class="p-2">
            <a class="btn btn-primary" href="{{ route('cms.posts.edit', ['post' => $post->id, 'locale' => $locale]) }}" role="button">{{__('cms.post.actions.edit')}}</a>
        </div>
    @endcan
    @can(\App\Policies\Abilities::PUBLISHED, $post)
        @if($post->is_published)
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
    @can(\App\Policies\Abilities::DELETE, $post)
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
                {{__('cms.fields.name')}}
            </th>
            <td style="width: 80%">
                {{$post->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.title')}}
            </th>
            <td>
                {{$post->title}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.keywords')}}
            </th>
            <td>
                {{$post->keywords}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.description')}}
            </th>
            <td>
                {{$post->description}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.post.fields.rubrics')}}
            </th>
            <td>
                {{$post->rubrics->pluck('name')->join('; ')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.image')}}
            </th>
            <td>
                @if ($post->image)
                    <img src="{{$image['path']}}/{{$image['image']}}">
                @endif
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.content')}}
            </th>
            <td>
                {{$post->content}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.slug')}}
            </th>
            <td>
                {{$post->slug}}
            </td>
        </tr>
        @if($post->is_published)
            <tr>
                <th scope="col">
                    {{__('cms.fields.published_at')}}
                </th>
                <td>
                    {{$post->published_at->format('d.m.Y H:m:i')}}
                </td>
            </tr>
        @endif
        <tr>
            <th scope="col">
                {{__('cms.fields.user')}}
            </th>
            <td>
                @if ($post->user->trashed())
                {{$post->user->name}}
                @else
                {{ link_to(route('cms.users.show', ['user' => $post->user->id, 'locale' => $locale]), $post->user->name, ['target' => '_blank']) }}
                @endif
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$post->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$post->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@if($post->is_published)
    @include('cms.post.blocks.form.unpublished')
@else
    @include('cms.post.blocks.form.published')
@endif
@include('cms.post.blocks.form.destroy')
@endsection