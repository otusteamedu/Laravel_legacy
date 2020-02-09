@extends('layouts.app')
@section('breadcrumbs', '')

@section("content")
    <div class="row no-gutters">
        <div class="col-12">
            <div class="card-deck mb-3 text-center">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h3 class="my-0 font-weight-normal">Создать клад</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">Чек-лист возможностей</h5>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Приступить</button>
                </div>
            </div>

            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h3 class="my-0 font-weight-normal">Найти клад</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title pricing-card-title">Чек-лист возможностей</h5>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Приступить</button>
                </div>
            </div>
        </div>
        </div>
    </div>

    <section class="counts section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>232</span>
                        <p>Участников</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>521</span>
                        <p>Активных кладов</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>1,463</span>
                        <p>Кладов найдено</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="count-box">
                        <span>15</span>
                        <p>Регионов</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
@stop
