@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Список новостей
@stop
@section("content")
    <div class="table-responsive">
        <p>
            <a href="{{route('admin.news.create')}}" class="btn btn-sm btn-outline-secondary">
                <svg height="24" class="octicon octicon-plus" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5v2z"></path></svg>
                Создать новость
            </a>
        </p>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Detail</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Picture id</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($newsList as $news)
                <tr>
                    <td>
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('admin.news.show', $news)}}">
                            <svg height="12" class="octicon octicon-person" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true">
                                <g transform="scale(0.015625 0.015625)"><path d="M864 0h-768c-52.8 0-96 43.2-96 96v832c0 52.8 43.2 96 96 96h768c52.8 0 96-43.2 96-96v-832c0-52.8-43.2-96-96-96zM832 896h-704v-768h704v768zM256 448h448v64h-448zM256 576h448v64h-448zM256 704h448v64h-448zM256 320h448v64h-448z"></path></g>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <form action="{{route('admin.news.destroy', $news)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                                <svg height="12" class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('admin.news.edit', $news)}}" method="GET">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                                <svg height="12" class="octicon octicon-pencil" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 011.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"></path></svg>
                            </button>
                        </form>
                    </td>
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->name }}</td>
                    <td>{{ mb_strimwidth($news->description, 0, 50, '...') }}</td>
                    <td>{{ $news->picture_id }}</td>
                    <td>{{ $news->created_at }}</td>
                    <td>{{ $news->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$newsList->links()}}
    </div>
@stop
