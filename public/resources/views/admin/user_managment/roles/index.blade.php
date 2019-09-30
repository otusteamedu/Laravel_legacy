@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Роли</li>
</ol>
@stop
@section('content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Роли</strong>
        </div>
        <div class="card-body">
            <a href="{{route('admin.user_managment.roles.create')}}" class="btn">Добавить роль</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">slug</th>
                    <th scope="col">Операции</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($roles as $role)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('admin.user_managment.roles.show', $role)}}">{{$role->name}}</a></td>
                    <td>{{$role->slug}}</td>
                    <td>
                       {{-- @isset($user->roles)
                        {{$user->roles()->pluck('name')->implode(', ')}}
                        @endisset--}}
                    </td>
                    <td>
                        <form onsubmit="if(confirm('удалить')){return true}else{return false}" action="{{route('admin.user_managment.roles.destroy', $role)}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a href="{{route('admin.user_managment.roles.edit', $role)}}" class="btn btn-default">
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