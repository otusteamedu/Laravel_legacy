@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('public.account.elements.left_menu')
            <div class="col-md-8 pl-md-4">
                <div class="card">
                    <div class="card-header">Избранные акции</div>
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
