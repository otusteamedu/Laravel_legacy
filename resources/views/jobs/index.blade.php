@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (!$jobs->count())
                <div class="alert alert-info" role="alert">
                    There isn't any job at the moment
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Attempts</th>
                    <th>Queue</th>
                    <th>Created At</th>
                    <th>Available At</th>
                    <th>Reserved At</th>
                    <th>Payload</th>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->attempts }}</td>
                            <td>{{ $job->queue }}</td>
                            <td>{{ $job->created_at }}</td>
                            <td>{{ $job->available_at }}</td>
                            <td>{{ $job->reserved_at }}</td>
                            <td>{{ $job->payload }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
