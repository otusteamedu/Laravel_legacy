<?php
/**
 * @var \Illuminate\Support\Collection $clients
 * @var int $clientId
 */
?>

@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Создание записи</h4>

            @component('components.pages.master.record.create_edit_form',
                [
                    'button_text' => 'Создать',
                    'clients' => $clients,
                    'clientId' => $clientId
                ]
	        )@endcomponent
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ mix('/js/pages/master/records/create_edit.js') }}"></script>
@endpush
