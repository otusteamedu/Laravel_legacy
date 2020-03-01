@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Список пользователей
@stop

@section("content")
    <div class="table-responsive">
        <p>
            <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-outline-secondary">
                <svg height="24" class="octicon octicon-plus" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5v2z"></path></svg>
                Создать нового пользователя
            </a>
        </p>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Detail</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Id</th>
                <th>Active</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($userList as $user)
                <tr>
                    <td>
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('admin.users.show', $user)}}">
                            <svg height="12" class="octicon octicon-person" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 14.002a.998.998 0 01-.998.998H1.001A1 1 0 010 13.999V13c0-2.633 4-4 4-4s.229-.409 0-1c-.841-.62-.944-1.59-1-4 .173-2.413 1.867-3 3-3s2.827.586 3 3c-.056 2.41-.159 3.38-1 4-.229.59 0 1 0 1s4 1.367 4 4v1.002z"></path></svg>
                        </a>
                    </td>
                    <td>
                        <form action="{{route('admin.users.destroy', $user)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                                <svg height="12" class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('admin.users.edit', $user)}}" method="GET">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                                <svg height="12" class="octicon octicon-pencil" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 011.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"></path></svg>
                            </button>
                        </form>
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->active }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$userList->links()}}
    </div>
@stop
