@extends('admin.layouts.admin')

@section('pageTitle', __('admin.movies.edit'))

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
                'url' => route('admin.movies.index'),
                'title' => __('admin.menu.movies.movies')
            ], [
                'url' => '#',
                'title' => __('admin.edit')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.movies.edit')])
@endsection

@section('pageContent')
    {{ Form::model($model, ['url' => route('admin.movies.update', ['itemId' => $model->id]), 'method' => 'put', 'files' => 'true']) }}

    @include('admin.movies.elements.fields')

    {{ Form::close() }}

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            {{ Form::open(['url' => route('admin.movies.destroy', ['itemId' => $model->id]), 'method' => 'delete', 'class' => 'modal-content']) }}
            <div class="modal-header">
                <h5 class="modal-title">@lang('admin.deletetitle', ['name' => $name])</h5>
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
                {{ Form::submit(__('admin.movies.delete'), array('class' => 'btn btn-danger')) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
