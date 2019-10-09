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

            <div class="form-group col-md-6 max-width">
                {{__('messages.dataUserCaption')}} <br><br>

                {{__('messages.profileUserID')}} : {{$user->id}} <br>
                {{__('messages.profileUserName')}} : {{$user->name}} <br>
                {{__('messages.profileUserEmail')}} : {{$user->email}} <br>
                {{__('messages.profileUserEmailVerified')}} : {{$user->email_verified_at}} <br>
                {{__('messages.profileUserCreated')}} : {{$user->created_at}} <br>
                {{__('messages.profileUserUpdated')}} : {{$user->updated_at}} <br>
            </div>




        </div>

    </div>

@endsection