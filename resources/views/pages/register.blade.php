@extends('pages.index')

@section('content')

    <div class="container">

        <div class="row">
         <div class="col s12 center-align">
            <h1>@lang('cf.register_header')</h1>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center-align">

<form>

    <div class="row">
        <div class="input-field col s6">
            <input id="name" type="text" class="validate">
            <label for="name">@lang('cf.register_name')</label>
        </div>
        <div class="input-field col s6">
            <input id="email" type="email" class="validate">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="password" type="password" class="validate">
            <label for="password">@lang('cf.register_pass')</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input id="date" type="text" class="datepicker">
            <label for="name">@lang('cf.register_date')</label>
        </div>
        <div class="input-field col s6 center-align">
            <a class="waves-effect waves-light btn-large">@lang('cf.enter')</a>
        </div>
    </div>




</form>


            </div>

        </div>
    </div>

@endsection

@push('scripts')

            document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, options);
            });
@endpush