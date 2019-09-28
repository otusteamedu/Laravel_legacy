@extends('layouts.app')

@section('content')
    <div class="content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">@lang('episode.new_episode')</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    {{ link_to_route('episodes.index', __('episode.to_list'), [], ['class' => 'is-size-7']) }}
                </div>
            </div>
        </nav>

        {{ Form::open(['route' => ['episodes.store'], 'files' => true]) }}

        @include('episodes.common.fields')

        @include('components.form.save', ['text' => __('episode.save'), 'cancelUrl' => route('episodes.index')])

        {!! Form::close() !!}

    </div>

@endsection
