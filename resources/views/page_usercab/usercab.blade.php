<!-- Stored in resources/views/page_usercab/usercab.blade.php -->

@extends('common_layouts.common')

@section('h1', __('usercab.pageHead'))

@section('maincontent')
    <div>remote ip: {{Request::ip()}}</div>
    <hr/>
    @foreach (Request::toArray() as $k => $v)
        <div>{{$loop->index}}: {{$k}}: {{$v}}</div>
    @endforeach
@endsection
