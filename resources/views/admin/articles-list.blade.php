<!--Список статей-->
@php /** @var \App\Models\Article $article */ @endphp
@extends('layouts.admin')
@section('content')
    @include('blocks.navbars.admin-menu')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 ">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Управление <b>Статьями</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                            Добавить
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
            </div>
            <div id="data-list" class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Автор</th>
                        <th>Дата публикации</th>
                        <th>Состояние</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category->title }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->published_at }}</td>
                            <td>{{ $article->state }}</td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'url'=> route('articles.destroy', $article->id)]) }}
                                    <button type="button" class="btn btn-outline-info btn-sm edit"
                                            data-id="{{ $article->id }}"  data-target="articles">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 011.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"></path>
                                        </svg>
                                    </button>
                                    {!! Form::button('<svg width="14" height="16" viewBox="0 0 14 16" fill="currentColor"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"></path></svg>
        ', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm article-delete']) !!}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($articles->total() > $articles->count())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
    @include('blocks.modals.article-add')
    @include('blocks.modals.article-edit')
@endsection
@section('footer')
    <footer class="blog-footer border-top pt-3">
        @include('blocks.footer.footer')
    </footer>
@endsection
