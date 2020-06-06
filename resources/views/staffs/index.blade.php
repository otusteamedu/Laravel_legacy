@extends('layouts.general')

@section('content')
    @can('staff.create')
        <div class="float-right">
            <a href="{{ route('staffs.create') }}" class="btn btn-primary m-1">{{ __('staffs/general.index.create') }}</a>
        </div>
    @endcan
    <h1>{{ $title }}</h1>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">{{__('staffs/general.index.list.id')}}</th>
                    <th>{{__('staffs/general.index.list.name')}}</th>
                    <th>{{__('staffs/general.index.list.email')}}</th>
                    <th>{{__('staffs/general.index.list.group')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($list as $item)
                    @include('staffs.blocks.list_item')
                @empty
                    <tr>
                        <td class="text-center" colspan="5">{{__('staffs/general.index.list.empty')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
        </div>
    </div>


@endsection
