@extends('layouts.app')

@section('content')
<div class="container">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                    Dashboard
                    </p>
                </header>

                <div class="card-content">
                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
</div>
@endsection
