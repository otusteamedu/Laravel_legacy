@extends('layouts.app')

@section('content')
    <div class="content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">@lang('common.episode')</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    {{ link_to_route('episodes.index', __('episode.to_list'), [], ['class' => 'is-size-7']) }}
                </div>
            </div>
        </nav>

        {{ Form::model($episode, ['route' => ['episodes.update', $episode->id], 'method' => 'put', 'files' => true]) }}

        @include('episodes.common.form')

        @include('components.form.save', ['text' => __('episode.save'), 'cancelUrl' => route('episodes.index')])

        {!! Form::close() !!}

        @include('components.form.delete', [
            'text' => __('episode.delete'),
            'confirmation' => __('episode.delete_confirmation', ['name' => $episode->name]),
            'url' => route('episodes.destroy', $episode->id),
        ])

    </div>

@endsection
