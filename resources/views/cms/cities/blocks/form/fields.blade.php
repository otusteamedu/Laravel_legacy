@php
    $countries = \App\Models\Country::all();
@endphp
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Название города') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('url', 'Страна') }}
            {{ Form::select('country_id', $countries->pluck('name', 'id')->toArray(), $countries->pluck('country_id')->toArray(), array('class'=>'form-control form-control')) }}
        </div>
    </div>
</div>
