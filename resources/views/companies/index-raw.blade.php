@extends('layouts.layout')

@section('title', __('messages.products'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => '/companies',
                'title' => __('messages.companies'),
            ],
        ];
    @endphp
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('companies.blocks.header.list')
    <table class="table table-striped">
        @include('companies.blocks.list.header', ['companies' => $companies])
        <tbody>

        @foreach($companies as $company)
            <tr>
                <th scope="row">{{ $company->id }}</th>
                <th>{{ $company->name }}</th>
                <th>{{ $company->url }}</th>
                <td>{{ $company->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
