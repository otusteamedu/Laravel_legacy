@extends('layouts.page_personal')


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
            <strong class="card-title">Транзакции</strong>

            <a href="{{route('admin.transaction.create', ['locale'=>$locale])}}" class="btn btn-success btn-sm text-right">Создать</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Кто (пользователь)</th>
                    <th scope="col">За кого (ученик)</th>
                    <th scope="col">За что (причина)</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($transactions as $transaction)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('admin.transaction.show', ['locale'=>$locale,'transaction'=>$transaction])}}">{{$transaction->amount}}</a></td>
                    <td>{{$transaction->user->name}}</td>
                    <td>{{$transaction->student->name}}</td>
                    <td>{{$transaction->reason->name}}</td>
                    <td>
                        <form onsubmit="if(confirm('удалить')){return true}else{return false}" action="{{route('admin.transaction.destroy', ['locale'=>$locale,'transaction'=>$transaction])}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <a href="{{route('admin.transaction.edit', ['locale'=>$locale,'transaction'=>$transaction])}}" class="btn btn-default">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i> Х</button>
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
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table-export_paginate">
                    <ul class="pagination">
                        {{$transactions->links()}}
                        <!--                            <li class="paginate_button page-item next" id="bootstrap-data-table-export_next"><a href="#" aria-controls="bootstrap-data-table-export" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>-->
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@stop