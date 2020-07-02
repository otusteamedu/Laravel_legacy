@extends('emails.layout')

@section('content')
    {{ __('emails/users.balance.current') }}: <b>@moneyFormat($user->balance)</b>
@endsection
