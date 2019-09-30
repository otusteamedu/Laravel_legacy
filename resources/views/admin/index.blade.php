@extends('admin.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.admin'))

@section('style')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')



    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md main-title">
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
            <form method="post">
                {{__('messages.adminCreateRole')}}
                    <div class="form-group col-md-6 max-width">
                        <label for="inputEmail">{{__('messages.adminUpdateUser')}}</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="{{__('messages.adminUpdateUser')}}">
                    </div>
                    <div class="form-group col-md-6 max-width">
                        <label for="inputPassword1">{{__('messages.adminUpdateRole')}}</label>
                        <input type="text" class="form-control" id="role_id" name="role_id" placeholder="{{__('messages.adminUpdateRole')}}">
                    </div>
                <button type="submit" class="btn btn-primary button-reg">{{__('messages.singIn')}}</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>


        </div>

    </div>

@endsection