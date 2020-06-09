@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        <div class="card-body">
            <div class="mt-2">
                <div>{{ __('clients/show.field.id') }}: <b>{{ $client['id'] }}</b></div>
                <div>{{ __('clients/show.field.name') }}: <b>{{ $client['name'] }}</b></div>
                <div>{{ __('clients/show.field.email') }}: <b>{{ $client['email'] }}</b></div>
                <div>{{ __('clients/show.field.balance') }}: <b>@moneyFormat($client->balance)</b></div>

                @can('client.update', $client)
                    <p class="mt-2">
                        <a href="{{ route('clients.edit', ['client' => $client['id']]) }}" class="btn btn-primary">{{ __('clients/show.change') }}</a>
                    </p>
                @endcan
            </div>
        </div>
    </div>
@endsection
