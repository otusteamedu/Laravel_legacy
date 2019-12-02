@extends('admin.layouts.admin')

@section('pageTitle', __('admin.security.perms'))

@section('pageTop')
    @php
        $pathNav = [
            [
                'url' => route('admin.index'),
                'title' => __('admin.home')
            ], [
                'url' => '#',
                'title' => __('admin.menu.security.index')
            ], [
                'url' => route('admin.security.index'),
                'title' => __('admin.menu.security.perms')
            ]
        ];
        $btnNav = [];
    @endphp

    @include('admin.elements.breadcrumbs', ['breadCrumbs' => $pathNav])
    @include('admin.elements.toppanel', [
        'title' => __('admin.security.perms'),
        'cmdButtons' => $btnNav
    ])
@endsection

@section('pageContent')
    {{ Form::open(['url' => route('admin.security.index'), 'method' => 'patch']) }}
    <table class="table table-striped table-sm" role="list">
        <thead>
        <tr>
            <th>Модуль / Роли</th>
            @foreach($roles as $role)
                <th style="width:190px;">{{ $role['name'] }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($modulesAccess as $module)
            <tr>
                <td>{{ $module['name'] }}</td>
                @foreach($roles as $role)
                    <td style="width:190px;">
                        <select class="form-select" name="permissions[{{ $module['id'] }}][{{ $role['id'] }}]" style="width:100%;">
                            <option value="0">[не задано]</option>
                            @foreach($module['accesses'] as $access)
                                <option value="{{ $access['id'] }}"
                                    @if($access['id'] == $permissions[$module['id']][$role['id']]) selected @endif >[{{ $access['code'] }}] {{ $access['name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ Form::submit(__('admin.save'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
