@extends('web.layouts.main')
@section('body_class', 'body__dashboard__index')

@section('content')

    <div class="container">
        <h1>Dashboard</h1>
        <div class="card-deck mb-3 text-center">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Best Time</h4>
                </div>
                <div class="card-body">
                    <p class="display-4 my-0">38:25</p>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Best Pace</h4>
                </div>
                <div class="card-body">
                    <p class="display-4 my-0">03:38</p>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Workout</h4>
                </div>
                <div class="card-body">
                    <p class="display-4 my-0">Sep 3</p>
                </div>
            </div>

            <div class="container">
                <h2 class="my-4">Latest workouts</h2>
                <div class="table-responsive text-left">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Workout</th>
                            <th>Distance</th>
                            <th>Time</th>
                            <th>Pace</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>03.09.2019</td>
                            <td>5km</td>
                            <td>20:00</td>
                            <td>04:00</td>
                        </tr>
                        <tr>
                            <td>28.08.2019</td>
                            <td>5km</td>
                            <td>20:00</td>
                            <td>04:00</td>
                        </tr>
                        <tr>
                            <td>26.08.2019</td>
                            <td>5km</td>
                            <td>20:00</td>
                            <td>04:00</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

@endsection
