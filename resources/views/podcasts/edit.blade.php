@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="title">@lang('Подкаст')</h1>
        <form method="POST" action="{{ route('podcasts.update', $podcast['id']) }}">
            @csrf
            @method('PATCH')

            <div class="columns">
                <div class="column">
                    @field(['field' => 'name', 'text' => 'Название'])
                        @input(['field' => 'name', 'value' => $podcast['name'], 'required' => true])
                    @endfield

                    @field(['field' => 'description', 'text' => 'Описание'])
                        @textarea(['field' => 'description', 'value' => $podcast['description']])
                    @endfield
                </div>
                <div class="column">
                    <img
                        src="https://via.placeholder.com/300x300.png?text={{ rawurlencode($podcast['name']) }}"
                        class="image" style="width: 300px; height: 300px"/>
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input" type="file" name="cover">
                            <span class="file-cta">
                              <span class="file-icon">
                                <i class="fas fa-upload"></i>
                              </span>
                              <span class="file-label">
                                @lang('Загрузить обложку')
                              </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <div class="field">
                            <button type="submit" class="button is-link">
                                @lang('Сохранить')
                            </button>
                        </div>
                    </div>
                </div>
                <div class="level-right">
                    <div class="navbar-item">
                        <a class="button is-outlined button-delete is-small"
                           href="{{ route('podcasts.destroy', $podcast['id']) }}"
                           onclick="
                               event.preventDefault();
                               confirm('@lang('Вы действительно хотите удалить подкаст?')')
                               ? document.getElementById('delete-form').submit()
                               : false;"
                        >
                            @lang('Удалить подкаст')
                        </a>
                    </div>

                </div>
            </nav>
        </form>

    </div>

    <form id="delete-form" action="{{ route('podcasts.destroy', $podcast['id']) }}" method="POST"
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection
