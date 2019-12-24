@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Locations</h1>

        <div class="row my-3">
            <div class="col-12">
                <a class="btn btn-primary"
                   href="{{ route('backend.location.create') }}"
                >Add new Location</a>
            </div>
        </div>

        @if($locations->count())
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
                        <th>{{ link_to(route('backend.location.edit', ['location' => $location->id]), $location->name) }}</th>
                        <th>{{ $location->distance }}</th>
                        <td>{{ $location->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $locations->links() }}
        @else
            <p>There are no records.</p>
        @endif

    </div>
@endsection
