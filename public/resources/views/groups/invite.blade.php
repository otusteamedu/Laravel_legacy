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
                    <th scope="col">Группы</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>


                @forelse ($users as $user)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->name}}</a></td>
                    <td>
                        @isset($user->groups)
                        {{$user->groups->pluck('name')->implode(', ')}}
                        @endisset
                    </td>
                    <td>
                        <form action="{{route('admin.groups.addUser', $group)}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i>пригласить</button>
                        </form>

                        {{--<a href="{{route('admin.groups.adduser', [$group->id, $user->id])}}">пригласить</a>--}}
                    </td>
                </tr>
                @empty
                <tr>
                    <th scope="row">-</th>
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