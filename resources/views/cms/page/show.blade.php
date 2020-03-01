<?php
/**
 * @var \App\Models\Page\Page $page
 */
?>
@extends('cms.layout')
@section('title', __('cms.page.title.show'))
@section('h1', __('cms.page.title.show'))
@section('controls')
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.pages.edit', [$page->id, 'locale' => $locale]) }}" role="button">{{__('cms.page.actions.edit')}}</a>
    </div>
    <div class="p-2">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroyModal">
            {{__('cms.actions.destroy')}}
        </button>
    </div>
@endsection
@section('content')
<table class="table table-striped">
    <tbody>
        <tr>
            <th scope="col">
                {{__('cms.fields.name')}}
            </th>
            <td style="width: 80%">
                {{$page->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.title')}}
            </th>
            <td>
                {{$page->title}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.keywords')}}
            </th>
            <td>
                {{$page->keywords}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.description')}}
            </th>
            <td>
                {{$page->description}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.content')}}
            </th>
            <td>
                {{$page->content}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.slug')}}
            </th>
            <td>
                {{$page->slug}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$page->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$page->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@include('cms.page.blocks.form.destroy')
@endsection