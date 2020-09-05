<!-- Управление системой -->
@extends('layouts.admin')
@section('content')
    @include('blocks.navbars.admin-menu')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 ">
        <div class="table-wrapper">
            <div class="table-title border-bottom">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>@lang('messages.admin.menu.commands')</h2>
                    </div>
                </div>
            </div>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('messages.admin.commands.description')</th>
                    <th>@lang('messages.admin.commands.actions')</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Очистить весь кеш</td>
                        <td>
                            {{ Form::open(['method' => 'GET', 'url'=> route('system.clearCache')]) }}
                            {!! Form::button('<svg width="14" height="16" viewBox="0 0 14 16" fill="currentColor"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"></path></svg>
                Выполнить', ['type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary cache-clear']) !!}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Опубликовать статьи ожидающие публикации</td>
                        <td>
                            {{ Form::open(['method' => 'GET', 'url'=> route('system.publishArticles')]) }}
                            {!! Form::button('<svg width="14" height="16" viewBox="0 0 14 16" fill="currentColor"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"></path></svg>
                Выполнить', ['type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary publish-articles']) !!}
                            {{ Form::close() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
@section('footer')
    <footer class="blog-footer border-top pt-3">
        @include('blocks.footer.footer')
    </footer>
@endsection
