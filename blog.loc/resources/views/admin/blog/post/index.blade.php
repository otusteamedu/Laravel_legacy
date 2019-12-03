@extends('admin.layouts.app')

@section('top_nav')
    @include('admin.navigation.top_menu')
@endsection

@section('main')
    <div class="row p-1">
        <div class="col-8">
            <h3>{{ $pageTitle }}</h3>
        </div>
        <div class="col-4">
            <a class="btn btn-primary float-right" href="{{ route('admin.blog.posts.create') }}">Создать пост</a>
        </div>
    </div>

    @include('admin._particle.flash.errors')

    @include('admin._particle.flash.success')

    @include('admin._particle.flash.error')

    @if(isset($users))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Статус</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Текст</th>
                <th scope="col">Автор</th>
                <th scope="col">Категоря</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->status }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->short_text }}</td>
                    <td>{{ $post->user_id }}</td>
                    <td>{{ $post->category_id }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Нет данных
    @endif
@endsection