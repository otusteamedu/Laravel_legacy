@extends('admin.layouts.admin')

@section('pageTitle', __('admin.countries.list'))

@section('pageTop')
    @php
        $pathNav = [
            [
                'url' => route('admin.index'),
                'title' => __('admin.home')
            ], [
                'url' => '#',
                'title' => __('admin.menu.movies.index')
            ], [
                'url' => route('admin.countries.index'),
                'title' => __('admin.menu.movies.countries')
            ]
        ];
        $btnNav = [
            [
                'url' => route('admin.countries.create'),
                'title' => __('admin.create')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', ['breadCrumbs' => $pathNav])
    @include('admin.elements.toppanel', [
        'title' => __('admin.countries.list'),
        'cmdButtons' => $btnNav
    ])
@endsection

@section('pageContent')
    @if(count($dataList) > 0)
    <div class="table-responsive">
        <form action="">
            <input name="cmd" type="hidden" value="" />
            <table class="table table-striped table-sm" role="list">
                <thead>
                    <tr>
                        <th><input type="checkbox" value="" role="checkall"></th>
                        <th>ID</th>
                        <th>@lang('admin.title')</th>
                        <th>@lang('admin.sort')</th>
                        <th>@lang('admin.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataList as $item)
                    <tr>
                        <td><input type="checkbox" value="{{ $item }}" role="checkitem" /></td>
                        <td>
                            <a href="{{ route('admin.countries.edit', ['country' => $item->id]) }}">{{ $item->id }}</a>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->sort }}</td>
                        <td>
                            <a href="{{ route('admin.countries.edit', ['country' => $item->id]) }}" class="i-icon i-edit text-info">
                                <i class="fas fa-edit"></i>
                                <span>@lang('admin.edit')</span>
                            </a>
                            <a href="{{ route('admin.countries.destroy', ['country' => $item->id]) }}"
                               onclick="var o=document.getElementById('deleteModal').getElementsByTagName('form')[0];o.action=this.href;return false;"
                               class="i-icon i-delete text-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i>
                                <span>@lang('admin.delete')</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                {{ Form::open(['url' => route('admin.countries.index'), 'method' => 'delete', 'class' => 'modal-content']) }}
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('admin.deletetitle', ['name' => $item->name])</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('admin.deleteconfirm')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                        <!--button type="button" class="btn btn-primary">Save changes</button-->
                        {{ Form::submit(__('admin.countries.delete'), array('class' => 'btn btn-danger')) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @else
        <div class="list-empty alert alert-danger">
            @lang('admin.listempty')
        </div>
    @endif
@endsection
