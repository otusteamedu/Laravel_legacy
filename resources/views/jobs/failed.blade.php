@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (!$failedJobs->count())
                <div class="alert alert-info" role="alert">
                    There isn't any job at the moment
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Connection</th>
                    <th>Queue</th>
                    <th>Failed At</th>
                    <th>Exception</th>
                    <th>Payload</th>
                    </thead>
                    <tbody>
                    @foreach($failedJobs as $failedJob)
                        <tr>
                            <td>{{ $failedJob->id }}</td>
                            <td>{{ $failedJob->connection }}</td>
                            <td>{{ $failedJob->queue }}</td>
                            <td>{{ $failedJob->failed_at }}</td>
                            <td>{{ $failedJob->exception }}</td>
                            <td>{{ $failedJob->payload }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
