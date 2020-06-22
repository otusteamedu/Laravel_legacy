@php
    if (isset($offer)){
        $name = $offer->name;
        $description = $offer->description;
        $teaser_image = $offer->teaser_image;
        $expiration_date = $offer->expiration_date;
        $lat = $offer->lat;
        $lon = $offer->lon;
    }else{
        $name = '';
        $description = '';
        $teaser_image = '';
        $expiration_date = '';
        $lat = '';
        $lon = '';
    }
@endphp

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('city_id', 'Город действия предложения') }}
            {{ Form::select('city_id', $cities->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Наименование предложения') }}
            {{ Form::text('name', $name ?? '', array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('category_id', 'Категория') }}
            {{ Form::select('category_id', $categories->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('description', 'Описание предложения') }}
            {{ Form::textarea('description', $description, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('project_id', 'Проект (магазин)') }}
            {{ Form::select('project_id', $projects, null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('teaser_image', 'Логотип акции') }}
            {{ Form::file('teaser_image', null, array('class'=>'form-control-file')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('expiration_date', 'Дата окончания предложения') }}
            {{ Form::date('expiration_date', $expiration_date, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lat', 'Широта') }}
            {{ Form::text('lat', $lat, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lon', 'Долгота') }}
            {{ Form::text('lon', $lon, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
