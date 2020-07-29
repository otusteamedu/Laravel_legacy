@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    <table class="table table-hover">
        <tr>
            <td>@lang('scheduler.id')</td>
            @php/** @var \App\Models\Post $post */@endphp
            <td>{{ $post->id }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.title')</td>
            <td>{{ $post->title }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.groups')</td>
            <td>{{ $post->groups->pluck('number') }}</td>
        </tr>
        <tr>
            <td>@lang('scheduler.published_at')</td>
            <td>{{ $post->published_at }}</td>
        </tr>
    </table>

    @can(\App\Services\Helpers\Ability::DELETE, $post)
        @include('blocks.buttons.send', [
            'src' => route('posts.send', $post),
        ])
    @endcan

    @can(\App\Services\Helpers\Ability::UPDATE, $post)
        @include('blocks.buttons.update', [
            'src' => route('posts.edit', $post->id),
        ])
    @endcan

    @can(\App\Services\Helpers\Ability::DELETE, $post)
        @include('blocks.buttons.delete', [
            'src' => route('posts.destroy', $post->id),
        ])
    @endcan
@endsection
