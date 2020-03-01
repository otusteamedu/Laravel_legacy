<?php
/**
 * @var \App\Models\User\Group $group
 */
?>
@extends('cms.layout')
@section('title', __('cms.group.title.show'))
@section('h1', __('cms.group.title.show'))
@section('controls')
    @can(\App\Policies\Abilities::UPDATE, $group)
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.groups.edit', [$group->id, 'locale' => $locale]) }}" role="button">{{__('cms.group.actions.edit')}}</a>
    </div>
    @endcan
    @can(\App\Policies\Abilities::DELETE, $group)
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
                {{$group->name}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.group.fields.rights')}}
            </th>
            <td>
                {{$group->rights->pluck('name')->join('; ')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.group.fields.countUsers')}}
            </th>
            <td>
                {{$group->users->count()}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.created_at')}}
            </th>
            <td>
                {{$group->created_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
        <tr>
            <th scope="col">
                {{__('cms.fields.updated_at')}}
            </th>
            <td>
                {{$group->updated_at->format('d.m.Y H:m:i')}}
            </td>
        </tr>
    </tbody>
</table>
@include('cms.group.blocks.form.destroy')
@endsection