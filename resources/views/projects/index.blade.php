@extends('layouts.general')

@section('content')
    <div class="float-right">
        <a href="{{ route('projects.create') }}" class="btn btn-primary m-1">{{ __('projects/general.index.create') }}</a>
    </div>
    <h1>{{ $title }}</h1>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">{{__('projects/general.index.list.id')}}</th>
                    <th>{{__('projects/general.index.list.name')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($list as $item)
                    @include('projects.blocks.list_item')
                @empty
                    <tr>
                        <td class="text-center" colspan="3">{{__('projects/general.index.list.empty')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $list->links() }}</div>
        </div>
    </div>


@endsection
