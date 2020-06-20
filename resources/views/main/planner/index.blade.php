@extends('layouts.main.index')

@section('class', 'mp')

@section('title', \App\Services\PageHelper::generateTitle(__('pages.planner')))

@section('content')
    <div class="content">
        <div class="row">
            <div class="col">
                <a href="#" class="btn btn-primary">Добавить прокси</a>
            </div>
        </div>
    </div>
@endsection
