@extends('app')

@section('content')

    <div class="page-header">
        <h3 class="page-title">{{__('lang-constructor-type.list-title')}}</h3>
        @include('partials.system.breadcrumb')
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('partials.system.status')
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width:10%">{{__('lang-constructor-type.table-col-id')}}</th>
                            <th style="width:30%"> {{__('lang-constructor-type.table-col-title')}}</th>
                            <th style="width:5%"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($langConstructorTypes as $item)
                            <tr>
                                <td> {{$item->id}}</td>
                                <td> {{$item->name}}</td>
                                <td><a href="{{route('lang-constructor-type-edit',['id' =>$item->id])}}" class="btn btn-gradient-primary btn-fw">{{__('button.edit')}}</a> <a href="{{route('lang-constructor-type-delete',['id' =>$item->id])}}"  class="btn btn-gradient-danger btn-fw">{{__('button.delete')}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end" style="margin-bottom: 20px">
                    <div class="col-2">
                        <a href="{{route('lang-constructor-type-edit',['locale' => $locale])}}" class="btn btn-gradient-info btn-fw">{{__('button.create')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
