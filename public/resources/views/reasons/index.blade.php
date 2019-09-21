@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Group</li>
</ol>
@stop
@section('content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Название группы</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Группа</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($reasons as $reason)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('admin.reasons.show', $reason)}}">{{$reason->name}}</a></td>
                    <td>{{$reason->amount}}</td>
                    <td>
                        @isset($reason->group)
                        {{$reason->group->name}}
                        @endisset
                    </td>
                    <td>
                        <form onsubmit="if(confirm('удалить')){return true}else{return false}" action="{{route('admin.reasons.destroy', $reason)}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <a href="{{route('admin.reasons.edit', $reason)}}" class="btn btn-default">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <th scope="row">-</th>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop