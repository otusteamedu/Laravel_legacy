@extends('layouts.page_personal')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Ученик</li>
</ol>
@stop


@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Редактирование ученика</div>
        <div class="card-body card-block">
            <form action="{{route('admin.student.update', $student)}}" method="post" class="">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Имя" class="form-control" value="{{$student->name}}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">Родители</label>
                    </div>
                    <div class="col-12 col-md-9">


                        @foreach ($users as $user)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="user_id[]" value="{{$user->id}}" id="defaultCheck{{$loop->iteration}}"
                            @if($student->users->where('id',$user->id)->count())
                            checked="checked"
                            @endif
                            >
                            <label class="form-check-label" for="defaultCheck{{$loop->iteration}}">
                                {{$user->name}}
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop