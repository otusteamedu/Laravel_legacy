@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Списки желаний</h1>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if($errors->count())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
        @endif

        {{ Form::open(['url' => route('wishlists.store'), 'class'=>'form-inline']) }}
        {{ Form::input('text', 'name', '', ['class'=>'form-control', 'required']) }}
        {{ Form::submit('+ Add new whishlist', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        <div class="row">

            <table class="table table-striped custab">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($wishlists as $wishlist)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{route('wishlists.show', $wishlist->id)}}">{{$wishlist->name}}</a></td>
                        <td class="text-center">

                            {{ Form::open(['url' => route('wishlists.destroy', $wishlist->id)]) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('X', ['class' => 'btn btn-outline-secondary btn-sm']) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

@endsection
