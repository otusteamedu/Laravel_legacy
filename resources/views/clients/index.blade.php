@extends('layouts.general')

@section('content')
    @can('client.create')
        <div class="float-right">
            <a href="{{ route('clients.create') }}" class="btn btn-primary m-1">{{ __('clients/general.index.create') }}</a>
        </div>
    @endcan
    <h1>{{ $title }}</h1>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">{{__('clients/general.index.list.id')}}</th>
                    <th>{{__('clients/general.index.list.name')}}</th>
                    <th>{{__('clients/general.index.list.email')}}</th>
                    <th>{{__('clients/general.index.list.balance')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($list as $item)
                    @include('clients.blocks.list_item')
                @empty
                    <tr>
                        <td class="text-center" colspan="5">{{__('clients/general.index.list.empty')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
        </div>
    </div>


@endsection
