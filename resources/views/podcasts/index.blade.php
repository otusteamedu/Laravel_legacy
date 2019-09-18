@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="title">@lang('Подкасты')</h1>

        <table class="table">
            <thead>
            <tr>
                <th>@lang('Обложка')</th>
                <th>@lang('Название подкаста')</th>
                <th>@lang('Последний эпизод')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($podcasts as $podcast)
                <tr>
                    <td>
                        <a href="{{ route('podcasts.edit', $podcast['id']) }}">
                        <img src="https://via.placeholder.com/128x128.png?text={{ rawurlencode($podcast['name']) }}"
                             class="image is-128x128"/>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('podcasts.edit', $podcast['id']) }}">{{ $podcast['name'] }}</a>
                    </td>
                    <td>
                        @if(!empty($podcast['last_episode']))
                            № {{ $podcast['last_episode']['no'] }}
                            {{ $podcast['last_episode']['name'] }}
                        @else
                            <span class="has-text-grey-light">Нет эпизодов</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <span class="has-text-grey-light">Нет подкастов</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
