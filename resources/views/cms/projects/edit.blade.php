@extends('cms.main')
@section('content')
    <h1 class="h3 text-center mt-5">Изменить проект</h1>
    @include('cms.include.message')
    @include('cms.projects.forms.form_edit')
@endsection
