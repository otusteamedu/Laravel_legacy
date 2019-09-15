@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Distance</th>
                <th scope="col">Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($locations as $location)
                <tr>
                    <th scope="row">{{ $location->id }}</th>
                    <th>{{ link_to(route('backend.location.show', ['location' => $location->id]), $location->name) }}</th>
                    <th>{{ $location->distance }}</th>
                    <td>{{ $location->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $locations->links() }}

    </div>
@endsection
