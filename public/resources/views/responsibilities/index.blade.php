@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Ответственности</li>
</ol>
@stop
@section('content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Ответственности</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Группа</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($responsibilities as $responsibility)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('admin.responsibilities.show', $responsibility)}}">{{$responsibility->name}}</a></td>
                    <td>

                        {{$responsibility->group->name}}

                    </td>

                    <td>
                        <form onsubmit="if(confirm('удалить')){return true}else{return false}" action="{{route('admin.responsibilities.destroy', $responsibility)}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}

                            <a href="{{route('admin.responsibilities.edit', $responsibility)}}" class="btn btn-default">
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
                </tr>
                @endforelse

                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="bootstrap-data-table-export_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table-export_paginate">
                        <ul class="pagination">
                            {{$responsibilities->links()}}
<!--                            <li class="paginate_button page-item next" id="bootstrap-data-table-export_next"><a href="#" aria-controls="bootstrap-data-table-export" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop