@extends('crm.layouts.nav_default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Личный кабинет</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Вы в личном кабинете!

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
