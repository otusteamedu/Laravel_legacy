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
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('project_id', 'Проект (магазин)') }}
            {{ Form::select('project_id', $projects->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('description', 'Описание предложения') }}
            {{ Form::textarea('description', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('teaser_image', 'Путь до тизерного изображения') }}
            {{ Form::text('teaser_image', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('expiration_date', 'Дата окончания предложения') }}
            {{ Form::date('expiration_date', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lat', 'Широта') }}
            {{ Form::text('lat', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lon', 'Долгота') }}
            {{ Form::text('lon', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
