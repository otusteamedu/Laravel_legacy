@extends('cms.main')
@section('content')
    <h1 class="h3 text-center mt-5">Добавить задачу</h1>
    @include('cms.include.message')
    @include('cms.tasks.forms.form_add')
@endsection

