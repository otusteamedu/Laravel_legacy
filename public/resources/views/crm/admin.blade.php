@extends('crm.layouts.nav_admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель управления</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Вы в панели управления администратора!


                        @isset($message)
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
