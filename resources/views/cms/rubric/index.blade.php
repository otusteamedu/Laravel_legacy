@extends('cms.layout')
@section('title', __('cms.rubric.title.index'))
@section('h1', __('cms.rubric.title.index'))
@section('controls')
    @can(\App\Policies\Abilities::CREATE, \App\Models\Post\Rubric::class)
        <div class="p-2">
            <a class="btn btn-primary" href="{{ route('cms.rubrics.create') }}" role="button">{{__('cms.rubric.actions.add')}}</a>
        </div>
    @endcan
@endsection
@section('content')
    <table class="table table-striped">
        @include('cms.rubric.blocks.list.header')
        <tbody>
        @each('cms.rubric.blocks.list.item', $rubrics, 'rubric')
        </tbody>
    </table>

    {{ $rubrics->links() }}
@endsection
