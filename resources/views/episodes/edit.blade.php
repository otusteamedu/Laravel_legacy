@extends('layouts.app')

@section('content')
    <div class="content">
        @include('episodes.common.nav', ['head_text' => __('common.episode')]);

        {{ Form::model($episode, ['route' => ['episodes.update', $episode->id], 'method' => 'put', 'files' => true]) }}

        @include('episodes.common.fields')

        @include('components.form.save', ['text' => __('episode.save'), 'cancelUrl' => route('episodes.index')])

        {!! Form::close() !!}

        @include('components.form.delete', [
            'text' => __('episode.delete'),
            'confirmation' => __('episode.delete_confirmation', ['name' => $episode->name]),
            'url' => route('episodes.destroy', $episode->id),
        ])

    </div>

@endsection
