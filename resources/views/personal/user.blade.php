@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/726x400" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Адаманов Павел</h5>
                        <p class="card-text">Делай нормально и будет нормально</p>
                        <div>
                            <div>Вовлеченность</div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <div>Популярность</div>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
