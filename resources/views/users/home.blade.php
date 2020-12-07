@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="count">
                        <h4 class="card-title">@lang('user.totalForThePeriod')</h4>
                        <p>@lang('user.incomeCount'): <span class="income">{{$incomeCount}}</span> @lang('user.consumptionCount'): <span class="consumption">{{$consumptionCount}}</span></p>
                    </div>
                    <h4 class="card-title">@lang('user.listOfOperations')</h4>
                    <div class="index-button-group">
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="today">@lang('user.today')</button>
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="yesterday">@lang('user.yesterday')</button>
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="week">@lang('user.week')</button>
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="month">@lang('user.month')</button>
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="quarter">@lang('user.quarter')</button>
                        <button type="button" class="btn waves-effect waves-light btn-success together" period="year">@lang('user.year')</button>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>@lang('user.sum')</th>
                                <th>@lang('user.category')</th>
                                <th>@lang('user.description')</th>
                                <th>@lang('user.date')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($operations as $operation)
                                <tr>
                                    <td><span class="@if($operation->category->type){{'income'}}@else{{'consumption'}}@endif">{{$operation->sum}}</span></td>
                                    <td>{{$operation->category->name}}</td>
                                    <td>{{$operation->description}}</td>
                                    <td>{{$operation->created_at}}</td>
                                    <td>
                                        <a href="{{route('operation.edit', ['operation' => $operation->id])}}">
                                            <i class="fas fa-edit" title="@lang('user.edit')"></i>
                                        </a>
                                        <form action="{{route('operation.destroy', ['operation' => $operation->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0);" onclick="parentNode.submit();">
                                                <i class="fas fa-trash" title="@lang('user.delete')"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- This is data table -->
    <script src="/assets/plugins/datatables/datatables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script src="/js/datatables.custom.js"></script>
@endsection