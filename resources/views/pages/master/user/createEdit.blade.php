<?php
/**
 * @var \App\Models\User $client
 */

$lastName = $client->last_name ?? '';
$firstName = $client->first_name ?? '';
$phoneNumber = $client->phone_number ?? '';
$email = $client->email ?? '';

$material = $client->clientInformation->material ?? '';
$note = $client->clientInformation->note ?? '';
?>

@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>{{ $title }}</h4>

            <div class="row">
                <form method="post" action="{{ route('master.user.create') }}">
                    @csrf
                    @foreach($errors->getMessages() as $messages)
                        @foreach($messages as $message)
                            <div class="col s12 red-text valign-wrapper">
                                <i class="material-icons">error_outline</i> {{ $message }}
                            </div>
                        @endforeach
                    @endforeach

                    <div class="input-field col s12 l6">
                        <input value="{{ $lastName }}" placeholder="Иванова" id="last_name" name="last_name" type="text" class="validate">
                        <label for="last_name">Фамилия</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="{{ $firstName }}" placeholder="Светлана" id="first_name" name="first_name" type="text" class="validate">
                        <label for="first_name">Имя</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="{{ $phoneNumber }}" placeholder="9999999999" id="phone_number" name="phone_number" type="text" class="validate">
                        <label for="phone_number">Номер телефона</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="{{ $material }}" placeholder="Klio Extra Rubber" id="material" name="material" type="text">
                        <label for="material">Материал</label>
                    </div>

                    <div class="input-field col s12 l12">
                        <textarea id="note" class="materialize-textarea" name="note">{{ $note }}</textarea>
                        <label for="note">Примечание</label>
                    </div>

                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn pink">{{ $submitText }}</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
