@extends('layouts.admin')
@section('breadcrumbs', '')

@section("content")
    <h2>Список пользователей</h2>
    <div class="table-responsive">
        <button type="button" class="btn-primary">
            <svg height="24" class="octicon octicon-plus" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5v2z"></path></svg>
            Создать нового пользователя
        </button>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Delete</th>
                <th>Edit</th>
                <th>Id</th>
                <th>Active</th>
                <th>Email</th>
                <th>Email_verified_at</th>
                <th>Phone</th>
                <th>Phone_verified_at</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Country id</th>
                <th>Region</th>
                <th>Locality</th>
                <th>Picture id</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($userList as $user)
                <tr>
                    <td>
                        <a href="#">
                            <svg height="12" class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                        </a>
                    </td>
                    <td>
                        <a href="#">
                            <svg height="12" class="octicon octicon-pencil" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 011.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"></path></svg>
                        </a>
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->active }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->phone_verified_at }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->country_id }}</td>
                    <td>{{ $user->region }}</td>
                    <td>{{ $user->locality }}</td>
                    <td>{{ $user->picture_id }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
