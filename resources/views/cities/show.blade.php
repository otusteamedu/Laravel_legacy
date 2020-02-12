@extends('layouts.inner')

@section('title', $city['name'])
@section('h1', $city['name'])
@section('content')
    <div class="container">
        @include('admin.blocks.actions',[
            'actions' => [
                'destroy', 'edit',
            ],
            'entity_name' => [
                 's' => 'city',
                 'm' => 'cities',
            ],
            'entity' => $city,
        ])
        <br>
        <table class="table table-striped">
            <tr>
                <td>{{__('admin.cities.country')}}</td>
                <td>{{$city->country->name}}</td>
            </tr>
            <tr>
                <td>{{__('admin.created_at')}}</td>
                <td>{{$city->created_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection