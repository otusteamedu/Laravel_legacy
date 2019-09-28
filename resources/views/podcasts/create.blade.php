@extends('layouts.app')

@section('content')
    <div class="content">
        @include('episodes.common.nav', ['head_text' => __('podcast.new_podcast')])

        {{ Form::open(['route' => ['podcasts.store'], 'files' => true]) }}

        @include('podcasts.common.fields')

        @include('components.form.save', ['text' => __('podcast.save'), 'cancelUrl' => route('podcasts.index')])

        {!! Form::close() !!}

    </div>

@endsection
