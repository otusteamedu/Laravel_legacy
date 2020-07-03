@extends('layouts.filter')

@section('filter_content')
    {!! Form::open(['url' => route('teachers.index'), 'method' => 'get']) !!}

    <div class="form-group">
        {{ Form::label('last_name', __('scheduler.last_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'last_name',
            $filter[\App\DTOs\TeacherFilterDTO::LAST_NAME] ?? null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', __('scheduler.email'), ['class' => 'control-label']) }}
        {{ Form::text(
            'email',
            $filter[\App\DTOs\TeacherFilterDTO::EMAIL] ?? null,
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('subject_id', __('scheduler.subject'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subject_id',
            $subjects,
            $filter[\App\DTOs\TeacherFilterDTO::SUBJECT_ID] ?? null,
            [
            'class' => 'selectpicker form-control',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            'placeholder' => ''
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
