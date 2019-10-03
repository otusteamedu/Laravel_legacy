@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @guest
                            Hello guest!
                        @else
                            You are logged in!
                        @endguest
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <div class="card">
                    <div class="card-header">5 самых привлекательных акций</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Apple</td>
                                    <td>235</td>
                                </tr>
                                <tr>
                                    <td>Amazon</td>
                                    <td>454</td>
                                </tr>
                                <tr>
                                    <td>Cisco</td>
                                    <td>634</td>
                                </tr>
                                <tr>
                                    <td>Uber</td>
                                    <td>34</td>
                                </tr>
                                <tr>
                                    <td>IBM</td>
                                    <td>543</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
