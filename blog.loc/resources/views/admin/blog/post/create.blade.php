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
            {{--<a class="btn btn-primary float-right" href="{{ route('admin.blog.posts.create') }}">Создать пост</a>--}}
        </div>
    </div>

    @include('admin._particle.flash.errors')

    @include('admin._particle.flash.success')

    @include('admin._particle.flash.error')

    <form action="{{ route('admin.blog.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" placeholder="Введите заголовок" name="title">
        </div>
        <div class="form-group">
            <label for="short_text">Тизер</label>
            <textarea class="form-control" id="short_text" rows="3" name="short_text"></textarea>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea class="form-control" id="text" rows="3" name="text"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Миниатюра</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select class="form-control" id="category" name="category">
                <option value="0">Нет</option>
                {{--@foreach($categories as $category)--}}
                    {{--<option value="{{ $category->id }}">{{ $category }}</option>--}}
                {{--@endforeach--}}
            </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
    </form>
@endsection