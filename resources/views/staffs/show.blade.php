@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        <div class="card-body">
            <div class="mt-2">
                <div>{{ __('staffs/show.field.id') }}: <b>{{ $staff['id'] }}</b></div>
                <div>{{ __('staffs/show.field.name') }}: <b>{{ $staff['name'] }}</b></div>
                <div>{{ __('staffs/show.field.email') }}: <b>{{ $staff['email'] }}</b></div>

                @can('staff.update', $staff)
                    <p class="mt-2">
                        <a href="{{ route('staffs.edit', ['staff' => $staff['id']]) }}" class="btn btn-primary">{{ __('staffs/show.change') }}</a>
                    </p>
                @endcan
            </div>
        </div>
    </div>
@endsection
