@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Journal $journal */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.journals.update', ['journal' => $journal]),
                'method' => 'PUT'
            ]
         )
    }}

    <?php
        $arUsers = $users->mapWithKeys(static function ( $user) {
            return [
              $user->id => $user->name
            ];
        })->toArray();

    $arStatuses = $statuses->mapWithKeys(static function ( $status) {
        return [
            $status->id => $status->name
        ];
    })->toArray();
    ?>

    <div class="form-group">

        {{Form::label('user_id', 'Пользователь')}}
        {{Form::select('user_id', $arUsers, $journal->user->id, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">

        {{Form::label('status_id', 'Статус')}}
        {{Form::select('status_id', $arStatuses, $journal->status->id, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
