@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <p>List</p>
        {{ $locations->links() }}

    </div>
@endsection
