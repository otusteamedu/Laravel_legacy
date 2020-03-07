@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Просмотр детальной страницы статьи №{{$article->id}}
@stop

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>Создан</strong>
                        <br>
                        {{$article->created_at ?? '-'}}
                    </p>
                    <p>
                        <strong>Активность</strong>
                        <br>
                        {{$article->active ?? '-'}}
                    </p>
                    <p>
                        <strong>Название</strong>
                        <br>
                        {{$article->name ?? '-'}}
                    </p>
                    <p>
                        <strong>Описание</strong>
                        <br>
                        {{$article->description ?? '-'}}
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>Изменена</strong>
                        <br>
                        {{$article->updated_at ?? '-'}}
                    </p>
                    <p>
                        <strong>Изображение</strong>
                        <br>
                        {{$article->picture_id ?? '-'}}
                    </p>
                </div>
                <div class="col-6">
                    <form class="float-left mr-2" action="{{route('admin.articles.destroy', $article)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                            Удалить
                            <svg height="12" class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                        </button>
                    </form>
                    <form class="float-left mr-2" action="{{route('admin.articles.edit', $article)}}" method="GET">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-sm btn-outline-secondary" value="submit" type="submit">
                            Изменить
                            <svg height="12" class="octicon octicon-pencil" viewBox="0 0 14 16" version="1.1" width="28" aria-hidden="true"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 011.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"></path></svg>
                        </button>
                    </form>
                    <p>
                        <a href="{{route('admin.articles.index')}}" class="btn btn-sm btn-outline-secondary">
                            <svg class="bi bi-list-ol" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7 13.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                                <path d="M3.713 13.865v-.474H4c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 01-.492.594v.033a.615.615 0 01.569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V11H3.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 00-.342.338v.041zM4.564 7h-.635V4.924h-.031l-.598.42v-.567l.629-.443h.635V7z"></path>
                            </svg>
                            Вернуться к списку
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
