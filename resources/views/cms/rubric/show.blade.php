<?php
/**
 * @var \App\Models\Post\Rubric $rubric
 */
?>
@extends('cms.layout')
@section('title', __('cms.rubric.title.show'))
@section('h1', __('cms.rubric.title.show'))
@section('controls')
    @can(\App\Policies\Abilities::UPDATE, $rubric)
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.rubrics.edit', [$rubric->id, 'locale' => $locale]) }}" role="button">{{__('cms.rubric.actions.edit')}}</a>
    </div>
    @endcan
    @can(\App\Policies\Abilities::DELETE, $rubric)
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
                {{$rubric->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.title')}}
            </th>
            <td>
                {{$rubric->title}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.keywords')}}
            </th>
            <td>
                {{$rubric->keywords}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.description')}}
            </th>
            <td>
                {{$rubric->description}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.rubric.fields.countPost')}}
            </th>
            <td>
                {{$rubric->posts->count()}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.slug')}}
            </th>
            <td>
                {{$rubric->slug}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$rubric->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$rubric->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@include('cms.rubric.blocks.form.destroy')
@endsection