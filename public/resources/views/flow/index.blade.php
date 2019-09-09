@extends('layout._layout')


@section('content')
@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Flow</li>
</ol>
@stop

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Приход/расход</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>

                @foreach($arItem as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['var1'] }}</td>
                    <td>{{ $item['count'] }}</td>
                </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop