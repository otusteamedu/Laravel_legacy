@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Workouts</h1>

        <div class="row my-3">
            <div class="col-12">
                <a class="btn btn-primary"
                   href="{{ route('backend.workout.create') }}"
                >Add new Workout</a>
            </div>
        </div>

        @if($workouts->count())
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Started</th>
                    <th scope="col">Duration</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($workouts as $workout)
                    <tr>
                        <th scope="row">{{ $workout->id }}</th>
                        <th>{{ link_to(route('backend.workout.edit', ['workout' => $workout->id]), $workout->name) }}</th>
                        <th>{{ $workout->distance }}</th>
                        <td>{{ $workout->started_at }}</td>
                        <td>{{ $workout->duration }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $workouts->links() }}
        @else
            <p>There are no records.</p>
        @endif

    </div>
@endsection
