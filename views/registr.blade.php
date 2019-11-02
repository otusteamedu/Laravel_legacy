@extends('layouts.site')
@section('content')
<form class="needs-validation" novalidate>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationCustom01">Имя</label>
            <input type="text" class="form-control" id="validationCustom01" placeholder="Имя" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom02">Фамилия</label>
            <input type="text" class="form-control" id="validationCustom02" placeholder="Фамилия" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationCustom03">Город</label>
            <input type="text" class="form-control" id="validationCustom03" placeholder="Город" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="validationCustomUsername">Имя пользователя</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                </div>
                <input type="text" class="form-control" id="validationCustomUsername" placeholder="Имя пользователя" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom04">Пароль</label>
            <input type="password" class="form-control" id="validationCustom04" placeholder="Пароль" required>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="validationCustom04">Повторение пароля</label>
            <input type="password" class="form-control" id="validationCustom04" placeholder="Повторение пароля" required>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Согласие на обработку персональных данных
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Сохранить</button>
</form>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection
