<?php
/**
 * @var \App\Models\User\User $user
 */
?>
@extends('cms.layout')
@section('title', __('cms.user.title.show'))
@section('h1', __('cms.user.title.show'))
@section('controls')
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.users.edit', [$user->id]) }}" role="button">{{__('cms.user.actions.edit')}}</a>
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
                {{__('cms.user.fields.name')}}
            </th>
            <td style="width: 80%">
                {{$user->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.icon')}}
            </th>
            <td>
            @if ($user->icon)
                <img src="{{$image['path']}}/{{$image['image']}}">
            @endif
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.user.fields.email')}}
            </th>
            <td>
                {{$user->email}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.user.fields.group')}}
            </th>
            <td>
                {{$user->group->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$user->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$user->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@include('cms.user.blocks.form.destroy')
@endsection