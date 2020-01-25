@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Редактирование записи</h4>

            @component('components.pages.master.record.create-edit-form', ['button_text' => 'Сохранить'])@endcomponent
        </div>
    </main>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large pink">
            <i class="large material-icons">delete</i>
        </a>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('/js/pages/master/records/create_edit.js') }}"></script>
@endpush
