@extends('layouts.app')

@section('content')
    <div class="content">
        @include('episodes.common.nav', ['head_text' => __('episode.new_episode')]);

        {{ Form::open(['route' => ['episodes.store'], 'files' => true]) }}

        @include('episodes.common.fields')

        @include('components.form.save', ['text' => __('episode.save'), 'cancelUrl' => route('episodes.index')])

        {!! Form::close() !!}

    </div>

@endsection
