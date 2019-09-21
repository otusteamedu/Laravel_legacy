@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Group</li>
</ol>
@stop
@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Создание группы</div>
        <div class="card-body card-block">
            <form action="" method="post" class="">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
            </form>
        </div>
    </div>
</div>

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
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                @foreelse ($groups as $group)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$group->name}}</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                @endforeelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop