@extends('admin.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.admin'))

@section('style')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')



    <div class="position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.admin')}}
            </div>

            <div class="links">
                <a href="/">{{__('messages.main')}}</a>
                <a href="/register">{{__('messages.registration')}}</a>
                <a href="/user">{{__('messages.userPage')}}</a>
                <a href="/helps">{{__('messages.referenceInformation')}}</a>
            </div>
        </div>
    </div>

    <div class="content">

        <div class="title m-b-md form-align">

            <form method="post" id="usrForm">
                <span id="result" class="spanResult">{{$response}}</span><br>
                {{__('messages.functionTitle')}}
                    <div class="form-group col-md-6 max-width">
                        <label for="input">{{__('messages.functionName')}}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('messages.functionName')}}">
                    </div>
                    <div class="form-group col-md-6 max-width">
                        <label for="input">{{__('messages.functionSubject')}}</label>
                        <input type="text" class="form-control" id="function" name="function" placeholder="{{__('messages.functionSubject')}}">
                    </div>
                    <div class="form-group col-md-6 max-width">
                        <label for="input">{{__('messages.functionDescription')}}</label>
                        <textarea class="form-control"  id="description" name="description" rows="5">{{__('messages.functionDescription')}}</textarea>
                    </div>
                <button type="submit" class="btn btn-primary button-reg">{{__('messages.functionButton')}}</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>


        </div>

    </div>

@endsection