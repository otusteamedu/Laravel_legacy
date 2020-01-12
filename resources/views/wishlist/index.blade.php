@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Списки желаний</h1>

        @include('blocks.message')

        @include('wishlist.partial.wishlist.create_form')

        <div class="row">

            <table class="table table-striped custab">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @include('wishlist.partial.wishlist.loop')

            </table>
        </div>
    </div>

@endsection
