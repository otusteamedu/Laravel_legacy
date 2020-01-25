@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Создание записи</h4>

            @component('components.pages.master.record.create-edit-form', ['button_text' => 'Создать'])@endcomponent
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ mix('/js/pages/master/users/create_edit.js') }}"></script>
@endpush
