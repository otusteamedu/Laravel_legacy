@php
/**
* @var $usersList \Illuminate\Pagination\Paginator список пользователей (по 15 за раз)
*/
@endphp

@extends('layouts.main')

@section('title', __('message.user.show_list.title'))

@section('content')
    <main>
        <div class="container">
            <div class="row pt-5">
                <div class="col text-center">
                    <h2>{{ __('message.user.show_list.title') }}</h2>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('message.user.show_list.table_thead_name') }}</th>
                        <th scope="col">{{ __('message.user.show_list.table_thead_email') }}</th>
                        <th scope="col">{{ __('message.user.show_list.table_thead_created_at') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersList as $user)
                    <tr>
                        <th scope="row">{{ $user['id'] }}</th>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $usersList->links() }}
            </div>
        </div>
    </main>
@endsection