@extends('layouts.app')

@section('content')
    <div class="content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">@lang('podcast.edit_h1')</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    {{ link_to_route('podcasts.index', __('podcast.to_list'), [], ['class' => 'is-size-7']) }}
                </div>
            </div>
        </nav>

        {{ Form::model($podcast, ['route' => ['podcasts.update', $podcast->id], 'method' => 'put', 'files' => true]) }}

        @include('podcasts.common.form')

        @include('components.form.save', ['text' => __('podcast.save'), 'cancelUrl' => route('podcasts.index')])

        {!! Form::close() !!}


        @include('components.form.delete', [
            'text' => __('podcast.delete'),
            'confirmation' => __('podcast.delete_confirmation', ['name' => $podcast->name]),
            'url' => route('podcasts.destroy', $podcast->id),
        ])

    </div>

@endsection
