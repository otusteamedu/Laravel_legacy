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

    <form action="{{ route('admin.blog.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Название категории</label>
            <input type="text" class="form-control" id="title" placeholder="Введите название категории" name="title">
        </div>
        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
    </form>
@endsection