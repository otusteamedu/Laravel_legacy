@extends('layouts.page_personal')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Ученики</li>
</ol>
@stop
@section('content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Ученики</strong>

            <a href="{{route('admin.student.create', ['locale'=>$locale])}}" class="btn btn-success btn-sm text-right">Создать</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Родители</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($students as $student)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('admin.student.show', ['locale'=>$locale, 'student'=>$student])}}">{{$student->name}}</a> [{{$student->id}}]</td>
                    <td>
                        {{$student->users()->pluck('name')->implode(', ')}}
                    </td>
                    <td>
                        <form onsubmit="if(confirm('удалить')){return true}else{return false}" action="{{route('admin.student.destroy', ['locale'=>$locale, 'student'=>$student])}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a href="{{route('admin.student.edit', ['locale'=>$locale, 'student'=>$student])}}" class="btn btn-default">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i>X</button>
                        </form>
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

            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table-export_paginate">
                        <ul class="pagination">
                            {{$students->links()}}
                            <!--                            <li class="paginate_button page-item next" id="bootstrap-data-table-export_next"><a href="#" aria-controls="bootstrap-data-table-export" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop