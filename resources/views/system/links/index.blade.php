@extends('layouts.app')
<?php /** @var \App\Model\Menu\Link[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $links */?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('blocks.success_message.default')
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <a class="btn btn-primary" href="{{route('links.create')}}"
                   role="button">@lang('link.system.list_page.create_nav_button')</a>
            </div>
            <div class="col-md-8">

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">@lang('link.system.label.id')</th>
                        <th scope="col">@lang('link.system.label.type')</th>
                        <th scope="col">@lang('link.system.label.name')</th>
                        <th scope="col">@lang('link.system.label.route_name')</th>
                        <th scope="col">@lang('link.system.label.disabled')</th>
                        <th scope="col">@lang('link.system.list_page.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr>
                            <th scope="row"><a href="{{route('links.show', [$link])}}">{{$link->id}}</a></th>
                            <td>{{$link->type}}</td>
                            <td>{{$link->name}}</td>
                            <td>{{$link->route_name}}</td>
                            <td>{{$link->disabled}}</td>
                            <td>@include('blocks.system.links.delete.button', ['link' => $link])</td>
                        </tr>
                    @endforeach
                    @if($links->count() < 1)
                        <tr>
                            <td colspan="5">@lang('link.system.list_page.no_items')</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{ $links->links() }}
            </div>
        </div>
    </div>
@endsection

