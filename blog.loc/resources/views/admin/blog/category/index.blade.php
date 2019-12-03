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
            <a class="btn btn-primary float-right" href="{{ route('admin.blog.categories.create') }}">Создать категорию</a>
        </div>
    </div>

    @include('admin._particle.flash.errors')

    @include('admin._particle.flash.success')

    @include('admin._particle.flash.error')

    @if (count($categories) != 0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Категория</th>
                <th scope="col">Ссылка</th>
                <th scope="col">Дата создания</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->category }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <form class="d-inline-block" method="POST" action="{{ route('admin.blog.categories.destroy', ['id' => $category->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-success">Удалить</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('admin.blog.categories.edit', ['id' => $category->id]) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Нет данных
    @endif
@endsection