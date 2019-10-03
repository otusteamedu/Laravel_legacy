@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('public.account.elements.left_menu')
            <div class="col-md-8 pl-md-4">
                <div class="card">
                    <div class="card-header">Личная информация</div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" id="name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input type="tel" id="phone">
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
