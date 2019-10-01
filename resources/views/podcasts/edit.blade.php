@extends('layouts.app')

@section('content')
    <div class="content">
        @include('episodes.common.nav', ['head_text' => __('common.podcast')])

        {{ Form::model($podcast, ['route' => ['podcasts.update', $podcast->id], 'method' => 'put', 'files' => true]) }}

        @include('podcasts.common.fields')

        @include('components.form.save', ['text' => __('podcast.save'), 'cancelUrl' => route('podcasts.index')])

        {!! Form::close() !!}

        @include('components.form.delete', [
            'text' => __('podcast.delete'),
            'confirmation' => __('podcast.delete_confirmation', ['name' => $podcast->name]),
            'url' => route('podcasts.destroy', $podcast->id),
        ])

    </div>

@endsection
