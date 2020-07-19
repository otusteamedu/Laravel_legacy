@extends('app')

@section('content')

    <div class="page-header">
        <h3 class="page-title">{{__('lang-constructor.list-title')}}</h3>
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
                            <th style="width:10%">{{__('lang-constructor.table-col-id')}}</th>
                            <th style="width:30%">{{__('lang-constructor.table-col-title')}}</th>
                            <th style="width:10%">{{__('lang-constructor.table-col-hard')}}</th>
                            <th style="width:5%"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($langConstructor as $item)
                            <tr>
                                <td> {{$item->id}}</td>
                                <td> {{$item->name}}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                             aria-valuenow="{{$item->hard}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><a href="{{route('lang-constructor-edit',['id' =>$item->id])}}" class="btn btn-gradient-primary btn-fw">{{__('button.edit')}}</a> <a href="{{route('lang-constructor-delete',['id' =>$item->id])}}"  class="btn btn-gradient-danger btn-fw">{{__('button.delete')}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end" style="margin-bottom: 20px">
                    <div class="col-2">
                        <a href="{{route('lang-constructor-edit',['locale' => $locale])}}" class="btn btn-gradient-info btn-fw">{{__('button.create')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
